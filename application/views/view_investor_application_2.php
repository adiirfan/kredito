
<!-- range slider -->
<link href="<?php echo base_url(); ?>assets/range-slider/css/simple-slider.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/range-slider/js/simple-slider.min.js"></script>

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
		<div class="col-lg-8 col-lg-offset-2">
			<h2>Melakukan investasi</h2>
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
		<div class="col-lg-4 col-lg-offset-2 register">
			<h3><i class="fa fa-user"></i>&nbsp;&nbsp;Data Investor</h3>
			<div class="form-group">
				<label>Nama Lengkap</label>
				<div style="display:block">
				<select id="cbo_salutation" name="cbo_salutation" class="form-control" style="width:25%;display:inline-block">
					<?php 
	                    echo '<option value="">Select</option>';
	                    for ($i = 0; $i < count($salutation_list); ++$i)
	                    { 
	                    	if ($salutation_id == $salutation_list[$i]->salutation_id)
	                    		echo '<option value="'.$salutation_list[$i]->salutation_id.'" selected="selected">'.$salutation_list[$i]->salutation_name.'</option>';
	                    	else
	                      		echo '<option value="'.$salutation_list[$i]->salutation_id.'">'.$salutation_list[$i]->salutation_name.'</option>';
	                    }
                    ?>
				</select>
				
				<?php 
					if (get_cookie("user_id") == "")
						echo form_input('txt_full_name', set_value('txt_full_name', $full_name), 'name="txt_full_name" class="form-control" style="width:74%;display:inline-block" ');
					else
						echo form_input('txt_full_name', set_value('txt_full_name', $full_name), 'name="txt_full_name" class="form-control" readonly="true" style="width:74%;display:inline-block" ');
				?>
				</div>
			</div>
			<div class="form-group">
				<label>Email</label>
				<?php 
					if (get_cookie("user_id") == "")
						echo form_input('txt_email', set_value('txt_email', $email), 'name="txt_email" class="form-control"');
					else
						echo form_input('txt_email', set_value('txt_email', $email), 'name="txt_email" class="form-control" readonly="true"');
				?>
			</div>
			<div class="form-group">
				<label>Telepon</label>
				<?php echo form_input('txt_mobile_phone', set_value('txt_mobile_phone', $mobile_phone), 'name="txt_mobile_phone" class="form-control"');?>
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
				<label>Tipe</label><br />
				<div class="btn-group" role="group" aria-label="...">
                  <button type="button" class="btn btn-default btn-type <?php if($investment_type == "I"){echo "active";} ?>" value="I">Perorangan</button>
                  <button type="button" class="btn btn-default btn-type <?php if($investment_type == "C"){echo "active";} ?>" value="C">Perusahaan</button>
                  <input type="hidden" id="h_investor_type" name="h_investor_type" value="<?php echo $investment_type ?>" />
                </div>
			</div>
			<br />
			<div id="div_company" class="hidden">
				<h3><i class="fa fa-building-o"></i>&nbsp;&nbsp;Company Information</h3>
				<div class="form-group">
					<label>Nama Perusahaan</label>
					<?php echo form_input('txt_company_name', set_value('txt_company_name', $company_name), 'name="txt_company_name" class="form-control"');?>
				</div>
				<div class="form-group">
					<label>Nomor NPWP</label>
					<?php echo form_input('txt_company_registration', set_value('txt_company_registration', $company_registration), 'name="txt_company_registration" class="form-control"');?>
				</div>
				<br />
			</div>
		</div>
		<input type="hidden" id="txt_fund" name="txt_fund" maxlength="20" value="100000" class="form-control group-input" />
		<!--
		<div class="col-lg-4 register">
			<h3><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Detail Pendanaan</h3>
			<div class="form-group">
				<label>Fund</label>
				<div class="row">
		        	<div class="col-sm-6">
		        		<div class="input-group">
							<span class="input-group-addon">RP</span>
							<input type="text" id="txt_fund" name="txt_fund" maxlength="20" class="form-control group-input" />
						</div>
		        	</div>
		        	<div class="col-sm-6">
		        		<div class="row">
		        			<?php //echo form_input('range-slider', set_value('range-slider', $fund), 'data-slider="true" data-slider-range="10000,500000" data-slider-step="1000"');?>
		        		</div>
		        		<div class="row">
		        			<span class="output">10k</span>
		        			<span class="pull-right">500k</span>
		        		</div>
		       		</div>
		       	</div>
			</div>
			<br />
			<button name="submit" class="btn btn-info pull-right longer">Lanjut <i class="fa fa-chevron-right"></i></button>
		</div>
		-->
		<div class="col-lg-4 register">
			<h3><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Upload Dokumen</h3>
			<div class="form-group">
				<label>KTP</label>
					<?php //echo form_input('txt_company_name', set_value('txt_company_name', $company_name), 'name="txt_company_name" type="file" class="form-control"');?>
				<input type="file" name="file_ktp" class="form-control">
			</div>
			<div class="form-group">
				<label>Bukti Transfer</label>
					<?php //echo form_input('txt_company_name', set_value('txt_company_name', $company_name), 'name="txt_company_name" type="file" class="form-control"');?>
				<input type="file" name="file_ktp" class="form-control">
			</div>
			<div class="form-group">
				<label>Folder</label>
					<?php //echo form_input('txt_company_name', set_value('txt_company_name', $company_name), 'name="txt_company_name" type="file" class="form-control"');?>
				<?php echo form_input('txt_folder', set_value('txt_folder', $folder), 'name="txt_folder" class="form-control"');?>
			</div>
			<br />
		
		</div>
		<br><br><br><br>
		<button name="submit" class="btn btn-info pull-right longer">Lanjut <i class="fa fa-chevron-right"></i></button>
	</div>
	<?php echo form_close();?>
</div>	

<script>
  $("[data-slider]")
    .bind("slider:ready slider:changed", function (event, data) {
      	$("#txt_fund").val(data.value.toFixed(0));
      	//calculate_repayment();
    });
  </script>
