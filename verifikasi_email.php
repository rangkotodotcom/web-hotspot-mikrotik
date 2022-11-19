<?php

include 'conf/conn.php';

$kode = base64_decode($_GET['kode']);

$sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$kode' ");
$data = mysqli_fetch_assoc($sql);
$password = $data['password'];

if (isset($_POST['verifikasi'])) {
    $pass = $_POST['password'];

    if (password_verify($pass, $password)) {
        $query = mysqli_query($conn, "UPDATE user SET status = '1' WHERE email = '$kode' ");

        if ($query) {
            echo "<div class='alert' data-flashdata='Verifikasi Berhasil'></div>";
        }
    } else {
        echo "<div class='alert' data-flashdata='Password Verifikasi Salah'></div>";
    }
}

if ($data['status'] == 0) {

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Verifikasi - Hotspot SMAN 1 2x11 Enam Lingkung</title>

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
                <div class="card-header">Verifikasi Email</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" name="email" class="form-control" value="<?= $data['email']; ?>" readonly>
                                <label for="inputEmail">Alamat Email</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                                <label for="inputPassword">Password</label>
                            </div>
                        </div>
                        <button type="submit" name="verifikasi" class="btn btn-primary btn-block">Verifikasi</button>
                    </form>
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

<?php } else {
    header('Location:login.php');
} ?>