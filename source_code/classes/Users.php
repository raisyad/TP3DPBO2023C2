<?php

include('config/db.php');

class Users extends DB
{
    function getUsersJoin()
    {
        $query = "SELECT * FROM user JOIN monitor ON user.monitor_id=monitor.monitor_id JOIN keyboard ON user.keyboard_id=keyboard.keyboard_id ORDER BY user.user_id";

        return $this->execute($query);
    }

    function getUsers()
    {
        $query = "SELECT * FROM user";
        return $this->execute($query);
    }

    function getUsersById($id)
    {
        $query = "SELECT * FROM user JOIN monitor ON user.monitor_id=monitor.monitor_id JOIN keyboard ON user.keyboard_id=keyboard.keyboard_id WHERE user_id=$id";
        return $this->execute($query);
    }

    function getUsersByMonitorId($id)
    {
        $query = "SELECT * FROM user WHERE monitor_id = $id";
        return $this->execute($query);
    }

    function getUsersByKeyboardId($id)
    {
        $query = "SELECT * FROM user WHERE keyboard_id = $id";
        return $this->execute($query);
    }

    function searchUsers($keyword)
    {
        $query = "SELECT * FROM user JOIN monitor ON user.monitor_id=monitor.monitor_id JOIN keyboard ON user.keyboard_id=keyboard.keyboard_id WHERE user_name LIKE '%".$keyword."%' OR no_pc LIKE '%".$keyword."%'";
        return $this->execute($query);
    }
    
    function filterUsersNewest()
    {
        // $query = "SELECT * FROM user ORDER BY user_id DESC";
        $query = "SELECT * FROM user JOIN monitor ON user.monitor_id=monitor.monitor_id JOIN keyboard ON user.keyboard_id=keyboard.keyboard_id ORDER BY user_id DESC";
        return $this->execute($query);
    }

    function filterUsersOldest()
    {
        // $query = "SELECT * FROM user ORDER BY user_id ASC";
        $query = "SELECT * FROM user JOIN monitor ON user.monitor_id=monitor.monitor_id JOIN keyboard ON user.keyboard_id=keyboard.keyboard_id ORDER BY user_id ASC";
        return $this->execute($query);
    }

    function filterUsersHighestBilling()
    {
        $query = "SELECT * FROM user JOIN monitor 
        ON user.monitor_id=monitor.monitor_id JOIN keyboard 
        ON user.keyboard_id=keyboard.keyboard_id 
        ORDER BY CAST(billing AS UNSIGNED) DESC";

        // $query = "SELECT * FROM user ORDER BY user_id ASC";
        return $this->execute($query);
    }

    function addUsers($data, $file)
    {
        $tmp_file = $file['file_image']['tmp_name'];
        $user_foto = $file['file_image']['name'];
        
        $dir = "assets/images/$user_foto";
        move_uploaded_file($tmp_file, $dir);

        

        $username_pc = $data['username_pc'];
        $password_pc = $data['password_pc'];
        $user_name = $data['user_name'];
        $billing = $data['billing'];
        $no_pc = $data['no_pc'];
        $monitor_id = $data['monitor_id'];
        $keyboard_id = $data['keyboard_id'];

        $query = "INSERT INTO user VALUES('','$username_pc', '$password_pc', '$user_name', '$user_foto', '$billing', '$no_pc', '$monitor_id', '$keyboard_id')";
        // var_dump($this->executeAffected($query));
        // die();

        return $this->executeAffected($query);
    }

    function updateUsers($id, $data, $file, $img)
    {
        $tmp_file = $file['file_image']['tmp_name'];
        $user_foto = $file['file_image']['name'];
        
        if ($user_foto == "") {
            $user_foto = $img;
        }

        $dir = "assets/images/$user_foto";
        move_uploaded_file($tmp_file, $dir);

        $username_pc = $data['username_pc'];
        $password_pc = $data['password_pc'];
        $user_name = $data['user_name'];
        $billing = $data['billing'];
        $no_pc = $data['no_pc'];
        $monitor_id = $data['monitor_id'];
        $keyboard_id = $data['keyboard_id'];
        

        $query = "UPDATE user SET username_pc = '$username_pc', password_pc = '$password_pc', 
            user_name = '$user_name', user_pict = '$user_foto', billing = '$billing', 
            monitor_id = '$monitor_id', keyboard_id = '$keyboard_id' WHERE user_id = '$id'";
        
        return $this->executeAffected($query);
    }

    function deleteUsers($id)
    {
        $query = "DELETE FROM user WHERE user_id = $id";
        return $this->executeAffected($query);
    }
}
