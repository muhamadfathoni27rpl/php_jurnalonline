<?php 
session_start();
if(!isset($_SESSION["loginn"])){
    header("Location:login.php");
    exit;
}
require"functions.php";

    // ambil data di url
    $id = $_GET["id"];
    // query data mahasiswa berdasar id
    $mhs = query("SELECT * FROM jurnal WHERE id = $id")[0];
    // cek apakah tombol ditekann
    if( isset($_POST["submit"])){
    if( ubah($_POST) > 0){
        echo "<script>
        alert('Data berhasil Diubah');
        document.location.href = 'index.php';
    </script>";
    }else{
        echo "<script>
        alert('Data Gagal Diubah');
        document.location.href = 'index.php';
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
    <link rel="icon" type="image/png" href="base/JO-title.png">
    <title>Edit | Jurnal Online</title>
</head>
<body>
    <h1>Ubah Data Jurnal</h1>

    <form action="" method="post" enctype=multipart/form-data>
    <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>"></input> 
    <input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?>"></input>
    <li>
        <label for="mataPelajaran">Mata Pelajaran</label>
        <input type="text" name="mataPelajaran" id="mataPelajaran" value="<?= $mhs["mata_pelajaran"];?>">
    
    </li>
    <li>
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal"value="<?= $mhs["tanggal"];?>">
    </li>
    <li>
        <label for="materi">Materi</label>
        <input type="text" name="materi" id="materi"value="<?= $mhs["materi"];?>">
    </li>
    <!-- <li>
        <label for="gambar">Gambar: </label><br>
        <img src="../img/<?= $mhs['gambar']; ?>" width="100"><br>
        <input type="file" name="gambar" id="gambar">
    </li> -->
    <li>
        <button type="submit" name="submit">Ubah Data</button>
    </li>
    </ul>
    </form>
</body>
</html>