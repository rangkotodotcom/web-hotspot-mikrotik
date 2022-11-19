<?php

$jumlah_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE level = 'user' "));
$jumlah_permohonan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE status_h = 'ditunda' "));

$sql = mysqli_query($conn, "SELECT * FROM admin_mikrotik");
$result = mysqli_fetch_assoc($sql);


$API->connect($result['ip_mikrotik'], $result['username'], $result['pass_m']);

$getlog = $API->comm("/log/print", array(
    "?topics" => "hotspot,info,debug"
));
$log = array_reverse($getlog);
$TotalReg = count($getlog);

?>



<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= $url; ?>">Dashboard</a>
    </li>
</ol>

<!-- Icon Cards-->
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5"><b><?= $jumlah_user;  ?></b> User</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="?page=<?= base64_encode('daftar_user'); ?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><b><?= $jumlah_permohonan;  ?></b> Pengajuan</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="?page=<?= base64_encode('pengajuan_akun'); ?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <!-- <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">123 New Orders!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">13 New Tickets!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div> -->
</div>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Hotspot Log</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Users (IP)</th>
                        <th>Messages</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Time</th>
                        <th>Users (IP)</th>
                        <th>Messages</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    for ($i = 0; $i < $TotalReg; $i++) {
                        $mess = explode(":", $log[$i]['message']);
                        $time = $log[$i]['time'];
                        echo "<tr>";
                        if (substr($log[$i]['message'], 0, 2) == "->") {
                            echo "<td>" . $time . "</td>";
                            //echo substr($mess[1], 0,2);
                            echo "<td>";
                            if (count($mess) > 6) {
                                echo $mess[1] . ":" . $mess[2] . ":" . $mess[3] . ":" . $mess[4] . ":" . $mess[5] . ":" . $mess[6];
                            } else {
                                echo $mess[1];
                            }
                            echo "</td>";
                            echo "<td>";
                            if (count($mess) > 6) {
                                echo str_replace("trying to", "", $mess[7] . " " . $mess[8] . " " . $mess[9] . " " . $mess[10]);
                            } else {
                                echo str_replace("trying to", "", $mess[2] . " " . @$mess[3] . " " . @$mess[4] . " " . @$mess[5]);
                            }
                            echo "</td>";
                        } else { }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
</div>