<?php ini_set( "display_errors", 0); // Start the session
session_start();

//include ('chart.inc.php');
// Process actions
$wlist = $_SESSION['wlist'];
$action = $_GET['action'];
switch ($action) {
	case 'add' :
		if ($wlist) {
			$wlist .= ',' . $_GET['id'];
		} else {
			$wlist = $_GET['id'];
		}
		break;
	//
	//B002,5,S,B003,10,M
	case 'delete' :
		if ($wlist) {
			$items = explode(',', $wlist);
			$newlist = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newlist != '') {
						$newlist .= ',' . $item;
					} else {
						$newlist = $item;
					}
				}
			}
			$wlist = $newlist;
		}
		break;
}
$_SESSION['wlist'] = $wlist;
?>

<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">

			<?php echo writeShoppingwlist();

	echo showwlist();

			?>
			
		</div></div></div></div></section>
 <!-- / Cart view section -->