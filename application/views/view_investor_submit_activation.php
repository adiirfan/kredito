
<!-- process steps -->
<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">

<div class="container">

	<div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="stepwizard">
                <div class="stepwizard-row">
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-orange btn-circle"><i class="fa fa-check"></i></li>
                        <p>Login/Registrasi</p>
                    </div>
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-orange btn-circle"><i class="fa fa-check"></i></li>
                        <p>Pendaftaran</p>
                    </div>
                    <img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-grey btn-circle disabled"><i class="fa fa-file-o"></i></li>
                        <p>Upload Dokumen</p>
                    </div>
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-grey btn-circle disabled"><i class="fa fa-flag-checkered"></i></li>
                        <p>Selesai</p>
                    </div> 
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                </div>
            </div>
        </div>
    </div>
    
	<div class="row">
		<div class="col-lg-5 col-lg-offset-3">
			<h2>Verifikasi ditunda</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-5 col-lg-offset-3 register">
				<div class="form-group">
					<?php if(get_cookie('full_name') == ""){ ?>
					
					<br />
					Silahkan cek email anda untuk mengkatifasi akun anda
					<?php } ?>
			    </div>
				</div>
				
				<br /><br />
		</div>
	</div>
</div>	

