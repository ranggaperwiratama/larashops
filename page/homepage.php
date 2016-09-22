<!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              
			  <?php 
				//mengambil data posisi kanan dan kiri
				$query="SELECT DISTINCT posisi FROM berita";
				$result=mysql_query($query) or die(mysql_error());
				while($rows=mysql_fetch_array($result)){
					$posisi = $rows['posisi'];
					if($posisi=="kiri"){?>
						<!-- promo left -->
						 <div class="col-md-5 no-padding">
						 <?php
							$data="SELECT * FROM berita WHERE posisi='kiri'";
							$resultdata=mysql_query($data) or die(mysql_error());
							while($rows2=mysql_fetch_object($resultdata)){?>
								<div class="aa-promo-left">
								  <div class="aa-promo-banner">                    
									<img src="upload/berita/<?=$rows2->gambar?>" alt="img" width="450px" height="450px">                    
									<div class="aa-prom-content">
									  <span><?=$rows2->isi?></span>
									  <h4><a href="index.php?mod=page&pg=produk&idkategori=<?=$rows2->idkategori?>"><?=$rows2->judul?></a></h4>                      
									</div>
								  </div>
								</div>
							<?php }
						 ?>
						 </div>
					<?php }else if($posisi=="kanan"){ ?>
						<!-- promo right -->
						<div class="col-md-7 no-padding">
						  <div class="aa-promo-right">
						  <?php
							$data="SELECT * FROM berita WHERE posisi='kanan'";
							$resultdata=mysql_query($data) or die(mysql_error());
							while($rows2=mysql_fetch_object($resultdata)){?>
								<div class="aa-single-promo-right">
									<div class="aa-promo-banner">                      
									  <img src="upload/berita/<?=$rows2->gambar?>" alt="img" width="300px" height="220px">                      
									  <div class="aa-prom-content">
										<span><?=$rows2->isi?></span>
										<h4><a href="index.php?mod=page&pg=produk&idkategori=<?=$rows2->idkategori?>"><?=$rows2->judul?></a></h4>
									  </div>
									</div>
								</div>
							<?php }
						  ?>
						  </div>
						</div>
					<?php }
				}
			  ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Free shipping to all over Indonesia with a minimum purchase of 300 IDR</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-envelope-o"></span>
                <h4>CASH ON DELIVERY</h4>
                <P>Cash On Delivery around D.I Yogyakarta</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT IN OFFICE HOURS</h4>
                <P>Every Monday - Friday, 8 am - 5 pm </P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->

  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->