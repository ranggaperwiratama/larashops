<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include ('../inc/config.php');
include ('../inc/function.php');
include('../inc/header-back.php');
?>


	<body>
	<?php
	if(isset($_SESSION['username'])){
		?>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner" style="background: #000000 none repeat scroll 0 0;">
				<div class="container-fluid">
					<a href="index.php" class="brand">
						<small>
							<i><img src="../assets/themes-back/images/4.jpg" width="70px"></i>
						<b>LARA</b> Shop Dashboard
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						
						<li style="background:#000000 none repeat scroll 0 0;">	<a href="login/logout.php">
									<i class="icon-off"></i>
									Logout
								</a></li>
					</ul><!--/.w8-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="container-fluid" id="main-container">
			<a id="menu-toggler" href="#">
				<span></span>
			</a>
<!--sidebar-->			
<div id="sidebar">
<?php
if(isset($_SESSION['username'])){
include('../inc/sidebar-back.php');
}
?>
</div>
<!--content -->
<div id="main-content" class="clearfix">
<div style='margin:10px;padding: 10px'>
	<?php
$pg = '';
/*
 * PHP Code untuk mendapatkan halaman view masing masing tabel
 */

if(!isset($_GET['pg'])) {
	if(isset($_SESSION['username'])){
		include('dashboard/statistik.php');
	}
	
} else {
	$pg = $_GET['pg'];
	$mod = $_GET['mod'];
	include $mod . '/' . $pg . ".php";

}?>
</div>
</div>
<?php
	}
	else{
		include ('login/login_form.php');
	}
?>

	<?php
include('../inc/js.php');
?>
	</body>
</html>
