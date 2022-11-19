<?php

$getuser = $API->comm("/ip/hotspot/user/print");
$TotalReg = count($getuser);

$counttuser = $API->comm("/ip/hotspot/user/print", array(
    "count-only" => ""
));

$getprofile = $API->comm("/ip/hotspot/user/profile/print");
$TotalReg2 = count($getprofile);


?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Daftar Akun</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Akun Hotspot</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>User Hotspot</th>
                        <th>Profil</th>
                        <th>Masa Aktif</th>
                        <th>Keterangan</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    for ($i = 2; $i < $TotalReg; $i++) {
                        $userdetails = $getuser[$i];
                        $uid = $userdetails['.id'];
                        $userver = @$userdetails['server'];
                        $uname = @$userdetails['name'];
                        $upass = @$userdetails['password'];
                        $uprofile = @$userdetails['profile'];
                        // $uuptime = formatDTM($userdetails['uptime']);
                        // $ubytesi = formatBytes($userdetails['bytes-in'], 2);
                        // $ubyteso = formatBytes($userdetails['bytes-out'], 2);

                        $ucomment = @$userdetails['comment'];

                        $pecah1 = @explode("/", $ucomment);
                        $pecah2 = @explode(" ", $pecah1[2]);

                        $tahun = $pecah2[0];
                        $bulan = $pecah1[0];
                        $tanggal = @$pecah1[1];
                        $jam = @$pecah2[1];

                        if ($bulan == "jan") {
                            $bln = '01';
                        } else if ($bulan == "feb") {
                            $bln = '02';
                        } else if ($bulan == "mar") {
                            $bln = '03';
                        } else if ($bulan == "apr") {
                            $bln = '04';
                        } else if ($bulan == "may") {
                            $bln = '05';
                        } else if ($bulan == "jun") {
                            $bln = '06';
                        } else if ($bulan == "jul") {
                            $bln = '07';
                        } else if ($bulan == "aug") {
                            $bln = '08';
                        } else if ($bulan == "sep") {
                            $bln = '09';
                        } else if ($bulan == "oct") {
                            $bln = '10';
                        } else if ($bulan == "nov") {
                            $bln = '11';
                        } else if ($bulan == "dec") {
                            $bln = '12';
                        }

                        $new_exp = $tahun . "-" . @$bln . "-" . $tanggal . " " . $jam;
                        // $udisabled = $userdetails['disabled'];
                        // $utimelimit = $userdetails['limit-uptime'];
                        // if ($utimelimit == '1s') {
                        //     $utimelimit = ' expired';
                        // } else {
                        //     $utimelimit = ' ' . $utimelimit;
                        // }
                        // $udatalimit = $userdetails['limit-bytes-total'];
                        // if ($udatalimit == '') {
                        //     $udatalimit = '';
                        // } else {
                        //     $udatalimit = ' ' . formatBytes($udatalimit, 2);
                        // }

                        // echo "<tr>";
                        // 
                        if (checkdate($bln, $tanggal, $tahun)) {
                            $exp_mk = date_create($new_exp);
                        } else {
                            $exp_mk = date_create();
                        }
                        $today = date_create();
                        $diff = date_diff($exp_mk, $today);

                        ?>

                        <tr>
                            <td style='text-align:center;'><?= $i; ?></td>
                            <td><?= $uname; ?></td>
                            <td><?= $uprofile; ?></td>
                            <td><?= $new_exp; ?></td>
                            <td>Expired dalam
                                <b> <?= $diff->days; ?> Hari </b>
                            </td>
                            <td>
                                <a href="?page=<?= base64_encode('data_akun'); ?>&action=<?= base64_encode('expired'); ?>&u_h=<?= base64_encode($uname); ?>&p_h=<?= base64_encode($upass); ?>&i_h=<?= base64_encode($uid); ?>" class="btn btn-warning btn-sm" title="expired">
                                    <i class="fas fa-hourglass-end"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>