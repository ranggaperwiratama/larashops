
<?php ini_set( "display_errors", 0);

cek_status_login($_SESSION['idpelanggan']);
?>
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
		   <h4 id="headings"> Data invoice</h4>
			<!--<a href='index.php?mod=invoice&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
		    <div class="cart-view-table">
              <div class="table-responsive">
				<table  class="table table-striped table-condensed">
					<thead>
						<th><td><b>Nama </b></td><td><b>Kd Invoice</b></td><td><b>Tanggal Transaksi</b></td><td><b>Total Transaksi</b></td><td><b>Pembayaran</b></td><td><b>Tgl Kirim</b></td><td><b>No. Resi</b></td><td><b>Aksi</b></td></th>
					</thead>
					<tbody>
<?php
//mengambil id pelanggan
$id=$_SESSION['idpelanggan'];
//query mengambil data invoice
$query="SELECT invoice.*,pelanggan.nama
 from invoice,pelanggan
 where invoice.idpelanggan=pelanggan.idpelanggan
 and pelanggan.idpelanggan='$id'
";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php echo $rows -> nama; ?></td>
			<td><a href='index.php?mod=chart&pg=invoice_detail&id=<?php echo $rows -> noinvoice; ?>'><?php echo $rows -> noinvoice; ?></a></td>
			<td><?php echo $rows -> tanggal; ?></td>
				<td><?php echo format_rupiah($rows ->totalbayar); ?></td>
		
			<td><?php echo get_status_invoice($rows -> transfer); ?></td>
			<td><?php echo tglkirim($rows -> tglkirim); ?></td>
			<td><?php echo $rows->noresi; ?></td>
			<?php
				if($rows->transfer == '0'){?>
					<td><a href="index.php?mod=page&pg=konfirmasi&id=<?= $rows -> noinvoice ?>"
						class='btn btn-success'>Konfirmasi Pembayaran</a></td>
				<?php } else { ?>
					<td></td>
				<?php }
			?>
			
				
			</tr>
			<?php $no++;
				}
			?>

			
		</tbody>
	</table>
</div>

           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <?php
	
 ?>