<?php

cek_status_login($_SESSION['idpelanggan']);
?>
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
<a href='index.php?mod=chart&pg=invoice' class='btn btn-warning'>
		<i class='icon-arrow-left icon-white'></i>Back</a>
	
	<h4 id="headings"> Detail Invoice dengan nomor <?php=$_GET['id']?></h4>
	<!--<a href='index.php?mod=produk&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<div class="cart-view-table">
              <div class="table-responsive">
	<table  class="table table-striped">
		<thead>
			<th><td><b>Nama </b></td><td><b>harga satuan</b></td><td><b>Jumlah</b></td><td class='pull-right'><b>Subtotal</b></td></th>
		</thead>
		<tbody>
<?php
$id=$_GET['id'];
$query="SELECT produk.*,transaksi.* ,stok.harga_jual
from produk,transaksi,stok 
where produk.idproduk=transaksi.idproduk
and produk.idproduk=stok.idproduk
and transaksi.noinvoice='$id'";

$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
$total=0;
while($rows=mysql_fetch_object($result)){
$subtotal= $rows -> harga_jual* $rows -> jumlah;
$total+=$total+$subtotal;
			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td>
					<img src='upload/produk/<?=$rows->foto ?>'  width='128px' height='128px' />
					<br>
					<?php echo $rows -> nama_produk; ?></td>
			<td><?php echo format_rupiah($rows -> harga_jual); ?></td>
			<td><?php echo $rows -> jumlah; ?></td>
			<td class='pull-right'><?php echo format_rupiah($subtotal); ?></td>
			
				
				
			</tr>
			
			<?php	$no++;
				}
			?>
<tr><td>Total</td><td colspan='4'  ><p class='pull-right'><?=format_rupiah($total);?></p></td></tr>
			
		</tbody>
	</table>
</div>
 </div>
         </div>
       </div>
     </div>
   </div>
 </section>