<?php

include('config.php');
include('classes/DB.php');
include('classes/Divisi.php');
include('classes/Team.php');
include('classes/Template.php');

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();

if (isset($_POST['btn-cari'])) {
    $team->searchTeam($_POST['cari']);
} else {
    $team->getTeam();
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($team->addTeam($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'team.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'team.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');
$link = "team";
$mainTitle = 'Team';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Team</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'team';

while ($div = $team->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_team'] . '</td>
    <td style="font-size: 22px;">
    <a href="team.php?id=' . $div['team_id'] . '" title="Edit data"><button type="button" class="btn btn-secondary">Pilih</button></a>
    <a href="team.php?id=' . $div['team_id'] . '" title="Edit Data" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal4" ><i class="bi bi-pencil-square text-warning"></i></a>
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
                    <form action="team.php?id=' . $div['team_id'] . '" method="post" id="form_edit">
                        <div class="form-group">
                            <label for="nama_team">Nama Team</label>
                            <input class="form-control" type="text" id="nama_team" name="nama_team" value="' . $div['nama_team'] . '" placeholder="Masukkan Nama Team" required>
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
        &nbsp;<a href="team.php?hapus=' . $div['team_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($team->updateTeam($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'team.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'team.php';
            </script>";
            }
        }

        $team->getTeamById($id);
        $row = $team->getResult();

        $dataUpdate = $row['nama_team'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($team->deleteTeam($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'team.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'team.php';
            </script>";
        }
    }
}
$ngelink = 'team.php';
$team->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_LINK', $link);
$view->replace('NGELINK', $ngelink);
$view->write();
