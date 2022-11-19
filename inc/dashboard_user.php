<?php

$jumlah_permohonan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE email = '$_SESSION[email]' "));

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
</ol>

<!-- Icon Cards-->
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?= $jumlah_permohonan;  ?> Pengajuan</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="?page=<?= base64_encode('daftar_akun'); ?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
</div>