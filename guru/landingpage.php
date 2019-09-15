<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}
// var_dump($_SESSION["tok"]);
require "functions.php";
$dataku = $_SESSION['idyu'];
$take = query("SELECT * FROM user WHERE id=$dataku");

if(isset($_POST["var2"])){
    $tokhen = $_POST["ver"];
    $result = mysqli_query($conn, "SELECT * FROM token WHERE token ='$tokhen'");

    $sql = mysqli_query($conn, "SELECT * FROM token WHERE token='$tokhen'");
    if(mysqli_num_rows($result) === 1){
        $row_data = mysqli_fetch_array($sql);
        $_SESSION["kelasup"] = $row_data["kelas"];
        $_SESSION["tok"] = 1;

        header("Location: tambah.php");
        exit;
    }else{
        $error = true;
    }
}

?>
<!-- Nama Title -->
<?php foreach($take as $em): ?>
    <?php $title = $em["username"];
            $gbr = $em["display_pict"];
            $nam = $em["username"];
             ?>
<?php endforeach; ?>

<?php 
// Sambut berdasar Jam

$date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$nig = $date->format('H');

if($nig == 1){
    $res = "Dini Hari";
}elseif($nig == 2){
    $res = "Dini Hari";
}elseif($nig == 3){
    $res = "Dini Hari";
}elseif($nig == 4){
    $res = "Dini Hari";
}elseif($nig == 5){
    $res = "Dini Hari";
}elseif($nig == 6){
    $res = "Selamat Pagi";
}elseif($nig == 7){
    $res = "Selamat Pagi";
}elseif($nig == 8){
    $res = "Selamat Pagi";
}elseif($nig == 9){
    $res = "Selamat Pagi";
}elseif($nig == 10){
    $res = "Selamat Siang";
}elseif($nig == 11){
    $res = "Selamat Siang";
}elseif($nig == 12){
    $res = "Selamat Siang";
}elseif($nig == 13){
    $res = "Selamat Siang";
}elseif($nig == 14){
    $res = "Selamat Sore";
}elseif($nig == 15){
    $res = "Selamat Sore";
}elseif($nig == 16){
    $res = "Selamat Sore";
}elseif($nig == 17){
    $res = "Selamat Sore";
}elseif($nig == 18){
    $res = "Selamat Malam";
}elseif($nig == 19){
    $res = "Selamat Malam";
}elseif($nig == 20){
    $res = "Selamat Malam";
}elseif($nig == 21){
    $res = "Selamat Malam";
}elseif($nig == 22){
    $res = "Tengah Malam";
}elseif($nig == 23){
    $res = "Tengah Malam";
}elseif($nig == 0){
    $res = "Tengah Malam";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../base/JO-title.png">
    <!-- <link rel="stylesheet" type="text/css" href="css/global.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <title>Selamat Datang <?php echo $title; ?> | Jurnal Daring</title>
</head>
<body>
    <a href="index.php">Lihat Jurnal</a>
    <br>
    <img src="../profiledisp/<?php echo $gbr; ?>" width="105">
<div class="frame">
    <h1 class="halo"><?php echo $res; ?>, <?php echo $nam; ?></h1>

    <form action="" method="post">
        <h2>Silahkan Masukkan Token</h2>
<div class="token">
        <input class="ver" autocomplete="off" type="text" name="ver" id="ver" maxlength="6">
        <button class="var2" type="submit" name="var2" id="var2">OK</button>
        <p>
        <?php if(isset($error)) : ?>
            <p class="fail">Token Tidak Valid</p>
        <?php endif; ?>
        </p>
    </form>
</div>
<p><?php echo date("l, M Y"); ?></p>
</div>
</body>
</html>