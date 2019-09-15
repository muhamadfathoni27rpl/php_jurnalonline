<?php
session_start();
if(!isset($_SESSION["loginn"])){
	header("Location:login.php");
	exit;
}
require 'functions.php';

$mahasiswa = query("SELECT * FROM user");



// tombol cari diklik
if(isset($_POST["cari"])){
	$mahasiswa = cariusr($_POST["keyword"]);
}



?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../base/JO-title.png">
	<title>🎫: Daftar Profil | Jurnal Daring</title>
</head>
<body>

<!-- <a href="logout.php">Keluar</a> -->
<br>
<img src="../base/JO-title.png" width="105">
<h1><a href="user.php">Jurnal Daring</a></h1>
<a href="index.php">Daftar Jurnal</a>
<a href="registrasi.php">Tambah User</a>
<a href="logout.php">Keluar</a>

<form action="" method="post">
<br>
<input type="text" name="keyword" size="48" autofocus="" placeholder="Cari" autocomplete="off" id="keyword">
<button type="submit" name="cari" id="tombol-cari">Cari</button>


</form>
<br>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">
	
<tr>
	<th>No.</th>
	<th>Aksi</th>
	<!-- <th>Posisi</th> -->
    <th>Identifikasi</th>
	<th>Gambar Profile</th>
	<th>Nama Profil</th>
	<th>Alamat Surel</th>
	<th>Nomor Ponsel</th>
</tr>
<?php $i = 1; ?>
	<?php foreach($mahasiswa as $row): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
			<a href="hapususr.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin ?');">Hapus</a>
		</td>
		<!-- <td><?php echo $row["posisi"]; ?></td> -->
        <td><?php echo $row["id"]; ?></td>
		<td><img src="../profiledisp/<?php echo $row["display_pict"]; ?>" width="105"></td>
		<td><?php echo $row["username"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["no_hp"]; ?></td>
	</tr>
	<?php $i++ ?>
	<?php endforeach; ?>


	
</table>
</div>
<script src="js/script2.js"></script> 

</body>
</html>