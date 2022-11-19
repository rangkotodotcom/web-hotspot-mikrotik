<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Pengajuan Hotspot</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Pengajuan Hotspot</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Nisn / NIP</th>
                        <th>Tipe Akun</th>
                        <th>Profil Hotspot</th>
                        <th>Status</th>
                        <th width="9%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                $i = 0;

                $sql = mysqli_query($conn, "SELECT * FROM akun_hotspot INNER JOIN user ON akun_hotspot.email = user.email ");

                while ($data = mysqli_fetch_assoc($sql)) :
                    $i++;
                    ?>

                    
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['nisn_nip']; ?></td>
                            <td><?= ucwords($data['tipe']); ?></td>
                            <td><?= ucwords($data['profil']); ?></td>
                            <td align="center">
                                <?php if ($data['status_h'] == 'ditolak') { ?>
                                    <div class="badge badge-danger">Ditolak</div>
                                <?php } else if ($data['status_h'] == 'diterima') { ?>
                                    <div class="badge badge-info">Diterima</div>
                                <?php } else { ?>
                                    <div class="badge badge-warning">Ditunda</div>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="?page=<?= base64_encode('pengajuan_akun'); ?>&action=<?= base64_encode('detail'); ?>&id_h=<?= base64_encode($data['id_h']); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- <a href="?page=<?= base64_encode('pengajuan_akun'); ?>&action=<?= base64_encode('hapus'); ?>&id_h=?<?= base64_encode($data['id_h']); ?>" class="btn btn-danger btn-sm my-1 tombol-hapus">
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