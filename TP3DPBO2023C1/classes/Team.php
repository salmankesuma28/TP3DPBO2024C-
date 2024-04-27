<?php

class Team extends Divisi
{
    function getTeam()
    {
        $query = "SELECT * FROM team";
        return $this->execute($query);
    }

    function getTeamById($id)
    {
        $query = "SELECT * FROM team WHERE team_id=$id";
        return $this->execute($query);
    }

    function searchTeam($keyword)
    {
        $query = "SELECT * FROM team WHERE nama_team LIKE '%$keyword%'  ORDER BY team.team_id;";
        return $this->execute($query);
    }

    function addTeam($data)
    {
        $nama_team = $data['nama_team'];
        $query = "INSERT INTO team VALUES('', '$nama_team')";
        return $this->executeAffected($query);
    }

    function updateTeam($id, $data)
    {
        $nama_team = $data['nama_team'];
        $query = "UPDATE team SET nama_team='$nama_team' WHERE team_id=$id";
        return $this->executeAffected($query);
    }

    function deleteTeam($id)
    {
        $query = "DELETE FROM team WHERE team_id=$id";
        return $this->executeAffected($query);
    }
}
