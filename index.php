
<?php
session_start();
include('inc/function.php');
include('inc/config.php');
include('inc/header-front.php');

//content 

$pg = '';
/*
 * PHP Code untuk mendapatkan halaman view masing masing tabel
 */

if(!isset($_GET['pg'])) {
		include ('page/homepage.php');
	} else {
		$mod=$_GET['mod'];
	$pg = $_GET['pg'];

	include  $mod."/". $pg . ".php";

}
ini_set( "display_errors", 0);
						//jika login gagal 
						if($_GET['loginerror']){
							echo "<script type='text/javascript'>alert('Login Failed!');</script>";
													}

include('inc/footer-front.php');



?>	