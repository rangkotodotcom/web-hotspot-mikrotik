<?php

$id = base64_decode(@$_GET['id']);

$sql = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['simpan'])) {
    $jumlah_max_akun = $_POST['jumlah_max_akun'];

    $query = mysqli_query($conn, "UPDATE user SET jumlah_max_akun = '$jumlah_max_akun' WHERE id = '$id' ");

    if ($query) {
        echo "<div class='alert' data-flashdata='Edit User Berhasil'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_user') . "&action=" . base64_encode('detail') . " &id=" . base64_encode($data['id']) . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Edit User Gagal'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_user') . "&action=" . base64_encode('edit') . " &id=" . base64_encode($data['id']) . "'></div>";
    }
}

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="?page=<?= base64_encode('daftar_user'); ?>">Daftar User</a>
    </li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-edit"></i>
        Edit User <?= $data['nama']; ?></div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" name="email" class="form-control" value="<?= $data['email']; ?>" readonly>
                        <label for="inputEmail">Alamat Email</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="number" id="kuotaAkun" name="jumlah_max_akun" class="form-control" value="<?= $data['jumlah_max_akun']; ?>" required="required">
                        <label for="kuotaAkun">Kuota Akun Hotspot</label>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm ml-auto mr-0 mr-md-3 my-2 my-md-2">
                    <i class="fas fa-fw fa-save"></i> Simpan
                </button>
                <a href="?page=<?= base64_encode('daftar_user'); ?>&action=<?= base64_encode('detail'); ?>&id=?<?= base64_encode($data['id']); ?>" class="btn btn-success btn-sm ml-auto mr-0 mr-md-3 my-2 my-md-2">
                    <i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>

</div>