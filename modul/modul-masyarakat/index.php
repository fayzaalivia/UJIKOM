<!DOCTYPE html>
<html lang="en">

<?php
// SESSION
session_start();
include('../../config/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/login.php');
}
// CRUD
if (isset($_POST['edit'])) {
    $status = $_POST['status'];
    $nik = $_POST['nik'];
    $q = mysqli_query($cone, "UPDATE `masyarakat` SET verifikasi = '$status' WHERE nik = '$nik'");
}

if (isset($_POST['hapus'])) {
    $username = $_POST['username'];
    $q = mysqli_query($cone, "DELETE FROM `masyarakat` WHERE username = '$username'");
}
if (isset($_POST['update'])) {
    $nikLama = $_POST['nikLama'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password = md5($_POST['password']);
    if ($password == '') {
        $q = mysqli_query($cone, "UPDATE `masyarakat` SET nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    } else {
        $q = mysqli_query($cone, "UPDATE `masyarakat` SET `password` = '$password', nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    }
}

?>

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
                <h4 class="card-title">Masyarakat</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-light">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nik</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Telp</th>
                          <th>Verifikasi</th>
                          <th>Hapus</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $q = mysqli_query($cone, "SELECT * FROM `masyarakat`");
                        $no = 1;
                        while ($d = mysqli_fetch_object($q)) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->nik ?></td>
                                <td><?= $d->nama ?></td>
                                <td><?= $d->username ?></td>
                                <td><?= $d->telp ?></td>
                                <td><?php if ($d->verifikasi == 0) {
                                    echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $d->nik . '"><input name="status" type="hidden" value="1"><button name="edit" type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button></form>';
                                } else {
                                    echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $d->nik . '"><input name="status" type="hidden" value="0"><button name="edit" type="submit" class="btn btn-info"><i class="fa fa-check"></i></button></form>';
                                } ?></td>
                                <td><button name="edit" data-bs-toggle="modal" data-bs-target="#modal-xl<?= $d->nik ?>" class="btn btn-success">edit</button></td>
                                <td>
                                    <form action="" method="post"><input type="hidden" name="username" value="<?= $d->username ?>"><button name="hapus" class="btn btn-danger">hapus</button></form>
                                </td>
                            </tr>
                      

                      <div class="modal fade" id="modal-xl<?= $d->nik ?>">
                        <div class="modal-dialog modal-xl<?= $d->nik ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <input type="hidden" name="nikLama" value="<?= $d->nik ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nik">Nik</label>
                                            <input class="form-control" type="text" name="nik" value="<?= $d->nik ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input class="form-control" type="text" name="nama" value="<?= $d->nama ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input class="form-control" type="text" name="username" value="<?= $d->username ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">New Password</label>
                                            <input class="form-control" type="password" name="password" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Telp</label>
                                            <input class="form-control" type="number" name="telp" value="<?= $d->nik ?>">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
                                            <button type="submit" name="update" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div></div>
                        <?php $no++;
                        }
                        ?>
                    </div>
                </tbody>
                </table>
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