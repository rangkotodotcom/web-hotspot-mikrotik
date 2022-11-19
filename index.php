<?php
session_start();

include 'conf/conn.php';
include 'functions.php';

$sql_mikrotik = mysqli_query($conn, "SELECT * FROM admin_mikrotik");
$result_mikrotik = mysqli_fetch_assoc($sql_mikrotik);

require('conf/routeros_api.class.php');
$API = new RouterosAPI();
$API->debug = false;

$API->connect($result_mikrotik['ip_mikrotik'], $result_mikrotik['username'], $result_mikrotik['pass_m']);

if (!isset($_SESSION['email'])) {
  echo "<script>window.location.href = 'login.php'</script>";
}

$sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$_SESSION[email]' ");


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $_SESSION['nama'];  ?> - Hotspot SMAN 1 2x11 Enam Lingkung</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <!-- Icon -->
  <link rel="icon" type="img/png" href="img/icon.png">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="<?= $url; ?>">Hotspot SMANSIC</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <!-- <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="?page=<?= base64_encode('profil'); ?>">Profil</a>
          <!-- <a class="dropdown-item" href="?page=<?= base64_encode('aktifitas'); ?>">Log Aktifitas</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= $url; ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <?php

      $level = @$_SESSION['level'];
      $page = base64_decode(@$_GET['page']);
      $action = base64_decode(@$_GET['action']);

      if ($level == 'admin') {

        ?>

        <li class="nav-item">
          <a class="nav-link" href="?page=<?= base64_encode('daftar_user'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Daftar User</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-wifi"></i>
            <span>Hotspot</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Hotspot Screens:</h6>
            <a class="dropdown-item" href="?page=<?= base64_encode('data_akun'); ?>">Data Akun</a>
            <a class="dropdown-item" href="?page=<?= base64_encode('pengajuan_akun'); ?>">Pengajuan Akun</a>
            <!-- <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item" href="blank.html">Blank Page</a> -->
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=<?= base64_encode('mikrotik'); ?>">
            <i class="fas fa-fw fa-server"></i>
            <span>Mikrotik</span></a>
        </li>

      <?php } else { ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-wifi"></i>
            <span>Hotspot</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Hotspot Screens:</h6>
            <a class="dropdown-item" href="?page=<?= base64_encode('akun'); ?>">Akun Hotspot</a>
            <a class="dropdown-item" href="?page=<?= base64_encode('daftar_akun'); ?>">Registrasi Hotspot</a>
          </div>
        </li>

      <?php } ?>

    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <?php

        if ($page == 'profil') {
          include 'inc/profil.php';
        }

        if ($level == 'admin') {
          if ($page == '') {
            include 'inc/dashboard.php';
          } else if ($page == 'daftar_user') {
            if ($action == "") {
              include 'inc/daftar_user/daftar.php';
            } else if ($action == "detail") {
              include 'inc/daftar_user/detail.php';
            } else if ($action == "edit") {
              include 'inc/daftar_user/edit.php';
            } else if ($action == "hapus") {
              include 'inc/daftar_user/hapus.php';
            }
          } else if ($page == 'data_akun') {
            if ($action == "") {
              include 'inc/data_akun/data.php';
            } else if ($action == "expired") {
              include 'inc/data_akun/expired.php';
            }
          } else if ($page == 'pengajuan_akun') {
            if ($action == "") {
              include 'inc/pengajuan_akun/data.php';
            } else if ($action == "detail") {
              include 'inc/pengajuan_akun/detail.php';
            }
          } else if ($page == 'mikrotik') {
            if ($action == "") {
              include 'inc/mikrotik/mikrotik.php';
            } else if ($action == "edit") {
              include 'inc/mikrotik/edit.php';
            } else if ($action == "hapus") {
              include 'inc/mikrotik/hapus.php';
            }
          }
        } else {
          if ($page == '') {
            include 'inc/dashboard_user.php';
          } else if ($page == 'akun') {
            if ($action == "") {
              include 'inc/akun/akun.php';
            } else if ($action == "detail") {
              include 'inc/akun/detail.php';
            } else if ($action == "update") {
              include 'inc/akun/update.php';
            }
          } else if ($page == 'daftar_akun') {
            if ($action == "") {
              include 'inc/daftar_akun/daftar_akun.php';
            } else if ($action == "detail") {
              include 'inc/daftar_akun/detail.php';
            } else if ($action == "update") {
              include 'inc/daftar_akun/update.php';
            } else if ($action == "edit") {
              include 'inc/daftar_akun/edit.php';
            }
          }
        }

        ?>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright ©
              <a href="http://facebook.com/jamilur.kotomambang" target="_blank" style="color:black; text-decoration:none;">Teknisi SMAN 1 2x11 ENAM LINGKUNG</a> 2019
            </span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tekan "Logout" jika ingin keluar dari web ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Countdown -->
  <script src="js/jquery.countdown.js"></script>

  <!-- sweetalert -->
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/alert.js"></script>
  <script src="js/myscript2.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>



</body>

</html>