<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Monitor.php');
include('classes/Users.php');
include('classes/Template.php');

$monitor = new Monitor($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$monitor->open();

$listUsers = new Users($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listUsers->open();
$listUsers->getUsersJoin();

if (isset($_POST['btn-cari'])) {
    $monitor->searchMonitor($_POST['cari']);
} else if (isset($_POST['btn-filterednew'])) {
    $monitor->filterMonitorNewest($_POST['cari']);
} else if (isset($_POST['btn-filteredold'])) {
    $monitor->filterMonitorOldest($_POST['cari']);
} else if (isset($_POST['btn-filteredhighest'])) {
    $monitor->filterMonitorHighestHz($_POST['cari']);
} else {
    $monitor->getMonitor();
}

$view = new Template('templates/skintabel.html');

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($monitor->addMonitor($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'monitor.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'monitor.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}



$mainTitle = 'Monitor';
$header = '<tr>
<th scope="row" class="text-icafe">No.</th>
<th scope="row" class="text-icafe">Spesifikasi Monitor</th>
<th scope="row" class="text-icafe">Aksi</th>
<th scope="row" class="text-icafe">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-filter"></i>
        </a>

        <ul class="dropdown-menu fill">
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
                    <button class="dropdown-item" type="submit" name="btn-filteredhighest">Highest Hz</button>
                </form>
            </li>
        </ul>
    </div>
</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Monitor';

while ($div = $monitor->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['monitor_spesification'] . '</td>
    <td style="font-size: 22px;" colspan="2">
        <a href="monitor.php?id=' . $div['monitor_id'] . '" title="Edit Data">
        <i class="bi bi-pencil-square text-warning"></i>
        </a>&nbsp;
        <a href="monitor.php?hapus=' . $div['monitor_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($monitor->updateMonitor($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'monitor.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'monitor.php';
            </script>";
            }
        }

        $monitor->getMonitorById($id);
        $row = $monitor->getResult();

        $dataUpdate = $row['monitor_spesification'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        $listUsers->getUsersByMonitorId($id);
        $row = $listUsers->getResult();
        $used = false;
        if (is_array($row)) {
            foreach ($row as $data) {
                if ($row['monitor_id'] === $id) {
                    $used = true;
                }
            }
        }
        
        if (!$used) {
            if ($monitor->deleteMonitor($id) > 0) {
                echo "<script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'monitor.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'monitor.php';
                </script>";
            }
        } else {
            echo "
            <script>
                alert('Data gagal dihapus, Data sedang dipakai oleh users !');
                document.location.href = 'monitor.php';
            </script>"
            ;
        }
    }
}

$monitor->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
