<?php  
session_start();
if(!isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
}
require 'functions.php';

$dataku = $_SESSION['idyu'];

$maha = query("SELECT * FROM user WHERE id=$dataku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../base/JO-title.png">
    <title>Profil Anda | Jurnal Daring</title>
</head>
<body>

<?php foreach($maha as $row): ?>
    <label>Nama Profil: </label>
	<h1><?php echo $row["username"]; ?></h1>
	<img src="../profiledisp/<?php echo $row["display_pict"]; ?>" width="105">
    <br>
    <label>Alamat Surel: </label>
    <p><?php echo $row["email"]; ?></p>
    <br>
    <label>Nomor Ponsel: </label>
    <p><?php echo $row["no_hp"]; ?></p>
    <br>
    <a href="editprofil.php">Edit Profil</a>
    <br>
    <a href="index.php">Kembali</a>
    <br>
    <a href="logout.php">Keluar</a>
<?php endforeach; ?>
    
</body>
</html>