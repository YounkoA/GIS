<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['userid'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

//cek level user
if($_SESSION['level']!="user"){
die("Anda bukan user");//jika bukan user jangan lanjut
}
?>

<html>
<head><title>Halaman User</title></head>
<body>
<?php echo "<h3>Welcome ".$_SESSION['userid']."</h3>";?>

<h4>Ini Halaman 3</h4>

</body>
</html>