<?php

class Pembalap extends Team
{
    function getPembalapJoin()
    {
        $query = "SELECT * FROM pembalap JOIN divisi ON pembalap.divisi_id=divisi.divisi_id JOIN team ON pembalap.team_id=team.team_id ORDER BY pembalap.id";

        return $this->execute($query);
    }

    function getPembalap()
    {
        $query = "SELECT * FROM pembalap";
        return $this->execute($query);
    }

    function getPembalapById($id)
    {
        $query = "SELECT * FROM pembalap JOIN divisi ON pembalap.divisi_id=divisi.divisi_id JOIN team ON pembalap.team_id=team.team_id WHERE id=$id";
        return $this->execute($query);
    }

    function searchPembalap($keyword)
    {
        $query = "SELECT * FROM pembalap JOIN divisi ON pembalap.divisi_id=divisi.divisi_id JOIN team ON pembalap.team_id=team.team_id WHERE nama LIKE '%$keyword%' OR nama_divisi LIKE '%$keyword%' OR nama_team LIKE '%$keyword%' ORDER BY pembalap.id;";
        return $this->execute($query);
    }

    function filterPembalapasc()
    {
        $query = "SELECT * FROM pembalap JOIN divisi ON pembalap.divisi_id=divisi.divisi_id JOIN team ON pembalap.team_id=team.team_id ORDER BY nama";
        return $this->execute($query);
    }

    function filterPembalapdesc()
    {
        $query = "SELECT * FROM pembalap JOIN divisi ON pembalap.divisi_id=divisi.divisi_id JOIN team ON pembalap.team_id=team.team_id ORDER BY nama DESC";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $foto = $file['foto']['name'];
        $temp_foto = $file['foto']['tmp_name'];
        $folder = 'assets/images/' . $foto;
        $isMoved = move_uploaded_file($temp_foto, $folder);
        if (!$isMoved) {
            $foto = 'default.jpg';
        }
        $nama = $data['nama'];
        $asal_negara = $data['asal_negara'];
        $team = $data['team_id'];
        $divisi = $data['divisi_id'];
        

        $query = "INSERT INTO pembalap VALUES('', '$foto', '$nama', '$asal_negara', $team, $divisi);";

        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $foto = $file['foto']['name'];
        $temp_foto = $file['foto']['tmp_name'];
        $folder = 'assets/images/' . $foto;
        $isMoved = move_uploaded_file($temp_foto, $folder);
        if (!$isMoved) {
            $foto = 'default.jpg';
        }
        $nama = $data['nama'];
        $asal_negara = $data['asal_negara'];
        $team = $data['team_id'];
        $divisi = $data['divisi_id'];

        $query = "UPDATE pembalap SET
                foto='$foto',
                nama='$nama',
                asal_negara='$asal_negara',
                team_id=$team,
                divisi_id=$divisi
                
                WHERE id=$id;";

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM pembalap WHERE id=$id";
        return $this->executeAffected($query);
    }
}
