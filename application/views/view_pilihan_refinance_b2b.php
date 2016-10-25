 <script src="<?php echo base_url() ?>assets/angular/angular.min.js"></script>
 
	 <script src="<?php echo base_url() ?>assets/angular/angular-locale_id-id.js"></script> 
	  <script src="<?php echo base_url() ?>assets/angular/dynamic-number.js"></script> 
	   <script src="<?php echo base_url() ?>assets/angular/angular-scroll.js"></script> 




<script>
$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
		// $("#cek").fadeIn("slow");
        scrollTop: $('#cek').offset().top
    }, 1000);
});
</script>
 <style>
.btn-cek {
    color: #fff;
    background-color: #F33131;
    border-color: #F33131;
}
.btn-cek:hover {
    color: #fff;
    background-color: #F70909;
    border-color: #F70909;
} 
 </style>

<div class="content-section-b"  ng-app="myApp" ng-controller="cek" ng-init="firstName='John';tenor=<?php echo $tenor ?>;pinjaman_nilai=10000;">
<div style="background:url('<?php echo base_url() ?>assets/img/rajakredit-banner.jpg') no-repeat center;background-size:100% auto;min-height:350px;">
        <div class="container" >

            <div class="row">
                
				<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6" >
						
						
						
				</div>
                
                <div class="col-lg-5 col-sm-pull-6  col-sm-6 hidden-xs" style=" margin-top: 50px; margin-bottom: 25px; padding:10px 10px 10px 10px;">
			<div class="panel panel-primary">
					<div class="panel-heading">
					<form id="apply-form-1" action="<?php echo base_url();?>pilihan" method="post" accept-charset="UTF-8">
					<font color="#fff">
					<h4 style="text-align:center;">
					Pinjaman Dana Tunai Cepat Segala Kebutuhan
					Pengajuan Online dengan Proses Cepat, Cicilan Ringan, & Bunga Rendah</h4>
					</font>
					</div>
					<div class="panel-body">
					
					<br>
					<font color="#000">
					<h5>
					Siapa anda<h5></font>
					<select name="siapa" id="siapa" class="form-control">
					<option value="Individu">Individu</option>
					<option value="Perusahaan">Perusahaan</option>
					</select>
						<font color="#000"><h5>Jumlah Pinjaman</h5></font>
						<div class="row">
						
								<div class="input-group">
									<span class="input-group-addon">Rp</span>
									<input type="text"  id="h_amount" name="h_amount" value="50000000"  data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep="." maxlength="20" class="form-control InsuredPrice group-input mystyle" />
									  <div class="input-group-addon">,00</div>
								</div>
						</div>
						
						<br />
						<font color="#000"><h5>Tujuan Peminjaman</h5></font>
						<select name="tujuan" id="tujuan" class="form-control">
						
						<option value="0">Pilih</option>
						<option value="1">Kredit Mobil</option>
						<option value="2">Kredit Pimilikan Rumah</option>
						<option value="3">Kredit Motor</option>
						<option value="4">Modal Usaha</option>
						<option value="5">Lain - lain</option>
						</select>
						
					
						
						<br />
						<!-- KREDIT MOBIL -->
						<div id="mobil" style="display:none" isShow="0">
						<font color="#000"><h5>Jangka Waktu</h5></font>
						<select name="waktu_mobil" id="waktu_mobil" class="form-control" >
						<option value="0">Pilih</option>
						<option value="1">1 Tahun</option>
						<option value="2">2 Tahun</option>
						<option value="3">3 Tahun</option>
						<option value="4">4 Tahun</option>
						<option value="5">5 Tahun</option>
						</select>
						</div>
						
						<!-- Kredit Rumah -->
						<div id="rumah" style="display:none" isShow="0">
						<font color="#000"><h5>Jangka Waktu</h5></font>
						<select name="waktu_rumah" id="waktu_rumah" class="form-control" >
						<option value="0">Pilih</option>
						<?php for ($x = 1; $x <= 25; $x++) { ?>
						<option value="<?php echo $x; ?>"><?php echo $x; ?> Tahun</option>
						
						<?php } ?>
						</select>
						</div>
						
						<!-- Modal Usaha -->
						<div id="usaha" style="display:none" isShow="0">
						<font color="#000"><h5>Jangka Waktu</h5></font>
						<select name="waktu_usaha" id="waktu_usaha" class="form-control" >
						<option value="0">Pilih Bulan</option>
						<option value="3">3 Bulan</option>
						<option value="6">6 Bulan</option>
						<option value="9">9 Bulan</option>
						<option value="12">12 Bulan</option>
						
						</select>
						</div>
						
						
						
						
						<br /><br />
						<!--
							Suku Bunga:<font color="#000"> <h4 style="display: inline-block;">15 %  sampai  20 % </h4><br>
							Cicilan perbulan: <h4 style="display: inline-block;"> <div style="display: inline-block;" id="span-repayment1">RP 0.00</div>  sampai  <div style="display: inline-block;" id="span-repayment2">RP 0.00</div></h4></font>
							<br /><br />-->
							
							<div class="col-sm-12 text-center"> 
								
									<button name="submit" class="btn btn-cek center-block longer">Cek Pinjaman</button>
								
									<input type="hidden" id="h_selected_month" name="h_selected_month" value="12" />
									<input type="hidden" id="h_selected_tujuan" name="h_selected_tujuan" value="0" />
									<input type="hidden" id="h_siapa" name="h_siapa" value="Individu"/>
									<input type="hidden" id="h_waktu_mobil" name="h_waktu_mobil" value="0"/>
									<input type="hidden" id="h_waktu_usaha" name="h_waktu_usaha" value="tes"/>
									<input type="hidden" id="h_waktu_rumah" name="h_waktu_rumah" value="tes"/>
									
					</form>
							</div>
					</div>
					</div>
						
				</div>
						</div>			
					</div>
					</div>
		
		
		
      
		
		<div id="cek">
		
		</div>
		<br>
		<br><br>
		<div class="row">
		  <div class="col-lg-2">
		    </div>
		  <div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
								<center><h4><b><strong>Kalkulator Pinjaman Rajakredit </strong></b></h5></center>
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
			
							  <select class="form-control group-input" ng-model="selected" name="period"  ng-options="opt as opt for opt in months" ng-init="selected='<?php echo $tenor;?>'" ng-change="change(selected)"></select>
							  <div class="input-group-addon">Bulan</div>
						</div>
						<br />
						<!--
						<font color="#000"><h5>Tujuan Peminjaman</h5></font>
						<label class="radio-inline"><input type="radio" ng-click="tujuan('1')" value="Kredit Mobil" name="h_selected_month" id="radio_1" ><font color="#000">Kredit Mobil</font></label>
						<label class="radio-inline"><input type="radio" ng-click="tujuan('2')" value="Kredit Pemilikan Rumah " name="h_selected_month" id="radio_1" ><font color="#000">Kredit Pemilikan Rumah</font></label><br>
						<label class="radio-inline"><input type="radio" ng-click="tujuan('3')" value="Kredit Motor" name="h_selected_month" id="radio_1" ><font color="#000">Kredit Motor</font></label>
						<label class="radio-inline"><input type="radio" ng-click="tujuan('4')" value="Modal Usaha" name="h_selected_month" id="radio_1" ><font color="#000">Modal Usaha</font></label>
						-->
						<br /><br />
						<!--
							Suku Bunga:<font color="#000"> <h4 style="display: inline-block;">15 %  sampai  20 % </h4><br>
							Cicilan perbulan: <h4 style="display: inline-block;"> <div style="display: inline-block;" id="span-repayment1">RP 0.00</div>  sampai  <div style="display: inline-block;" id="span-repayment2">RP 0.00</div></h4></font>
							<br /><br />-->
							
							<div class="col-sm-12 text-center"> 
								
									<button type="submit" ng-click="scrollTo(1)" name="submit" class="btn btn-info center-block longer">Cek</button>
									
							</div>
					
					</div>
					</div>
						
				</div>
		<div class="col-lg-4  "> 
		
		<div  class="panel nopadding" style="border:none;-webkit-box-shadow:none;box-shadow:none">
          <div class="panel-body nopadding" style="border:none;-webkit-box-shadow:none;box-shadow:none"> 
		 <table class="table table-hover table-responsive table-striped datatable comparetable" id="quoteEngine">     
              <thead>
              <tr> 
             
				<th class="col-lg-3 col-md-3 col-sm-3 col-xs-3" colspan="2"><center><b>PINJAMAN RAJAKREDIT</b></center></th>
               
              </tr>
              </thead>
              <tbody style="text-align: center;">
                <tr>
               
                <td colspan="2"><center><div class="logoComp"><img src="<?php echo base_url() ?>/assets/img/logo-rajakredit.png" class="img-responsive" style="max-width:100px"></div></center></td>
				                        
                </tr>
				<tr>
                <td><b>Jenis Kredit</b></td>
                <td><center>Kredit Tanpa Anggunan</center></td>                       
              
                </tr>
				<!--
				<tr>
                <td><b>Tujuan Peminjaman</b></td>
                <td><center>{{ nama_tujuan }}</center></td>                       
                <td><center>{{ nama_tujuan }}</center></td> 
                </tr>
				-->
				 <tr>
                <td><b>Proses</b></td>
                <td><center>3 hari</center></td>                       
                
                </tr>
                <tr>
                <td><b>Jumlah Pinjaman</b></td>
                <td><center>{{ pinjaman  | currency:"Rp ":0 }}</center></td>                       
                
                </tr>
				 <tr>
                <td><b>Tenor</b></td>
                <td><center>{{ tenor }} Bulan</center></td>                       
              
                </tr>
				<tr>
                <td><b>Suku Bunga per-tahun</b></td>
				<td><center>Hanya <br><b>15% - 20%</b></center>
				</td>
				
				</tr>
				<tr>
                <td><b>Cicilan Perbulan</b></td>
				<td>
				<p>{{(((pinjaman/100)*((15*bulan)/12))/bulan)+(pinjaman/bulan) | currency:"Rp ":0}} sampai {{(((pinjaman/100)*((20*bulan)/12))/bulan)+(pinjaman/bulan) | currency:"Rp ":0}}</p></td>
				
				</tr>
                <tr>
                <td><b>Total Bunga</b></td>
				<td><center>Hanya <br><b>{{(((((pinjaman/100)*((15*bulan)/12)  )/bulan)+(pinjaman/bulan))*bulan)-pinjaman | currency:"Rp ":0}} sampai {{(((((pinjaman/100)*((20* bulan)/12))/bulan)+(pinjaman/bulan))*bulan)-pinjaman | currency:"Rp ":0}} </b></center></td>
				
				</tr>
                <tr>
                <td><b>Kecepatan pencairan dana</b></td>
                <td><img alt="1" src="https://www.trustklik.com/css/images/star-on.png" title="Memuaskan">&nbsp;<img alt="2" src="https://www.trustklik.com/css/images/star-on.png" title="Memuaskan">&nbsp;<img alt="3" src="https://www.trustklik.com/css/images/star-on.png" title="Memuaskan">&nbsp;<img alt="4" src="https://www.trustklik.com/css/images/star-on.png" title="Memuaskan">&nbsp;<img alt="5" src="https://www.trustklik.com/css/images/star-half.png" title="Memuaskan"></td>
				
                </tr>
                <tr>
                <td><b>Syarat Dokumen</b></td>
				<td><center> KTP</center></td>
			           
                </tr>
               
                <tr>
                <td><b>Uang cair langsung ke peminjam</b></td>
                                                    <td><center> <span class="fa fa-check-circle"></span></center></td>
                        
                                                                  
                        
                                                  
                </tr>
               
                <tr>
                <td><b>Syarat Dokumen</b></td>
                <td style="text-align: left;">
				 <ul>
                <li>KTP</li><li>NPWP </li><li>SIUP</li>
				</ul> 
                </td>
				                             
                </tr>
                <tr>
               
                <td colspan="2">
				<form method="post" action="<?php echo base_url(); ?>borrower/option">
				<input type="hidden" name="h_amount" value="{{pinjaman}}">
				<input type="hidden" name="h_siapa" value="<?php echo $siapa; ?>">
				<input type="hidden" name="h_selected_month" value="{{tenor}}">
				<input type="hidden" name="h_tujuan" value="<?php echo $tujuan; ?>">
				<button  type="submit"  class="btn btn-cek">Saya ingin pinjam</button></td>
				
                </tr>
				</form>
                <tr>
                  <td colspan="4" style="text-align: left;"></td>
                  
                </tr>
              </tbody>
            </table>
		</div>
		<div class="col-lg-1"> 
		</div>
		</div>
		
		</div>
		</div>
		<div id="demo" class="collapse">
		<hr>
	
  </div>			<!-- /.container -->

</div>

	
<script>
var app = angular.module('myApp', ["dynamicNumber","duScroll"]);
app.controller('cek', function($scope, $http, $location, $anchorScroll, $locale, $document) {
   
  
   $scope.pinjaman = <?php echo $pinjaman ?>;
	 $scope.radioModel = 'Middle';
	 $scope.months = ['3','6','9','12'];
	 $scope.bunga=20/100;
	 $scope.bulan=<?php echo $tenor?>;
	 $scope.percent=(15* $scope.bulan)/12;
	 $scope.percentnew=(20* $scope.bulan)/12;
	 $scope.nama_tujuan='<?php echo $tujuan ?>';
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