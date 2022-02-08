<?php
session_start();
mysql_connect("localhost","root","") or die("Nggak bisa koneksi");
mysql_select_db("db_peta");//sesuaikan dengan nama database anda

$userid = $_POST['userid'];
$psw = $_POST['psw'];
$op = $_GET['op'];

if($op=="in"){
	$cek = mysql_query("SELECT * FROM tabeluser WHERE userid='$userid' AND password='$psw'");
if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
$c = mysql_fetch_array($cek);
$_SESSION['userid'] = $c['userid'];
$_SESSION['level'] = $c['level'];
if($c['level']=="admin"){
header("location:homeadmin.php");
}else if($c['level']=="user"){
header("location:homeuser.php");
}
}else{
die("password salah <a href=\"javascript:history.back()\">kembali</a>");
}
}else if($op=="out"){
unset($_SESSION['userid']);
unset($_SESSION['level']);
header("location:index.php");
}
?>