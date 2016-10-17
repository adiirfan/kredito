<!-- range slider -->
<link href="<?php echo base_url(); ?>assets/range-slider/css/simple-slider.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/range-slider/js/simple-slider.min.js"></script>

<!-- process steps -->

<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">
 <script src="<?php echo base_url() ?>assets/angular/angular.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    
    	$('.btn-month').on('click', function(){
		    $(".btn-month").removeClass('active');
		    $(this).addClass('active');

		    $("#h_selected_month").val($(this).val());
		}); 

		$('#cbo_loan_purpose').on('change', function(){
		    if ($('#cbo_loan_purpose').val() == "-1")
		    {
		    	$("#txt_loan_purpose_other").removeClass('hidden');
		    }
		    else
		    {
		    	$("#txt_loan_purpose_other").addClass('hidden');
		    }
		}); 

	});

  

</script>
	<script src="http://www.rajapremi.com/assets/js/autoNumeric.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".InsuredPrice").length > 0 && $(".InsuredPrice").autoNumeric("init");
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
			            <p>Login/Registrasi </p>
			        </div>
					<img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Informasi Pinjaman</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Pengajuan</p>
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
			<h2 align="center">Pengajuan Multiguna</h2>
			<hr>
		<?php //echo form_open('borrower/application/next'); ?>
	<form method="post" id="form_borrower" action="<?php echo base_url(); ?>borrower/application/next" enctype="multipart/form-data">
	<div class="row">
	<div class="col-lg-12" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
	<div class="row">
		<div class="col-lg-6  register">
			<?php echo validation_errors('<p class="alert alert-danger">');?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 register">
			<h3><i class="fa fa-user"></i>&nbsp;&nbsp;Biodata Anda</h3>
			<div class="form-group">
				<label>Nomor KTP</label>
				<?php 
					if (get_cookie("user_id") == "")
						echo form_input('txt_ktp', set_value('txt_ktp', $ktp), 'name="txt_ktp" class="form-control"');
					else
						echo form_input('txt_ktp', set_value('txt_ktp', $ktp), 'name="txt_ktp" class="form-control" ');
				?>
			</div>
			<div class="form-group">
				<label>Nama Lengkap</label>
				<div style="display:block">
				
				
				<?php 
					if (get_cookie("user_id") == "")
						echo form_input('txt_full_name', set_value('txt_full_name', $full_name), 'name="txt_full_name" class="form-control"  ');
					else
						echo form_input('txt_full_name', set_value('txt_full_name', $full_name), 'name="txt_full_name" class="form-control" readonly="true" style="width:74%;display:inline-block" ');
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
				<label>Alamat</label>
				<?php
			
						//echo form_textarea($data);
				//echo form_textarea('txt_address', set_value('txt_address', $address), 'name="txt_address" rows="2" class="form-control"');?>
				<textarea class="form-control" rows="3" name="txt_address"><?php echo $address; ?></textarea>
			
			</div>
			
			<div class="form-group">
				<label>Kota</label>
				<?php echo form_input('txt_city', set_value('txt_city', $city), 'name="txt_city" class="form-control"');?>
			</div>
			<div class="form-group">
				<label>Provinsi</label>
				<?php echo form_input('txt_provinsi', set_value('txt_provinsi', $provinsi), 'name="txt_provinsi" class="form-control"');?>
			</div>
			<div class="form-group">
				<label>Kode Pos</label>
				<?php echo form_input('txt_postal_code', set_value('txt_postal_code', $postal_code), 'name="txt_postal_code" class="form-control"');?>
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
				<label>Tujuan peminjaman </label><br/>
				<select id="cbo_loan_purpose" name="cbo_loan_purpose" class="form-control">
					<?php 
	                    echo '<option value="">- Pilih -</option>';
	                    for ($i = 0; $i < count($loan_purpose_list); ++$i)
	                    { 
	                    	if ($loan_purpose_id == $loan_purpose_list[$i]->loan_purpose_id)
	                    		echo '<option value="'.$loan_purpose_list[$i]->loan_purpose_id.'" selected="selected">'.$loan_purpose_list[$i]->loan_purpose_name.'</option>';
	                    	else
	                      		echo '<option value="'.$loan_purpose_list[$i]->loan_purpose_id.'">'.$loan_purpose_list[$i]->loan_purpose_name.'</option>';
	                    }
	                    if ($loan_purpose_id == -1)
	                    	echo '<option value="-1" selected="selected">Lain lain</option>';
	                    else
	                    	echo '<option value="-1">Lain lain</option>';
                    ?>
				</select>
				<?php
					if ($loan_purpose_id == -1)
				 		echo form_input('txt_loan_purpose_other', set_value('txt_loan_purpose_other', $loan_purpose_other), 'id="txt_loan_purpose_other" class="form-control" placeholder="Your Loan Purpose"');
				 	else
				 		echo form_input('txt_loan_purpose_other', set_value('txt_loan_purpose_other', $loan_purpose_other), 'id="txt_loan_purpose_other" class="form-control hidden" placeholder="Your Loan Purpose"');
				?>
			</div>
		
			<br />
			
			<br />
		</div>
		<div class="col-lg-6 register">
		
			<div ng-app="myApp" ng-controller="customersCtrl">
							<input type="hidden" id="txt_amount" name="txt_amount"  value='{{pinjaman}}' />
							<input type="hidden" id="txt_amount" name="period" value="<?php echo get_cookie("b_month")?>"  maxlength="20" class="form-control group-input" />			 
			
			</div>
			
			
			
			<h3><i class="fa fa-building-o"></i>&nbsp;&nbsp;Informasi Perusahaan Anda</h3>
			<div class="form-group">
				<label>Nama Perusahaan</label>
				<?php echo form_input('txt_company_name', set_value('txt_company_name', $company_name), 'name="txt_company_name" class="form-control"');?>
			</div>
			<div class="form-group">
				<label>Nomor NPWP </label>
				<?php echo form_input('txt_company_registration', set_value('txt_company_registration', $company_registration), 'name="txt_company_registration" class="form-control"');?>
			</div>
			<div class="form-group">
				<label>Domisili Usaha</label>
				<?php echo form_input('txt_company_location', set_value('txt_company_location', $company_location), 'name="txt_company_location" class="form-control"');?>
			</div>
			<div class="form-group">
				<label>Pendapatan per-bulan</label>
				<?php echo form_input('txt_company_paid_up_capital', set_value('txt_company_paid_up_capital', $company_paid_up_capital), 'class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep="."');?>
				<!--<input type="text" class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep="." name="txt_company_paid_up_capital" id="InsuredPrice" value="<?php //echo $company_paid_up_capital; ?>" placeholder="Modal usaha (Rp. .......)" >-->
				<?php //echo form_input('txt_company_paid_up_capital', set_value('txt_company_paid_up_capital', $company_paid_up_capital), 'name="txt_company_paid_up_capital" class="form-control"');?>
			</div>
			
			<div class="form-group">
				<label>Pendapatan pertahun</label>
				<?php echo form_input('txt_company_revenue', set_value('txt_company_revenue', $company_revenue), 'class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep="." name="txt_company_revenue" id="InsuredPrice"');?>
				
		<!--<input type="text" class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep="." name="txt_company_revenue" id="InsuredPrice" value="<?php //echo $company_revenue; ?>" placeholder="Modal usaha (Rp. .......)" >-->
				<?php //echo form_input('txt_company_revenue', set_value('txt_company_revenue', $company_revenue), 'name="txt_company_revenue" class="form-control"');?>
			</div>
			<div class="form-group">
				<label>Jumlah Karyawan</label>
				<select id="cbo_man_power" name="cbo_man_power" class="form-control">
					<option value="1" <?php if ($company_man_power=='1') { echo "selected='selected'";} ?> >1 - 10</option>
					<option value="2" <?php if ($company_man_power=='2') { echo "selected='selected'";} ?> >Karyawan <= 50</option>
					<option value="3" <?php if ($company_man_power=='3') { echo "selected='selected'";} ?> >Karyawan <= 100</option>
					<option value="4" <?php if ($company_man_power=='4') { echo "selected='selected'";} ?> >Karyawan <= 500</option>
					<option value="5" <?php if ($company_man_power=='5') { echo "selected='selected'";} ?> >Karyawan >= 500</option>
				</select>
			</div>
			<div class="form-group">
				<input id="chk_company_is_new" name="chk_company_is_new" type="checkbox" value="1" <?php if ($company_is_new == "1"){ echo "checked='checked'";} ?> />
				<label for="chk_company_is_new">Ini perusahaan baru</label>
			</div>
			
			<div class="form-group">
				<label>Alamat</label>
				<?php //echo form_textarea('txt_company_address', set_value('txt_company_address', $company_address), 'name="txt_company_address" class="form-control" rows="3"');?>
				<textarea class="form-control" rows="3" name="txt_company_address"><?php echo $company_address; ?></textarea>
			</div>
			<div class="form-group">
				<label>Kode Pos</label>
				<?php echo form_input('txt_company_postal_code', set_value('txt_company_postal_code', $company_postal_code), 'name="txt_company_postal_code" class="form-control"');?>
			</div>

			<br />
			  <a href="<?php echo base_url(); ?>borrower/application/info" class="btn btn-info" style="margin-bottom:5px"><i class="fa fa-chevron-left"></i> Kembali</a>
			<button name="submit" class="btn btn-info pull-right longer">Lanjut <i class="fa fa-chevron-right"></i></button>
		</div>
	</div>
	</div>
	</div>
		</div>		
	</div>
	
	<?php echo form_close();?>
</div>	


<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $location, $anchorScroll, $locale) {
   $http.get("<?php echo base_url() ?>product_data/?tenor=3&kategory=1")
   .then(function (response) {$scope.names = response.data.records;});
    $scope.pinjaman = '<?php echo get_cookie("b_amount")?>';
	 $scope.months = ['3','6','9','12','18','24'];
	 $scope.selected = 0;
	  $scope.bunga=20/100;
	   $scope.bulan=<?php echo get_cookie("b_month")?>;
	   $scope.percent=(15* $scope.bulan)/12;
	    $scope.percentnew=(20* $scope.bulan)/12;
	 // $scope.interestrate= ($scope.pinjaman*20)/100;
	  //$scope.bulan=12;
     // $scope.pembayaran_perbulan=$scope.pinjaman-$scope.interestrate;
	 
	   $scope.change = function(tahun) {
   
	
	  $scope.bulan=tahun;
     // $scope.pembayaran_perbulan= "200";
	
	//alert( $scope.selected);
    };
	 
	 
	 
});


app.directive('format', ['$filter', function ($filter) {
    return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;


            ctrl.$formatters.unshift(function (a) {
                return $filter(attrs.format)(ctrl.$modelValue)
            });


            ctrl.$parsers.unshift(function (viewValue) {
                var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g, '');
                elem.val($filter(attrs.format)(plainNumber));
                return plainNumber;
            });
        }
    };
}]);
</script>

<script>
  $("[data-slider]")
    .bind("slider:ready slider:changed", function (event, data) {
      	$("#txt_amount").val(data.value.toFixed(0));
      	//calculate_repayment();
    });
	
	
		
  </script>