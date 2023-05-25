<?php

class Monitor extends DB
{
    function getMonitor()
    {
        $query = "SELECT * FROM monitor";
        return $this->execute($query);
    }

    function getMonitorById($id)
    {
        $query = "SELECT * FROM monitor WHERE monitor_id=$id";
        return $this->execute($query);
    }

    function searchMonitor($keyword)
    {
        $query = "SELECT * FROM monitor WHERE monitor_spesification LIKE '%".$keyword."%'";
        return $this->execute($query);
    }

    function filterMonitorNewest()
    {
        $query = "SELECT * FROM monitor ORDER BY monitor_id DESC";
        return $this->execute($query);
    }

    function filterMonitorOldest()
    {
        $query = "SELECT * FROM monitor ORDER BY monitor_id ASC";
        return $this->execute($query);
    }

    function filterMonitorHighestHz()
    {
        // $query = "SELECT * FROM monitor ORDER BY monitor_id DESC";
        $query = "SELECT *, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(monitor_spesification, 'Hz', 1), ' - ', -1) AS UNSIGNED) AS hz_value
          FROM monitor
          ORDER BY hz_value DESC";
        return $this->execute($query);
    }

    function addMonitor($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO monitor VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateMonitor($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE monitor SET monitor_spesification = '$nama' WHERE monitor_id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteMonitor($id)
    {
        $query = "DELETE FROM monitor WHERE monitor_id = $id";
        return $this->executeAffected($query);
    }
}
