<?php

if(empty($_SESSION['username'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
		//===========CODE DELETE RECORD ================
			
				if(isset($_GET['act'])) {
					$id = $_GET['id'];
					$sql = "delete from berita where idberita='$id' ";
					mysql_query($sql) or die(mysql_error());

				}
				//==========================================?>
<div class='bs-docs-example'>
	<h2 id="headings">Data Promo</h2>
	<table  class="table table-striped table-condensed">
		<thead>
		<th><td><h4>Judul Promo </h4></td><td><h4>Posisi</h4></td><td><h4>Aksi</h4></td></th>
		</thead>
		<tbody>
		<?php
				//bata paging 

$query="SELECT * from berita";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

		?>
		<tr>
			<td><?php echo $posisi+$no
			?></td>
			<td><?php		echo $rows -> judul;?></td>
			<td><?php		echo $rows -> posisi;?></td>
			<td><a href="index.php?mod=berita&pg=berita_form&id=<?=	$rows -> idberita;?>" 
				class='btn btn-warning'><i class="icon-pencil"></i></a></td>
		</tr>
		<?php
	$no++;
	}?>
		</tbody>
	</table>

	<?php
// KODE UNTUK MENAMPILKAN PESAN STATUS
if(isset($_GET['status'])) {
	if($_GET['status'] == 0) {
		echo " Operasi data berhasil";
	} else {
		echo "operasi gagal";
	}
}

//close database	?>

</div>
