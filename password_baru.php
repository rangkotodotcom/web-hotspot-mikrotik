<?php

include 'conf/conn.php';
include 'functions.php';

$kode = base64_decode($_GET['kode']);
$pass = kodeAcak(8);
$password = password_hash($pass, PASSWORD_DEFAULT);

$query = mysqli_query($conn, "UPDATE user SET password = '$password' WHERE email = '$kode' ");
if ($query) {
    echo "<div class='pesan' data-flashdata='" . $pass . "'></div>";
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Baru</title>
</head>

<body class="bg-image">
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- sweetalert -->
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        const pesan = $('.pesan').data('flashdata');

        if (pesan) {
            Swal.fire({
                title: 'Reset Password Berhasil',
                text: 'Password baru anda adalah ' + pesan,
                type: 'info'
            }).then((result) => {
                window.location.href = 'login.php';
            });
        }
    </script>
</body>

</html>