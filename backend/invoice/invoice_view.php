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
?>
<?php 
//===========CODE DELETE RECORD ================

if (isset($_GET['act'])) {
	$act=$_GET['act'];
	if($act=='del'){
		$id = $_GET['id'];
		$sql = "delete from transaksi where noinvoice='$id' ";
		mysql_query($sql) or die(mysql_error());
		$sql = "delete from invoice where noinvoice='$id' ";
		mysql_query($sql) or die(mysql_error());
	}else if($act=='bayar'){
		$id = $_GET['id'];
		$sql = "update  invoice set transfer='2' where noinvoice='$id' ";
		mysql_query($sql) or die(mysql_error());
		//kode untuk mengurangi barang 
		//1. dapatkan idbarang dan jumlah pada transaksi tersebut 
		$sql = "select idproduk,jumlah from transaksi where  noinvoice='$id' ";
		$res=mysql_query($sql) or die(mysql_error());
		while($rows=mysql_fetch_object($res)){
			//2. kurangi barang sejumlah pembelian 
			$query="update stok set jumlah=jumlah - ".$rows->jumlah." where idproduk=".$rows->idproduk;
			mysql_query($query) or die(mysql_error());
		}
	}else if($act=='kirim'){
		$id = $_POST['noinvoice'];
		$noresi = $_POST['noresi'];
		$query =mysql_fetch_array(mysql_query("SELECT transfer FROM invoice WHERE noinvoice='$id'"));
		if($query['transfer']=='2'){
			$sql = "update invoice set tglkirim=now(), noresi='$noresi' where noinvoice='$id' ";
			mysql_query($sql) or die(mysql_error());
		} else {
			echo "<script> alert('Customer belum bayar!') </script>";
		}
	}
}
?>

<div>
	<h2 id="headings"> Data invoice</h2>
	<table class="table">
			<tr>
				<td style="text-align:right; line-height:10px; padding:0px; border-top:0px;">
					<?php
						$ambilbulan = "SELECT DISTINCT DATE_FORMAT(tanggal, '%M %Y') as bulantahun FROM invoice";
						$hasil = mysql_query($ambilbulan);
					?>
					<form action="" method="post" name="form1" id="form1" style="margin:0;">
						<select class="form-control" name="filterbulan" onChange="document.getElementById('form1').submit()">
							<option selected='selected' value="">Semua Transaksi</option>
						<?php
							while($data = mysql_fetch_array($hasil)){
								if($data[bulantahun] == $_POST['filterbulan']){
						?>
							<option selected='selected' value="<?= $data[bulantahun]; ?>"><?php echo $data[bulantahun]; ?></option>
						<?php	}else{
						?>
							<option value="<?= $data[bulantahun]; ?>"><?php echo $data[bulantahun]; ?></option>
						<?php
							}}
						?>
						</select>
					</form>
				</td>
				<td width="350px" style="text-align:right; line-height:10px; padding:0px; border-top:0px;">
					
					<form action="" method="post" name="form" style="margin:0;">
						<div class="form-group"><div class="input-group">
							<input style="margin-bottom:0; width:300px;" name="kunci" id="kunci" type="text" class="form-control" placeholder="Search by no invoice" /><span class="input-group-addon"><i id="kunci"><img src="../assets/themes-back/images/search.png" width="30px"></i></span>
						</div></div>
					</form>
				</td>
			</tr>
	</table>
	<!--<a href='index.php?mod=invoice&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>Kd Invoice</b></td><td><b>Tanggal Transaksi</b></td><td><b>Total Transaksi</b></td><td><b>Pembayaran</b></td><td><b>Tgl Kirim</b></td><td><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='5';
$tabel="invoice";
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
	$query="SELECT invoice.*,pelanggan.nama
	 from invoice,pelanggan
	 where invoice.noinvoice like '%$kunci%' and invoice.idpelanggan=pelanggan.idpelanggan
	 limit $posisi,$batas ";
	$result=mysql_query($query) or die(mysql_error());
}else if(isset($_POST['filterbulan'])){
	$filter = $_POST['filterbulan'];
	if(!empty($filter)){
		$query="SELECT invoice.*,pelanggan.nama
		 from invoice,pelanggan
		 where date_format(tanggal, '%M %Y') = '$filter' and invoice.idpelanggan=pelanggan.idpelanggan
		 limit $posisi,$batas ";
		$result=mysql_query($query) or die(mysql_error());
	}else{
		$query="SELECT invoice.*,pelanggan.nama
		 from invoice,pelanggan
		 where invoice.idpelanggan=pelanggan.idpelanggan
		 limit $posisi,$batas ";
		$result=mysql_query($query) or die(mysql_error());
	}
	
}else{
	$query="SELECT invoice.*,pelanggan.nama
	 from invoice,pelanggan
	 where invoice.idpelanggan=pelanggan.idpelanggan
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
			
				<td><?php echo $rows -> nama; ?></td>
			<td><a href='index.php?mod=invoice&pg=invoice_detail&id=<?php echo $rows -> noinvoice; ?>'><?php echo $rows -> noinvoice; ?></a></td>
			<td><?php echo $rows -> tanggal; ?></td>
				<td><?php echo format_rupiah($rows ->totalbayar); ?></td>
		
			<td><?php echo get_status_invoice($rows -> transfer); ?></td>
			<td><?php echo tglkirim($rows -> tglkirim); ?>
				
				</td>
			
				<td>	
				<?php if($rows->transfer=='1'){ ?>
					<a href="index.php?mod=invoice&pg=invoice_view&act=bayar&id=<?= $rows -> noinvoice; ?>"
					onclick="return confirm('Tandai sudah bayar?') ";
					class='btn btn-success'> <i class="icon-ok"></i>Konfirm Pembayaran</a><?php }
				else { ?>
					<button class='btn btn-success'> <i class="icon-ok"></i>Konfirm Pembayaran</button><?php
				}
				if($rows->tglkirim == null){ ?>
					<a href="#" data-toggle2="tooltip" data-placement="top" data-toggle="modal" data-target="#<?=$rows->noinvoice;?>"
					class='btn btn-success'> <i class="icon-ok"></i>Kirim barang</a><?php }
				else { ?>
					<button class='btn btn-success'> <i class="icon-ok"></i>Kirim barang</button><?php
				} ?>
				<a href="index.php?mod=invoice&pg=invoice_view&act=del&id=<?= $rows -> noinvoice; ?>"
				onclick="return confirm('Yakin data akan dihapus?') ";
				class='btn btn-danger'> <i class="icon-trash"></i></a>
				</td>
			</tr>
			<!-- Resi Modal -->  
  <div class="modal fade" id="<?=$rows->noinvoice;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="color:#ffffff;">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Masukkan nomor resi</h4>
          <form class="aa-login-form" action="index.php?mod=invoice&pg=invoice_view&act=kirim"  method="post" id='form1'>
            <label for="">No. Resi</label>
            <input type="text" id="noresi" name='noresi'><input type="hidden" id="noinvoice" name='noinvoice' value="<?php echo $rows->noinvoice;?>">
            <button class="aa-browse-btn" type="submit">Submit</button>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
			<?php $no++;
			$totalbayar += $rows -> totalbayar;
				}
			?>

			
		</tbody>
	</table>
	<div>Total transaksi : <strong><?php echo format_rupiah($totalbayar); ?> </strong></div>
	<?php //=============CUT HERE for paging====================================
	$tampil2 = mysql_query("SELECT noinvoice from invoice");

	$jmldata = mysql_num_rows($tampil2);
	$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php pagination($halaman, $jumlah_halaman, "invoice"); ?>
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

//close database
?>

</div>

