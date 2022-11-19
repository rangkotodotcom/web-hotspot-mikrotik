<?php

include 'conf/conn.php';

$nama = htmlspecialchars(ucwords(@$_POST['nama']));
$nisn_nip = htmlspecialchars(@$_POST['nisn_nip']);
$email = htmlspecialchars(@$_POST['email']);
$pass = @$_POST['pass'];
$password = password_hash($pass, PASSWORD_DEFAULT);
$level = 'user';
$status = 0;
$jumlah_max_akun = '1';
$tanggal_daftar = time();

if (isset($_POST['registrasi'])) {
  $cek_email = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' "));

  if ($cek_email < 1) {
    $query = mysqli_query($conn, "INSERT INTO user VALUES('', '$nama', '$nisn_nip', '$email', '$password', '$level', '$status', '$jumlah_max_akun', '$tanggal_daftar') ");

    if ($query) {
      $from = "Admin Internet SMAN 1 2x11 ENAM LINGKUNG<admin@hotspot.sman12x11el.sch.id>";
      $to = $email;
      $subject = "Verifikasi Akun Email";
      $message = file_get_contents(__DIR__ . '/pesan_verifikasi.html');
      $message = str_replace("%email%", base64_encode($email), $message);
      $headers = 'MIME-Version: 1.0' . "\r\n";

      $lf = strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' ? "\r\n" : "\n";

      $headers .= "From: $from" . $lf;
      $headers .= "Date: " . date('r') . $lf;
      $headers .= "X-Mailer: PHP" . $lf;
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      $mail = mail($to, $subject, $message, $headers);
      if ($mail) {
        echo "<div class='alert' data-flashdata='Registrasi Akun Berhasil'></div>";
      }
    } else {
      echo "<div class='alert' data-flashdata='Registrasi Akun Gagal'></div>";
    }
  } else {
    echo "<div class='alert' data-flashdata='Email Sudah Terdaftar'></div>";
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

  <title>Registrasi - Hotspot SMAN 1 2x11 Enam Lingkung</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">

  <!-- Icon -->
  <link rel="icon" type="img/png" href="img/icon.png">

</head>

<body class="bg-image">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrasi Akun</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="fullName" name="nama" class="form-control" placeholder="Nama Lengkap" required="required" autofocus="autofocus">
              <label for="fullName">Nama Lengkap</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="number" id="nisn_nip" name="nisn_nip" class="form-control" placeholder="Nisn / Nip" required="required">
              <label for="nisn_nip">NISN / NIP</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Alamat Email" required="required">
              <label for="inputEmail">Alamat Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" name="registrasi" class="btn btn-primary btn-block">Registrasi</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" style="color:lightcyan" href="login.php">Login</a>
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