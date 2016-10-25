
<!-- balloon -->
<link href="<?php echo base_url(); ?>assets/balloon/css/mb.balloon.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/balloon/js/jquery.mb.balloon.js"></script>

<style type="text/css">

        *{
            box-sizing: border-box;
        }

</style>
<script>
	
	$(function () {

		jQuery.balloon.init();

		if ($("#btn_mobile_toggle").is(":visible"))
		{
			setTimeout(function(){
	            var balloon = $("#balloon2").showBalloon();
	        },500);	
		}
		else
		{
			setTimeout(function(){
	            var balloon = $("#balloon1").showBalloon();
	        },500);	
		}

        

    });

</script>

<div class="container">
	<div class="row">
		<div class="col-lg-5 col-lg-offset-3">
			<h2>Loan Request Submitted</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-5 col-lg-offset-3 register">
				<div class="form-group">
					Reference number: <span class="alert alert-danger"><?php echo $code?></span>.
					<br /><br />
					We will get back to you within 3 working days.
					<br /><br />
					<?php if(get_cookie('full_name') == ""){ ?>
					A confirmation email has been sent to your email.
					<br />
					Please check your mailbox and follow the instruction to activate your account.
					<?php } ?>
			    </div>
				</div>
				
				<br /><br />
		</div>
	</div>
</div>	

