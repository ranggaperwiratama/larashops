<?php
/* Toko Kita Ecommerce v2.0
 * http://www.candra.web.id/
 * Candra adi putra <candraadiputra@gmail.com>
 * last edit: 15 okt 2013
 */
 ?>
<div class="span5 offset4 well" style="margin-top:115px; background-color:#ffffff;">
	<form method="POST" id="form1" class='form-horizontal' action="login/login_action.php">
		<legend>
			<img src="../assets/themes-back/images/logo.jpg">
		
		</legend>
	
		<div class="control-group">
			<label class="control-label" for="nama">username</label>
			<div class="controls">
				<input   type="text" name='username' >
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Password</label>
			<div class="controls">
				<input   type="password" name='password'>
			</div>
		</div>
		<div class="row">
			<div class="span4 offset2">
				
				<input type="submit"  name="login" class="btn btn-primary" value='login' style="background-color: #000000 !important;">
			</div>
			
		</div>
	</form>
</div>
<style>
	body::before{
		background-color: #000;
	}
</style>
