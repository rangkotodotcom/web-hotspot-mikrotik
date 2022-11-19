<?php

$id_h = base64_decode(@$_GET['id_h']);

$sql = mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE id_h = '$id_h' ");
$data = mysqli_fetch_assoc($sql);

$user_h = $data['user_h'];
$pass_h = $data['pass_h'];
$profile = $data['profil'];
$comment = $data['tipe'] . "-" . $data['email'] . "-" . $data['id_h'];


if (isset($_POST['tolak'])) {
    $status_h = 'ditolak';
    $query = mysqli_query($conn, "UPDATE akun_hotspot SET status_h = '$status_h' WHERE id_h = '$id_h' ");
    echo "<script>window.location.href='?page=" . base64_encode('pengajuan_akun') . "&action=" . base64_encode('detail') . " &id_h=" . base64_encode($data['id_h']) . "';</script>";
} else if (isset($_POST['terima'])) {
    $API->comm("/ip/hotspot/user/add", array(
        "server" => "all",
        "name" => "$user_h",
        "password" => "$pass_h",
        "profile" => "$profile",
        "disabled" => "no",
        "comment" => "$comment",
    ));

    if ($API) {
        $status_h = 'diterima';
        $query = mysqli_query($conn, "UPDATE akun_hotspot SET status_h = '$status_h' WHERE id_h = '$id_h' ");
        $from = "Admin Internet SMAN 1 2x11 ENAM LINGKUNG<admin@hotspot.sman12x11el.sch.id>";
        $to = $data['email'];
        $subject = "Pengaktifan Akun Hotspot";
        $message = "Pengajuan akun hotspot anda telah disetujui, Silahkan nikmati internet di lingkungan SMAN 1 2x11 Enam Lingkung menggunakan akun anda. \n Masa berlaku selama 60 Hari, terhitung dari awal login hotspot";
        $headers = 'MIME-Version: 1.0' . "\r\n";

        $lf = strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' ? "\r\n" : "\n";

        $headers .= "From: $from" . $lf;
        $headers .= "Date: " . date('r') . $lf;
        $headers .= "X-Mailer: PHP" . $lf;
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $mail = mail($to, $subject, $message, $headers);

        echo "<div class='alert' data-flashdata='Akun Hotspot Berhasil Disetujui'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('pengajuan_akun') . "&action=" . base64_encode('detail') . " &id_h=" . base64_encode($data['id_h']) . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Akun Hotspot Gagal Disetujui'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('pengajuan_akun') . "&action=" . base64_encode('detail') . " &id_h=" . base64_encode($data['id_h']) . "'></div>";
    }
}

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="?page=<?= base64_encode('pengajuan_akun'); ?>">Registrasi Akun Hotspot</a>
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
                            <div class="badge badge-danger mr-1">Ditolak</div>
                        <?php } else if ($data['status_h'] == 'diterima') { ?>
                            <div class="badge badge-info">Diterima</div>
                        <?php } else { ?>
                            <div class="badge badge-warning mb-2">Ditunda</div>
                            <form action="" method="post">
                                <button type="submit" name="terima" class="btn btn-info btn-sm">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="submit" name="tolak" class="btn btn-danger btn-sm ml-1">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td width="40%">Masa Berlaku</td>
                    <td width="1%">:</td>
                    <td>
                        <?php if ($data['status_h'] == 'diterima') {
                            if ($data['masa_berlaku'] == 0) { ?>
                                <div class="badge badge-danger">Expired</div>
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