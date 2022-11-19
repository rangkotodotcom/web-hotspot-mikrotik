<?php

$id_h = base64_decode(@$_GET['id_h']);

$sql = mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE id_h = '$id_h' ");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['simpan'])) {
    $profil = $_POST['profil'];
    $user_h = $_POST['user_h'];
    if ($data['tipe'] == 'voucher') {
        $pass_h = $user_h;
    } else {
        $pass_h = $_POST['pass_h'];
    }

    $status_h = 'ditunda';
    $tanggal_kirim = time();

    $query = mysqli_query($conn, "UPDATE akun_hotspot SET profil = '$profil', user_h = '$user_h', pass_h = '$pass_h', status_h = '$status_h', tanggal_kirim = '$tanggal_kirim' WHERE id_h = '$id_h' ");

    if ($query) {
        echo "<div class='alert' data-flashdata='Perbaikan Registrasi Hotspot Berhasil'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "&action=" . base64_encode('detail') . " &id_h=" . base64_encode($data['id_h']) . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Perbaikan Registrasi Hotspot Gagal'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_akun') . "&action=" . base64_encode('edit') . " &id_h=" . base64_encode($data['id_h']) . "'></div>";
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
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-edit"></i>
        Edit User Hotspot <b><?= $data['user_h']; ?></b></div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <select id="inputProfil" name="profil" class="form-control">
                            <option value="">Pilih Profil</option>
                            <option value="pegawai" <?php if ($data['profil'] == 'pegawai') {
                                                        echo "selected";
                                                    } ?>>Pegawai</option>
                            <option value="guru" <?php if ($data['profil'] == 'guru') {
                                                        echo "selected";
                                                    } ?>>Guru</option>
                            <option value="siswa" <?php if ($data['profil'] == 'siswa') {
                                                        echo "selected";
                                                    } ?>>Siswa</option>
                        </select>
                        <label for="inputProfil">Profil Hotspot</label>
                    </div>
                </div>
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