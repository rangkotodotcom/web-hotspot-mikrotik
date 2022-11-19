<?php
session_start();

include 'conf/conn.php';

if (isset($_SESSION['email'])) {
  echo "<script>window.location='" . $url . "'</script>";
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");

  $cek_email = mysqli_num_rows($sql);
  $data = mysqli_fetch_assoc($sql);

  if ($cek_email > 0) {

    $password = $data['password'];

    if (password_verify($pass, $password)) {

      $status = $data['status'];

      if ($status == 1) {

        $_SESSION['nama'] = $data['nama'];
        $_SESSION['nisn_nip'] = $data['nisn_nip'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['tanggal_daftar'] = $data['tanggal_daftar'];

        echo "<script>window.location='" . $url . "'</script>";
      } else {
        echo "<div class='alert' data-flashdata='Email Belum Aktif'></div>";
      }
    } else {
      echo "<div class='alert' data-flashdata='Password Salah'></div>";
    }
  } else {
    echo "<div class='alert' data-flashdata='Email Tidak Terdaftar'></div>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - Hotspot SMAN 1 2x11 Enam Lingkung</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">

  <!-- Icon -->
  <link rel="icon" type="img/png" href="img/icon.png">

</head>

<body class="bg-image">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Alamat Email" required="required" autofocus="autofocus">
              <label for="inputEmail">Alamat Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" style="color:lightcyan" href="registrasi.php">Registrasi Akun</a>
          <a class="d-block small" style="color:lightcyan" href="reset_password.php">Lupa Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- sweetalert -->
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/myscript.js"></script>

</body>

</html>