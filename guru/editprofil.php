<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}
require "functions.php";

    // ambil data di url
    $id = $_SESSION["idyu"];
    // query data mahasiswa berdasar id
    $mhs = query("SELECT * FROM user WHERE id = $id");
    // cek apakah tombol ditekann
    if( isset($_POST["submit"])){
    if( ubhprof($_POST) > 0){
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
    <link rel="icon" type="image/png" href="../base/JO-title.png">
    <title>Edit Profil | Jurnal Online</title>
</head>
<body>
    <h1>Ubah Data Akun</h1>

    <?php foreach($mhs as $q): ?>
    <form action="" method="post" enctype=multipart/form-data>
    <input type="hidden" name="id" value="<?php echo $q["id"]; ?>"></input> 
    <input type="hidden" name="gambarLama" value="<?php echo $q["display_pict"]; ?>"></input>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" value="<?= $q["username"];?>">
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" id="email"value="<?= $q["email"];?>">
        <br>
        <label for="no_hp">Nomor HP: </label>
        <input type="text" name="no_hp" id="no_hp"value="<?= $q["no_hp"];?>">
        <br>
        <label for="display_pict">Foto Profil: </label><br>
        <img src="../profiledisp/<?= $q['display_pict']; ?>" width="100"><br>
        <input type="file" name="display_pict" id="display_pict">
        <br>
        <button type="submit" name="submit">Ubah Data</button>
    </form>
    <?php endforeach; ?>

    <a href="profil.php">Batalkan</a>
</body>
</html>