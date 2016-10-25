
<script type="text/javascript">
  $(document).ready(function() {
    
    	$('.btn-user-group').on('click', function(){
		    $(".btn-user-group").removeClass('active');
		    $(this).addClass('active');

		    $("#h_user_group").val($(this).val());
		}); 

	});
</script>  

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Lupa Password</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('security/forgot_my_password/reset'); ?>
				<?php echo validation_errors('<p class="alert alert-danger">');?>
				<div class="form-group">
					<label>Masukan Email anda</label>
					<?php echo form_input('txt_email', set_value('txt_email', ''), 'name="txt_email" placeholder="Email" class="form-control"');?>
				</div>
				<button name="submit" class="btn btn-info center-block longer">Submit</button>
			<?php echo form_close();?>
		</div>
	</div>
</div>	
