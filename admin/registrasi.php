<?php 
require 'functions.php';
if(isset($_POST["register"])){
    if(isset($_POST["Gru"])){
        $_POST["posisi"] = "Guru";
    }
    if(isset($_POST["Sis"])){
        $_POST["posisi"] = "Ketua Kelas";
    }
    if(registrasi($_POST) > 0){
        echo"<script>
        alert('User baru berhasil ditambahkan')
        document.location.href = 'index.php';
        </script>";
    }else{
        echo mysqli_error($conn);
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
    <title>Register | Jurnal Online</title>
    <style>
        label {
            display: block;

        }
    </style>
</head>
<body>
    <h1>Tambah Akun</h1>

    <form action="" method="post" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <label for="password2">Konfirmasi Password</label>
            <input type="password" name="password2" id="password2">
         
            <!-- <button type="submit" id="Gru">Guru</button>
        
            <button type="submit" id="Sis">Siswa</button> -->

<!-- <div id = "optioni" >
</div> -->

            <label for="email">Email</label>
            <input type="Email" name="email" id="email">

            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp">

            <label for="display_pict">Foto Profil: </label>
            <input type="file" name="display_pict" id="display_pict">
<br>
            <button type="submit" name="register">Sign Up</button>
<br>
            <a href="index.php">Kembali</a>
    </form>
<!-- <script src="js/script3.js"></script>  -->
</body>
</html>