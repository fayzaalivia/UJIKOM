<!DOCTYPE html>
<html lang="en">
    <?php
session_start();
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/login.php');
} else {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];
    $id_petugas = $_SESSION['id_petugas'];
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include('../../assets/header.php') ?>
<body>

    <?php include('../../assets/menu.php') ?>
<div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Petugas</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                      <thead>
                        <div class="alert alert-success alert-dismissable">Selamat Datang <strong><?= $_SESSION['username'] ?></strong> anda Login Sebagai <strong><?= $_SESSION['level'] ?></strong></div>
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user-circle"></i><strong>Profil</strong>
                            </div>
                            <div class="card-body">
                                <div class="card col-md-auto">
                                    <div class="card-header">Username : <?= $username ?></div>
                                    <div class="card-header">Level : <?= $level ?></div>
                                    <div class="card-header">Id_Petugas : <?= $id_petugas ?></div>
                                </div>
                            </div>
                        </div>
                      </thead>
                    </table>
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
          
</body>
</html>