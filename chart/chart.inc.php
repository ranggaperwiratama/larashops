<!-- Cart view section -->
 
<?php
//utk menyembunyikan warning
ini_set( "display_errors", 0);
//fungsi membuat kode transaksi
function kd_transaksi() {
	$kode_temp = fetch_row("SELECT noinvoice FROM invoice ORDER BY noinvoice DESC LIMIT 0,1");
	if ($kode_temp == '')
		$kode = "T00001";
	else {
		$jum = substr($kode_temp, 1, 6);
		$jum++;
		if ($jum <= 9)
			$kode = "T0000" . $jum;
		elseif ($jum <= 99)
			$kode = "T000" . $jum;
		elseif ($jum <= 999)
			$kode = "T00" . $jum;
		elseif ($jum <= 9999)
			$kode = "T0" . $jum;
		elseif ($jum <= 99999)
			$kode = "T" . $jum;
		else
			die("Kode pemesanan melebihi batas");
	}
	return $kode;
}

//fungsi untuk menulis pemberitahuan berdasarkan jumlah barang di keranjang
function writeShoppingchart() {
	//mengambil cart
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return '<h3>Anda belum membeli apapun</h3>';
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);
		$s = (count($items) > 1) ? 's' : '';
		return '<h3>Ada <a href="index.php?mod=chart&pg=chart">' . count($items) . ' barang' . $s . ' di cart</a></h3>';
	}
}

//fungsi untuk menampilkan notifikasi jumlah barang di cart
function chartNotification() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return '0';
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);

		return count($items);
	}
}

//fungsi untuk mengambil jumlah barang
function getQty() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return 0;
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);
		$s = (count($items) > 1) ? 's' : '';
		return count($items);
	}
}

//fungsi untuk menampilkan barang yang masuk keranjang
function showchart() {
	
	$chart = $_SESSION['chart'];
//	print_r($chart);
	//jika keranjang ada isinya
	if ($chart) {
		//mengambil per item barang yang ada di array cart
		$items = explode(',', $chart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		//menampilkan barang2 di cart
		$output[] = "<div class=\"cart-view-table\">";
		$output[] = "<div class=\"table-responsive\">";
		$output[] = "<table class=\"table\">";
		$output[] = "<thead><tr><th></th><th></th><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr></thead>";
		$output[] = '<form action="index.php?mod=chart&pg=chart&action=update" method="post" id="chart">';
		$no = 1;
		//perulangan menampilkan barang
		foreach ($contents as $id => $qty) {
			$sql = "SELECT produk.*,stok.harga_jual from produk,stok WHERE produk.idproduk = '$id' and stok.idproduk = '$id'";
			$result = mysql_query($sql);
			$row = mysql_fetch_object($result) or die (mysql_error);
			$output[] = '<tbody><tr><td><a class="remove" href="index.php?mod=chart&pg=chart&action=delete&id=' . $id . '"><fa class="fa fa-close"></fa></a></td>';
			$output[] = '<td><img src=\'upload/produk/' . $row ->foto .'\' width=\'128px\' height=\'128px\'></td>';
			$output[] = '<td><a class="aa-cart-title" href="#">'.$row ->nama_produk. '</a></td>';
			$output[] = '<td>' . format_rupiah($row -> harga_jual) . '</td>';
			$output[] = '<td><input class="aa-cart-quantity" type="number" name="qty' . $id . '" value="' . $qty . '"></td>';
			$output[] = '<td>' . format_rupiah($row -> harga_jual * $qty) . '</td></tr>';
			$total += $row -> harga_jual * $qty;
			$no++;
		}
		$qty = getQty();
		$_SESSION['totalbayar'] = $total;
		$output[] = '<tr><td colspan="6" class="aa-cart-view-bottom"><input class="aa-cart-view-btn" type="submit" value="Update Cart"></td></tr></tbody>';
		$output[] = '</form>';
		$output[] = "</table></div>";
		$output[] = '<div class="cart-view-total"><h4>Cart Totals</h4><table class="aa-totals-table"><tbody><tr><th>Total</th><td>' . format_rupiah($total) . '</td></tr></tbody></table>';
		$output[] = '<a href=\'chart/chart_action.php\' class="aa-cart-view-btn">Proced to Checkout</a>
             </div></div>';
	} else {
		$output[] = '<p>Keranjang belanja masih kosong.</p>';
	}
	
	return join('', $output);
}

//fungsi untuk insert invoice ke tabel invoice
function insertToDB($kd_transaksi, $idpelanggan, $totalbayar) {

	$chart = $_SESSION['chart'];
	if ($chart) {
		$items = explode(',', $chart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}

		$sql_transaksi = "insert into invoice (noinvoice,tanggal,totalbayar,idpelanggan) 
		values( '$kd_transaksi', now(),'$totalbayar','$idpelanggan')";
		//echo "SQL transaksi:".$sql_transaksi;
		mysql_query($sql_transaksi) or die(mysql_error());
		foreach ($contents as $id => $qty) {

			$sql = "insert into transaksi(noinvoice,idproduk,jumlah)
			values('$kd_transaksi','$id','$qty')";
			//		echo "SQL transaksi:".$sql;
			$result = mysql_query($sql) or die(mysql_error());
		}
	} else {
		$output[] = '<p>Keranjang belanja masih kosong.</p>';
	}

}
?>