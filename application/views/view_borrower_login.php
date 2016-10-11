<!-- process steps -->
<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">

<div class="container">

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="stepwizard">
			    <div class="stepwizard-row">
			    	<img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-user"></i></li>
			            <p>Login/Register</p>
			        </div>
					<img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Informasi Pinjaman</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-grey btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Pengajuan</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-grey btn-circle disabled"><i class="fa fa-file-o"></i></li>
			            <p>Upload Dokumen</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-grey btn-circle disabled"><i class="fa fa-flag-checkered"></i></li>
			            <p>Proses selesai</p>
			        </div> 
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			    </div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Login Peminjam</h2>
			<hr>
			<br />
			
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('borrower/login/validation'); ?>
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
				<br />
				<button name="submit" class="btn btn-info center-block longer">Login</button>
				<br />
				<a href="<?php echo base_url();?>borrower/application/info">Anda tidak memiliki akun di Rajakredit.com? Klik disini untuk melanjutkan</a>
			<?php echo form_close();?>
		</div>
	</div>
</div>	
