
<?php 
session_start();
include('../inc/config.php');
include('../inc/function.php');
//memanggil status login 
update_status_login("0",$_SESSION['idpelanggan']);

session_destroy();
header("location:../index.php");
?>