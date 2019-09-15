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


function tambah($data){
	global $conn;
	$mataPelajaran = htmlspecialchars($data["mataPelajaran"]);
    $materi = htmlspecialchars($data["materi"]);
	$tanggal = date("Y-m-d");
	$code = $_SESSION["idyu"];
	$kelas = $_SESSION["kelasup"];
	// $attch = att();
	
	// upload gambar
	// $gambar = upload();
	// if(!$gambar){
	// 	return false;
	// }

	
	if ($mataPelajaran == "0"){
		echo "<script>alert('Pilih mata pelajaran')</script>";
		echo "<meta http-equiv='refresh' content='1 url=tambah.php'>";
	}elseif (empty($materi)){
		echo "<script>alert('Materi belum diisi')</script>";
		echo "<meta http-equiv='refresh' content='1 url=tambah.php'>";

		
		}else {
		$daftar = mysqli_query($conn, "INSERT INTO jurnal (id, code, tanggal, mata_pelajaran, materi, kelas) values ('', '$code','$tanggal', '$mataPelajaran','$materi', '$kelas')");
		echo "<script>alert('Data dibuat')</script>";
		$_SESSION["tok"] = 0;
		return mysqli_affected_rows($conn);
		}
	

	
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
//         alert('Apa yang diupload?');
//     </script>
    
// 	";
// 	return false;
// 	}

// // 	cek size file
// 	if( $ukuranFile > 30000000 ){
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

function att(){
	$namaFile = $_FILES['attch']['name'];
	$ukuranFile = $_FILES['attch']['size'];
	$error = $_FILES['attch']['error'];
	$tmpName = $_FILES['attch']['tmp_name'];

// cek tdk ada yg diupload
// if( $error === 4){
// 	$namaFile = '';
// 	return $namaFile;
// 	exit;
// }

// 	cek apa yg diapload
	$extensiFileValid = ['zip', 'rar', 'mp3', 'mp4', '7zip', 'flv'];
	$extensiFile = explode('.', $namaFile);
	$extensiFile = strtolower(end($extensiFile));
	if(!in_array($extensiFile, $extensiFileValid)){
		echo "
    
    <script>
        alert('Apa yang diupload?');
    </script>
    
	";
	return false;
	}

// 	cek size file
	if( $ukuranFile > 30000000 ){
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
	$namaFileBaru .= $extensiFile;
	

	move_uploaded_file($tmpName, 'att/' . $namaFileBaru);
	return $namaFileBaru;
	
}

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM jurnal WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$id = $data["id"];
    $materi = htmlspecialchars($data["materi"]);
    $mataPelajaran = htmlspecialchars($data["mataPelajaran"]);
	// $gambarLama = htmlspecialchars($data["gambarLama"]);
	// cek apakah user pilih gambar baru
	// if($_FILES["gambar"]["error"]===4){
	// 	$gambar = $gambarLama;
	// }else{
	// 	$gambar = upload();
	// }
	
	mysqli_query($conn, "UPDATE jurnal SET materi = '$materi', mata_pelajaran = '$mataPelajaran' WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$spesifik = $_SESSION['idyu'];
	if(empty($keyword)){
		$query = "SELECT * FROM jurnal WHERE code=$spesifik";
}else{
	$query = "SELECT * FROM jurnal WHERE code=$spesifik AND tanggal LIKE '%$keyword%'OR mata_pelajaran LIKE '%$keyword%'OR materi LIKE '%$keyword%'";
}
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
	mysqli_query($conn, "INSERT INTO user values ('', '$username','$display_pict', '$password', '$email', '$no_hp')");

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

	move_uploaded_file($tmpName, 'profiledisp/' . $namaFileBaru);
	return $namaFileBaru;
	
}

function ubhprof($data){

	global $conn;
	$id = $data["id"];
	$username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
	$display_pict = htmlspecialchars($data["gambarLama"]);
	//cek apakah user pilih gambar baru
	if($_FILES["display_pict"]["error"]===4){
		$gambar = $display_pict;
	}else{
		$gambar = dispic();
	}
	
	mysqli_query($conn, "UPDATE user SET username = '$username', email = '$email', no_hp = '$no_hp', display_pict = '$gambar' WHERE id = $id");

	return mysqli_affected_rows($conn);	
}

?>