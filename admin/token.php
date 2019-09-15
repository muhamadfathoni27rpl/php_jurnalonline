<?php 
session_start();
require "functions.php";

$tn = query("SELECT * FROM token");

if(!isset($_SESSION["loginn"])){
    header("Location:login.php");
    exit;
};

if(isset($_POST["token"])){
    if( token($_POST) > 0){
        echo "<script>
        document.location.href = 'token.php';
    </script>";
    }else{
        echo "<script>
        alert('Data Gagal Diubah');
        document.location.href = 'token.php';
    </script>";
    } 
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../base/JO-title.png">
    <title>🎫: Token Kelas Manual | Jurnal Daring</title>
</head>
<body>

<form action="" method="post">
    <input type="hidden" value="TEFA" name="kelas" id="kelas">
    <label for="token">Hasilkan Token</label><br>
    <button type="submit" name="token" id="token">Hasilkan Manual</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
	
<tr>
	<th>No.</th>
	<th>Kelas</th>
	<th>Token</th>
	<th>Tanggal</th>
</tr>
<?php $i = 1; ?>
	<?php foreach($tn as $row): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row["kelas"]; ?></td>
		<td><?php echo $row["token"]; ?></td>
		<td><?php echo $row["tanggal"]; ?></td>
	</tr>
	<?php $i++ ?>
	<?php endforeach; ?>


	
</table>

<a href="index.php">Kembali</a>
    
</body>
</html>