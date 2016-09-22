<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>LARA Shop | Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/themes-front/img/3.jpg">
	
    <!-- Font awesome -->
    <link href="assets/themes-front/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="assets/themes-front/css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="assets/themes-front/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="assets/themes-front/css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="assets/themes-front/css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="assets/themes-front/css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="assets/themes-front/css/theme-color/default-theme.css" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="assets/themes-front/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="assets/themes-front/css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <body> 
   <!-- wpf loader Two -->
   <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
  <!-- / wpf loader Two -->       
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <?php if(empty($_SESSION['idpelanggan'])){ ?>
					<li class="hidden-xs"><a href="index.php">Home</a></li>
					<li class="hidden-xs"><a href="index.php?mod=page&pg=contact">Contac Us</a></li>
					<li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
				  <?php }else{ ?>
					<li><a href="index.php?mod=chart&pg=invoice">Invoice</a></li>	
					<li><a href="index.php?mod=user&pg=profil">My Account</a></li>	
					<li><a href="user/logout.php">Logout</a></li>	
				  <?php	} ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo" style="margin-top:0;">
                <!-- Text based logo -->
                <a href="index.php">
                  <img src="assets/themes-front/img/1.jpg" width="120px">
                </a>
              </div>
              <!-- / logo  -->
			  
               <!-- cart box -->
              <?php include ('chart/chart.inc.php');?>
				<div class="aa-cartbox">
					<a class="aa-cart-link" href="index.php?mod=chart&pg=chart">
					  <span class="fa fa-shopping-basket"></span>
					  <span class="aa-cart-title">SHOPPING CART</span>
					  <span class="aa-cart-notify"><?php echo chartNotification();?></span>
					</a>
				</div>
              <!-- / cart box -->
			  <!-- wishlist -->
			  <?php include ('chart/wishlist.inc.php');?>
			  <div class="aa-cartbox">
					<a class="aa-cart-link" href="index.php?mod=chart&pg=wishlist">
					  <span class="fa fa-heart"></span>
					  <span class="aa-cart-title">WISHLIST</span>
					  <span class="aa-cart-notify"><?php echo wlistNotification();?></span>
					</a>
				</div>
				<!-- / wishlist -->
              <!-- search box -->
              <div class="aa-search-box">
                <form action="index.php?mod=page&pg=produk"method="post">
                  <input type="text" name="kunci" id="kunci" placeholder="Search here by category">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <?php
					list_kategori(); 
					?>
			  <li><a href="index.php?mod=page&pg=produk">All Produk</a></li>
			  <li><a href="#">Sale</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  
  <!-- / menu -->
  <!-- Start slider -->
  <?php
	if(empty($_GET['pg'])){
  ?>
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            <?php
				list_slider(); 
			?>
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <?php }else{
	  $pg = $_GET['pg'];?>
   <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="assets/themes-front/img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2><?php echo $pg; ?></h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>         
          <li class="active"><?php echo $pg; ?></li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->	  
  <?php } //end of careousel ?>
  <!-- / slider -->
  