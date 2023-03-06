<?php
// SESSION
session_start();
include('../../config/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/login.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}
// CRUD
if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl = $_POST['tgl_pengaduan'];
    //upload
    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($cone, $q);
            if ($r) {
                move_uploaded_file($file_tmp, '../../assets/images/masyarakat/' . $foto);
            }
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($cone, $q);
    }
}

// hapus pengaduan
if (isset($_POST['hapus'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($id_pengaduan != '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
        $r = mysqli_query($cone, $q);
        $d = mysqli_fetch_object($r);
        unlink('../../assets/images/masyarakat/' . $d->foto);
    }
    $q = "DELETE FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
    $r = mysqli_query($cone, $q);
}

// rubah status pengaduan
if (isset($_POST['proses_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];
    $q = "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'";
    $r = mysqli_query($cone, $q);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">

<?php include('../../assets/header.php') ?>
<body>

    <?php include('../../assets/menu.php') ?>
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaduan</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                    <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                    <div class="card">
                        <div class="card-header">
                            <button data-toggle="modal" data-target="#modal-lg" class="btn btn-success">buat pengaduan&nbsp;<i class="fa fa-pen"></i></button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                 Buat Pengaduan
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="nik" value="">
                                           <div class="form-group">
                                                <label for="isi_laporan">Isi Laporan</label>
                                                <textarea name="isi_laporan" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                                                <input type="date" name="tgl_pengaduan" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                                <input type="submit" name="tambahPengaduan" value="simpan" class="btn btn-success">
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
                              <th>Tanggal Pengaduan</th>
                              <th>Nik</th>
                              <th>Isi Laporan</th>
                              <th>Foto</th>
                              <th>Status</th>
                              <th>Hapus</th>
                              <th>Proses Pengaduan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ($_SESSION['level'] == 'masyarakat') {
                                $q = "SELECT * FROM `pengaduan` WHERE `nik` = $nik";
                            } else {
                                $q = "SELECT * FROM `pengaduan`";
                            }
                            $r = mysqli_query($cone, $q);
                            $no = 1;
                            while ($d = mysqli_fetch_object($r)) {
                            ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->tgl_pengaduan ?></td>
                                <td><?= $d->nik ?></td>
                                <td><?= $d->isi_laporan ?></td>
                                <td><?php if ($d->foto == '') {
                                        echo '<img style="max-height:100px" class="img img-thumbnail" src="../../assets/images/no-foto.png">';
                                    } else {
                                        echo '<img style="max-height:100px" class="img img-thumbnail" src="../../assets/images/masyarakat/' . $d->foto . '">';
                                } ?>
                                </td>
                                <td><?= $d->status ?></td>
                                <td>
                                    <?php if ($_SESSION['level'] == 'petugas') { ?>
                                        <form action="" method="post"><input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>"><button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i>hapus</button></form>
                                    <?php } ?>
                                </td>
                                <td><?php if ($_SESSION['level'] == 'petugas') { ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>">
                                        <select class="form-control" name="status">
                                            <option value="0"> 0 </option>
                                            <option value="proses"> proses </option>
                                            <option value="selesai"> selesai </option>
                                        </select><br>
                                        <button type="submit" name="proses_pengaduan" class="btn btn-success form-control">ubah</button>
                                    </form>
                                    <?php } ?>
                                </td>     
                            </tr>
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