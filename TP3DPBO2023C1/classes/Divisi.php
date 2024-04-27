<?php

class Divisi extends DB
{
    function getDivisi()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function getDivisiById($id)
    {
        $query = "SELECT * FROM divisi WHERE divisi_id=$id";
        return $this->execute($query);
    }

    function searchDivisi($keyword)
    {
        $query = "SELECT * FROM divisi WHERE nama_divisi LIKE '%$keyword%'  ORDER BY divisi.divisi_id;";
        return $this->execute($query);
    }

    function addDivisi($data)
    {
        $nama_divisi = $data['nama_divisi'];
        $query = "INSERT INTO divisi VALUES('', '$nama_divisi')";
        return $this->executeAffected($query);
    }

    function updateDivisi($id, $data)
    {
        $nama_divisi = $data['nama_divisi'];
        $query = "UPDATE divisi SET nama_divisi='$nama_divisi' WHERE divisi_id=$id";
        return $this->executeAffected($query);
    }

    function deleteDivisi($id)
    {
        $query = "DELETE FROM divisi WHERE divisi_id=$id";
        return $this->executeAffected($query);
    }
}
