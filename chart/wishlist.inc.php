 <!-- Cart view section -->
 
<?php
ini_set( "display_errors", 0);

function writeShoppingwlist() {
	$wlist = $_SESSION['wlist'];
	if (!$wlist) {
		return '<h3>Tidak ada produk yang disimpan</h3>';
	}
}

function wlistNotification() {
	$wlist = $_SESSION['wlist'];
	if (!$wlist) {
		return '0';
	} else {
		// Parse the chart session variable
		$items = explode(',', $wlist);

		return count($items);
	}
}

function showwlist() {

	$wlist = $_SESSION['wlist'];
//	print_r($wlist);
	if ($wlist) {
		$items = explode(',', $wlist);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = "<div class=\"cart-view-table\">";
		$output[] = "<div class=\"table-responsive\">";
		$output[] = "<table class=\"table\">";
		$output[] = "<thead><tr><th></th><th></th><th>Product</th><th>Price</th><th>Stock Status</th><th></th></tr></thead>";
		$no = 1;
		foreach ($contents as $id => $qty) {
			$sql = "SELECT produk.*,stok.harga_jual, stok.jumlah from produk,stok WHERE produk.idproduk = '$id' and stok.idproduk = '$id'";
			$result = mysql_query($sql);
			$row = mysql_fetch_object($result) or die (mysql_error);
			$output[] = '<tbody><tr><td><a class="remove" href="index.php?mod=chart&pg=wishlist&action=delete&id=' . $id . '"><fa class="fa fa-close"></fa></a></td>';
			$output[] = '<td><img src=\'upload/produk/' . $row ->foto .'\' width=\'128px\' height=\'128px\'></td>';
			$output[] = '<td><a class="aa-cart-title" href="#">'.$row ->nama_produk. '</a></td>';
			$output[] = '<td>' . format_rupiah($row -> harga_jual) . '</td>';
			$output[] = '<td>'.get_status_stok($row -> jumlah).'</td>';
			$output[] = '<td><a href="index.php?mod=chart&pg=chart&action=add&id=<?=$row->idproduk?>" class="aa-add-to-cart-btn">Add To Cart</a></td></tr>';
			$no++;
		}
		
		$output[] = "</tbody></table></div>";
	}
	
	return join('', $output);
}
?>