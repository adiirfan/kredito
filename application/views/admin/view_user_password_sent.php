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
			A password reset link has been sent to you (<?php echo $email?>). Please check your mailbox.
			<br /><br />
			<?php echo anchor('admin', 'Click here to sign in');?>
		</div>
	</div>


	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>