<?php
// SESSION
session_start();
include('../../config/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/login.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    } else {
        $id_petugas = $_SESSION['id_petugas'];
    }
}
// tambah tanggapan
if (isset($_POST['tambah_tanggapan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $id_petugas = $_POST['id_petugas'];
    $tanggapan = $_POST['tanggapan'];
    $q = "INSERT INTO `tanggapan` (id_tanggapan, id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('','$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
    $r = mysqli_query($cone, $q);
}
// hapus tanggapan
if (isset($_POST['hapus'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($cone, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}
// update tanggapan
if (isset($_POST['ubah'])) {
    $id_tanggapan =  $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($cone, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<?php include('../../assets/header.php') ?>
<body>

    <?php include('../../assets/menu.php') ?>
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tanggapan</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                    <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                    <div class="card">
                        <div class="card-header">
                            <button data-toggle="modal" data-target="#modal-lg" class="btn btn-success">buat Tanggapan&nbsp;<i class="fa fa-pen"></i></button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                 Buat Tanggapan
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <label for="id_pengaduan"> Pilih Id Pengaduan</label>
                                        <select name="id_pengaduan" class="form-control">
                                            <?php
                                            $q = "SELECT * FROM pengaduan JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik";
                                            $r = mysqli_query($cone, $q);
                                            while ($d = mysqli_fetch_object($r)) { ?>
                                                <option value="<?= $d->id_pengaduan ?>"><?= $d->id_pengaduan . '|' . $d->nik . '|' . $d->nama ?></option>
                                            <?php } ?>
                                        </select>
                                        <br>
                                        <label for="tgl_tanggapan">Tanggal</label>
                                        <input class="form-control" type="date" name="tgl_tanggapan">
                                        <label for="tanggapan">Beri Tanggapan</label>
                                        <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"></textarea>
                                        <label for="id_petugas">ID Petugas</label>
                                        <input name="id_petugas" type="text" class="form-control" value="<?= $id_petugas ?>" readonly>
                                        <br>
                                        <button name="tambah_tanggapan" type="submit" class="btn btn-info">simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                        <table id="dataTablesNya" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Id Pengaduan</th>
                            <th>tanggal Tanggapan</th>
                            <th>Isi Tanggapan</th>
                            <th>Petugas</th>
                            <th>hapus</th>
                            <th>edit</th>
                        </tr>
                          </thead>
                          <tbody>
                          <?php
                                $no = 1;
                                $q = "SELECT * FROM `tanggapan` JOIN `petugas` JOIN `pengaduan`
                             WHERE tanggapan.id_petugas = petugas.id_petugas 
                             AND tanggapan.id_pengaduan = pengaduan.id_pengaduan";
                                $r = mysqli_query($cone, $q);
                                while ($d = mysqli_fetch_object($r)) { ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?= $d->id_pengaduan ?>
                                        </td>
                                        <td>
                                            <?= $d->tgl_tanggapan ?>
                                        </td>
                                        <td>
                                            <?= $d->tanggapan ?>
                                        </td>
                                        <td>
                                            <?= $d->nama_petugas ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <form action="" method="post"><input type="hidden" name="id_tanggapan" value="<?= $d->id_tanggapan ?>"><button name="hapus" class="btn btn-danger" type="submit">hapus</button></form>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg<?= $d->id_pengaduan ?>" class="btn btn-success" name="ubah"><i class="fa fa-pen"></i>Edit</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-lg<?= $d->id_pengaduan ?>">
                                        <div class="modal-dialog modal-lg<?= $d->id_pengaduan ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Edit Pengaduan
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input class="form-control" name="id_tanggapan" type="hidden" value="<?= $d->id_tanggapan ?>">
                                                        <label for="id_pengaduan">ID Pengaduan</label><br>
                                                        <select class="form-control" name="id_pengaduan">
                                                            <?php
                                                            $result = mysqli_query($cone, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik");
                                                            while ($data = mysqli_fetch_object($result)) { ?>
                                                                <option value="<?= $data->id_pengaduan ?>" <?php if ($d->id_pengaduan == $data->id_pengaduan) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $data->id_pengaduan . '|' . $data->nik . '|' . $data->nama ?></option>
                                                            <?php } ?>
                                                        </select><br>
                                                        <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                                        <input class="form-control" name="tgl_tanggapan" class="form-control" type="date" name="" value="<?= $d->tgl_tanggapan ?>">
                                                        <label for="tanggapan">Tanggapan</label>
                                                        <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"><?= $d->tanggapan ?></textarea>
                                                        <br>
                                                        <button name="ubahTanggapan" type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php $no++;
                            } ?>
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.instagram.com/enhypen/" target="_blank">Fayza Alivia</a> 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Klik <a href="https://www.instagram.com/enhypen/" target="_blank">Fayza Alivia </a>Untuk Tahu lebih lanjutnya</span>
    </div>
</footer>

          <script src="../../assets/fontawesome/js/all.min.js"></script>
          <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>