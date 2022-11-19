<?php

include 'conf/conn.php';

$email = htmlspecialchars(@$_POST['email']);

if (isset($_POST['reset'])) {
  $cek_email = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' "));

  if ($cek_email > 0) {

    $from = "Admin Internet SMAN 1 2x11 ENAM LINGKUNG<admin@hotspot.sman12x11el.sch.id>";
    $to = $email;
    $subject = "Reset Password";
    $message = file_get_contents(__DIR__ . '/pesan_reset_password.html');
    $message = str_replace("%email%", base64_encode($email), $message);
    $headers = 'MIME-Version: 1.0' . "\r\n";

    $lf = strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' ? "\r\n" : "\n";

    $headers .= "From: $from" . $lf;
    $headers .= "Date: " . date('r') . $lf;
    $headers .= "X-Mailer: PHP" . $lf;
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $mail = mail($to, $subject, $message, $headers);
    if ($mail) {
      echo "<div class='alert' data-flashdata='Permintaan Reset Password'></div>";
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

  <title>Reset Password - Hotspot SMAN 1 2x11 Enam Lingkung</title>

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
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Lupa Password Akunmu?</h4>
          <p>Masukan email kamu dan kami akan mengirimkan langkah-langkah untuk mereset password.</p>
        </div>
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Masukan Email" required="required" autofocus="autofocus">
              <label for="inputEmail">Masukan Email</label>
            </div>
          </div>
          <button type="submit" name="reset" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" style="color:lightcyan" href="registrasi.php">Registrasi Akun</a>
          <a class="d-block small" style="color:lightcyan" href="login.php">Login</a>
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