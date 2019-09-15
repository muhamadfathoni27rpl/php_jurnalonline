<?php
session_start();
if(!isset($_SESSION["loginn"])){
	header("Location:login.php");
	exit;
}
require 'functions.php';

$mahasiswa = query("SELECT * FROM jurnal");



// tombol cari diklik
if(isset($_POST["cari"])){
	$mahasiswa = cari($_POST["keyword"]);
}



?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../base/JO-title.png">
	<title>🎫: Beranda | Jurnal Daring</title>
</head>
<body>

<!-- <a href="logout.php">Keluar</a> -->
<br>
<img src="../base/JO-title.png" width="105">
<h1><a href="index.php">Jurnal Daring</a></h1>

<a href="user.php">Daftar Profil</a>
<br>
<a href="token.php">Token Kelas Manual</a>
<br>
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
    <th>Nama Pengguna</th>
	<!-- <th>Gambar</th> -->
	<!-- <th>Attachment</th> -->
	<th>Tanggal</th>
	<th>Mata Pelajaran</th>
	<th>Materi</th>
</tr>
<?php $i = 1; ?>
	<?php foreach($mahasiswa as $row): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
			<!-- <a href="ubah.php?id=<?php echo $row["id"]; ?>">Ubah</a> | -->
			<a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin ?');">Hapus</a>
		</td>
        <td><?php echo $row["code"]; ?></td>
		<!-- <td><img src="../img/<?php echo $row["gambar"]; ?>" width="105"></td> -->
		<!-- <td><?php echo $row["att"]; ?></td> -->
		<td><?php echo $row["tanggal"]; ?></td>
		<td><?php echo $row["mata_pelajaran"]; ?></td>
		<td><?php echo $row["materi"]; ?></td>
	</tr>
	<?php $i++ ?>
	<?php endforeach; ?>


	
</table>
</div>
<script src="../js/script.js"></script> 

</body>
</html>