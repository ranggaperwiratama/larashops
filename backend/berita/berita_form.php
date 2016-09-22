<?php
/* Toko Kita Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */
cek_status_login($_SESSION['username']); 
	$aksi = null;
	if(isset($_GET['id'])) {
		$aksi = "edit";
		$id = $_GET['id'];
		//baris dibawah ini disesuaikan dengan nama tabel dan idtabelnya
		$sql = "select * from berita where idberita='$id' ";
		$result = mysql_query($sql) or die(mysql_error());
		$baris = mysql_fetch_object($result);

	}?>
	<script type="text/javascript" src="../assets/bootstrap/js/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src='../assets/bootstrap/js/editor.js'></script> 

<form  class="form-horizontal" method="POST" id="form1" action="berita/berita_action.php" enctype="multipart/form-data">
 <legend>  PROMO</legend>
	<input type='hidden' name='id' value="<?=$id?>">
  <div class="control-group">
    <label class="control-label" for="judul">Judul</label>
    <div class="controls">
      <input type="text" name='judul' id="judul" class='input-xxlarge'
      value='<?=$baris->judul;?>' >
    </div>
   </div>
  <div class="control-group">
    <label class="control-label" for="gambar">Gambar</label>
    <div class="controls">
      <input type="file" name='gambar' id="gambar" >
    </div>
   </div>
   <!-- <div class="control-group">
    <label class="control-label" for="isi">Keterangan</label>
    <div class="controls">
      <input type="text" name='isi' id="isi" class='input-xxlarge' value='<?=$baris->isi;?>'>
    </div>
  </div> -->
  <div class="control-group">
    <label class="control-label" for="posisi">Letak</label>
    <div class="controls">
	  <select name="posisi" id="posisi">
		<option value="kiri">Kiri</option>
		<option value="kanan">Kanan</option>
	  </select>
    </div>
  </div>
  <div class="control-group">
			<label class="control-label" for="idkategori">Link kategori</label>
			<div class="controls">
				<select id='idkategori' name='idkategori' class="required " >
						<?php
   
    combo_kategori($data->idkategori);
   	?>
				</select>
			</div>
		</div>

  <div class="control-group">
    <div class="controls">
     
      <button type="submit" class="btn btn-success" name='aksi'value=<?=$aksi?> ><?=$aksi?></button>
    </div>
  </div>
</form>

<div id="form1_errorloc"  class="text-error"></div>
