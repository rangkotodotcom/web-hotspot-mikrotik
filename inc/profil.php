<?php

$email = $_SESSION['email'];

$sql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['simpan'])) {
    $pass = $_POST['pass'];

    $password = password_hash($pass, PASSWORD_DEFAULT);

    $query = mysqli_query($conn, "UPDATE user SET password = '$password' WHERE email = '$email' ");

    if ($query) {
        echo "<div class='alert' data-flashdata='Password Berhasil Di Rubah'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('profil') . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Password Gagal Di Rubah'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('profil') . "'></div>";
    }
}

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Profil</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Lihat Profil <?= ucfirst($data['nama']); ?></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                    <td width="40%">Nama Lengkap</td>
                    <td width="1%">:</td>
                    <td><?= ucfirst($data['nama']); ?></td>
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
                    <td width="40%">Password</td>
                    <td width="1%">:</td>
                    <td>

                        <form action="" method="post">
                            <input type="password" name="pass" class="form-control">
                            <button type="submit" name="simpan" class="btn btn-info btn-sm mt-2">
                                <i class="fas fa-check"> Simpan</i>
                            </button>
                        </form>

                    </td>
                </tr>
                <tr>
                    <td width="40%">Terdaftar Sejak</td>
                    <td width="1%">:</td>
                    <td><?= tanggal(date("D, j F Y H:i:s", $data['tanggal_daftar'])); ?></td>
                </tr>
            </table>
        </div>
    </div>
    </a>
</div>