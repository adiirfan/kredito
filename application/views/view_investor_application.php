
<!-- range slider -->
<link href="<?php echo base_url(); ?>assets/range-slider/css/simple-slider.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/range-slider/js/simple-slider.min.js"></script>

<!-- process steps -->
<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
  $(document).ready(function() {
    
    	$('.btn-month').on('click', function(){
		    $(".btn-month").removeClass('active');
		    $(this).addClass('active');

		    $("#h_selected_month").val($(this).val());
		}); 

		$('.btn-type').on('click', function(){
            $(".btn-type").removeClass('active');
            $(this).addClass('active');

            $("#h_investor_type").val($(this).val());

            show_hide_company($(this).val());
        }); 

		function show_hide_company(investor_type_id)
		{
			if (investor_type_id == "I")
			{
				$("#div_company").addClass('hidden');
			}
			else
			{
				$("#div_company").removeClass('hidden');
			}
		}

		show_hide_company($("#h_investor_type").val());


		$('#chk_period_0').on('click', function(){
			var l_period_0 = $("#chk_period_0").is(':checked');
			var l_period_3 = $("#chk_period_3").is(':checked');
			var l_period_6 = $("#chk_period_6").is(':checked');
			var l_period_9 = $("#chk_period_9").is(':checked');
			var l_period_12 = $("#chk_period_12").is(':checked');
			var l_period_18 = $("#chk_period_18").is(':checked');
			var l_period_24 = $("#chk_period_24").is(':checked');
		    
			if (l_period_0)
			{
				$("#chk_period_3").prop("checked", true);
				$("#chk_period_6").prop("checked", true);
				$("#chk_period_9").prop("checked", true);
				$("#chk_period_12").prop("checked", true);
				$("#chk_period_18").prop("checked", true);
				$("#chk_period_24").prop("checked", true);
			}
		}); 

		$('.repayment_period').on('click', function(){
			var l_period_3 = $("#chk_period_3").is(':checked');
			var l_period_6 = $("#chk_period_6").is(':checked');
			var l_period_9 = $("#chk_period_9").is(':checked');
			var l_period_12 = $("#chk_period_12").is(':checked');
			var l_period_18 = $("#chk_period_18").is(':checked');
			var l_period_24 = $("#chk_period_24").is(':checked');
		    
			if (l_period_3 && l_period_6 && l_period_9 && l_period_12 && l_period_18 && l_period_24)
			{
				//
			}
			else
			{
				$("#chk_period_0").prop("checked", false);
			}
		}); 


	});

  

</script>


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
			        <img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Pendaftaran</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
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
		<div class="col-lg-8 col-lg-offset-2">
			
			<hr>
		</div>		
	</div>
	<?php echo form_open('investor/application/next'); ?>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-2 register">
			<?php echo validation_errors('<p class="alert alert-danger">');?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
		
		<div class="row">
			<div class="col-lg-12" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
			<h2 align="center">Pendaftaran</h2>
			<div class="row">
				<div class="col-lg-6 register">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<div style="display:block">
						<?php 
							echo form_input('txt_full_name', set_value('txt_full_name', ''), 'name="txt_full_name" class="form-control"  ');
						?>
						</div>
					</div>
					<div class="form-group">
						<label>Panggilan</label>
						<select id="cbo_salutation" name="cbo_salutation" class="form-control" >
							<?php 
								echo '<option value="">Pilih</option>';
								for ($i = 0; $i < count($salutation_list); ++$i)
								{ 
									if ($salutation_id == $salutation_list[$i]->salutation_id)
										echo '<option value="'.$salutation_list[$i]->salutation_id.'" selected="selected">'.$salutation_list[$i]->salutation_name.'</option>';
									else
										echo '<option value="'.$salutation_list[$i]->salutation_id.'">'.$salutation_list[$i]->salutation_name.'</option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Email</label>
						<?php 
							echo form_input('txt_email', set_value('txt_email', ''), 'name="txt_email" class="form-control"');
						?>
					</div>
				</div>
			
			
			
		
				<div class="col-lg-6 register">
				
				<div class="form-group">
						<label>Nomor Telepon</label>
						<?php echo form_input('txt_mobile_phone', set_value('txt_mobile_phone', ''), 'name="txt_mobile_phone" class="form-control"');?>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<?php 
						$data = array(
						  'name'        => 'txt_address',
						  'id'          => 'txt_address',
						  'value'       =>  $address,
						  'rows'   		=> '5',
						  'class'		=> 'form-control',
						  'maxlength' 	=> 255
						);
						echo form_textarea($data); ?>
					</div>
					<div class="form-group">
						<label>Siapa anda</label><br />
						<div class="btn-group" role="group" aria-label="...">
						  <button type="button" class="btn btn-default btn-type <?php if($investment_type == "I"){echo "active";} ?>" value="I">Individu</button>
						  <button type="button" class="btn btn-default btn-type <?php if($investment_type == "C"){echo "active";} ?>" value="C">Perusahaan</button>
						  <input type="hidden" id="h_investor_type" name="h_investor_type" value="<?php echo $investment_type ?>" />
						</div>
					</div>
					<br />
					<div id="div_company" class="hidden">
						<h3><i class="fa fa-building-o"></i>&nbsp;&nbsp;Informasi Perusahaan</h3>
						<div class="form-group">
							<label>Nama Perusahaan</label>
							<?php echo form_input('txt_company_name', set_value('txt_company_name', ''), 'name="txt_company_name" class="form-control"');?>
						</div>
						<div class="form-group">
							<label>Nomor NPWP</label>
							<?php echo form_input('txt_company_registration', set_value('txt_company_registration', ''), 'name="txt_company_registration" class="form-control"');?>
						</div>
						<br />
					</div>
				<!--
					<div class="form-group">
						<label>Fund</label>
						<div class="row">
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon">MYR</span>
									<input type="hidden" id="txt_fund" name="txt_fund" maxlength="20" class="form-control group-input" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="row">
									<?php// echo form_input('range-slider', set_value('range-slider', $fund), 'data-slider="true" data-slider-range="10000,500000" data-slider-step="1000"');?>
								</div>
								<div class="row">
									<span class="output">10k</span>
									<span class="pull-right">500k</span>
								</div>
							</div>
						</div>
					</div>
					-->
					
					
				</div>
			</div>
			<p align="center"><button name="submit" class="btn btn-info longer">Selanjutnya <i class="fa fa-chevron-right"></i></button></p>
			<?php echo form_close();?>
			<hr>
			</div>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			
		</div>		
	</div>
</div>	


<script>
  $("[data-slider]")
    .bind("slider:ready slider:changed", function (event, data) {
      	$("#txt_fund").val(data.value.toFixed(0));
      	//calculate_repayment();
    });
  </script>
