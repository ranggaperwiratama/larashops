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
                  <div class="aa-product-hvr-content">
					<a href="index.php?mod=chart&pg=wishlist&action=add&id=<?=$rows->idproduk?>" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#<?=$rows->idproduk?>"><span class="fa fa-search"></span></a>                            
                  </div>
				  <!-- product badge -->
				  <?php
					$stok = $rows->jumlah;
					$sale = $rows->status_sale;
					if($stok == '0'){ ?>
						<span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
					<?php } else if($stok <= '5'){ ?>
						<span class="aa-badge aa-hot" href="#">Limited!</span>
					<?php } else if($sale == '1'){ ?>
						<span class="aa-badge aa-sale" href="#">SALE!</span>
					<?php }
				  ?>
                </li>
              <!-- quick view modal -->                  
              <div class="modal fade" id="<?=$rows->idproduk?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="upload/produk/<?=$dt['foto']?>">
                                          <img src="upload/produk/<?=$dt['foto']?>" width="250px" height="300px" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:20px;">
                          <div class="aa-product-view-content">
                            <h3><?=$dt['nama_produk']?></h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price"><?=format_rupiah($dt['harga_jual'])?></span>
                              <p class="aa-product-avilability">Avilability: <span><?php echo get_status_stok($dt['jumlah'])?></span></p>
                            </div>
                            <p><?=$dt['deskripsi']?></p>
                            <div class="aa-prod-quantity">
                              <p class="aa-prod-category">
                                Category: <a href="#"><?=$dt['nama_kategori']?></a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="index.php?mod=chart&pg=chart&action=add&id=<?=$dt['idproduk']?>" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="index.php?mod=page&pg=produk-detail&id=<?=$dt['idproduk']?>" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
			  </div>