 <script src="<?php echo base_url() ?>assets/angular/angular.min.js"></script>
 
	<script src="<?php echo base_url() ?>assets/angular/angular-locale_id-id.js"></script> 
	<script src="<?php echo base_url() ?>assets/angular/dynamic-number.js"></script> 
	<script src="<?php echo base_url() ?>assets/angular/angular-scroll.js"></script>   
	<!-- assets for chart -->
	<script src="<?php echo base_url() ?>assets/angular/chart/chartjs/chart.js"></script>
		<script src="<?php echo base_url() ?>assets/angular/chart/angular-chart.min.js"></script> 
		<!-- assets for chart -->
<script>
var app = angular.module('myApp', ["dynamicNumber","duScroll","chart.js"]);
app.controller('cek', function($scope,$filter, $http, $location, $anchorScroll, $locale, $document) {
   
  
   $scope.pinjaman = <?php echo $pinjaman;?>;
	 $scope.radioModel = 'Middle';
	 $scope.months = ['3','6','9','12'];
	 $scope.bunga=20/100;
	 $scope.bulan=<?php echo $tenor;?>;
	 $scope.percent=(20* $scope.bulan)/12;
	 $scope.percentnew=(20* $scope.bulan)/12;
	 
	 $scope.change = function(tahun) {
		 $scope.bulan=tahun;
		  $scope.tenor=tahun;
		  $scope.percent=(20* $scope.bulan)/12;
		};
		   var section3 = angular.element(document.getElementById('cek'));
		$scope.scrollTo = function(div) {
		
		 $document.scrollToElementAnimated(section3);
		 //$location.hash('cek');
		//$anchorScroll();
		}
	
	//first define variabel value on pie chart function
	$scope.bunga_chart=((((($scope.pinjaman/100)*$scope.percent)/$scope.bulan)+($scope.pinjaman/$scope.bulan))*$scope.bulan)-$scope.pinjaman;
	$scope.principal_chart=$scope.pinjaman/$scope.bulan;
	
	//pie chart function
	$scope.labels = ["Principal","Bunga"];
	$scope.data = [$scope.principal_chart, $scope.bunga_chart/$scope.bulan];
	$scope.colors=['#46BFBD', '#FDB45C', '#949FB1'];

	
	//format legend on pie chart
	$scope.options = { 
	  legend: { 
		display: true 
	  },
	
	  tooltips: {
		enabled: true,
		mode: 'single',
		callbacks: {
		  label: function(tooltipItem, data) {
			var label = data.labels[tooltipItem.index];
			var datasetLabel = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
			return label + ': ' + $filter('currency')(datasetLabel);
		  }
		}
	  },
	};
	
	$scope.update_chart=function(){
		$scope.bunga_chart=((((($scope.pinjaman/100)*$scope.percent)/$scope.bulan)+($scope.pinjaman/$scope.bulan))*$scope.bulan)-$scope.pinjaman;
		$scope.principal_chart=$scope.pinjaman/$scope.bulan;
		//alert($scope.bunga_chart | currency);
	//alert($filter('currency')($scope.bunga_chart))
	$scope.labels = ["Principal","Bunga"];
	$scope.data = [$scope.principal_chart, $scope.bunga_chart/$scope.bulan];
		
		
	}
	//pie chart function
	 
		
});

</script>   
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
			<strong>Pinjaman Multiguna <?php //echo $this->input->post('h_selected_month',true); ?></strong>
			<br><br>
			<div class="row">
				<div class="col-lg-12">
				<center><h4><b><strong>Kalkulator Pinjaman Multiguna </strong></b></h5></center>
								<br>
				<div class="row">
				<div class="col-lg-6">
								
						<font color="#000"><h5>Jumlah Pinjaman</h5></font>
								<div class="input-group">
									<span class="input-group-addon">RP</span>
									<input type="text" class="form-control group-input" ng-model="pinjaman" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>
									
								</div>	
						<font color="#000"><h5>Jangka Waktu</h5></font>
						
						<div class="input-group">
			
							  <select class="form-control group-input" ng-model="selected" name="period"  ng-options="opt as opt for opt in months" ng-init="selected='<?php echo $tenor; ?>'" ng-change="change(selected)"></select>
							  <div class="input-group-addon">Bulan</div>
						</div>
					
						<font color="#000"><h5>Suku Bunga per-tahun</h5></font>
						
						<div class="input-group">
									
									<input type="text" readonly class="form-control group-input" value="20">
									<div class="input-group-addon">%</div>
									
						</div>	
						
						<font color="#000"><h5>Suku Bunga</h5></font>
						
						<div class="input-group">
									
									<input type="text" readonly value="{{percent}}" class="form-control group-input" >
									<div class="input-group-addon">%</div>
									
						</div>	
						
						<br>
							<div class="col-sm-12 text-center"> 
									<button type="submit" ng-click="update_chart()" name="submit" class="btn btn-info center-block longer">Kalkulasi Pinjaman</button>	
							</div>
					
					
				</div>
				<div class="col-lg-6">
				<div class="form-group">
				<font color="#000"><h5>Cicilan per-bulan</h5></font>
				<div style="display:block">
				<h4>{{(((pinjaman/100)*percent)/bulan)+(pinjaman/bulan) | currency:"Rp ":0}} <h4>
				</div>
				</div>
				<canvas id="pie" class="chart chart-pie"
				chart-data="data" chart-labels="labels" chart-options="options" chart-colors="colors">
				</canvas>
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
                <li>Warga Negara Indonesia </li><li>Minimal Umur 20 tahun </li><li>Minimal penghasilan per-bulan Rp. 10.000.0000</li>
				</ul> 
				</div>
				</div>
				
				<!--
				<input type="hidden" name="h_amount" value="{{pinjaman}}">
			
				<input type="hidden" name="h_selected_month" value="<?php //echo get_cookie("b_month")?>">
				-->
				
				<form method="post" action="<?php echo base_url(); ?>borrower/option">
				<input type="hidden" name="h_amount" value="{{pinjaman}}">
			
				<input type="hidden" name="h_selected_month" value="{{bulan}}">
				
				<button  type="submit"  class="btn btn-cek center-block longer">Saya ingin pinjam</button>
				<br>
				</form>

				</div>
				
				</div>
					
				
				</div>
				
			</div>
			
			</div>
			</div>
		  
		  </div>
		  <div class="col-lg-1">
		   </div>
		
		   
		</div>
		</div>
		</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('borrower/login/validation'); ?>
				
			<?php echo form_close();?>
		</div>
	</div>
</div>	
