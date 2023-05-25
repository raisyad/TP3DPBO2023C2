<?php 

    include('config/db.php');
    include('classes/DB.php');
    include('classes/Template.php');
    include('classes/Users.php');
    include('classes/Monitor.php');
    include('classes/Keyboard.php');

    $monitor = new Monitor($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $keyboard = new Keyboard($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $users = new Users($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $tmp_image = new Users($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $monitor->open();
    $keyboard->open();
    $users->open();
    $tmp_image->open();

    // VAR UNTUK SHOW MONITOR DAN KEYBOARD
    $monitor_options = null;
    $keyboard_options = null;

    // VAR UNTUK EDIT TAPI JADI GLOBAL
    $img_edit = ""; $nim_edit = "";
    $usernamepc_edit = ""; $passwordpc_edit = "";
    $username_edit = ""; $billing_edit = "";
    $nopc_edit = "";
    $monitor_edit = ""; $keyboard_edit = "";
    $btn_title = "";

    $view_form = new Template('templates/skintambah.html');
    if (!isset($_GET['edit'])) {
    
        if (isset($_POST['submit'])) {
            if ($users->addUsers($_POST, $_FILES) > 0) {
                echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = 'tambah.php';
                </script>
                ";
            }
        }
        
        // Connect to Tabel Divisi
        
        $monitor->getMonitor();
    
        // Looping for Shows the data 
        while ($row = $monitor->getResult()) {
            $monitor_options .= "<option value=". $row['monitor_id']. ">" . $row['monitor_spesification'] . "</option>";
        }
    
    
        // Connect to Tabel Jabatan
        
        $keyboard->getKeyboard();
    
        // Looping for shows the data
        while($row = $keyboard->getResult()) {
            $keyboard_options .= "<option value=". $row['keyboard_id']. ">" . $row['keyboard_spesification'] . "</option>";
        }
        $btn_title = "Tambah Data";
    } else if (isset($_GET['edit'])) {
        $_ID = $_GET['edit'];
        $tmp_image->getUsers();
        $tmp_image->getUsersById($_ID);
        $temp_fix = $tmp_image->getResult();
        $temp_img = $temp_fix['user_pict'];
        // $temp_data = $tmp_image->getPengurusById($_ID);
        // $image_temp_edit = $temp_data->getResult();
        if (isset($_POST['submit'])) {
            if ($users->updateUsers($_ID, $_POST, $_FILES, $temp_img) > 0) {
                echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data gagal diubah!');
                    document.location.href = 'tambah.php';
                </script>
                ";
            }
        }
        // var_dump($_ID);
        // die();
        $users->getUsersById($_ID);

        $row = $users->getResult();
        $usernamepc_edit = $row['username_pc'];
        $passwordpc_edit = $row['password_pc'];
        $username_edit = $row['user_name'];
        $img_edit = $row['user_pict'];
        $billing_edit = $row['billing'];
        $nopc_edit = $row['no_pc'];
        $monitor_edit = $row['monitor_id'];
        $keyboard_edit = $row['keyboard_id'];

        // $nim_edit = $row['pengurus_nim'];
        // $nama_edit = $row['pengurus_nama'];
        // $semester_edit = $row['pengurus_semester'];
        
        
        // $tmp_file = $file['file_image']['tmp_name'];
        // $users_foto = $file['file_image']['name'];


        $monitor->getMonitor();
    
        // Looping for Shows the data 
        while ($row = $monitor->getResult()) {
            $select = ($row['monitor_id'] == $monitor_edit) ? 'selected' : "";
            $monitor_options .= "<option value=". $row['monitor_id']. " . $select . >" . $row['monitor_spesification'] . "</option>";
        }
    
    
        // Connect to Tabel Jabatan
        
        $keyboard->getKeyboard();
    
        // Looping for shows the data
        while($row = $keyboard->getResult()) {
            $select = ($row['keyboard_id'] == $keyboard_edit) ? 'selected' : "";
            $keyboard_options .= "<option value=". $row['keyboard_id']. " . $select . >" . $row['keyboard_spesification'] . "</option>";
        }
        $btn_title = "Update Data";

    }

    $view_form->replace('IMAGE_DATA' , $img_edit);
    $view_form->replace('USERNAMEPC' , $usernamepc_edit);
    $view_form->replace('PASSWORDPC' , $passwordpc_edit);
    $view_form->replace('USER_NAME' , $username_edit);
    $view_form->replace('BILLING' , $billing_edit);
    $view_form->replace('NOPC' , $nopc_edit);
    $view_form->replace('MONITOR_OPTIONS', $monitor_options);
    $view_form->replace('KEYBOARD_OPTIONS', $keyboard_options);
    $view_form->replace('TITLE_BTN', $btn_title);
    $view_form->write();


    $users->close();
    $monitor->close();
    $keyboard->close();

?>