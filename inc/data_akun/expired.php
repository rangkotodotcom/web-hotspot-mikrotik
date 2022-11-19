<?php

$id_h = base64_decode(@$_GET['i_h']);
$user_h = base64_decode(@$_GET['u_h']);
$pass_h = base64_decode(@$_GET['p_h']);

// echo "$user_h";
// echo "$pass_h";

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM akun_hotspot WHERE user_h = '$user_h' AND pass_h = '$pass_h' "));

$API->comm("/ip/hotspot/user/remove", array(
    ".id" => "$id_h",
));

$query = mysqli_query($conn, "UPDATE akun_hotspot SET masa_berlaku = '0' WHERE user_h = '$user_h' AND pass_h = '$pass_h' ");

if ($query) {
    $from = "Admin Internet SMAN 1 2x11 ENAM LINGKUNG<admin@hotspot.sman12x11el.sch.id>";
    $to = $data['email'];
    $subject = "Expired Akun Hotspot";
    $message = 'Akun Hotspot anda dengan user ' . $user_h . ' dan password ' . $pass_h . ' telah expired. ' . "\n" . ' Silahkan perbarui kembali di web hotspot SMAN 1 2x11 Enam Lingkung';
    $headers = 'MIME-Version: 1.0' . "\r\n";

    $lf = strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' ? "\r\n" : "\n";

    $headers .= "From: $from" . $lf;
    $headers .= "Date: " . date('r') . $lf;
    $headers .= "X-Mailer: PHP" . $lf;
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $mail = mail($to, $subject, $message, $headers);
    echo "<script>window.location.href='?page=" . base64_encode('data_akun') . "';</script>";
}
