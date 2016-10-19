
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
		<br>
			
			
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
			<?php echo form_open('security/activate'); ?>
			<h2>Aktifasi Akun Anda</h2>
			<br>
				<?php echo validation_errors('<p class="alert alert-danger">');?>
				<div class="form-group">
					<label>Hai, <?php echo $full_name?></label>
				</div>
				<div class="form-group">
					<label>Masukan password baru</label>
					<?php echo form_password('txt_password', '', 'placeholder="Password" maxlength="20" class="password form-control"'); ?>
				</div>
				<div class="form-group">
					<label>Konfirmasi Password anda</label>
					<?php echo form_password('txt_confirm_password', '', 'placeholder="Konfirmasi Password" maxlength="20" class="password form-control"'); ?>
				</div>
				<br />
				<button name="submit" class="btn btn-info center-block longer">Submit</button>
				<input type="hidden" id="h_full_name" name="h_full_name" value="<?php echo $full_name?>" />
				<input type="hidden" id="h_dynamic_codee" name="h_dynamic_code" value="<?php echo $dynamic_code?>" />
			<?php echo form_close();?>
			<br>
		</div>
	</div>
</div>	