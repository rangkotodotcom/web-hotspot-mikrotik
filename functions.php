<?php 



function tanggal($str){

	$tr = trim($str);

	$str = str_replace(

		array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','November', 'December'), 

		array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), 

		$tr);

	return $str;

}



function kodeAcak($panjang){

	$karakter = '';

	$karakter .= 'abcdefghijklmnopqrstuvwxyz';

	$karakter .= '1234567890';



	$string = '';

	for ($i=0; $i < $panjang; $i++) { 

	$pos = rand(0, strlen($karakter)-1);

	$string .= $karakter{$pos};

	}

	return $string;

}



function kode($panjang){

	$karakter = '';

	$karakter .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

	$karakter .= '1234567890';



	$string = '';

	for ($i=0; $i < $panjang; $i++) { 

	$pos = rand(0, strlen($karakter)-1);

	$string .= $karakter{$pos};

	}

	return $string;

}
