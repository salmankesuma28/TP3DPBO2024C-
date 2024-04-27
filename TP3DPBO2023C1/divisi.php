<?php

include('config.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Template.php');

$divisi = new Divisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$divisi->open();

if (isset($_POST['btn-cari'])) {
    $divisi->searchDivisi($_POST['cari']);
} else {
    $divisi->getDivisi();
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($divisi->addDivisi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'divisi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'divisi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');
$link = "divisi";

$mainTitle = 'Divisi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Divisi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'divisi';
$ngelink = 'divisi.php';

while ($div = $divisi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_divisi'] . '</td>
    <td style="font-size: 22px;">
    <a href="divisi.php?id=' . $div['divisi_id'] . '" title="Edit data"><button type="button" class="btn btn-secondary">Pilih</button></a>
    <a href="divisi.php?id=' . $div['divisi_id'] . '" title="Edit Data" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal4" ><i class="bi bi-pencil-square text-warning"></i></a>
    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Data DATA_MAIN_TITLE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="divisi.php?id=' . $div['divisi_id'] . '" method="post" id="form_edit">
                        <div class="form-group">
                            <label for="nama_divisi">Nama Divisi</label>
                            <input class="form-control" type="text" id="nama_divisi" name="nama_divisi" value="' . $div['nama_divisi'] . '" placeholder="Masukkan Nama Divisi" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info text-white" name="submit" id="submit" form="form_edit">DATA_BUTTON</button>
                </div>
            </div>
        </div>
    </div>
    &nbsp;<a href="divisi.php?hapus=' . $div['divisi_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
</td>

    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($divisi->updateDivisi($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'divisi.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'divisi.php';
            </script>";
            }
        }

        $divisi->getDivisiById($id);
        $row = $divisi->getResult();

        $dataUpdate = $row['nama_divisi'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($divisi->deleteDivisi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'divisi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'divisi.php';
            </script>";
        }
    }
}



$divisi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_LINK', $link);
$view->replace('NGELINK', $ngelink);
$view->write();
