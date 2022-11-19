<?php

$id = base64_decode(@$_GET['id']);

$sql = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ");
$data = mysqli_fetch_assoc($sql);

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="?page=<?= base64_encode('daftar_user'); ?>">Daftar User</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Detail User <?= $data['nama']; ?></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                    <td width="40%">Nama Lengkap</td>
                    <td width="1%">:</td>
                    <td><?= $data['nama']; ?></td>
                </tr>
                <tr>
                    <td width="40%">NISN / NIP</td>
                    <td width="1%">:</td>
                    <td><?= $data['nisn_nip']; ?></td>
                </tr>
                <tr>
                    <td width="40%">Email</td>
                    <td width="1%">:</td>
                    <td><?= $data['email']; ?></td>
                </tr>
                <tr>
                    <td width="40%">Status User</td>
                    <td width="1%">:</td>

                    <?php if ($data['status'] == "1") { ?>

                        <td>Aktif</td>

                    <?php } else { ?>

                        <td>Non-Aktif</td>

                    <?php } ?>
                </tr>
                <tr>
                    <td width="40%">Kuota Hotspot</td>
                    <td width="1%">:</td>
                    <td><?= $data['jumlah_max_akun']; ?> Akun</td>
                </tr>

                <tr>
                    <td width="40%">Terdaftar Sejak</td>
                    <td width="1%">:</td>
                    <td><?= tanggal(date("D, j F Y H:i:s", $data['tanggal_daftar'])); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <a href="?page=<?= base64_encode('daftar_user'); ?>&action=<?= base64_encode('edit'); ?>&id=?<?= base64_encode($data['id']); ?>" class="btn btn-success btn-md ml-auto mr-0 mr-md-3 my-2 my-md-2">
        <i class="fas fa-fw fa-edit"></i>
    </a>
</div>