<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Daftar User</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Users</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Nisn / NIP</th>
                        <th>Email</th>
                        <th width="9%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                $i = 0;

                $sql = mysqli_query($conn, "SELECT * FROM user WHERE level = 'user' ");

                while ($data = mysqli_fetch_assoc($sql)) :
                    $i++;
                    ?>

                    
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['nisn_nip']; ?></td>
                            <td><?= $data['email']; ?></td>
                            <td>
                                <a href="?page=<?= base64_encode('daftar_user'); ?>&action=<?= base64_encode('detail'); ?>&id=<?= base64_encode($data['id']); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- <a href="?page=<?= base64_encode('daftar_user'); ?>&action=<?= base64_encode('hapus'); ?>&id=?<?= base64_encode($data['id']); ?>" class="btn btn-danger btn-sm my-1 tombol-hapus">
                                    <i class="fas fa-eraser"></i>
                                </a> -->
                            </td>
                        </tr>
                    

                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>