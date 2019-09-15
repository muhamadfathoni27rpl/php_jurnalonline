<?php 
session_start();
if(!isset($_SESSION["loginn"])){
    header("Location:login.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];

if(hapususr($id) > 0 ){
    echo "
    
    <script>
        alert('Data berhasil Dihapus');
        document.location.href = 'user.php';
    </script>
    
    ";

}else{
    echo "
    
    <script>
        alert('Data gagal Dihapus');
        document.location.href = 'user.php';
    </script>
    ";
}

?>