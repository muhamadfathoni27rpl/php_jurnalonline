<?php 
session_start();
require '../guru/functions.php';
$dollar = $_SESSION['idyu'];
$keyword = $_GET['keyword'];
if(empty($keyword)){
	$query = "SELECT * FROM jurnal WHERE code = $dollar";
}else{
$query = "SELECT * FROM jurnal WHERE code = $dollar AND tanggal LIKE '%$keyword%'OR materi LIKE '%$keyword%'";
}
$mahasiswa = query($query);

?>
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