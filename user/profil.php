<?php

cek_status_login($_SESSION['idpelanggan']);
?>
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
		   <h4 id="headings">Profile</h4>
			<!--<a href='index.php?mod=invoice&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
		    <div class="cart-view-table">
              <div class="table-responsive">
				<table  class="table table-striped table-condensed">
		
		<tbody>
<?php
$id=$_SESSION['idpelanggan'];
$query="SELECT pelanggan.*
 from pelanggan
 where idpelanggan='$id'";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
		
			
				<tr><td>Nama </td><td><?php echo $rows -> nama; ?></td></td></tr>
			
			<tr><td>Email </td><td><?php echo $rows -> email; ?></td></td></tr>
				<tr><td>Telepon </td><td><?php echo $rows -> telp; ?></td></td></tr>
					<tr><td>Alamat </td><td><?php echo $rows -> alamat; ?></td></td></tr>
						<tr><td>Kota </td><td><?php echo $rows -> kota; ?></td></td></tr>
							<tr><td>Kode Post </td><td><?php echo $rows -> kodepos; ?></td></td></tr>
								<tr><td> Tanggal Daftar</td><td><?php echo tampil_tanggal($rows -> tanggal_daftar); ?></td></td></tr>
			
			
			
			</tr>
			<?php	$no++;
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