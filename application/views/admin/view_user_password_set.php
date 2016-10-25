<!DOCTYPE html> 
<html lang="en-US">
<head>
	<title><?php echo APP_NAME;?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/png">
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
  	<link href="<?php echo base_url(); ?>assets/custom/css/admin.css" rel="stylesheet" type="text/css">

  	<script src="<?php echo base_url();?>assets/jquery/js/jquery.min.js"></script>

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
	  		window.location.href="<?php echo base_url();?>admin";
	  	}
	}
	start(6);

    </script>
</head>

<body class="body-login">
	<div class="row">
		<div class="col-lg-3 col-lg-offset-4 div-logo">
			<img src="<?php echo base_url(); ?>assets/img/logo.png" class="center"/>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-lg-3 col-lg-offset-4 div-signin">
			Your password has been reset. The page will route to the login page in <span id="lbl_counter">5</span> seconds.
			<br /><br />
			<?php echo anchor('admin', 'Click here to sign in');?>
		</div>
	</div>


	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>