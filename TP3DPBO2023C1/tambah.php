<?php

include('config.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Team.php');
include('classes/Pembalap.php');
include('classes/Template.php');

$pembalap = new Pembalap($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi = new Divisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team= new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$pembalap->open();
$divisi->open();
$team->open();

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

$dataDivisi = null;
$dataTeam = null;

if (isset($_POST['btn-save'])) {
    if ($pembalap->addData($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'index.php';
        </script>";
    }
}

$title = 'Tambah';

foreach ($divs as $div) {
    $dataDivisi .= '<option value="' . $div['divisi_id'] . '">' . $div['nama_divisi'] . '</option>';
}

foreach ($teams as $tim) {
    $dataTeam .= '<option value="' . $tim['team_id'] . '">' . $tim['nama_team'] . '</option>';
}

$pembalap->close();
$divisi->close();
$team->close();

$tambah = new Template('templates/skintambah.html');
$tambah->replace('DATA_TITLE', $title);
$tambah->replace('DATA_DIVISI', $dataDivisi);
$tambah->replace('DATA_TEAM', $dataTeam);
$tambah->write();
