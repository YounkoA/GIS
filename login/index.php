<!-- <html>
	<head><title>Login</title></head>
<body>

<h2>Halaman Login</h2>

<form action="log.php?op=in" method="post">
User ID : <input type="text" name="userid"><br>
Password : <input type="password" name="psw"><br>
<input type="submit" value="Login">
</form>

</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
	<title>form login</title>
</head>
<body>
	<h1>SELAMAT DATANG</h1><br>
	<h3>Masukkan Username dan Password</h3>
	<div class="container">
	<div class="form">
		<form action="log.php?op=in" method="post">
		<p>Username : <input type="text" name="userid"></p><br>
        <p>Password : <input type="password" name="psw"></p><br>

       <div class="button">
       	<input type="submit" value="Login">
        </div>
		</form>
	</div>

</body>
</html>





<style type="text/css">
body{
	background:url(2.jpg);
	background-size: 100%;

}
h1 {
	text-align: center;
	color: white;
	font-family: arial;
	margin-bottom: 0px;
	margin-top: 12%;
}
h3 {
	margin-top: 0px;
	color: white;
	text-align: center;
	font-family: arial;
}
form {
	padding: 1em;
	color: white;
}
input{
	font-size: 20px;
}
.form{
	background:rgba(25, 24, 24, 0.2);
	background-size: 100%;
	border: 1px;
	margin: auto;
	width: 277px;
	align-content: center;
	border-radius: 10px;

	}
.form p{
	margin: 0;
	font-size: 19px;
	font-family: arial;
}
.button input {
	width: 70px;
    height: 35px;
}
</style>