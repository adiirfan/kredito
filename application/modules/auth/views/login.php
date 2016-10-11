<!DOCTYPE html>
<html lang="en">

  <!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3 Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	
<!-- Mirrored from www.cliptheme.com/clip-one/login_example1.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 16 Nov 2013 08:38:33 GMT -->
<head>
		<title>Rajakredit</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-unj.png');?>" />

	     <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/fonts/style.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main-responsive.css')?>">

	</head>
	
 <body class="login example1">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
		<div align="center" >
		<!--	<img  src="<?php //echo base_url() ?>assets/img/logo-unj.png">-->
			</div>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3>Sign in to your account</h3>
				<p>
					Please enter your username and password to log in.
				</p>
				<div id="pesan"></div>
				
				 <form action="<?php echo base_url() ?>auth/cek_login" method="post" id="form-login">
				
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" id="username"  placeholder="Username">
								<i class="fa fa-user"></i> </span>
							<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
							<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
						</div>
						<div id="error">

						</div>	
					
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" id="password" placeholder="Password">
								<i class="fa fa-lock"></i>
								
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								Keep me signed in
							</label>
							<button type="submit" name="masuk" id="login" class="btn btn-bricky pull-right">
								Login <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					
						
					</fieldset>
					
				</form>
			</div>
			<!-- end: LOGIN BOX -->
			<!-- start: FORGOT BOX -->
			
			<!-- end: FORGOT BOX -->
			<!-- start: REGISTER BOX -->
			
			<!-- end: REGISTER BOX -->
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				2016 &copy; Rajakredit.
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		
		
		
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->
	
		<!-- end: MAIN JAVASCRIPTS -->
	
	</body>
	<!-- end: BODY -->

<!-- Mirrored from www.cliptheme.com/clip-one/login_example1.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 16 Nov 2013 08:38:34 GMT -->
</html>

</html>
<script type="text/javascript" src="<?php echo base_url() ?>assets/lib/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/dist/jquery.validate.js"></script>

  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
			$("#login").click(function(){

				var action = $("#form-login").attr('action');
				var form_data = {
					username: $("#username").val(),
					password: $("#password").val(),
					is_ajax: true
				};
				$.ajax({
					type: "POST",
					url: action,
					data: form_data,
					success: function(response)
					{
						//var c=val(response.status)
						//alert(response);
						if(response == "success")
							window.location.assign("<?php echo base_url() ?>backend")
						//$("#pesan").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">&times;</button><i class="fa fa-times-circle"></i><strong>tes tes </div>');
							
						else
							//window.location.assign("<?php echo base_url() ?>")
							$("#pesan").html('<div class="alert alert-danger"><button data-dismiss="alert" class="close">&times;</button><i class="fa fa-times-circle"></i><strong>Sorry! </strong>Invalid Username or password </div>');
					}
				});
				return false;
			});
		});
</script>
	
	
	
		