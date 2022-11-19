<?php

$sql = mysqli_query($conn, "SELECT * FROM admin_mikrotik ");
$cek_mikrotik = mysqli_num_rows($sql);

if (isset($_POST['simpan'])) {
    $ip_mikrotik = $_POST['ip_mikrotik'];
    $username = $_POST['username'];
    $pass_m = $_POST['pass_m'];

    $query = mysqli_query($conn, "INSERT INTO admin_mikrotik VALUES('', '$ip_mikrotik', '$username', '$pass_m')");

    if ($query) {
        echo "<div class='alert' data-flashdata='Server Mikrotik Berhasil Ditambahkan'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('mikrotik') . "'></div>";
    } else {
        echo "<div class='alert' data-flashdata='Server Mikrotik Gagal Ditambahkan'></div>";
        echo "<div class='link' data-flashdata='?page=" . base64_encode('mikrotik') . "'></div>";
    }
}


?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Server Mikrotik</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-hdd"></i>
        Server Mikrotik</div>
    <div class="card-body">
        <?php if ($cek_mikrotik < 1) { ?>

            <a class="btn btn-success btn-sm mb-2" href="#" data-toggle="modal" data-target="#tambah_M_Modal">Tambah</a>

        <?php } else {  ?>

            <button class="btn btn-success btn-sm mb-2" disabled>Tambah</button>

        <?php } ?>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>IP Mikrotik</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th width="9%">Aksi</th>
                    </tr>
                </thead>

                <?php

                $i = 0;



                while ($data = mysqli_fetch_assoc($sql)) :
                    $i++;
                    ?>

                    <tbody>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['ip_mikrotik']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td>********</td>
                            <td>
                                <a href="?page=<?= base64_encode('mikrotik'); ?>&action=<?= base64_encode('edit'); ?>&id_m=<?= base64_encode($data['id_m']); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- <a href="?page=<?= base64_encode('mikrotik'); ?>&action=<?= base64_encode('hapus'); ?>&id_m=?<?= base64_encode($data['id_m']); ?>" class="btn btn-danger btn-sm my-1 tombol-hapus">
                                    <i class="fas fa-eraser"></i>
                                </a> -->
                            </td>
                        </tr>
                    </tbody>

                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="tambah_M_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Server Mikrotik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="ip_Mikrotik" name="ip_mikrotik" class="form-control" placeholder="IP Mikrotik" required="required" autofocus="autofocus">
                            <label for="ip_Mikrotik">IP Mikrotik</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="required">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="password" name="pass_m" class="form-control" placeholder="Password" required="required">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>