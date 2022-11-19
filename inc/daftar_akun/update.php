<?php

$id_h = base64_decode(@$_GET['id_h']);

$sql = mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE id_h = '$id_h' ");
$data = mysqli_fetch_assoc($sql);

$email = $data['email'];
$tipe = $data['tipe'];
$profil = $data['profil'];

if (isset($_POST['simpan'])) {
    $user_h = $_POST['user_h'];
    if ($data['tipe'] == 'voucher') {
        $pass_h = $user_h;
    } else {
        $pass_h = $_POST['pass_h'];
    }

    $status_h = 'ditunda';
    $masa_berlaku = '1';
    $tanggal_kirim = time();

    $query = mysqli_query($conn, "UPDATE akun_hotspot SET user_h = '$user_h', pass_h = '$pass_h', status_h = '$status_h', masa_berlaku = '$masa_berlaku', tanggal_kirim = '$tanggal_kirim' WHERE id_h = '$id_h' ");

    if ($query) {
        $data_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE level = 'admin' "));

        $from = "Admin Internet SMAN 1 2x11 ENAM LINGKUNG<admin@hotspot.sman12x11el.sch.id>";
        $to = $data_admin['email'];
        $subject = "Pembaruan Akun Hotspot";
        $message = file_get_contents(__DIR__ . '/../../pesan_permohonan_baru.html');
        $message = str_replace("%email%", $email, $message);
        $message = str_replace("%tipe%", $tipe, $message);
        $message = str_replace("%profil%", $profil, $message);
        $message = str_replace("%user_h%", $user_h, $message);
        $headers = 'MIME-Version: 1.0' . "\r\n";

        $lf = strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' ? "\r\n" : "\n";

        $headers .= "From: $from" . $lf;
        $headers .= "Date: " . date('r') . $lf;
        $headers .= "X-Mailer: PHP" . $lf;
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $mail = mail($to, $subject, $message, $headers);
        echo "<div class='alert' data-flashdata='Pembaharuan Akun Hotspot Berhasil'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "&action=" . base64_encode('detail') . " &id_h=" . base64_encode($data['id_h']) . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Pembaharuan Akun Hotspot Gagal'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "&action=" . base64_encode('update') . " &id_h=" . base64_encode($data['id_h']) . "'></div>";
    }
}

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="?page=<?= base64_encode('daftar_akun'); ?>">Registrasi Akun Hotspot</a>
    </li>
    <li class="breadcrumb-item active">Update</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-sync"></i>
        Update Akun Hotspot <b><?= $data['email']; ?></b></div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="post">
                <?php if ($data['tipe'] == 'voucher') { ?>

                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputUser" name="user_h" class="form-control" value="<?= $data['user_h']; ?>">
                            <label for="inputUser">Kode Login</label>
                        </div>
                    </div>

                <?php } else { ?>

                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputUser" name="user_h" class="form-control" value="<?= $data['user_h']; ?>">
                            <label for="inputUser">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="pass_h" class="form-control" placeholder="Password" required>
                            <label for="inputPassword" id="labelPassword">Password</label>
                        </div>
                    </div>

                <?php } ?>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm ml-auto mr-0 mr-md-3 my-2 my-md-2 mt-6">
                    <i class="fas fa-fw fa-save"></i> Simpan
                </button>
                <a href="?page=<?= base64_encode('daftar_akun'); ?>&action=<?= base64_encode('detail'); ?>&id_h=<?= base64_encode($data['_h']); ?>" class="btn btn-success btn-sm ml-auto mr-0 mr-md-3 my-2 my-md-2 mt-6">
                    <i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>

</div>