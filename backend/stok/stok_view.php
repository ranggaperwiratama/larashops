<?php
/* Toko Kita Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */
 if(empty($_SESSION['username'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
 
 				//===========CODE DELETE RECORD ================

					if(isset($_GET['act'])) {
						$id = $_GET['id'];
						$sql = "delete from stok where idstok='$id' ";
						mysql_query($sql) or die(mysql_error());

					}
					if(isset($_POST['update'])) {
						$persen = $_POST['persen'];
						$persen=$persen/100;
						$sql = "update stok set harga_jual=harga_jual+(harga_jual*$persen) ";
						mysql_query($sql) or die(mysql_error());

					}
					?>

<div>
	
	<!--<a href='index.php?mod=stok&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<h2 id="headings"> Data stok</h2>
	<table class="table">
			<tr><td style="text-align:right; line-height:10px; padding:0px; border-top:0px;">
					<form action="" method="post" name="form" style="margin:0;">
						<div class="form-group"><div class="input-group">
							<input style="margin-bottom:0; width:300px;" name="kunci" id="kunci" type="text" class="form-control" placeholder="Search by nama atau kategori produk" /><span class="input-group-addon"><i id="kunci"><img src="../assets/themes-back/images/search.png" width="30px"></i></span>
						</div></div>
					</form>
				</td>
			</tr>
	</table>
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama produk </b></td><td><b>Harga Beli</b></td><td><b>Harga Jual</b></td><td><b>jumlah</b></td><td><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='10';
$tabel="stok";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
if(isset($_POST['kunci']) && $_POST['kunci']){
	$kunci = $_POST['kunci'];
	$query="SELECT stok.*,produk.nama_produk
	 from stok,produk
	 where produk.nama_produk like '%$kunci%' and stok.idproduk=produk.idproduk
	 limit $posisi,$batas ";
	$result=mysql_query($query) or die(mysql_error());
}else{
	$query="SELECT stok.*,produk.nama_produk
	 from stok,produk
	 where stok.idproduk=produk.idproduk
	 limit $posisi,$batas ";
	$result=mysql_query($query) or die(mysql_error());
}
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php		echo $rows -> nama_produk;?></td>
			<td align='right'><?php		echo format_rupiah($rows ->harga_beli);?></td>
			<td align='right'><?php		echo format_rupiah($rows ->harga_jual);?></td>
			<td align='right'><?php		echo $rows ->jumlah;?></td>
			
				<td>	
					
					<a href="index.php?mod=stok&pg=stok_form&id=<?=	$rows -> idstok;?>"

				class='btn btn-warning'> <i class="icon-pencil"></i></a><a href="#"

				class='btn btn-danger'> <i><img src="../assets/themes-back/images/sale.png" width="20px"></i></a></td>
			</tr>
			<?php	$no++;
	}?>
		</tbody>
	</table>
	<?php
//=============CUT HERE for paging====================================
$tampil2 = mysql_query("SELECT idstok from stok");

$jmldata = mysql_num_rows($tampil2);
$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php
pagination($halaman, $jumlah_halaman,"stok");
?>
	</ul>
</div>
<div class='well'>Jumlah data :<strong><?=$jmldata;?> </strong></div>
<?php
// KODE UNTUK MENAMPILKAN PESAN STATUS
if(isset($_GET['status'])) {
	if($_GET['status'] == 0) {
		echo " Operasi data berhasil";
	} else {
		echo "operasi gagal";
	}
}

//close database?>

</div>
