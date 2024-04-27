<?php

include('config.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Team.php');
include('classes/Pembalap.php');
include('classes/Template.php');

$pembalap = new Pembalap($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi = new Divisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$pembalap->open();
$divisi->open();
$team->open();

if (isset($_POST['btn-save'])) {
    $id = $_GET['id'];
    if ($pembalap->updateData($id, $_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php';
        </script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pembalap->getPembalapById($id);
        $row = $pembalap->getResult();

        $pembalap->getPembalapById($id);
        $divisi->getDivisi();
        $team->getTeam();

        $divs = [];
        while ($div = $divisi->getResult()) {
            $divs[] = $div;
        }

        $teams = [];
        while ($tim = $team->getResult()) {
            $teams[] = $tim;
        }

        $dataPembalap = [];
        $dataDivisi = null;
        $dataTeam = null;

        foreach ($divs as $div) {
            $dataDivisi .= '<option value="' . $div['divisi_id'] . '">' . $div['nama_divisi'] . '</option>';
        }

        foreach ($teams as $tim) {
            $dataTeam .= '<option value="' . $tim['team_id'] . '">' . $tim['nama_team'] . '</option>';
        }

        $title = 'Ubah';

        $dataPembalap[0] = $row['nama'];
        $dataPembalap[1] = $row['asal_negara'];
        $dataPembalap[2] = $row['team_id'];
        $dataPembalap[3] = $row['divisi_id'];
        
    }
}

$pembalap->close();
$divisi->close();
$team->close();

$tambah = new Template('templates/skintambah.html');
$tambah->replace('DATA_TITLE', $title);
$tambah->replace('DATA_DIVISI', $dataDivisi);
$tambah->replace('DATA_TEAM', $dataTeam);
$tambah->replace('DATA_NAMA', $dataPembalap[0]);
$tambah->replace('DATA_NEGARA', $dataPembalap[1]);
$tambah->replace('DATA_TIM', $dataPembalap[2]);
$tambah->replace('DATA_DIV', $dataPembalap[3]);
$tambah->write();
