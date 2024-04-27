<?php

include('config.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Team.php');
include('classes/Pembalap.php');

include('classes/Template.php');

$listPembalap = new Pembalap($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listPembalap->open();
$listPembalap->getPembalapJoin();

if (isset($_POST['btn-cari'])) {
    $listPembalap->searchPembalap($_POST['cari']);
}else if(isset($_POST['btn-filter'])){
    $listPembalap->filterPembalapasc();
} else if(isset($_POST['btn-filter-desc'])){
    $listPembalap->filterPembalapdesc();
} 
else {
    $listPembalap->getPembalapJoin();
}

$data = null;

while ($row = $listPembalap->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pembalap-thumbnail">
        <a href="detail.php?id=' . $row['id'] . '">
            <div class="row pembalap justify-content-center">
                <img src="assets/images/' . $row['foto'] . '" class="card-img-top" alt="' . $row['foto'] . '" style="height: 200px; width: 200px;">
            </div>
            <div class="card-body">
                <p class="card-text pembalap-nama my-0">' . $row['nama'] . '</p>
                <p class="card-text divisi-nama">' . $row['nama_team'] . '</p>
                <p class="card-text team-nama my-0">' . $row['nama_divisi'] . '</p>
                <a href="detail.php?id=' . $row['id'] . '" class="mt-2 btn btn-secondary">detail</a>
            </div>
        </a>
    </div>    
    </div>';
}

$listPembalap->close();
$home = new Template('templates/skin.html');
$home->replace('DATA_PEMBALAP', $data);
$home->write();
