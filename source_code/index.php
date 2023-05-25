<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Monitor.php');
include('classes/Keyboard.php');
include('classes/Users.php');
include('classes/Template.php');

$listUsers = new Users($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listUsers->open();

if (isset($_POST['btn-cari'])) {
    $listUsers->searchUsers($_POST['cari']);
} else if (isset($_POST['btn-filteredusernew'])) {
    $listUsers->filterUsersNewest();
} else if (isset($_POST['btn-filtereduserold'])) {
    $listUsers->filterUsersOldest();
} else if (isset($_POST['btn-filteredhighestbilling'])) {
    $listUsers->filterUsersHighestBilling();
} else {
    $listUsers->getUsersJoin();
}

$data = null;

while ($row = $listUsers->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail card-classes">
        <a href="detail.php?id=' . $row['user_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['user_pict'] . '" class="card-img-top" alt="' . $row['user_pict'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0 name-classes">' . $row['user_name'] . ' - PC ' . $row['no_pc'] .'</p>
                <p class="card-text divisi-nama">' . $row['billing'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['monitor_spesification'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['keyboard_spesification'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$listUsers->close();
$home = new Template('templates/skin.html');
$home->replace('DATA_PENGURUS', $data);
$home->write();
