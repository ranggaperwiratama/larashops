<?php
	include ('../../inc/config.php');
	include('../../inc/function.php');
	if(isset($_POST)){
		$id = $_POST['id'];
		$aksi = $_POST['aksi'];
		$target_dir = "../../upload/banner/";
		$filename = $_FILES['foto']['name'];
		$target_file = $target_dir . $filename;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["aksi"])) {
			$check = getimagesize($_FILES["foto"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["foto"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
				if($aksi == 'tambah'){
					$sql = "INSERT INTO slider(namaslider) VALUES ('$filename')";
					echo "The file ". $filename. " has been uploaded. ";
				}else if($aksi == 'edit') {
					$sql = "update slider set namaslider='$filename' where idslider='$id'";
					echo "The file ". $filename. " has been updated. ";
				}
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
		/*if($aksi == 'tambah') {
			$sql = "INSERT INTO slider(namaslider) VALUES ('$filename')";
			echo $filename;
		}else if($aksi == 'edit') {
			$sql = "update slider set namaslider='$filename' where idslider='$id'";
		}*/

		$result = mysql_query($sql) or die(mysql_error());

		//check if query successful
		if($result) {
			header('location:../index.php?mod=slider&pg=slider_view&status=0');
		} else {
			header('location:../index.php?mod=slider&pg=slider_view&status=1');
		}
	}
?>