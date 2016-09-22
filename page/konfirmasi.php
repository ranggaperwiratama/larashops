<?php
	session_start();
	$idpelanggan = $_SESSION['idpelanggan'];
	$query=mysql_fetch_array(mysql_query("SELECT nama FROM pelanggan WHERE idpelanggan = '$idpelanggan'"));
	$noinvoice = $_GET['id'];
?>
<!-- Konfirmasi -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Konfirmasi Pembayaran</h4>
                 <form action="" id="form" class="aa-login-form" method="POST" enctype="multipart/form-data">
                    <label for="">No. Invoice</label>
					<input type="text" name="noinvoice" id="noinvoice" required value="<?=$noinvoice?>" disabled>
					<label for="">Nama</label>
                    <input type="text" name="nama" id="nama" required value="<?=$query['nama']?>" disabled>
					<label for="">Tanggal Transfer</label>
                    <input type="text" name="tgl_tr" id="tgl_tr" required>
                    <label for="">Bank Pengiriman</label>
                    <input type="text" name="bank_from" id="bank_from" required>
					<label for="">Transfer Bank Tujuan</label>
					<select name="bank_dest" required>
						<option value="" selected>-Pilih Bank Tujuan-</option>
						<option value="BCA">BCA</option>
						<option value="Mandiri">Mandiri</option>
					</select>
					<label for="">Rekening / Atas Nama</label>
                    <input type="text" name="nama_rek" id="nama_rek" required>
					<label for="">Jumlah Transfer</label>
                    <input type="text" name="jumlah_tr" id="jumlah_tr" required placeholder="ex. 100000">
					<label for="">Bukti Transfer</label>
                    <input type="file" name="foto">
					<label for="">Catatan</label>
                    <textarea name="ket" id="ket"></textarea>
                    <button type="submit" class="aa-browse-btn" onClick="document.getElementById('form').submit()">Kirim Konfirmasi</button>                    
                  </form>
                </div>
              </div>
			  <div class="col-md-3">
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- menginput data konfirmasi pembayaran-->
 <?php
	if(isset($_POST['tgl_tr']) && isset($_POST['bank_from']) && isset($_FILES) ){
		$tgl_tr = $_POST['tgl_tr'];
		$bank_from = $_POST['bank_from'];
		$bank_dest = $_POST['bank_dest'];
		$nama_rek = $_POST['nama_rek'];
		$jumlah_tr = $_POST['jumlah_tr'];
		$ket = $_POST['ket'];
		
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$foto_file = $_FILES['foto']['name'];
		$tipe_file = $_FILES['foto']['type'];
		$ukuran_file = $_FILES['foto']['size'];
		$direktori = "../upload/bukti/$foto_file";
		
		$MAX_FILE_SIZE = 1000000;
		if($ukuran_file > $MAX_FILE_SIZE) {
			header("Location:../index.php?mod=page&pg=konfirmasi&status=1");
			exit();
		}
		if($ukuran_file > 0) {
			move_uploaded_file($lokasi_file, $direktori);
		} else {
			echo "<script>alert('File tdk ada')</script>";
		}
		
			$sql = "UPDATE invoice SET transfer='1',
				tgl_tr='$tgl_tr', 
				bank_from='$bank_from', 
				bank_dest='$bank_dest', 
				nama_rek='$nama_rek', 
				jumlah_tr='$jumlah_tr', 
				bukti_tr='$foto_file',
				ket='$ket'
				WHERE noinvoice='$noinvoice'";
		$result=mysql_query($sql) or die(mysql_error());
		if($result){
			echo "<script>alert('Konfirmasi pembayaran berhasil!')</script>";
		} else {
			echo "<script>alert('Konfirmasi pembayaran gagal!')</script>";
		}
	}	
 ?>
<!-- / Konfirmasi -->