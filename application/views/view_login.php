<!-- process steps -->
<?php if(get_cookie('full_name') != ""){
if(get_cookie('user_group') == "B"){
	redirect("borrower/application/list");
}else{
	redirect("investor/saldo");
}
	
	
	
}else{ ?>
<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">
<?php $this->load->library('recaptcha');
echo $this->recaptcha->getScriptTag();?>
<div class="container">

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<br>
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">

		</div>	
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
		<h2 align="center">Login </h2>
			<hr>
			<?php echo form_open('security/login/validation'); ?>
				<?php 
					echo validation_errors('<p class="alert alert-danger">');
					if(isset($pMessage) == '1')
					{
						echo form_label($pMessage, '', array('class' => 'alert alert-danger'));
					}
				?>
				<div class="form-group">
					<label>Masukan email anda</label>
					<div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <?php echo form_input('txt_email', set_value('txt_email', ''), 'placeholder="Email" maxlength="255" class="form-control group-input"'); ?>
                    </div>
				</div>
				<div class="form-group">
					<label>Masukan password anda</label>
					<div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input id="txt_password" name="txt_password" type="password" placeholder="Password" maxlength="20" class="password form-control group-input" />
                    </div>
				</div>
				<div class="form-group">
					<input id="chk_remember_me" name="chk_remember_me" type="checkbox" value="1" />
                    <label for="chk_remember_me"> Ingatkan saya</label>
				</div>
				<?php
				$this->load->library('recaptcha');
				echo $this->recaptcha->getWidget();
				?>
				<br />
				<button name="submit" class="btn btn-info center-block longer">Login</button>
				<br />
				<a href="<?php echo base_url();?>security/register">Anda tidak memiliki akun di Kredito.co.id? Klik disini untuk registrasi</a>
				<br>
			<?php echo form_close();?>
		</div>
	</div>
</div>	
<?php } ?>