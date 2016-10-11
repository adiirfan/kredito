
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
	  		window.location.href="<?php echo base_url();?>security/login/activationsuccess";
	  	}
	}
	start(6);

    </script>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
		<br>
			<h2>Aktivasi Berhasil</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('security/reset_password'); ?>
				<?php echo validation_errors('<p class="alert alert-danger">');?>
				<div class="form-group">
				Akun anda sudah berhasil diaktifkan. anda akan menuju ke halaman utama.
					
					<span id="lbl_counter" class="alert alert-danger">5</span> detik.
				</div>
				
				<br />
				
			<?php echo form_close();?>
		</div>
	</div>
</div>	