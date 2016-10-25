<script type="text/javascript">
  $(document).ready(function() {
    
    	$('.btn-user-group').on('click', function(){
		    $(".btn-user-group").removeClass('active');
		    $(this).addClass('active');

		    $("#h_user_group").val($(this).val());
		}); 

	});
</script>  
<?php $this->load->library('recaptcha');
echo $this->recaptcha->getScriptTag();?>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Registrasi</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('security/register/add'); ?>
				<?php echo validation_errors('<p class="alert alert-danger">');?>
				<div class="form-group">
					<label>Nama lengkap</label>
					<?php echo form_input('txt_full_name', set_value('txt_full_name', ''), 'placeholder="Nama lengkap" class="form-control"');?>
				</div>
				<div class="form-group">
					<label>Email</label>
					<?php echo form_input('txt_email', set_value('txt_email', ''), 'placeholder="Email" class="form-control"');?>
				</div>
				<div class="form-group">
					<label>Registrasi sebagai</label><br />
					<div class="btn-group" role="group" aria-label="...">
					  <button type="button" class="btn btn-default btn-user-group active" value="B">Peminjam</button>
					  <button type="button" class="btn btn-default btn-user-group" value="I">Investor</button>
					  <input type="hidden" id="h_user_group" name="h_user_group" value="B" />
					</div>
				</div>
				<?php
				$this->load->library('recaptcha');
				echo $this->recaptcha->getWidget();
				?>
				<button name="submit" class="btn btn-info center-block longer">Daftar</button>
			<?php echo form_close();?>
		</div>
	</div>
</div>	
