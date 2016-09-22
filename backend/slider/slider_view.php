<?php
	if(empty($_SESSION['username'])){
		echo "<p style='color:red'>akses denied</p>";
		exit();		
	}

	if (isset($_GET['act'])) {
		$id = $_GET['id'];
		$sql = "delete from slider where idslider='$id' ";
		mysql_query($sql) or die(mysql_error());

	}
?>
<div>
	<h2 id="headings"> Data Slider</h2>
	<table  class="table table-striped table-condensed">
		<thead>
			<th>
				<td><b>Nama Slider </b></td>
				<td style='min-width: 100px'><b>Aksi</b></td>
			</th>
		</thead>
		<tbody>
			<?php
				$batas='10';
				$tabel="slider";
				$halaman=$_GET['halaman'];
				$posisi=null;
				if(empty($halaman)){
				$posisi=0;
				$halaman=1;
				}else{
				$posisi=($halaman-1)* $batas;
				}
				$query="SELECT * from slider limit $posisi,$batas ";
				$result=mysql_query($query) or die(mysql_error());
				$no=1;
				while($rows=mysql_fetch_object($result)){
			?>
			<tr>
				<td><?php echo $posisi+$no ?></td>
				<td><?php echo $rows -> namaslider; ?></td>
				<td>
					<a href="index.php?mod=slider&pg=slider_form&id=<?= $rows -> idslider; ?>" class='btn btn-warning'>
						<i class="icon-pencil"></i>
					</a>
					<a href="index.php?mod=slider&pg=slider_view&act=del&id=<?= $rows -> idslider; ?>" onclick="return confirm('Yakin data akan dihapus?') "; class='btn btn-danger'> 
						<i class="icon-trash"></i>
					</a>
				</td>
			</tr>
			<?php $no++;
				}
			?>
			<tr>
				<td colspan='4' ></td>
				<td><a href="index.php?mod=slider&pg=slider_form" class='btn btn-primary'>
					<i class="icon-plus"></i>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
		$tampil2 = mysql_query("SELECT idslider from slider");

		$jmldata = mysql_num_rows($tampil2);
		$jumlah_halaman = ceil($jmldata / $batas);
	?>
	<div class='pagination'> 
		<ul>
			<?php pagination($halaman, $jumlah_halaman, "slider"); ?>
		</ul>
	</div>
	<div class='well'>Jumlah data :<strong><?= $jmldata; ?> </strong></div>
	<?php
		// KODE UNTUK MENAMPILKAN PESAN STATUS
		if (isset($_GET['status'])) {
			if ($_GET['status'] == 0) {
				echo " Operasi data berhasil";
			} else {
				echo "operasi gagal";
			}
		}
	?>
</div>
