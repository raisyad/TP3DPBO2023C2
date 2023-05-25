<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Monitor.php');
include('classes/Keyboard.php');
include('classes/Users.php');
include('classes/Template.php');

$users = new Users($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$users->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $users->getUsersById($id);
        $row = $users->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['user_name'] . ' No. PC ' . $row['no_pc'] .'</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['user_pict'] . '" class="img-thumbnail bg-dark" alt="' . $row['user_pict'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card bg-dark px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Username PC</td>
                                    <td>:</td>
                                    <td>' . $row['username_pc'] . '</td>
                                </tr>
                                <tr>
                                    <td>Password PC</td>
                                    <td>:</td>
                                    <td>' . $row['password_pc'] . '</td>
                                </tr>
                                <tr>
                                    <td>Billing</td>
                                    <td>:</td>
                                    <td>' . $row['billing'] . '</td>
                                </tr>
                                <tr>
                                    <td>Monitor</td>
                                    <td>:</td>
                                    <td>' . $row['monitor_spesification'] . '</td>
                                </tr>
                                <tr>
                                    <td>Keyborad</td>
                                    <td>:</td>
                                    <td>' . $row['keyboard_spesification'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="form.php?edit=' . $row['user_id'] .'"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?del=' . $row['user_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    if ($id > 0) {
        if ($users->deleteUsers($id) > 0) {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}

$users->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENGURUS', $data);
$detail->write();
