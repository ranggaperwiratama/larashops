
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
			  <div class="col-md-6">
				<h4>Login or Register</h4>
				  <form class="aa-login-form" action="user/login_action.php"  method="post" id='form1'>
					<label for="">Email address<span>*</span></label>
					<input type="text" id="email" name='email' placeholder="email">
					<label for="">Password<span>*</span></label>
					<input type="password" id="password" name='password' placeholder="Password">
					<button class="aa-browse-btn" type="submit">Login</button>
					<br><br><br><p></p>
					<!--<p class="aa-lost-password"><a href="#">Lost your password?</a></p>-->
				  </form>
			  </div>
              <div class="col-md-6">
				<div class="aa-myaccount-register">                 
                 <h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
				 <?php
						if(isset($_GET['status'])){
							if($_GET['status']==0){
								echo "<script type='text/javascript'>alert('Registrasi berhasil, silakan login!');</script>";
							}else {
							echo "<script type='text/javascript'>alert('Proses registrasi gagal');</script>";
							}
						}
				 ?>
                 <form action="user/register_action.php"  id='form2' method="post" class="aa-login-form">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" name='nama' required>
					<label for="">Jenis Kelamin</label>
                    <select name='kelamin' id='kelamin'>
						<option value='L'>Laki laki</option>
						<option value='P'>Perempuan</option>
					</select>
                    <label for="">Email<span>*</span></label>
                    <input type="text" name='email' id='email' required>
					<label for="">Password<span>*</span></label>
                    <input type="password" name='password' id='password' required>
					<label for="">Telp</label>
                    <input type="text" name='telp' id='telp' required>
					<label for="">Kota</label>
                    <input type="text" name='kota' id='kota' required>
					<label for="">Kode Post</label>
                    <input type="text" name='kodepos' id='kodepos' required>
					<label for="">Alamat</label>
                    <textarea name='alamat' class="input-xlarge"></textarea>
                    <button type="submit" name="aksi" value="register" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>