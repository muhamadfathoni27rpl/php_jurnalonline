<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sck");


function query ($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	
	return $rows;
}

// function upload(){
// 	$namaFile = $_FILES['gambar']['name'];
// 	$ukuranFile = $_FILES['gambar']['size'];
// 	$error = $_FILES['gambar']['error'];
// 	$tmpName = $_FILES['gambar']['tmp_name'];

// // cek tdk ada yg diupload
// if( $error === 4){
// 	$namaFileBaru = '';
// 	return $namaFileBaru;
// 	exit;
// }

// // 	cek apa yg diapload gambar
// 	$extensiGambarValid = ['jpg', 'png', 'jpeg', 'jfif'];
// 	$extensiGambar = explode('.', $namaFile);
// 	$extensiGambar = strtolower(end($extensiGambar));
// 	if(!in_array($extensiGambar, $extensiGambarValid)){
// 		echo "
    
//     <script>
//         alert('Yang diUpload bukan Gambar!');
//     </script>
    
// 	";
// 	return false;
// 	}

// // 	cek size file
// 	if( $ukuranFile > 1000000 ){
// 		echo "
    
//     <script>
//         alert('Ukuran telalu besar');
//     </script>
    
// 	";
// 	return false;
// 	}

// 	// gambar siap diupload
	
// 	// generate nama baru
// 	$namaFileBaru = uniqid();
// 	$namaFileBaru .= '.';
// 	$namaFileBaru .= $extensiGambar;

// 	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
// 	return $namaFileBaru;
	
// }

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM jurnal WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function hapususr($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE id = $id");
	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$query = "SELECT * FROM jurnal WHERE tanggal LIKE '%$keyword%'OR mata_pelajaran LIKE '%$keyword%'OR materi LIKE '%$keyword%' OR code LIKE '%$keyword%'";
	return query($query);
}

function cariusr($keyword){
	$query = "SELECT * FROM user WHERE id LIKE '%$keyword%'OR username LIKE '%$keyword%'OR email LIKE '%$keyword%' OR no_hp LIKE '%$keyword%'";
	return query($query);
}


function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$email = mysqli_real_escape_string($conn, $data["email"]);
	$no_hp = mysqli_real_escape_string($conn, $data["no_hp"]);
	$display_pict = dispic();
	// $posisi = $data["posisi"];

if(empty($username)){
	echo "<script>alert('Username belum diisi')</script>";
	echo "<meta http-equiv='refresh' content='1 url=registrasi.php'>";
	exit;
}
if(empty($password)){
	echo "<script>alert('Password belum diisi')</script>";
	echo "<meta http-equiv='refresh' content='1 url=registrasi.php'>";
	exit;
}
if(empty($password2)){
	echo "<script>alert('Password2 belum diisi')</script>";
	echo "<meta http-equiv='refresh' content='1 url=registrasi.php'>";
	exit;
}
if(empty($email)){
	echo "<script>alert('Email belum diisi')</script>";
	echo "<meta http-equiv='refresh' content='1 url=registrasi.php'>";
	exit;
}
if(empty($no_hp)){
	echo "<script>alert('Nomor HP belum diisi')</script>";
	echo "<meta http-equiv='refresh' content='1 url=registrasi.php'>";
	exit;
}
// if(empty($posisi)){
// 	echo "<script>alert('Piih Posisi')</script>";
// 	echo "<meta http-equiv='refresh' content='1 url=registrasi.php'>";
// 	exit;
// }
if(empty($display_pict)){
	$display_pict = "Guest - Default.png";
}
	// cek username double
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result)){
		echo"<script>
        alert('Nama user sudah ada')
		</script>";
		return false;
	}

	// cek konfirm pass
	if($password != $password2){
		echo"<script>
        alert('Pasword tidak sama')
		</script>";
		return false;
	}
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	// tambah user baru
	// mysqli_query($conn, "INSERT INTO user values ('','$posisi', '$username','$display_pict', '$password', '$email', '$no_hp')");

	mysqli_query($conn, "INSERT INTO user values ('', '$username','$display_pict', '$password', '$email', '$no_hp')");

	return mysqli_affected_rows($conn);
}

function token($tkn){
	global $conn;
	$tkn1 = $tkn["kelas"];

	mysqli_query($conn, "DELETE FROM token");

	for( $count= 1 ; $count <= 7 ; $count ++){
		$gen1 = mt_rand(0,999999);
		$kelas1 = "XR".$count;
		$token = $gen1;
		$tgl = date("Y-m-d");

		mysqli_query($conn, "INSERT INTO token (id, kelas, token, tanggal) values ('', '$kelas1', '$token', '$tgl')");
		
	}
	

	for( $count= 1 ; $count <= 6 ; $count ++){
		$gen2 = mt_rand(0,999999);
		$kelas1 = "XT".$count;
		$token = $gen2;
		$tgl = date("Y-m-d");

		mysqli_query($conn, "INSERT INTO token (id, kelas, token, tanggal) values ('', '$kelas1','$token', '$tgl')");
	}
	return mysqli_affected_rows($conn);
}

function dispic(){
	$namaFile = $_FILES['display_pict']['name'];
	$ukuranFile = $_FILES['display_pict']['size'];
	$error = $_FILES['display_pict']['error'];
	$tmpName = $_FILES['display_pict']['tmp_name'];

// cek tdk ada yg diupload
if( $error === 4){
	$namaFileBaru = '';
	return $namaFileBaru;
	exit;
}

// 	cek apa yg diapload gambar
	$extensiGambarValid = ['jpg', 'png', 'jpeg', 'jfif'];
	$extensiGambar = explode('.', $namaFile);
	$extensiGambar = strtolower(end($extensiGambar));
	if(!in_array($extensiGambar, $extensiGambarValid)){
		echo "
    
    <script>
        alert('Apa yang diupload?');
    </script>
    
	";
	return false;
	}

// 	cek size file
	if( $ukuranFile > 1000000 ){
		echo "
    
    <script>
        alert('Ukuran telalu besar');
    </script>
    
	";
	return false;
	}

	// gambar siap diupload
	
	// generate nama baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $extensiGambar;

	move_uploaded_file($tmpName, '../profiledisp/' . $namaFileBaru);
	return $namaFileBaru;
	
}

 ?>