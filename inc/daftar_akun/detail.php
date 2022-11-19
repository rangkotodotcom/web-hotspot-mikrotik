<?php

$id_h = base64_decode(@$_GET['id_h']);

$sql = mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE id_h = '$id_h' ");
$data = mysqli_fetch_assoc($sql);

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="?page=<?= base64_encode('daftar_akun'); ?>">Registrasi Akun Hotspot</a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Detail Registrasi Akun</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                    <td width="40%">Tipe Akun</td>
                    <td width="1%">:</td>
                    <td><?= ucfirst($data['tipe']); ?></td>
                </tr>
                <tr>
                    <td width="40%">Profil Hotspot</td>
                    <td width="1%">:</td>
                    <td><?= ucfirst($data['profil']); ?></td>
                </tr>

                <?php if ($data['tipe'] == 'voucher') { ?>

                    <tr>
                        <td width="40%">Kode Login Hotspot</td>
                        <td width="1%">:</td>
                        <td><?= $data['user_h']; ?></td>
                    </tr>

                <?php } else { ?>
                    <tr>
                        <td width="40%">Username Hotspot</td>
                        <td width="1%">:</td>
                        <td><?= $data['user_h']; ?></td>
                    </tr>
                    <tr>
                        <td width="40%">Password Hotspot</td>
                        <td width="1%">:</td>
                        <td><?= $data['pass_h']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td width="40%">Status Registrasi</td>
                    <td width="1%">:</td>
                    <td>

                        <?php if ($data['status_h'] == 'ditolak') { ?>
                            <div class="badge badge-danger mr-1">Ditolak</div> | <a href="?page=<?= base64_encode('daftar_akun'); ?>&action=<?= base64_encode('edit'); ?>&id_h=?<?= base64_encode($data['id_h']); ?>" class="btn btn-info btn-sm ml-1">
                                <i class="fas fa-edit"></i>
                            </a>
                        <?php } else if ($data['status_h'] == 'diterima') { ?>
                            <div class="badge badge-info">Diterima</div>
                        <?php } else { ?>
                            <div class="badge badge-warning">Ditunda</div>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td width="40%">Masa Berlaku</td>
                    <td width="1%">:</td>
                    <td>
                        <?php if ($data['status_h'] == 'diterima') {
                            if ($data['masa_berlaku'] == 0) { ?>
                                <div class="badge badge-danger mr-1">Expired</div> | <a href="?page=<?= base64_encode('daftar_akun'); ?>&action=<?= base64_encode('update'); ?>&id_h=?<?= base64_encode($data['id_h']); ?>" class="btn btn-success btn-sm ml-1">
                                    <i class="fas fa-sync"></i>
                                </a>
                            <?php } else { ?>
                                <div class="badge badge-success">Berlaku</div>
                        <?php }
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td width="40%">Pembaharuan Terakhir</td>
                    <td width="1%">:</td>
                    <td><?= tanggal(date("D, j F Y H:i:s", $data['tanggal_kirim'])); ?></td>
                </tr>
            </table>
        </div>
    </div>
    </a>
</div>