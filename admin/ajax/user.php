<?php 
session_start();
require '../functions.php';
$dollar = $_SESSION['login'];
$keyword = $_GET['keyword'];
$query = "SELECT * FROM user
WHERE id LIKE '%$keyword%'OR username LIKE '%$keyword%'OR email LIKE '%$keyword%' OR no_hp LIKE '%$keyword%'";
$mahasiswa = query($query);

?>
<table border="1" cellpadding="10" cellspacing="0">
	<th>No.</th>
	<th>Aksi</th>
    <th>ID</th>
	<th>Display Picture</th>
	<th>Username</th>
	<th>Email</th>
	<th>Nomor HP</th>
</tr>
<?php $i = 1; ?>
	<?php foreach($mahasiswa as $row): ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
			<a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin ?');">Hapus</a>
		</td>
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
    </body>
</html>