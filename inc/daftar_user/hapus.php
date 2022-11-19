<?php

$id = base64_decode(@$_GET['id']);

$query = mysqli_query($conn, "DELETE FROM user WHERE id = '$id' ");

echo "<div class='alert' data-flashdata='Data Berhasil Dihapus'></div>";
echo "<div class='link' data-flashdata='?page=" . base64_encode('daftar_user') . "'></div>";
