<?php  
session_start();
if(!isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
}
require 'functions.php';

$dataku = $_SESSION['idyu'];

$mahasiswa = query("SELECT * FROM jurnal WHERE code=$dataku");
$maha = query("SELECT * FROM user WHERE id=$dataku");
$tabel = mysqli_query($conn, "SELECT * FROM jurnal WHERE code=$dataku");
// tombol cari diklik
if(isset($_POST["cari"])){
	$mahasiswa = cari($_POST["keyword"]);
}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../base/JO-title.png">
	<title>Beranda | Jurnal Daring</title>
</head>
<body>

<h1><a href="index.php">Jurnal Daring</a></h1>

<?php foreach($maha as $row): ?>
	<h1><?php echo $row["username"]; ?></h1>
	<img src="../profiledisp/<?php echo $row["display_pict"]; ?>" width="105">
<?php endforeach; ?>

<a href="landingpage.php">Tambah Jurnal</a>

<a href="profil.php">Profil Anda</a>

<!-- <form action="" method="GET">
<br>
<input type="text" name="keyword" size="48" autofocus="" placeholder="Cari" autocomplete="off" id="keyword">
<button type="submit" name="cari" id="tombol-cari">Cari</button>


</form> -->
<br>
<?php if(mysqli_num_rows($tabel)>0): ?>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">
	
<tr>
	<th>No.</th>
	<th>Kelas</th>
	<!-- <th>Gambar</th> -->
	<!-- <th>Attachment</th> -->
	<th>Tanggal</th>
	<th>Mata Pelajaran</th>
	<th>Materi</th>
	<th>Aksi</th>
</tr>
<?php $i = 1; ?>
	<?php foreach($mahasiswa as $row): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row["kelas"]; ?></td>
		<!-- <td><img src="img/<?php echo $row["gambar"]; ?>" width="105"></td> -->
		<!-- <td><a href="showdata.php?id=<?php echo $row["att"]; ?>">Lihat Attachment</a></td> -->
		<td><?php echo $row["tanggal"]; ?></td>
		<td><?php echo $row["mata_pelajaran"]; ?></td>
		<td><?php echo $row["materi"]; ?></td>
		<td>
			<a href="ubah.php?id=<?php echo $row["id"]; ?>">Ubah</a> |
			<a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin ?');">Hapus</a>
		</td>
	</tr>
	<?php $i++ ?>
	<?php endforeach; ?>


	
</table>
</div>
<?php else: ?>
<h1>Data Kosong</h1>
<?php endif; ?>

<!-- <script src="../js/script.js"></script>  -->

</body>
</html>