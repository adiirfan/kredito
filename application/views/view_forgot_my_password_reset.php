
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Ubah Password</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('security/forgot_my_password_reset_done'); ?>
				<?php echo validation_errors('<p class="alert alert-danger">');?>
				<div class="form-group">
					<label>Hai, <?php echo $full_name?></label>
				</div>
				<div class="form-group">
					<label>Masukan Password Baru</label>
					<?php echo form_password('txt_password', '', 'placeholder="Password" maxlength="20" class="password form-control"'); ?>
				</div>
				<div class="form-group">
					<label>Konfirm password</label>
					<?php echo form_password('txt_confirm_password', '', 'placeholder="Confirm Password" maxlength="20" class="password form-control"'); ?>
				</div>
				<br />
				<button name="submit" class="btn btn-info center-block longer">Submit</button>
				<input type="hidden" id="h_full_name" name="h_full_name" value="<?php echo $full_name?>" />
				<input type="hidden" id="h_dynamic_codee" name="h_dynamic_code" value="<?php echo $dynamic_code?>" />
			<?php echo form_close();?>
		</div>
	</div>
</div>	