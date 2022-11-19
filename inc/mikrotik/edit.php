<?php

$id_m = base64_decode(@$_GET['id_m']);

$sql = mysqli_query($conn, "SELECT * FROM admin_mikrotik WHERE id_m = '$id_m' ");
$data = mysqli_fetch_assoc($sql);

if (isset($_POST['simpan'])) {
    $ip_mikrotik = $_POST['ip_mikrotik'];
    $username = $_POST['username'];
    $pass_m = $_POST['pass_m'];

    $query = mysqli_query($conn, "UPDATE admin_mikrotik SET ip_mikrotik = '$ip_mikrotik', username = '$username', pass_m = '$pass_m' WHERE id_m = '$id_m' ");

    if ($query) {
        echo "<div class='alert' data-flashdata='Server Mikrotik Berhasil Diedit'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('mikrotik') . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Server Mikrotik Gagal Diedit'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('mikrotik') . "&action=" . base64_encode('edit') . " &id_m=" . base64_encode($data['id_m']) . "'></div>";
    }
}

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="?page=<?= base64_encode('mikrotik'); ?>">Server Mikrotik</a>
    </li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-edit"></i>
        Edit Server <?= $data['ip_mikrotik']; ?></div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="inputMikrotik" name="ip_mikrotik" class="form-control" value="<?= $data['ip_mikrotik']; ?>">
                        <label for="inputMikrotik">IP Mikrotik</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="Username" name="username" class="form-control" value="<?= $data['username']; ?>">
                        <label for="Username">Username</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="Password" name="pass_m" class="form-control" value="<?= $data['pass_m']; ?>">
                        <label for="Password">Password</label>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm ml-auto mr-0 mr-md-3 my-2 my-md-2">
                    <i class="fas fa-fw fa-save"></i> Simpan
                </button>
                <a href="?page=<?= base64_encode('mikrotik'); ?>" class="btn btn-success btn-sm ml-auto mr-0 mr-md-3 my-2 my-md-2">
                    <i class="fas fa-fw fa-arrow-alt-circle-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>

</div>