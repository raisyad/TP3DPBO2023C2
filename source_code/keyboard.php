<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Keyboard.php');
include('classes/Users.php');
include('classes/Template.php');

$keyboard = new Keyboard($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$keyboard->open();

$listUsers = new Users($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listUsers->open();
$listUsers->getUsersJoin();
$btn = 'Data Keyboard';

if (isset($_POST['btn-cari'])) {
    $keyboard->searchKeyboard($_POST['cari']);
} else if (isset($_POST['btn-filterednew'])) {
    $keyboard->filterKeyboardNewest($_POST['cari']);
} else if (isset($_POST['btn-filteredold'])) {
    $keyboard->filterKeyboardOldest($_POST['cari']);
} else if (isset($_POST['btn-filteredlowest'])) {
    $keyboard->filterKeyboardLowest($_POST['cari']);
} else {
    $keyboard->getKeyboard();
}

$view = new Template('templates/skintabel.html');
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($keyboard->addKeyboard($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'keyboard.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'keyboard.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$mainTitle = 'Keyboard';
$header = '<tr>
<th scope="row" class="text-icafe">No.</th>
<th scope="row" class="text-icafe">Nama Keyboard</th>
<th scope="row" class="text-icafe">Aksi</th>
<th scope="row" class="text-icafe">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-filter"></i>
        </a>

        <ul class="dropdown-menu">
            <li>
                <form method="post">
                    <button class="dropdown-item" type="submit" name="btn-filterednew">Newest</button>
                </form>
            </li>
            <li>
                <form method="post">
                    <button class="dropdown-item" type="submit" name="btn-filteredold">Oldest</button>
                </form>
            </li>
            <li>
                <form method="post">
                    <button class="dropdown-item" type="submit" name="btn-filteredlowest">Lowest</button>
                </form>
            </li>
        </ul>
    </div>
</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Keyboard';

while ($div = $keyboard->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['keyboard_spesification'] . '</td>
    <td style="font-size: 22px;" colspan="2">
        <a href="keyboard.php?id=' . $div['keyboard_id'] . '" title="Edit Data">
        <i class="bi bi-pencil-square text-warning"></i>
        </a>&nbsp;
        <a href="keyboard.php?hapus=' . $div['keyboard_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($keyboard->updateKeyboard($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'keyboard.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'keyboard.php';
            </script>";
            }
        }

        $keyboard->getKeyboardById($id);
        $row = $keyboard->getResult();

        $dataUpdate = $row['keyboard_spesification'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        $listUsers->getUsersByKeyboardId($id);
        $row = $listUsers->getResult();
        $used = false;
        if (is_array($row)) {
            foreach ($row as $data) {
                if ($row['keyboard_id'] === $id) {
                    $used = true;
                }
            }
        }

        if (!$used) {
            if ($keyboard->deleteKeyboard($id) > 0) {
                echo "<script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'keyboard.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'keyboard.php';
                </script>";
            }
        } else {
            echo "
            <script>
                alert('Data gagal dihapus, Data sedang dipakai oleh users !');
                document.location.href = 'keyboard.php';
            </script>"
            ;
        }
    }
}

$keyboard->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
