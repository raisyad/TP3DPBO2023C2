<?php

class Keyboard extends DB
{
    function getKeyboard()
    {
        $query = "SELECT * FROM keyboard";
        return $this->execute($query);
    }

    function getKeyboardById($id)
    {
        $query = "SELECT * FROM keyboard WHERE keyboard_id=$id";
        return $this->execute($query);
    }

    function searchKeyboard($keyword)
    {
        $query = "SELECT * FROM keyboard WHERE keyboard_spesification LIKE '%".$keyword."%'";
        return $this->execute($query);
    }
    
    function filterKeyboardNewest()
    {
        $query = "SELECT * FROM keyboard ORDER BY keyboard_id DESC";
        return $this->execute($query);
    }

    function filterKeyboardOldest()
    {
        $query = "SELECT * FROM keyboard ORDER BY keyboard_id ASC";
        return $this->execute($query);
    }

    function filterKeyboardLowest()
    {
        $query = "SELECT * FROM keyboard
          ORDER BY CASE WHEN keyboard_spesification LIKE '%NonBacklight%' THEN 0 ELSE 1 END, keyboard_id DESC";
        return $this->execute($query);
    }

    function addKeyboard($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO keyboard VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateKeyboard($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE keyboard SET keyboard_spesification = '$nama' WHERE keyboard_id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteKeyboard($id)
    {
        $query = "DELETE FROM keyboard WHERE keyboard_id = $id";
        return $this->executeAffected($query);
    }
}
