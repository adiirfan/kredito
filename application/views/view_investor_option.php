


<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Melakukan Investasi</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('investor/login'); ?>
				<div class="form-group">
					<button name="submit" class="btn btn-outline btn-primary btn-lg btn-block">Akun anda sudah aktif</button>
				</div>
			<?php echo form_close();?>
			<?php echo form_open('investor/application'); ?>
				<div class="form-group">
					<button name="submit" class="btn btn-outline btn-primary btn-lg btn-block">Saya user baru</button>
				</div>
			<?php echo form_close();?>
			<br /><br />
		</div>
	</div>
</div>	
