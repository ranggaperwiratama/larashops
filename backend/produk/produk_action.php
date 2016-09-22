<?php
/* Toko Kita Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */
 
include ('../../inc/config.php');
include('../../inc/function.php');
//data dari produk
if(isset($_POST)){
$nama_produk=$_POST['nama_produk'];
$idkategori=$_POST['idkategori'];
$harga_jual = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];

$harga_beli = $_POST['harga_beli'];


$deskripsi=$_POST['deskripsi'];

$aksi = $_POST['aksi'];
$id = $_POST['id'];

$lokasi_file = $_FILES['foto']['tmp_name'];
$foto_file = $_FILES['foto']['name'];
$tipe_file = $_FILES['foto']['type'];
$ukuran_file = $_FILES['foto']['size'];
$direktori = "../../upload/produk/$foto_file";
$sql = null;
$MAX_FILE_SIZE = 1000000;
//100kb
if($ukuran_file > $MAX_FILE_SIZE) {
	header("Location:../index.php?mod=produk&pg=produk_form&status=1");
	exit();
}
$sql = null;
if($ukuran_file > 0) {
	move_uploaded_file($lokasi_file, $direktori);
}

if($aksi == 'tambah') {
	$sql = "INSERT INTO produk(idproduk, nama_produk,idkategori,foto,
	deskripsi)
		VALUES('$id','$nama_produk',
		'$idkategori','$foto_file','$deskripsi')";
	$sql2 = "INSERT INTO stok(idproduk,harga_jual,
	harga_beli,jumlah)
		VALUES('$id',
		'$harga_jual','$harga_beli','$jumlah')";
}else if($aksi== 'edit') {
	if($ukuran_file > 0){
	$sql = "update produk set nama_produk='$nama_produk',foto='$foto_file',
	idkategori='$idkategori',deskripsi='$deskripsi'
	where idproduk='$id'";
	$sql2 = "update stok set harga_beli='$harga_beli',jumlah='$jumlah',harga_jual='$harga_jual'
	where idproduk='$id'";
	}else{
		$sql = "update produk set nama_produk='$nama_produk',
	deskripsi='$deskripsi',idkategori='$idkategori'
	where idproduk='$id'";
	$sql2 = "update stok set harga_beli='$harga_beli',jumlah='$jumlah',harga_jual='$harga_jual'
	where idproduk='$id'";
	}
}

$result = mysql_query($sql) or die(mysql_error());
$result2 = mysql_query($sql2) or die(mysql_error());
//check if query successful
if($result && $result2) {
	header('location:../index.php?mod=produk&pg=produk_view&status=0');
} else {
	header('location:../index.php?mod=produk&pg=produk_view&status=1');
}
}
?>
