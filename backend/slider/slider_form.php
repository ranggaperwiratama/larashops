<?php
	if(empty($_SESSION['username'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
	$aksi = null;
	if(isset($_GET['id'])) {
		$aksi = "edit";
		$id = $_GET['id'];
		//baris dibawah ini disesuaikan dengan nama tabel dan idtabelnya
			$sql = "select * from slider where idslider='$id' ";
		$result = mysql_query($sql) or die(mysql_error());
		$data = mysql_fetch_object($result);

	} else {
		$aksi = "tambah";
	}
?>
	
	<h2> Form Slider</h2>
	<form  class="form-horizontal" method="POST" id="form1"  enctype="multipart/form-data" action="slider/slider_action.php">
		<?php
			$id = $_GET['id'];
		?>
		<input type='hidden' name='id' value="<?=$id?>">
		<div class="control-group">
			<label class="control-label" for="foto">Upload Gambar</label>
			<div class="controls">
				<input type="file" name='foto' 
				>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-success" name='aksi'value='<?=$aksi?>'>
				<?=$aksi?>
				</button>
			</div>
		</div>
	</form>