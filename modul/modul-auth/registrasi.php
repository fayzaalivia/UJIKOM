<?php
include('../../config/koneksi.php');
if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['telp'];
    $q = mysqli_query($cone, "INSERT INTO `masyarakat` (nik, nama, username, password, telp, verifikasi) VALUES ('$nik', '$nama', '$username', '$password', $telp, 0)");
    if ($q) {
        echo  '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                Registrasi Berhasil Tunggu verifikasi oleh admin
                </div>';
    }
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
<?php include('../../assets/header.php') ?>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3">
                <div class="form-group">
                <label>NIK</label>
                  <input name="nik" type="text" class="form-control form-control-lg" id="exampleInputUsername1">
                </div>
                <div class="form-group">
                <label>Nama Lengkap</label>
                  <input name="nama" type="text" class="form-control form-control-lg" id="exampleInputUsername1">
                </div>
                <div class="form-group">
                <label>Username</label>
                  <input name="username" type="text" class="form-control form-control-lg" id="exampleInputUsername1">
                </div>
                <div class="form-group">
                <label>Password</label>
                  <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                <label>Telp</label>
                  <input name="telp" type="text" class="form-control form-control-lg" id="exampleInputUsername1">
                </div>
                <div class="mt-3">
                  <button name="cek" type="submit" class="form-control btn btn-primary">Daftar</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  <span class="text text-success">Sudah punya akun?</span>Coba login <a href="login.php">disini</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php include('../../assets/footer.php') ?>
</body>
</html>