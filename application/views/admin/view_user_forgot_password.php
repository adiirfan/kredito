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
	<?php echo form_open('admin/forgot_password/request'); ?>
	<div class="row">
		<div class="col-lg-3 col-lg-offset-4 div-logo">
			<img src="<?php echo base_url(); ?>assets/img/logo.png" class="center"/>
		</div>
	</div>
	<br />
	<div class="row">
		<div class="col-lg-3 col-lg-offset-4 div-signin">
			<h4>Please enter your email</h4>
			<hr />
			<?php 
				echo validation_errors('<p class="alert-danger">');
				if(isset($pMessage) == '1')
				{
					echo form_label($pMessage, '', array('class' => 'alert-danger'));
				}
			?>
			<?php echo form_input('txtEmail', set_value('txtEmail', ''), 'placeholder="Email" maxlength="255" class="form-control"'); ?>
			<br /><br />
			<button type="submit" name="submit" class="btn btn-info btn-block">Request for Password</button>
		</div>
	</div>

	<?php echo form_close();?>

	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>