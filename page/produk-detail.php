
<!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
			  <?php
					$idproduk = $_GET['id'];
					$query = " SELECT produk.*,stok.*,kategori.nama_kategori from produk,stok,kategori
							where produk.idproduk='$idproduk'
							and produk.idproduk=stok.idproduk and produk.idkategori = kategori.idkategori";
					$result = mysql_query($query) or die(mysql_error());
					$no = 1;
					while($rows = mysql_fetch_object($result)) {
				?>
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="upload/produk/<?=$rows -> foto?>" width="900px" height="1024px" class="simpleLens-lens-image"><img src="upload/produk/<?=$rows -> foto?>" width="250px" height="300px" class="simpleLens-big-image"></a></div>
                      </div>
                    </div>
                  </div>
                </div>
				<!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3><?=$rows->nama_produk?></h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price"><?=format_rupiah($rows->harga_jual)?></span>
                      <p class="aa-product-avilability">Avilability: <span><?php echo get_status_stok($rows->jumlah)?></span></p>
                    </div>
                    <p><?=$rows->deskripsi?></p>
                    <div class="aa-prod-quantity">
                      <p class="aa-prod-category">
                        Category: <a href="#"><?=$rows->nama_kategori?></a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="index.php?mod=chart&pg=chart&action=add&id=<?=$rows->idproduk?>">Add To Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>      
              </ul>
			  <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p><?=$rows->deskripsi?></p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa!</li>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor qui eius esse!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, modi!</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, iusto earum voluptates autem esse molestiae ipsam, atque quam amet similique ducimus aliquid voluptate perferendis, distinctio!</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ea, voluptas! Aliquam facere quas cumque rerum dolore impedit, dicta ducimus repellat dignissimos, fugiat, minima quaerat necessitatibus? Optio adipisci ab, obcaecati, porro unde accusantium facilis repudiandae.</p>
                </div>
					<?php } ?>
				<!-- Related product -->
			  <div class="aa-product-related-item">
				  <h3>Random Products</h3>
				  <ul class="aa-product-catg aa-related-item-slider">
				  <?php	
					$query="select produk.*,stok.*,kategori.nama_kategori
					 from produk,stok,kategori
					 where produk.idproduk=stok.idproduk and produk.idkategori = kategori.idkategori
					  order by rand() desc limit 8";
						$result = mysql_query($query) or die(mysql_error());
					$no = 0;
					//proses menampilkan data
					while($rows = mysql_fetch_object($result)) {
						
							
					?>
					<!-- start single product item -->
					<li>
					  <figure>
						<a class="aa-product-img" href="index.php?mod=page&pg=produk-detail&id=<?=$rows->idproduk?>"><?php
							if (!empty($rows -> foto)) {
								echo "<img src='upload/produk/" . $rows -> foto . "' width='250px' height='300px'/>";
							}?>
						</a>
						<a class="aa-add-card-btn"href="index.php?mod=chart&pg=chart&action=add&id=<?=$rows->idproduk?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
						<figcaption>
						  <h4 class="aa-product-title"><a href="#"><?=$rows->nama_produk?></a></h4>
						  <span class="aa-product-price"><?=format_rupiah($rows->harga_jual)?></span>
						  <p class="aa-product-descrip"><?=$rows->deskripsi?></p>
						</figcaption>
					  </figure>
					</li>
					<?php }
			  ?>
			  </ul>
			  </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->