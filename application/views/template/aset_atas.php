<!DOCTYPE html>
<html>
<head>
<title>Kredito.co.id</title>
		 <link rel="icon" href="<?php echo base_url(); ?>/assets/img/favicon.png" type="image/png">
		<!-- start: META -->
		 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- end: META -->
		<!-- start: MAIN CSS -->
        <link href="<?php echo base_url('assets_backend/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		 <link href="<?php echo base_url('assets_backend/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets_backend/dist/css/AdminLTE.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets_backend/dist/css/skins/_all-skins.min.css')?>" rel="stylesheet">
		
		<link rel="shortcut icon" href="<?php //echo base_url('assets_backend/img/logo-unj.png');?>" />
 <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
 
</head>
  <script type="text/javascript">
    $().ready(function() {
        $("#form").validate({
            rules : {
                login : {
                  required : true
                },
                email : {
                    required : true,
                    email : true
                },
				 company_code : {
                    required : true,
					 minlength : 4,
					 maxlength : 4
                  
                },
				 company_name : {
                    required : true,
                  
                },
				 company_email : {
                    email : true
					
                },
				 product_main_code : {
                    required : true,
                    minlength : 4,
                    maxlength : 4
                },
				 product_main_name : {
                    required : true,
                 
                },
				 product_code : {
                    required : true,
                    minlength : 4,
                    maxlength : 4
                },
				 interest_rate : {
                    required : true,
                   number: true,
                    maxlength : 4
                },
				down_payment : {
                    required : true,
                   number: true,
                    maxlength : 4
                },
				product_name : {
                    required : true,
                   
                },
				plafon_loan : {
                    required : true,
                     number: true,
                },
                password : {
                    required : true,
                    minlength : 5,
                    maxlength : 8
                }
            },
            messages: {
                login: "Enter you login",
                password: {
                    required: "Enter your password",
                    minlength: "Minimum password length is 5",
                    maxlength: "Maximum password length is 8"
                },
                email: "Enter you email"
            },
            submitHandler: function(form) {
                form.submit();
				 $('#delete-submission').modal('show');
            }
        });
    });
</script>

<style>
  #form label.error {
    color: red;
    font-weight: bold;
  }
  .main {
    width: 600px;
    margin: 0 auto;
  }
</style>