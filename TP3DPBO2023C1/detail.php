<?php

include('config.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Team.php');
include('classes/Pembalap.php');
include('classes/Template.php');

$pembalap = new Pembalap($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pembalap->open();

$data = nulL;

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($pembalap->deleteData($id) > 0) {
            echo "
					<script>
						alert('Data berhasil dihapus!');
						document.location.href = 'index.php';
					</script>
				";
        } else {
            echo "
					<script>
						alert('Data gagal dihapus!');
						document.location.href = 'index.php';
					</script>
				";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pembalap->getPembalapById($id);
        $row = $pembalap->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <img src="assets/images/' . $row['foto'] . '" class="img-thumbnail" alt="' . $row['foto'] . '" style="height: 200px; width: 200px;">
                    </div>
                    <div class="card px-3">
                            <table border="0" class="text-start small-card">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>' . $row['nama'] . '</td>
                            </tr>
                            <tr>
                                <td>Asal Negara</td>
                                <td>:</td>
                                <td>' . $row['asal_negara'] . '</td>
                            </tr>
                            <tr>
                                <td>Nama Team</td>
                                <td>:</td>
                                <td>' . $row['nama_team'] . '</td>
                            </tr>
                            <tr>
                                <td>Divisi</td>
                                <td>:</td>
                                <td>' . $row['nama_divisi'] . '</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <!-- Konten lainnya -->
                </div>
            </div>
        </div>
        <div class="card-footer text-end text-center">
            <a href="ubah.php?id=' . $row['id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
            <a href="detail.php?hapus=' . $row['id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
        </div>';



    }
}

$pembalap->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PEMBALAP', $data);
$detail->write();
