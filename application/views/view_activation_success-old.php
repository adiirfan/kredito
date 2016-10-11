
<script>

	function start(counter){
	  	if(counter > 1){
	    	setTimeout(function(){
	      		counter--;
	      		$("#lbl_counter").text(counter);
	      		//alert(counter);
	      		start(counter);
	    	}, 1000);
	  	}
	  	else
	  	{
	  		window.location.href="<?php echo base_url();?>security/login/activation-success";
	  	}
	}
	start(6);

    </script>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Activation Successful</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('security/reset_password'); ?>
				<?php echo validation_errors('<p class="alert alert-danger">');?>
				<div class="form-group">
					You have successfully activate your account. The page will be routed to the main page in
					<span id="lbl_counter" class="alert alert-danger">5</span> seconds.
				</div>
				
				<br />
				
			<?php echo form_close();?>
		</div>
	</div>
</div>	