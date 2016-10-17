 <script src="<?php echo base_url() ?>assets/angular/angular.min.js"></script>
 
	 <script src="<?php echo base_url() ?>assets/angular/angular-locale_id-id.js"></script> 
	  <script src="<?php echo base_url() ?>assets/angular/dynamic-number.js"></script> 
	   <script src="<?php echo base_url() ?>assets/angular/angular-scroll.js"></script> 
<!-- process steps -->
<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">

<div class="container" ng-app="myApp" ng-controller="cek" ng-init="firstName='John';tenor=<?php echo get_cookie("b_month")?>;pinjaman_nilai=10000;">

	<div class="row" >
		<div class="col-lg-10 col-lg-offset-1">
			<div class="stepwizard">
			    <div class="stepwizard-row">
					<img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			    	
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-user"></i></li>
			            <p>Login/Register</p>
			        </div>
					<img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Informasi Pinjaman</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-grey btn-circle disabled"><i class="fa fa-info"></i></li>
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
			            <p>Proses selesai</p>
			        </div> 
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			    </div>
			</div>
		</div>
	</div>
		
		<div class="row">
		  <div class="col-lg-2">
		   </div>
			<div class="col-lg-8" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
			<div class="panel panel-default" style="border-color: #fff !important;">
			<div class="panel-body">
			<strong>Detail Pinjaman </strong>
			<br><br>
			<div class="row">
				<div class="col-lg-6">
				<div class="panel panel-default" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
					<div class="panel-body">
								<center><h4><b><strong>Kalkulator Pinjaman </strong></b></h5></center>
								<br>
						<font color="#000"><h5>Jumlah Pinjaman</h5></font>
						<div class="row">
						
								<div class="input-group">
									<span class="input-group-addon">RP</span>
									<input type="text" class="form-control group-input" ng-model="pinjaman" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>
									
								</div>	
						</div>
						<br />
						<font color="#000"><h5>Jangka Waktu</h5></font>
						
						<div class="input-group">
			
							  <select class="form-control group-input" ng-model="selected" name="period"  ng-options="opt as opt for opt in months" ng-init="selected='<?php echo get_cookie("b_month")?>'" ng-change="change(selected)"></select>
							  <div class="input-group-addon">Bulan</div>
						</div>
						<br />
						
						<br /><br />
						
							<div class="col-sm-12 text-center"> 
								
									<button type="submit" ng-click="scrollTo(1)" name="submit" class="btn btn-info center-block longer">Kalkulasi Pinjaman</button>
									
							</div>
					
					</div>
					</div>
			
					
				
				</div>
				<div class="col-lg-6">
					 <div class="form-group">
				<label>Pinjaman</label>
				<div style="display:block">
				{{ pinjaman  | currency:"Rp ":0 }}
				</div>
				</div>
				
				<div class="form-group">
				<label>Jangka Waktu</label>
				<div style="display:block">
				<?php echo get_cookie("b_month")?> Bulan
				</div>
				</div>
				
				<div class="form-group">
				<label>Suku Bunga per-tahun</label>
				<div style="display:block">
				15% - 20%
				</div>
				</div>
				
				<div class="form-group">
				<label>Cicilan per bulan</label>
				<div style="display:block">
				<p>{{(((pinjaman/100)*percent)/bulan)+(pinjaman/bulan) | currency:"Rp ":0}} sampai {{(((pinjaman/100)*percentnew)/bulan)+(pinjaman/bulan) | currency:"Rp.":0}}</p>
				</div>
				</div>
				
				<div class="form-group">
				<label>Total bunga dibayar</label>
				<div style="display:block">
				<p>{{(((((pinjaman/100)*percent)/bulan)+(pinjaman/bulan))*bulan)-pinjaman | currency:"Rp ":0}} sampai {{(((((pinjaman/100)*percentnew)/bulan)+(pinjaman/bulan))*bulan)-pinjaman | currency:"Rp ":0}}</p>
				</div>
				</div>
				
				<div class="form-group">
				<label>Jenis Pinjaman</label>
				<div style="display:block">
				Kredit Tanpa Angunan
				</div>
				</div>
				
				<div class="form-group">
				<label>Proses Verifikasi</label>
				<div style="display:block">
				3 Hari Kerja
				</div>
				</div>
				
				<div class="form-group">
				<label>Syarat Dokumen</label>
				<div style="display:block">
				 <ul>
                <li>KTP</li><li>NPWP </li><li>SIUP</li>
				</ul> 
				</div>
				</div>
				
				<div class="form-group">
				<label>Syarat dan ketentuan</label>
				<div style="display:block">
				 <ul>
                <li>Warga Negara Indonesia </li><li>Minimal Umur 20 tahun </li><li>Minimal penghasilan per-bulan 10000000</li>
				</ul> 
				</div>
				</div>
				<form method="post" action="<?php echo base_url(); ?>borrower/application">
				<!--
				<input type="hidden" name="h_amount" value="{{pinjaman}}">
			
				<input type="hidden" name="h_selected_month" value="<?php //echo get_cookie("b_month")?>">
				-->
			
				<button  type="submit"  class="btn btn-info pull-right">Selanjutnya</button></td>
				
                
				</form>
				</div>
			</div>
			
			</div>
			</div>
		  
		  </div>
		  <div class="col-lg-1">
		   </div>
		
		   
		</div>
		
	
		<!--
		<div class="row">
		  <div class="col-lg-2">
		    </div>
		  <div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
								<center><h4><b><strong>Pinjaman Anda </strong></b></h5></center>
								<br>
						<font color="#000"><h5>Jumlah Pinjaman</h5></font>
						<div class="row">
						
								<div class="input-group">
									<span class="input-group-addon">RP</span>
									<input type="text" class="form-control group-input" ng-model="pinjaman" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>
									
								</div>	
						</div>
						<br />
						<font color="#000"><h5>Jangka Waktu</h5></font>
						
						<div class="input-group">
			
							  <select class="form-control group-input" ng-model="selected" name="period"  ng-options="opt as opt for opt in months" ng-init="selected='<?php echo get_cookie("b_month")?>'" ng-change="change(selected)"></select>
							  <div class="input-group-addon">Bulan</div>
						</div>
						<br />
						
						<br /><br />
						
							<div class="col-sm-12 text-center"> 
								
									<button type="submit" ng-click="scrollTo(1)" name="submit" class="btn btn-info center-block longer">Cek</button>
									
							</div>
					
					</div>
					</div>
						
				</div>
		<div class="col-lg-4  "> 
		
		
		</div>
		<div class="col-lg-1"> 
		</div>
		</div>
		-->
		</div>
		</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('borrower/login/validation'); ?>
				
			<?php echo form_close();?>
		</div>
	</div>
</div>	
<script>
var app = angular.module('myApp', ["dynamicNumber","duScroll"]);
app.controller('cek', function($scope, $http, $location, $anchorScroll, $locale, $document) {
   
  
   $scope.pinjaman = <?php echo get_cookie("b_amount")?>;
	 $scope.radioModel = 'Middle';
	 $scope.months = ['3','6','9','12'];
	 $scope.bunga=20/100;
	 $scope.bulan=<?php echo get_cookie("b_month")?>;
	 $scope.percent=(15* $scope.bulan)/12;
	 $scope.percentnew=(20* $scope.bulan)/12;
	 
	 $scope.change = function(tahun) {
		 $scope.bulan=tahun;
		  $scope.tenor=tahun;
		};
		   var section3 = angular.element(document.getElementById('cek'));
		$scope.scrollTo = function(div) {
		
		 $document.scrollToElementAnimated(section3);
		 //$location.hash('cek');
		//$anchorScroll();
		}
		
		
	 
	 $scope.tujuan = function(kondisi) {
     // $http.get("<?php echo base_url() ?>product_data/?condition="+kondisi+"&tenor="+$scope.selected)
  // .then(function (response) {$scope.names = response.data.records;});
		$scope.role_tujuan=kondisi;
		if($scope.role_tujuan=='1'){
		$scope.nama_tujuan="Kredit Tanpa Anggunan";
		}else if($scope.role_tujuan=='2'){
		$scope.nama_tujuan="Kredit Pemilikan Rumah";
		}else if($scope.role_tujuan=='3'){
			$scope.nama_tujuan="Kredit Motor";
		}else {
			$scope.nama_tujuan="Modal Usaha";
		}
	
	//alert( $scope.selected);
    };
	 
		
});

//app.$inject = ['$scope'];
 




</script>