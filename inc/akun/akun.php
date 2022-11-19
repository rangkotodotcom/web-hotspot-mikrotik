<?php

$email = $_SESSION['email'];

$sql = mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE email = '$email' ");
$data = mysqli_fetch_assoc($sql);

$username = $data['user_h'];

$getuser = $API->comm("/ip/hotspot/user/print", array(
    "?name" => "$username",
));
$TotalReg = count($getuser);

$counttuser = $API->comm("/ip/hotspot/user/print", array(
    "count-only" => "",
    "?name" => "$username",
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
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>User Hotspot</th>
                        <th>Password Hotspot</th>
                        <th>Masa Aktif</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    for ($i = 0; $i < $TotalReg; $i++) {
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
                            $bln = 01;
                        } else if ($bulan == "feb") {
                            $bln = 02;
                        } else if ($bulan == "mar") {
                            $bln = 03;
                        } else if ($bulan == "apr") {
                            $bln = 04;
                        } else if ($bulan == "may") {
                            $bln = 05;
                        } else if ($bulan == "jun") {
                            $bln = 06;
                        } else if ($bulan == "jul") {
                            $bln = 07;
                        } else if ($bulan == "aug") {
                            $bln = 8;
                        } else if ($bulan == "sep") {
                            $bln = 9;
                        } else if ($bulan == "oct") {
                            $bln = 10;
                        } else if ($bulan == "nov") {
                            $bln = 11;
                        } else if ($bulan == "dec") {
                            $bln = 12;
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
                            <td><?= $upass; ?></td>
                            <td><?= $new_exp; ?></td>
                            <td>Expired dalam
                                <b> <?= $diff->days; ?> Hari </b>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>