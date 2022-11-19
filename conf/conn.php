<?php

date_default_timezone_set('Asia/Jakarta');

$url = 'http://localhost/hotspot/';

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hotspot";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}
