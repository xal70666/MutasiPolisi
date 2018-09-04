<?php

// fungsi untuk melakukan koneksi ke database mysql pertama
function koneksi1_buka() {
    mysql_connect($server1,$username1,$password1);
	mysql_select_db($database1);
}
 
// fungsi untuk menutup koneksi ke database mysql pertama
function koneksi1_tutup() {
    mysql_close(mysql_connect($server1,$username1,$password1));
}
// fungsi untuk melakukan koneksi ke database mysql kedua
function koneksi2_buka() {
    mysql_connect($server2,$username2,$password2);
	mysql_select_db($database2);
}
 
// fungsi untuk menutup koneksi ke database mysql kedua
function koneksi2_tutup() {
    mysql_close(mysql_connect($server2,$username2,$password2));
}

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

function average($arr){
   if (!is_array($arr)) return false;
   return array_sum($arr)/count($arr);
}

function cek_session_admin(){
	$level = $_SESSION[level];
	if ($level != 'admin' AND $level != 'admin'){
		echo "<script>document.location='index.php';</script>";
	}
}

function cek_session_guru(){
	$level = $_SESSION[level];
	if ($level != 'user' AND $level != 'admin'){
		echo "<script>document.location='index.php';</script>";
	}
}

function cek_session_siswa(){
	$level = $_SESSION[level];
	if ($level == ''){
		echo "<script>document.location='index.php';</script>";
	}
}
?>