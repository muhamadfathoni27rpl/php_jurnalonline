<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}

if($_SESSION["tok"] == 0){
    header("Location:landingpage.php");
    exit;
}

if(isset($_POST["back"])){
    $_SESSION["tok"] = 0;
    header("Location:landingpage.php");
    exit;
}
require "functions.php";
    // cek apakah data berhasil ditambahkan
    if( isset($_POST["submit"])){
        // var_dump($_FILES);
    if( tambah($_POST) > 0){
        $_SESSION["tok"] = 0;
        header("Location:index.php");
        exit;
    }else{
        echo "Gagal Ditambahkan";
        exit;
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
    <title>Jurnal | Jurnal Daring</title>
</head>
<body>
    <h1>Tambah Jurnal</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="mataPelajaran">Mata Pelajaran</label>
        <!-- <input type="text" name="mataPelajaran" id="mataPelajaran" require=""> -->
        <select name="mataPelajaran" id="mataPelajaran">
               <option value="0">Pilih Mapel</option>
               <option value = "Bahasa Indonesia">Bahasa Indonesia</option>
               <option value = "Bahasa Inggris">Bahasa Inggris</option>
               <option value = "Bimbingan Konseling">Bimbingan Konseling</option>
               <option value = "Dasar Desain Grafis">Dasar Desain Grafis</option>
               <option value = "Fisika">Fisika</option>
               <option value = "Kimia">Kimia</option>
               <option value = "Komputer dan Jaringan Dasar">Komputer dan Jaringan Dasar</option>
               <option value = "Matematika">Matematika</option>
               <option value = "Pendidikan Agama Islam">Pendidikan Agama Islam</option>
               <option value = "Pendidikan Jasmani dan Kesehatan">Pendidikan Jasmani dan Kesehatan</option>
               <option value = "Pendidikan Kewarganegaraan">Pendidikan Kewarganegaraan</option>
               <option value = "Produktif RPL">Produktif RPL</option>
               <option value = "Produktif RPL TeFa">Produktif RPL TeFa</option>
               <option value = "Sejarah Indonesia">Sejarah Indonesia</option>
               <option value = "Seni Budaya">Seni Budaya</option>
               <option value = "Sistem Telekomunikasi">Sistem Telekomunikasi</option>
             </select>
             <br>
        <label for="materi">Materi</label>
        <input type="text" name="materi" id="materi"require="">
    <!-- </li>
    <li>
        <label for="gambar">Gambar: </label>
        <input type="file" name="gambar" id="gambar">
    </li> -->
    <!-- <li>
        <label for="attch">Attachment: </label>
        <input type="file" name="attch" id="attch">
    </li> -->
    <br>
        <button type="submit" name="submit">Tambah Jurnal</button>
        <br>
        <button type="submit" name="back">Kembali</button>
    </form>
</body>
</html>