
<?php ini_set( "display_errors", 0); // Start the session
session_start();

//include ('chart.inc.php');
// Process actions
$chart = $_SESSION['chart'];
//mengambil aksi button
$action = $_GET['action'];
switch ($action) {
	//button add to cart
	case 'add' :
		if ($chart) {
			//memasukan barang ke dalam array cart
			$chart .= ',' . $_GET['id'];
		} else {
			$chart = $_GET['id'];
		}
		break;
	//
	//B002,5,S,B003,10,M
	//menghapus barang dari cart
	case 'delete' :
		if ($chart) {
			$items = explode(',', $chart);
			$newchart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newchart != '') {
						$newchart .= ',' . $item;
					} else {
						$newchart = $item;
					}
				}
			}
			$chart = $newchart;
		}
		break;
	//update cart
	case 'update' :
		if ($chart) {
			$newchart = '';
			foreach ($_POST as $key => $value) {
				if (stristr($key, 'qty')) {
					$id = str_replace('qty', '', $key);
					$items = ($newchart != '') ? explode(',', $newchart) : explode(',', $chart);
					$newchart = '';
					foreach ($items as $item) {
						if ($id != $item) {
							if ($newchart != '') {
								$newchart .= ',' . $item;
							} else {
								$newchart = $item;
							}
						}
					}
					for ($i = 1; $i <= $value; $i++) {
						if ($newchart != '') {
							$newchart .= ',' . $id;
						} else {
							$newchart = $id;
						}
					}
				}
			}
		}

		$chart = $newchart;
		break;
}
//menyimpan cart terbaru dalam session
$_SESSION['chart'] = $chart;
?>

<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
			<!--memanggil fungsi untuk menampilkan pemberitahuan-->
			<?php echo writeShoppingchart();

	echo showchart();

	if (isset($_GET['s'])) {
		if ($_GET['status'] == OK) {
			echo " proses pembelian berhasil dilakukan sudah selesai";
		} else {
			echo "operasi gagal";
		}
	}
			?>
			
		</div></div></div></div></section>
 <!-- / Cart view section -->