<?php
//cek_akses_langsung();
?>
<!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" method="post" name="form" id="form" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="sort" onChange="document.getElementById('form').submit()">
				  <!--combo box sort data-->
					<?php
						$a = array(array("","Default"),array("nama_produk","Name"),array("harga_jual","Price"));
						for($i=0; $i<3; $i++){
							if($a[$i][0] == $_POST['sort']){?>
								<option selected='selected' value="<?=$a[$i][0]?>"><?=$a[$i][1]?></option>
					<?php	}else{?>
								<option value="<?=$a[$i][0]?>"><?=$a[$i][1]?></option>
					<?php	}
						}
					?>
                  </select>
                </form>
                <form action="" method="post" name="form1" id="form1" class="aa-show-form">
                  <label for="">Show</label>
                  <select  name="batas" onChange="document.getElementById('form1').submit()">
				  <!-- combo box grid data-->
					<?php
						$a = array("6","12","24","36");
						for($i=0; $i<4; $i++){
							if($a[$i] == $_POST['batas']){?>
								<option selected='selected' value="<?=$a[$i]?>"><?=$a[$i]?></option>
					<?php	}else{?>
								<option value="<?=$a[$i]?>"><?=$a[$i]?></option>
					<?php	}
						}
					?>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
			  <?php
				$sort = $_POST['sort'];
				$batas=$_POST['batas'];
				if(!empty($batas)){
					$batas=$_POST['batas'];
				}else{
					$batas=6;
				}
				$tabel="produk";
				$halaman=$_GET['halaman'];
				$posisi=null;
				if(empty($halaman)){
					$posisi=0;
					$halaman=1;
				}else{
					$posisi=($halaman-1)* $batas;
				}
				$id = $_GET['idkategori'];
				if(isset($_POST['kunci']) && $_POST['kunci']){
					$kunci = $_POST['kunci'];
					if(!empty($sort)){
						$query = "SELECT produk.*,stok.*,kategori.* from produk,stok,kategori where produk.idproduk=stok.idproduk and produk.idkategori = kategori.idkategori and kategori.nama_kategori like '%$kunci%' ORDER BY $sort limit $posisi,$batas";
						
					}else{
						$query = "SELECT produk.*,stok.*,kategori.* from produk,stok,kategori where produk.idproduk=stok.idproduk and produk.idkategori = kategori.idkategori and kategori.nama_kategori like '%$kunci%' limit $posisi,$batas";
						
					}
				}else{
					if(!empty($sort)){
						if(!empty($id)){				
							$query = " SELECT produk.*,stok.*
							 from produk,stok
							  where produk.idkategori='$id'
							  and produk.idproduk=stok.idproduk ORDER BY $sort limit $posisi,$batas";
						}else{
							$query = "SELECT produk.*,stok.* from produk,stok where produk.idproduk=stok.idproduk ORDER BY $sort limit $posisi,$batas";
						}
					}else{
						if(!empty($id)){				
							$query = " SELECT produk.*,stok.*
							 from produk,stok
							  where produk.idkategori='$id'
							  and produk.idproduk=stok.idproduk limit $posisi,$batas";
						}else{
							$query = "SELECT produk.*,stok.* from produk,stok where produk.idproduk=stok.idproduk limit $posisi,$batas";
						}
					}
				}
				
				$result = mysql_query($query) or die(mysql_error());
				$no = 1;
				//proses menampilkan data
				while($rows = mysql_fetch_object($result)) {
					$a = mysql_query(" SELECT produk.*,stok.*,kategori.nama_kategori from produk,stok,kategori
					where produk.idproduk=stok.idproduk and produk.idproduk = '$rows->idproduk' and produk.idkategori = kategori.idkategori");
					$dt=mysql_fetch_array($a);
					include('item-produk.php');
				} 
			  ?>
			  
				                                      
              </ul>
              <!-- / quick view modal -->   
            </div>
			<?php //=============CUT HERE for paging====================================
				if(!empty($id)){
					$tampil2 = mysql_query("SELECT idproduk from produk where idkategori = '$id'");
				}else{
					$tampil2 = mysql_query("SELECT idproduk from produk");
				}

				$jmldata = mysql_num_rows($tampil2);
				$jumlah_halaman = ceil($jmldata / $batas);
			?>
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <?php paginationfront($halaman, $jumlah_halaman, $tabel, "page", $id); ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                <?php
					list_kategori(); 
					?>
              </ul>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->
