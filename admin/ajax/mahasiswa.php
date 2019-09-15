<?php 
session_start();
require '../functions.php';
// $dollar = $_SESSION['login'];
$keyword = $_GET['keyword'];
$query = "SELECT * FROM jurnal 
WHERE tanggal LIKE '%$keyword%'OR mata_pelajaran LIKE '%$keyword%'OR materi LIKE '%$keyword%' OR code LIKE '%$keyword%'";
$mahasiswa = query($query);

?>
<table border="1" cellpadding="10" cellspacing="0">
	
<tr>
	<th>No.</th>
	<th>Aksi</th>
	<th>Author ID</th>
	<!-- <th>Gambar</th> -->
	<th>Tanggal</th>
	<th>Mata Pelajaran</th>
	<th>Materi</th>
</tr>
<?php $i = 1; ?>
	<?php foreach($mahasiswa as $row): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
			<a href="ubah.php?id=<?php echo $row["id"]; ?>">Ubah</a> |
			<a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin ?');">Hapus</a>
		</td>
		<td><?php echo $row["code"]; ?></td>
		<!-- <td><img src="../img/<?php echo $row["gambar"]; ?>" width="105"></td> -->
		<td><?php echo $row["tanggal"]; ?></td>
		<td><?php echo $row["mata_pelajaran"]; ?></td>
		<td><?php echo $row["materi"]; ?></td>
	</tr>
	<?php $i++ ?>
	<?php endforeach; ?>
    
    
        
    </table>