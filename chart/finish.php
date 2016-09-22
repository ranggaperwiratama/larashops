
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
<?php
$kd_transaksi = $_GET['kd_transaksi'];
$totalBayar = $_GET['total_bayar'];?>

<h3> Selamat,Transaksi sukses di lakukan</h2>
<h3> Kode Pesan :<?=$kd_transaksi;?></h2>
<h3>Total Harga :<?=format_rupiah($totalBayar);?></h2>


</h2>
<p>
	Silahkan transfer uang ke
</p>
<blockquote>
	Candra Adi Putra
	<br>
	BNI Syariah Yogyakarta
	<br>
	No Rek 978934234343
	<br>
</blockquote>
<hr>
<p>
	Langkah selanjutnya :
	<ol>
	<li>Silahkan transfer sesuai dengan uang jumlah total transaksi</li> 
	<li>Konfirmasi lewat SMS /Telp ke no 0274 123 123 </li>
	<li>Cek status pembayaran dan pengiriman barang di halaman invoice </li>
	</ol>
</p>
</div></div></div></div></div></section>
 <!-- / Cart view section -->	
