<?php

$sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$_SESSION[email]' ");
$sql1 = mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE email = '$_SESSION[email]' ");
$data = mysqli_fetch_assoc($sql);

$cek_jumlah_akun = mysqli_num_rows($sql1);

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Registrasi Hotspot</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-user"></i>
        Form Registrasi Akun Hotspot</div>
    <div class="card-body">
        <p style="font-size:1.1em">Jumlah akun hotspot yang dapat anda daftarkan adalah <?= $data['jumlah_max_akun']; ?> Akun

            <?php if ($cek_jumlah_akun >= $data['jumlah_max_akun']) { ?>
                <button class="btn btn-success btn-sm" disabled>Tambah</button>
            <?php } else { ?>
                <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#tambahModal">Tambah</a>
            <?php } ?>
        </p>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Tipe Akun</th>
                        <th>Profil Hotspot</th>
                        <th>Status Registrasi</th>
                        <th>Masa Berlaku Akun</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>

                <?php

                $i = 0;

                while ($data1 = mysqli_fetch_assoc($sql1)) :
                    $i++;
                    ?>

                    <tbody>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= strtoupper($data1['tipe']); ?></td>
                            <td><?= strtoupper($data1['profil']); ?></td>
                            <td align="center">
                                <?php if ($data1['status_h'] == 'ditolak') { ?>
                                    <div class="badge badge-danger">Ditolak</div>
                                <?php } else if ($data1['status_h'] == 'diterima') { ?>
                                    <div class="badge badge-info">Diterima</div>
                                <?php } else { ?>
                                    <div class="badge badge-warning">Ditunda</div>
                                <?php } ?>
                            </td>
                            <td align="center">
                                <?php if ($data1['status_h'] == 'diterima') {
                                        if ($data1['masa_berlaku'] == 0) { ?>
                                        <div class="badge badge-danger">Expired</div>
                                    <?php } else { ?>
                                        <div class="badge badge-success">Berlaku</div>
                                <?php }
                                    } ?>
                            </td>
                            <td>
                                <a href="?page=<?= base64_encode('daftar_akun'); ?>&action=<?= base64_encode('detail'); ?>&id_h=<?= base64_encode($data1['id_h']); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>

                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Hotspot</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php


                $sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$_SESSION[email]' ");
                $data = mysqli_fetch_assoc($sql);

                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control" value="<?= $data['email']; ?>" readonly>
                            <label for="inputEmail">Alamat Email</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <select id="inputTipe" onchange="myTipe()" name="tipe" class="form-control">
                                <option value="">Pilih Tipe User</option>
                                <option value="voucher" id="vc">Username = Password</option>
                                <option value="member" id="mb">Username & Password</option>
                            </select>
                            <label for="inputTipe">Tipe User Hotspot</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <select id="inputProfil" name="profil" class="form-control">
                                <option value="">Pilih Profil</option>
                                <option value="pegawai">Pegawai</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>
                            <label for="inputProfil">Profil Hotspot</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputUser" name="user_h" class="form-control" placeholder="Username" required="required">
                            <label for="inputUser">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="pass_h" class="form-control" placeholder="Password" required="required">
                            <label for="inputPassword" id="labelPassword">Password</label>
                        </div>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan</button>
                </form>

                <?php

                if (isset($_POST['simpan'])) {
                    $email = $_POST['email'];
                    $tipe = $_POST['tipe'];
                    $profil = $_POST['profil'];
                    $user_h = $_POST['user_h'];

                    if ($tipe == 'voucher') {
                        $pass_h = $user_h;
                    } else {
                        $pass_h = $_POST['pass_h'];
                    }
                    $status_h = 'ditunda';
                    $masa_berlaku = '1';
                    $tanggal_kirim = time();

                    $cek_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE user_h = '$user_h' "));

                    if ($cek_user < 1) {

                        $query = mysqli_query($conn, "INSERT INTO akun_hotspot VALUES ('', '$email', '$tipe', '$profil', '$user_h', '$pass_h', '$status_h', '$masa_berlaku', '$tanggal_kirim') ");


                        if ($query) {
                            $data_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE level = 'admin' "));

                            $from = "Admin Internet SMAN 1 2x11 ENAM LINGKUNG<admin@hotspot.sman12x11el.sch.id>";
                            $to = $data_admin['email'];
                            $subject = "Permohonan Akun Hotspot";
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

                            echo "<div class='alert' data-flashdata='Registrasi Akun Hotspot Berhasil'></div>";
                            echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "'></div>";
                        } else {
                            echo "<div class='alert' data-flashdata='Registrasi Akun Hotspot Gagal'></div>";
                            echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "'></div>";
                        }
                    } else {
                        echo "<div class='alert' data-flashdata='Akun Hotspot Sudah Ada'></div>";
                        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "'></div>";
                    }
                }

                ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>