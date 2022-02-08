<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['userid'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

//cek level user
if($_SESSION['level']!="admin"){
die("Anda bukan admin");//jika bukan admin jangan lanjut
}
?>

<html>
<head><title>Halaman Admin</title></head>
<body>
<?php echo "<h3>Welcome ".$_SESSION['userid']."</h3>";?>

<h4>Ini Halaman 1</h4>

</body>
</html>