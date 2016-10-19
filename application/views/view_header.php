<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if($title == null){ echo GLOBAL_TITLE; }else { echo $title;}?> - RajaKredit</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(); ?>/assets/img/kredito-logo.png" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Slider -->
    <!--
    <link href="<?php echo base_url(); ?>assets/light-slider/css/lightslider.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url();?>assets/light-slider/js/lightslider.js"></script>
-->

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/custom/css/web.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/custom/css/modal-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- jQuery -->
  
    <script src="<?php echo base_url();?>assets/jquery/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/jquery/js/jquery-ui.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
  
  
  
<style>
  #form label.error {
    color: red;
    font-weight: bold;
  }
   #form_borrower label.error {
    color: red;
    font-weight: bold;
  }
  .main {
    width: 600px;
    margin: 0 auto;
  }
  nav {
    width: 100%;
    border-bottom: 1px solid #ccc;
}
.topnav {
    font-size: 16px;
    padding: 4px;
}
</style>

<script>
    $().ready(function() {
		"use strict";
        $("#form_borrower").validate({
            rules : {
                login : {
                  required : true
                },
                email : {
                    required : true,
                    email : true
                },

				cbo_salutation : {
                    required : true,
                  
                },
				txt_email : {
                    required : true,
                  
                },
				txt_address : {
                    required : true,
                  
                },
				txt_ktp : {
                    required : true,
                  
                },
				txt_full_name : {
                    required : true,
                  
                },
				txt_city: {
                    required : true,
                  
                },
				txt_provinsi: {
                    required : true,
                  
                },
				
				txt_postal_code: {
                    required : true,
                  
                },
				txt_email: {
                    required : true,
                  
                },
				txt_provinsi: {
                    required : true,
                  
                },
				txt_mobile_phone: {
                    required : true,
                  
                },
				txt_company_registration: {
                    required : true,
                  
                },
				txt_company_name: {
                    required : true,
                  
                },
				txt_company_location: {
                    required : true,
                  
                },
				txt_company_revenue: {
                    required : true,
                  
                },
				txt_company_revenue: {
                    required : true,
                  
                },
				txt_company_address: {
                    required : true,
                  
                },
				txt_company_postal_code: {
                    required : true,
                  
                },
				txt_company_paid_up_capital: {
                    required : true,
                  
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
				bukti_transfer: {
                    required: "Upload bukti transfer",
                    extension: "Extensi file harus JPG, JPEG, atau PNG",
                    filesize: "Maximal ukuran file harus 1 Mb"
                },
                email: "Enter you email"
            },
            submitHandler: function(form) {
                form.submit();
				 $('#delete-submission').modal('show');
            }
        });
    });

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');
    $().ready(function() {
		"use strict";
        $("#form").validate({
            rules : {
                login : {
                  required : true
                },
                email : {
                    required : true,
                    email : true
                },
				bukti_transfer: {
                required: true,
                extension: "jpg,jpeg,png",
                filesize: 1000000,
				},
				 bank : {
                    required : true,
					
                  
                },
				 company_name : {
                    required : true,
                  
                },
				
				cbo_salutation : {
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
				 nama_rek : {
                    required : true,
					 minlength : 4,
					 maxlength : 4
                  
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
				bukti_transfer: {
                    required: "Upload bukti transfer",
                    extension: "Extensi file harus JPG, JPEG, atau PNG",
                    filesize: "Maximal ukuran file harus 1 Mb"
                },
                email: "Enter you email"
            },
            submitHandler: function(form) {
                form.submit();
				 $('#delete-submission').modal('show');
            }
        });
    });
	
    $(function(){
        $("#lbl_message").hide();
    });        

    function screen_check()
    {
        //alert($("#chk_remember_me").is(":checked"));
        //return false;

        if ($("#txt_email").val().trim() == "")
        {
            $("#lbl_message").text("Please enter Email.");
            $("#lbl_message").show();
            $("#txt_email").focus();
            return false;   
        }

        if ($("#txt_password").val().trim() == "")
        {
            $("#lbl_message").text("Please enter Password.");
            $("#lbl_message").show();
            $("#txt_password").focus();
            return false;   
        }

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "security/login/check",
            dataType: 'json',
            data: {
                email: $('#txt_email').val(),
                password: $('#txt_password').val(),
                remember: ($("#chk_remember_me").is(":checked") ? "1" : "0")},
            success: function(res) {
                if (res)
                {
					
                    if (res.status == true)
                    {
						
                        document.getElementById("login-form").submit(); 
                    }
                    else
                    {
						
                        $("#lbl_message").text("Email atau password anda salah");
                        $("#lbl_message").show();
                    }
                }
            }
        });

        return false;
    }

</script>


<style>
@media (min-width: 1200px) {
    .navbar {
        height: 70px;
    }
	
	
}
.navbar-default {
    background-color: #fff;
    border-color: #e7e7e7;
}

@media (min-width: 1200px) {
    .tes {
        height: 55px;
		width:210px;
    }
}
@media (min-width: 768px) {
    .tes {
        height: 55;
		width:210px;
    }
}
.tes{
	 height: 30;
	width:210px;
}
</style>
</head>

<body>

<body>


    <!-- style="padding:0px 100px; Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav" ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button id="btn_mobile_toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <div class="hidden-xs"> <a class="navbar-brand topnav" href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/img/kredito-logo.png" style="height:30px;width:210px;margin-top: 6px;" ></a></div>
			   <div class="hidden-lg"> <a class="navbar-brand topnav" href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>assets/img/kredito-logo.png" style="height:40px; width:210px;" ></a></div>
                <a class="pull-right" id="balloon2" data-balloon = "<?php if(isset($balloon_message) == '1'){echo $balloon_message;}else{echo '';} ?>"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo base_url();?>">Beranda</a>
                    </li>
				<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pinjaman <span class="caret"></span></a>
                <ul class="dropdown-menu">
				 <li><a href="<?php echo base_url(); ?>borrower/application/info">Multiguna</a></li>
                  <li><a href="<?php echo base_url(); ?>kredit-pemilikan-rumah">Kredit Pemilikan Rumah</a></li>
                  <li><a href="<?php echo base_url(); ?>kredit-mobil">Kredit Mobil</a></li>
				 <!-- <li><a href="<?php //echo base_url(); ?>">Kredit Motor</a></li>-->
                </ul>
			
				</li>

				
			   <?php if(get_cookie('user_group') == "I" && get_cookie('status') == 3){ ?>
			      <li>
			   <a href="<?php echo base_url();?>bid/application">Bid</a>
			   <li>
			   <?php } ?>
					<?php if(get_cookie('user_group') != "I" ){ ?>
					<li>
                        <a href="<?php echo base_url();?>investor/application">Investasi</a>
                    </li>
					<?php } ?>
                    <li>
                        <a href="<?php echo base_url();?>tentang-kami">Tentang kami</a>
                    </li>
                    
                  
                    <li>
                        <a href="<?php echo base_url();?>faq">FAQ</a>
                    </li>
					<li>
                        <a href="<?php echo base_url();?>kontak">Kontak</a>
                    </li>
					<?php if(get_cookie('full_name') == ""){ ?>
					<li>
                        <a href="<?php echo base_url();?>security/login/">Login</a>
                    </li>
					<?php } ?>
                    <!--
                    http://mifsud.me/adding-dropdown-login-form-bootstraps-navbar/
                    -->
					<?php if(get_cookie('full_name') != ""){ ?>
                    <li class="dropdown" id="balloon1" data-balloon = "<?php if(isset($balloon_message) == '1'){echo $balloon_message;}else{echo '';} ?>" data-justonce="true">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <?php if(get_cookie('full_name') != ""){echo get_cookie('full_name');}else{echo '';} ?> <strong class="caret"></strong></a>
                        <div class="dropdown-menu dropdown-signin">
						
                            <form accept-charset="UTF-8">
                                <?php if(get_cookie('full_name') == ""){ ?>
                               
                                <?php } else{?>
                                    <li><a href="" data-modal-id="popup_profile" class="dropdown-label"><i class="fa fa-user fa-fw"></i> Profil</a></li>
                                    <li><a href="" data-modal-id="popup_password" class="dropdown-label"><i class="fa fa-gear fa-fw"></i> Ubah Password</a></li>
                                    <li class="divider"></li>
                                    <?php if(get_cookie('user_group') == "B"){ ?>
                                    <li><a href="<?php echo base_url();?>borrower/application/list" class="dropdown-label"><i class="fa fa-dollar fa-fw"></i> Pinjaman Multiguna</a></li>
									 <li><a href="<?php echo base_url();?>borrower/application/listproduct" class="dropdown-label"><i class="fa fa-dollar fa-fw"></i> Pinjaman Produk</a></li>
                                    <?php }
                                    else{ ?>
                                    <li><a href="<?php echo base_url();?>investor/bid/listprogress" class="dropdown-label"><i class="fa fa-line-chart fa-fw"></i> Investasi Saya</a></li>
								
									<li><a href="<?php echo base_url();?>investor/bid/list" class="dropdown-label"><i class="fa fa-legal fa-fw"></i>Aktivitas Bid</a></li>
									<li><a href="<?php echo base_url();?>investor/saldo" class="dropdown-label"><i class="fa fa-legal fa-fw"></i>Saldo</a></li>
                                    <?php }?>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo base_url();?>security/logout" class="dropdown-label"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>
                                <?php } ?>
                            </form>
                        </div>
                    </li>
					<?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<form id="login-form" action="<?php echo base_url();?>security/login/success" method="post" accept-charset="UTF-8">
</form>

  <script src="<?php //echo base_url(); ?>assets/custom/js/dropdown.js"></script>
 