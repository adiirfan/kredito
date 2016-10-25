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
	  		window.location.href="<?php echo base_url();?>investor/konfirmasi-saldo";
	  	}
	}
	start(6);

    </script>

<div class="container">

	

	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
		<br>
			<h2 align="center">Konfirmasi pendanaan anda telah kami terima. Kami akan memverifikasi pendanaan anda</h2>
			<hr>
		</div>
<span id="lbl_counter" class="alert alert-danger">5</span> detik.		
	</div>
</div>