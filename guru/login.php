<?php
session_start(); 
require "functions.php";

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasar id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $_SESSION["id"] = $row_akun['id'];

    // cek cookie dan username
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login']= true;
    }
}

if(isset($_SESSION["login"])){
    header ("Location: index.php");
    exit;
}

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    // cek username
    if( $username === 'admin' && $password === 'JO'){
        $_SESSION["loginn"] = true;
        $_SESSION["idyu"] = "";
        setcookie('id', '', time() - 3600);
	    setcookie('key', '', time() - 3600);
        header ('Location: ../admin/index.php');
        exit;
    }else{
    $error = true;
}
if(mysqli_num_rows($result) === 1){
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            // set session
            $sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

            if(mysqli_num_rows($sql)>0){
                $row_data = mysqli_fetch_array($sql);
                $_SESSION['idyu'] = $row_data["id"];
                $_SESSION["login"] = true;
            }
            
            header("Location: landingpage.php");
            exit;
        }
    }else

    $error = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../base/JO-title.png">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Masuk | Jurnal Daring</title>
</head>
<body>
    
                    <form method="post" action="login.php">
	<input type="text" name = "username" placeholder="Masukan Username">
	<input type="password" name="password" placeholder="Password mu">
	<input type="submit" name="submit" value="Login">
</form>

<a href="daftar.php" >Belum punya akun?</a>
                
        
        </form>
</body>
</html>

