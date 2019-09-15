<?php 
	session_start();
	if($_POST['submit']){
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$db = mysqli_connect("localhost", "root", "", "sck") or die ("Gagal Terhubung Database");
		$query = "INSERT INTO members(username,password,activated) VALUES('$username', '$password','1')";
		$result = mysqli_query($db,$query);
		if($result) {
			echo "Sukses Mendaftar bos!!!";
			header('Location: login.php');
		}
		else {
			echo "Eror";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
</head>
<body>
<h1>Daftar Member XPregammerTeam</h1>
<form method="post" action="register.php">
	<input type="text" name = "username" placeholder="Enter username">
	<input type="password" name="password" placeholder="Enter password here">
	<input type="submit" name="submit" value="Register">
</form>
<a href = "login.php" >Login</a>

</body>
</html>