<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['userid'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

//cek level user
if($_SESSION['level']!="admin" && $_SESSION['level']!="user"){
die("Anda bukan admin");//jika bukan admin dan user jangan lanjut
}
?>

<html>
<head><title>Halaman Admin dan User</title></head>
<body>
<?php echo "<h3>Welcome ".$_SESSION['userid']."</h3>";?>

<h4>Ini Halaman 2</h4>

</body>
</html>