<?php

$id_m = base64_decode(@$_GET['id_m']);

$query = mysqli_query($conn, "DELETE FROM admin_mikrotik WHERE id_m = '$id_m' ");

echo "<div class='alert' data-flashdata='Data Berhasil Dihapus'></div>";
echo "<div class='link' data-flashdata='?page=" . base64_encode('mikrotik') . "'></div>";
