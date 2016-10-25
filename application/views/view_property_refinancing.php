 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
 
	 <script src="https://code.angularjs.org/1.2.5/i18n/angular-locale_id-id.js"></script> 
	  <script src="<?php echo base_url() ?>assets/angular/dynamic-number.js"></script> 
	  <script src="<?php echo base_url() ?>assets/angular/angular-scroll.js"></script>
 <script src="<?php echo base_url() ?>assets/custom/js/table_top.js"></script>
    <script data-require="angular-bootstrap@0.12.0" data-semver="0.12.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.min.js"></script>
 <style>
 body {
    padding-top:50px;
}
table.floatThead-table {
    border-top: none;
    border-bottom: none;
    background-color: #fff;
}
			.tes {
				backgrond-color:#25A8E0;
				width: 350px;
				padding: 10px;	
			}
			.panel-primary {
			border-color: #337ab7;
			}
			
			.panel-primary>.panel-heading{
			color:#fff;background-color:#337ab7;border-color:#337ab7;
			height:75px;
			}
			.panel-heading{
				padding:20px 15px;
			}
			
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
			.btn-detail {
				color: #fff;
				background-color: #1E60F0;
				border-color: #1E60F0;
			}
			.btn-detail:hover {
				color: #fff;
				background-color: #487CED;
				border-color: #487CED;
			}

</style>
<script>

$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
		// $("#cek").fadeIn("slow");
        scrollTop: $('#cek').offset().top
    }, 1000);
});



$(document).ready(function () {

    $(".sticky-header").floatThead({
        scrollingTop: 50
    });

});
</script>
 
 <script>

$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
		// $("#cek").fadeIn("slow");
        scrollTop: $('#cek').offset().top
    }, 1000);
});
</script>

<div class="konten">
<div class="content-section-b">

        <div class="container panel panel-default" >

            <div class="row" style="margin-top:50px;">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
				


				
				<?php $random=$this->model_credit->random_generator(10);
				?>
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Bandingkan dan Tentukan Kredit Pemilikan Rumah Terbaik Anda!  </h2>
                    <p class="lead">
                 Tabel dibawah adalah daftar Produk Kredit Pemilikan Rumah yang ditawarkan berbagai bank di Indonesia. AturDuit menyediakan informasi terkini tentang KPR rumah termurah. Pastikan Anda menggunakan simulasi KPR dibawah dan dapatkan bunga KPR terendah untuk rumah idaman Anda. Ketika Anda telah menentukan pilihan terbaik Anda, cukup Click "Apply" untuk meneruskan aplikasi melalui sistem Kami ke website bank pilihan Anda
                    </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6 hidden-xs" >
                    <img class="img-responsive home-image" src="<?php echo base_url(); ?>uploads/kpr.jpg" alt="">
                </div>
            </div>
			<br>
				<div id="cek">
		
				</div>
			
				<ul class="nav nav-tabs hidden-xs">
				<li class="active"><a data-toggle="tab" href="#bandingkan">Bandingkan Kredit Termurah Untuk Anda</a></li>
				<li><a data-toggle="tab" href="#faq">FAQ</a></li>
				<li><a data-toggle="tab" href="#tanya">Tanya Kami</a></li>
			    </ul>
			    <div class="tab-content">
				<div id="bandingkan" class="tab-pane fade in active">
				<div ng-app="myApp" ng-controller="customersCtrl" ng-init="code_loan=<?php echo $random; ?>;quantity=1;cost=5;value_total=50000000" autoscroll="false">	
			<div class="row">
					<div class="col-md-4  col-md-push-9" style=" margin-top: 50px; margin-bottom: 25px;  padding:0px 0px 0px 0px;">
						<div class="panel panel-primary">
						<div class="panel-heading">
						<center><h4><b><strong>Tentukan Pinjaman KPR ideal anda </strong></b></h5></center>
						</div>
						<div class="panel-body">
						<div class="form-group">
							<label>1. Jumlah Pinjaman    </label>
							<div class="input-group">
							<div class="input-group-addon">Rp</div>
							<!--  <input  type="text" ng-model="total_pinjaman" field="currencyVal"  currency-input size="15" maxlength="10" value="{{ value_total }}" class="form-control"> -->
							 <input type="text" class="form-control group-input" ng-model="total_pinjaman" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>
						<!-- <input type="text" ng-model="total_pinjaman" class="form-control InsuredPrice"   placeholder="Harga Mobil" value="{{ value_total }}"> -->
							  <div class="input-group-addon">,00</div>
							</div>
						  </div>
						<div class="form-group">
							<label>2. Jangka Waktu Pinjaman</label>
							  <div class="input-group">
							  <select class="form-control group-input" ng-model="selected"  ng-options="opt as opt for opt in months" ng-init="selected='<?php echo $tenor ?>'" ng-change="change(selected)"></select>
							  <div class="input-group-addon">Tahun</div>
							  </div>
						</div>
						<label for="exampleInputPassword1">3. Masa Pelunasan dengan Penalti</label><br>
						<div class="btn-group">
							<a class="btn btn-primary" ng-click="condition('0')" href="javascript:void(0)" ng-click="button = 'red'" ng-class="{ 'active' : button == 'red' }" class="btn">Semua</a>
							<a class="btn btn-primary"  ng-click="condition('1')" href="javascript:void(0)" ng-click="button = 'blue'" ng-class="{ 'active' : button == 'blue' }" class="btn">Ya</a>
							<a class="btn btn-primary"  ng-click="condition('2')" href="javascript:void(0)" ng-click="button = 'green'" ng-class="{ 'active' : button == 'green' }" class="btn">Tidak</a>
						</div>
						
						<br><br>
						<button type="submit" ng-click="scrollTo(1)" name="submit" class="btn btn-cek center-block longer">Cek</button>
						</div>
						</div>
						
						
	   
				</div>
				<div id="cek2">
		
				</div>	
				
				<div class="col-md-8 col-md-pull-4 hidden-sm hidden-xs" style=" margin-top: 50px; box-shadow: 0 0 10px black; padding:0 0px 0 0px;">
					<style>
					table {
						border-collapse: collapse;
						border: 1px solid black;
						 border-style: solid;
						border-color: #25A8E0;
					}
					</style>			     
					  <table class="table table-hover table-responsive hidden-sm hidden-xs  table-striped sticky-header"  id="example">
						<thead>
						  <tr align="center">
							<th style="width:15%;height:20%;"><center><b><font color="#000">Produk </font></b></center></th>
							<th style="width:15%;height:20%;">
							<a href="#" ng-click="sortType = 'interest_rate'; sortReverse = !sortReverse">
							 <i class="glyphicon glyphicon-so"></i>
							<center><b><font color="#000"><p>Suku Bunga</p>(% per-tahun)</font></b></center>
							  <i class="glyphicon glyphicon-sort"></i>
							</th>
							<th style="width:15%;height:20%;">
							
							<center><b><font color="#000">Cicilan Perbulan</font></b></center>
							
							</th>
							<th style="width:15%;height:20%;">
							<a href="#" ng-click="sortType = 'plafon_loan'; sortReverse = !sortReverse">
							 <i class="glyphicon glyphicon-so"></i>
							<center><b><font color="#000">Plafon Pinjaman</font></b></center>
							 <i class="glyphicon glyphicon-sort"></i>
							</th>
							<th style="width:15%;height:20%;">
							<a href="#" ng-click="sortType = 'periode_pinalty'; sortReverse = !sortReverse">
							 <i class="glyphicon glyphicon-so"></i>
							<center><b><font color="#000">Masa pelunasan dengan pinalti </font></b></center>
							 <i class="glyphicon glyphicon-sort"></i>
							</th>
							<th class="th-6" style="width:5%;height:20%; cursor:pointer;">
							
							</th>
							 <th style="width:15%;height:20%;"><center><b><font color="#000">Apply</font></th>
						  </tr>
						</thead>
						<tbody ng-hide="loading">
						<tr ><td colspan="6"><center> <img  src="<?php echo base_url() ?>assets/img/loader.gif"></img></center></td></tr>
						</tbody>
						<tbody ng-hide="IsHidden">
						  <tr ng-repeat-start="x in names | orderBy:sortType:sortReverse | filter:searchFish">
							<th><img src="<?php echo base_url();?>assets/img/{{ x.company_image }}" width="90px" height="35px" ><center><b><p>{{ x.company_product_name }}</p></b></center>
							</th> 
							<th align="justify"><h3><font color="3E70C6">{{ x.interest_rate }}%</font></h3><br></p></th> 
						<td>{{ (((total_pinjaman-(x.down_payment / 100 * total_pinjaman)) + (3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman)))/ 36) | currency:"Rp ":0 }}</td> 
						<td><h4><center><b><font color="3E70C6">{{ x.plafon_loan }} %</font></b></center></h4></td> 
						<td><h4><center><b>
						<span ng-if="x.periode_pinalty === 0">
							<span class="label label-warning">Tidak Ada</span>
							</span>
							<span ng-if="x.periode_pinalty >= 1">
							<span class="label label-info">{{ x.periode_pinalty  }} Tahun</span>
							</span>
						</b></center></h4><br>
						</td> 
						<td>
							<div class="checkbox">
								<label><input type="checkbox" value=""  ng-click="addItem(x.company_product_id,x.company_product_name,x.company_image,$index)"
								
								ng-model="checkedStatus[$index]"
								></label>
							</div>
							
						</td>
						<td>
						
						<span title="Details" ng-click="toggleModal(x.company_product_id)" data-href="http://google.com" class="btn btn-cek button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE;">Apply</span>
						<br> <br>
						<span title="Details" ng-click="isCollapsed = !isCollapsed" data-href="http://google.com" class="btn btn-detail button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE; ">Detail</span>
						  </td>
						  </tr>
						  <tr collapse="isCollapsed" ng-repeat-end="">
							<td colspan="6">
							 <div class="row">
							    <div class="col-md-6" style="padding-left:30px">
								<i class="fa fa-check" style="font-size:20px;color:#93E3EE;"></i>Persyaratan
								 <br>
								 <br>
								 <table class="hover responsive" style="border:none;">
								 <tr><td>Status Kewarganegaraan</td><td> WNI <br></td></tr>
								 <tr><td>Minimal Umur</td><td> 20 Tahun</td></tr>
								 <tr><td>Apakah Dibutuhkan KTP/ID? </td><td> Diperlukan</td></tr>
								 <tr><td>Jenis Jaminan</td><td> Deposito</td></tr>
								 <tr><td>Jenis Pekerjaan </td><td> Apapun</td></tr>
								 </table>
								</div>
								 <div class="col-md-6" style="padding-left:30px">
								 <i class="fa fa-check" style="font-size:20px;color:#93E3EE;"></i>Ringkasan Pembayaran
								 <br>
								 <br>
								 <table class="hover responsive" style="border:none;">
								 <tr><td>Jumlah Pinjaman</td><td> {{ total_pinjaman | currency:"Rp ":0  }} <br></td></tr>
								 <tr><td>Cicilan Tiap Bulan</td><td> {{ (((total_pinjaman-(x.down_payment / 100 * total_pinjaman)) + (3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman)))/ 36) | currency:"Rp ":0 }}</td></tr>
								 <tr><td>Suku Bunga </td><td> {{ x.interest_rate }}%</td></tr>
								 <tr><td>Tenor Pinjaman</td><td> {{ selected }}</td></tr>
								 <tr><td>Jumlah bunga yang dibayarkan  </td><td> {{ ((3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman))) | currency:"Rp ":0 }}</td></tr>
								 </table>
								</div>
							 
							 </div>
							</td>
						  </tr>
						</tbody>
					  </table>
					  <!--
					  <table class="table table-hover table-responsive hidden-sm hidden-xs"  id="example">
						<thead>
						  <tr align="center">
							<th style="width:15%;height:20%;"><center><b><font color="#000">Modal Usaha </font></b></center></th>
							<th style="width:15%;height:20%;">
							<a href="#" ng-click="sortType = 'interest_rate'; sortReverse = !sortReverse">
							<center><b><font color="#000">Suku Bunga</font></b></center>
							</th>
							<th style="width:15%;height:20%;">
							<a href="#" ng-click="sortType = 'interest_rate'; sortReverse = !sortReverse">
							<center><b><font color="#000">Pinjaman</font></b></center>
							 <span ng-show="sortType == 'interest_rate' && !sortReverse" class="fa fa-caret-down"></span>
							 <span ng-show="sortType == 'interest_rate' && sortReverse" class="fa fa-caret-up"></span>
							</th>
							<th style="width:15%;height:20%;">
							<a href="#" ng-click="sortType = 'down_payment'; sortReverse = !sortReverse">
							<center><b><font color="#000">Cicilan Perbulan</font></b></center>
							 <span ng-show="sortType == 'down_payment' && !sortReverse" class="fa fa-caret-down"></span>
							 <span ng-show="sortType == 'down_payment' && sortReverse" class="fa fa-caret-up"></span>
							</th>
							
							<th style="width:15%;height:20%;"><center><b><font color="#000">Total Jumlah Bunga Dibayarkan </font></b></center></th>
							 <th style="width:15%;height:20%;"><center><b><font color="#000">Ajukan</font></th>
						  </tr>
						</thead>
						<tbody ng-hide="loading">
						<tr ><td colspan="6"><center> <img  src="<?php echo base_url() ?>assets/img/loader.gif"></img></center></td></tr>
						</tbody>
						<tbody ng-hide="IsHidden">
						  <tr >
							<th><img src="<?php echo base_url();?>assets/img/logo-rajakredit.png" width="90px" height="35px" ><p>{{ x.company_product_name }}</p>
							
							
						
							</th> 
							<th align="justify"><h5><font color="3E70C6">15 - 20%</font></h5><h3><font color="3E70C6">Per-tahun</font></h3><br></p></th> 
						<td align="justify">{{ total_pinjaman | currency:"Rp ":0 }}</td> 
						<td>{{(((total_pinjaman/100)*percent)/bulan)+(total_pinjaman/bulan) | currency:"Rp ":0}} sampai {{(((total_pinjaman/100)*percentnew)/bulan)+(total_pinjaman/bulan) | currency:"Rp.":0}}</td> 
						<td>
						{{(((((total_pinjaman/100)*percent)/bulan)+(total_pinjaman/bulan))*bulan)-total_pinjaman | currency:"Rp ":0}} sampai {{(((((total_pinjaman/100)*percentnew)/bulan)+(total_pinjaman/bulan))*bulan)-total_pinjaman | currency:"Rp ":0}}
						</td> 
							
						<td>
						
						<a ng-href="<?php echo base_url(); ?>pilihan/?pinjaman={{total_pinjaman}}"<span title="Details"  class="btn btn-cek button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE;">Ajukan</span></a>
						 <br> <br>
						<span data-toggle="collapse" data-target="#demo1" class="btn btn-detail button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE; ">Detail</span>
						</td>
						</tr>
						    <tr>
							<td colspan="6" class="hiddenRow"><div class="accordian-body collapse" id="demo1"> 
							 <div class="row">
							    <div class="col-md-6" style="padding-left:30px">
								<i class="fa fa-check" style="font-size:20px;color:#93E3EE;"></i>Persyaratan
								 <br>
								 <br>
								 <table class="hover responsive" style="border:none;">
								 <tr><td>Status Kewarganegaraan</td><td> WNI <br></td></tr>
								 <tr><td>Minimal Umur</td><td> 20 Tahun</td></tr>
								 <tr><td>Apakah Dibutuhkan KTP/ID? </td><td> Diperlukan</td></tr>
								 <tr><td>Jenis Jaminan</td><td> Tanpa Anggunan</td></tr>
								 <tr><td>Jenis Pekerjaan </td><td> Apapun</td></tr>
								 </table>
								</div>
								 <div class="col-md-6" style="padding-left:30px">
								 <i class="fa fa-check" style="font-size:20px;color:#93E3EE;"></i>Ringkasan Pembayaran
								 <br>
								 <br>
								 <table class="hover responsive" style="border:none;">
								 <tr><td>Jumlah Pinjaman</td><td> {{ total_pinjaman | currency:"Rp ":0  }} <br></td></tr>
								 <tr><td>Cicilan Tiap Bulan</td><td> {{(((total_pinjaman/100)*percent)/bulan)+(total_pinjaman/bulan) | currency:"Rp ":0}} sampai {{(((total_pinjaman/100)*percentnew)/bulan)+(total_pinjaman/bulan) | currency:"Rp.":0}}</td></tr>
								 <tr><td>Suku Bunga </td><td> 15 - 20%</td></tr>
								 <tr><td>Tenor Pinjaman</td><td> 1 Tahun</td></tr>
								 <tr><td>Jumlah Bunga yang dibayarkan </td><td> {{(((((total_pinjaman/100)*percent)/bulan)+(total_pinjaman/bulan))*bulan)-total_pinjaman | currency:"Rp ":0}} sampai {{(((((total_pinjaman/100)*percentnew)/bulan)+(total_pinjaman/bulan))*bulan)-total_pinjaman | currency:"Rp ":0}}</td></tr>
								 </table>
								</div>
							 
							 </div>
							 </div>
							</td>
						  </tr>
						</tbody>
						
					  </table>
					 -->
				</div>
				
				
			</div>
				
				<!-- Mobile Version -->
				 <div ng-repeat="x in names" class="row hidden-lg hidden-md ">
					<div class="col-md-8 col-md-pull-4" style=" margin-top: 10px; box-shadow: 0 0 2px black; padding:0 0px 0 0px;">
					<table class="table table-bordered" width="100%"  style="border-collapse: collapse;
						border: 0px solid black;
						 border-style: solid;
						border-color: #000;">
					<tr>
					<td colspan="2">
					<img src="<?php echo base_url();?>assets/img/{{ x.company_image }}" class="img-responsive" width="40px" height="20px" ><p>{{ x.company_product_name }}
					<span ng-if="x.company_product_condition === '1'">
					<span class="label label-warning">Baru</span>
					</span>
					<span ng-if="x.company_product_condition !== '1'">
					<span class="label label-info">Bekas</span>
					</span></p>
					</td>
					<td rowspan="2">
					<span title="Details"  ng-click="toggleModal()" data-href="http://google.com" class="btn btn-default button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE;">Apply</span>
					</td>
					</tr>
					<tr><td><p>Suku Bunga</p><p><font color="3E70C6">{{ x.interest_rate }}%</font></p></td><td><p>Cicilan Perbulan</p><p>{{ (((total_pinjaman-(x.down_payment / 100 * total_pinjaman)) + (3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman)))/ 36) | currency:"Rp ":0 }}</p></td></tr>
					</table>
					<table class="table table-condensed" width="100%">
					<tr class="active"><td>Uang Muka</td><td><b>{{ x.down_payment / 100 * total_pinjaman | currency:"Rp ":0 }}</b></td></tr>
					<tr class="active"><td>Total Jumlah Bunga Dibayarkan</td><td>{{ ((3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman))) | currency:"Rp ":0 }}</td></tr>
					</table>
					</div>
				  </div> 
				 <!-- MODAL -->
				 <div class="container">
				  <modal title="Dapatkan Produk Keuangan Terbaik untuk Anda" visible="showModal">
				  
					<form role="form" name="userForm" ng-submit="submitForm()">
					
						<div class="row">
						 <div class="col-md-2">
						 </div>
						  <div class="col-md-8">
						  
						  <div class="form-group">
						   <h5 align="center">  <label for="email">Apakah anda menginginkan produk ini?</label></h5>
							<input type="hidden" class="form-control input-lg" id="email"  placeholder="Enter email" />
					 <input type="text" class="form-control group-input" name="loan" ng-model="order.loan" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>		
						
							<input type="hidden" class="form-control" name="codeloan" ng-model="order.codeloan"  />
							<input type="hidden" class="form-control" name="company_product_id" ng-model="order.company_product_id" />
							
							
							
							 <div ng-repeat="x in name" class="row">
							<div style=" margin-top: 10px; box-shadow: 0 0 2px black; padding:0 0px 0 0px;">
							<table class="table table-bordered" width="100%"  style="border-collapse: collapse;
								border: 0px solid black;
								 border-style: solid;
								border-color: #000;">
							<tr>
							<td colspan="2">
							<center><img src="<?php echo base_url();?>assets/img/{{ x.company_image }}" class="img-responsive" width="40px" height="20px" ><p>{{ x.company_product_name }}</p></center>
							</td>
							
							</tr>
							<tr><td><p>Suku Bunga</p><p><font color="3E70C6">{{ x.interest_rate }}%</font></p></td><td><p>Cicilan Perbulan</p><p>{{ (((order.loan-(x.down_payment / 100 * order.loan)) + (3 * x.interest_rate / 100) *  (order.loan-(x.down_payment / 100 * order.loan)))/ 36) | currency:"Rp ":0 }}</p></td></tr>
							</table>
							<table class="table table-condensed" width="100%">
							<tr class="active"><td>Plafon Peminjaman</td><td><b>{{ x.plafon_loan }} %</b></td></tr>
							<tr class="active"><td>Masa pelunasan dengan pinalti</td><td>{{ x.periode_pinalty }} Tahun</td></tr>
							</table>
							
							</div>
						  </div> 
						  </div>
						  </div>
						  <div class="col-md-2">
						 </div>
						</div>
					 <h2 align="center"> <button type="submit"  class="btn btn-cek">Kirim dan Lanjutkan</button></h2>
					</form>
				  </modal>
				</div>
				<!-- BATAS MODALL -->
					 <!-- MODAL -->
				<div class="container">
				  <modal title="Sumit pengajuan anda" visible="Modalregister">
				  
					<form role="form" name="userForm" ng-submit="submitRegister()">
					
						<div class="row">
						 <div class="col-md-2">
						 </div>
						  <div class="col-md-8">
						  
						  <div class="form-group">
						  
							<input type="hidden" class="form-control input-lg" id="email"  placeholder="Enter email" />
							 <input type="hidden" class="form-control group-input" name="loan" ng-model="reg.loan" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>		
									
								<div class="form-group">
									  <label for="usr">Nama Lengkap</label>
									  <input type="text" ng-model="reg.nama" class="form-control" id="nama" placeholder='Nama lengkap anda'>
								</div>
								<div class="form-group">
								  <label for="pwd">Nomor telepon</label>
								  <input type="text" ng-model="reg.telp" class="form-control" id="telp" placeholder='Nomor Telpon'>
								</div>
								<div class="form-group">
								  <label for="pwd">Email</label>
								  <input type="email" ng-model="reg.email" class="form-control" id="email" placeholder='Email anda'>
								</div>
								<div class="form-group">
								  <label for="pwd">Penghasilan per-bulan:</label>
									
								<div class="input-group">
								<div class="input-group-addon">Rp</div>
									<input type="text" class="form-control group-input" ng-model="reg.income" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Penghasilan perbulan'>
								  <div class="input-group-addon">,00</div>
								</div>
								 
								 </div>
								
							
							
							<input type="hidden" class="form-control" name="codeloan" ng-model="order.codeloan"  />
							<input type="hidden" class="form-control" name="company_product_id" ng-model="order.company_product_id" />
						
						  </div>
						  </div>
						  <div class="col-md-2">
						 </div>
						</div>
					 <h2 align="center"> <button type="submit"  class="btn btn-cek">Ajukan Sekarang</button></h2>
					</form>
				  </modal>
				</div>
				<!-- BATAS MODALL -->
				
				<div class="container">
				  <modal title="Pengajuan anda kami terima" visible="Modalthanks">
				  
					<form role="form" name="tohome" ng-submit="submitThanks()">
					
						<div class="row">
						 <div class="col-md-2">
						 </div>
						  <div class="col-md-8">
						  
						<h2 align="center"> Silahkan cek email anda </h2>
						  </div>
						  <div class="col-md-2">
						 </div>
						</div>
					<h2 align="center"> <button type="submit"  class="btn btn-cek">Tutup</button></h2>
					</form>
				  </modal>
				</div>
				
				<!-- BATAS MODALL -->
<style>
.ajukan {
    position: fixed;
    bottom: 0;
    right: 542px;
    width: 700px;
	height: 100px;
	border: 3px solid #E4ECF1;
	background-color:#BFC8CE;
	z-index:3000;
}
</style>			
<div class="ajukan" ng-hide="ajukan">
<button type="button" ng-click="close_multiple()" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<button ng-click="close_multiple()" style="float:right;position:absolute;margin-left:630px"><i class="fa fa-times"></i> Batal</button>

<div class="row" style="margin-top:10px;">
		<div class="col-md-5">
		
			<table style="border: 0px solid black !important;">
			<tr>
			<td data-ng-repeat="item in items " style="width:120px;height:0%; padding-left:25px">
			<img src="<?php echo base_url();?>assets/img/{{ item.company_image }}" width="70px" height="70px" ><button style="position:absolute" type="button" data-ng-click="remove(item.index,$index)" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</td>
			</tr>
			</table>
		</div>
		<div class="col-md-7" style="margin:0px !important">
		<span title="Details" ng-click="showregisterModal()" ng-href="http://google.com" class="btn btn-cek button tbl custombtncom" style="width: 80%; margin-top: 20px;margin-left:50px; backgrond-color=93E3EE;">Ajukan</span>
		</div>
</div>
<!--
 <div  data-ng-repeat="item in items ">
 {{item.nama_produk}}
 </div>
 -->
</div>				

				</div>
					
				</div>
				
				<div id="faq" class="tab-pane fade">
				  <h3> Pengertian Kredit Mobil</h3>

				Kredit mobil merupakan salah satu fasilitas kredit yang diberikan bank/perusahaan kredit kepada pihak peminjam/nasabah untuk pembelian mobil. Jangka waktu kredit mobil pada umunya hampir sama dengan kredit tanpa agunan, yakni berkisar antara 1 hingga 5 tahun. Akan tetapi ada beberapa perusahaan yang dapat memberikan kredit hingga 7 tahun dengan paket atau persyaratan tertentu saja. Setiap kredit mobil dapat membiayai mobil idaman Anda hingga 70% atau 80% dari harga mobil tersebut, hal ini tergantung dari pihak penyedia pinjaman/bank dan ketentuan masing-masing.

				 <h3>Bagaimana Sistem Kerja Kredit Mobil? </h3>

				Sama halnya dengan jenis pinjaman lain, kredit mobil mengharuskan Anda untuk melakukan angsuran tiap bulannya berdasarkan dari jumlah pinjaman yang diambil dan suku bunga yang dikenakan selama jangka waktu tertentu. Saat setelah Anda menandatangi kontrak perjanjian kredit mobil, Anda diharuskan membayar biaya awal yang terdiri dari jumlah uang muka mobil Anda ditambahkan dengan biaya administrasi, premi asuransi 1 tahun, dan juga cicilan untuk bulan pertama pada kredit mobil. Asuransi mobil yang diberikan dari pihak penyedia kredit akan bervariasi antara TLO, all risk/komprehensif atau gabungan TLO dan all risk.

				 <h3>Uang Muka dan Asuransi Mobil </h3>

				Uang muka atau down payment merupakan persentase dari harga mobil yang harus peminjam bayarkan kepada pihak penjual pada awal proses pembelian mobil. Persentase ini berkisar antara 20% hingga 30% dari harga mobil, sehingga jika Anda ingin mendapatkan mobil idaman Anda maka Anda harus setidaknya memiliki sejumlah uang sekitar 30% dari harga kendaraan tersebut.

				Asuransi mobil adalah salah satu persyaratan yang harus Anda ambil ketika melakukan pembelian mobil. Asuransi mobil yang harus Anda bayarkan adalah untuk polis selama satu tahun dan seperti yang dijelaskan diatas Anda dapat memilih asuransi dengan perlindungan TLO, all risk atau gabungan.

				 <h3>Suku Bunga Kredit Mobil </h3>

				Suku bunga kredit mobil akan dikenakan pada pihak peminjam sama dengan suku bunga kredit tanpa agunan yaitu suku bunga flat atau tetap. Yang berarti bunga pada cicilan setiap bulannya dikalkulasikan berdasar dari jumlah pokok pinjaman dikalikan dengan dengan suku bunga per tahun dan dibagi 12 bulan. Jumlah suku bunga ini akan bervariasi dari 5% hingga 14%. Sedangkan jumlah cicilan pokok hutang dihitung dari jumlah pokok pinjaman dibagi dengan durasi pinjaman dalam satuan bulan.

				 <h3>Pelunasan Awal </h3>

				Melakukan pelunasan lebih awal dari jangka waktu yang disediakan akan menyebabkan penalti atau denda kepada pihak peminjam. Seandainya peminjam menyetujui perjanjian pinjaman dengan jangka waktu 5 tahun dan setelah 2 tahun sang peminjam melunasi sisa pokok pinjaman maka pada umumnya dia akan dikenakan denda sejumlah beberapa persen dari sisa hutang pinjaman tersebut. Dan jumlah persentase ini akan bervariasi untuk setiap bank, tergantung dengan regulasi masing-masing bank.

				 <h3>Keterlambatan Pembayaran </h3>

				Denda keterlambatan pembayaran akan dibebankan kepada peminjam apabila sang peminjam membayar cicilan lewat dari tanggal jatuh tempo atau jumlah cicilan yang dibayarkan kurang dari jumlah angsuran yang seharusnya dibayarkan. Jika hal ini terjadi maka denda akan diberikan kepada pihak peminjam yang pada umumnya dikalkulasikan berdasarkan pada persentase denda dikalikan dengan jumlah angsuran dikalikan jumlah hari keterlambatan. Jika terjadi penunggakan pembayaran angsuran maka ketentuan yang berlaku akan tergantung dari pihak penyedia pinjaman itu sendiri.

				 <h3>Kredit Mobil Baru VS Mobil Bekas </h3>

				Ada beberapa hal mendasar yang membedakan antara kredit mobil baru dan kredit mobil bekas diantaranya adalah:

				Harga mobil yang mobil baru dan mobil bekas akan berbeda dan tentunya harga mobil baru akan jauh lebih tinggi daripada mobil bekas. Hal ini menyebabkan sehingga jumlah uang muka yang harus Anda bayarkan pada awal pembayaran akan lebih tinggi untuk mobil baru, begitu juga hal ini akan meningkatkan jumlah angsuran tiap bulannya karena pokok pinjaman yang lebih besar.
				Sedangkan dalam hal suku bunga, untuk mobil baru suku bunganya akan lebih rendah dibandingkan mobil bekas pada umumnya.
				Dalam hal biaya perawatan, mobil baru hampir tidak ada sama sekali akan tetapi biaya perawatan untuk mobil bekas relatif ada.
				Sedangkan dalam perbandingan untuk nilai jual kembali, tentunya mobil baru akan berkurang relatif lebih banyak dari harga beli dibandingkan mobil bekas yang hanya akan mengalami penurunan sedikit. Akan tetapi perlu diingat mobil baru akan memiliki garansi jika mobil tersebut mengalami kecacatan.
				<h3>Gunakanlah Kalkulator Pinjaman Untuk Menentukan Kredit Mobil Yang Terbaik Bagi Anda</h3>

				Seperti halnya pinjaman pribadi dengan agunan lainnya, bahwa terdapat berbagai suku bunga dan ketentuan yang ditawarkan oleh bank. Sehingga untuk mendapatkan penawaran yang terbaik, maka kami menyarankan Anda untuk melakukan perbandingan terlebih dahulu. Ini dapat Anda lakukan dengan mudah melalui Kalkulator AturDuit Online yang terdapat di bagian atas halaman ini.

				Untuk memulai, tentukan jumlah harga mobil yang diinginkan beserta jangka waktu pinjaman di tempat yang telah Kami sediakan dan secara otomatis kalkulator online Kami akan menunjukkan daftar opsi yang sesuai permintaan Anda, dengan susunan suku bunga yang terbaik di paling atas. Untuk melakukan pendaftaran pinjaman pribadi secara online, Anda hanya perlu klik tombol "Aplikasi” untuk ke pihak penyedia atau bank pilihan. Perlu Anda ketahui bahwa jasa aplikasi online Kami adalah GRATIS dan tersedia untuk masyarakat umum.
				</div>
				</div>	 
							 <!--batas tab content -->
						
						
						
					
						<br /><br />
						
		</div>
					<!-- /.container -->

				</div>
				</div>
				<script>
function save(aksi)
    {
		//alert(aksi);
       jQuery('#showModal').modal('hide'); 

    }
</script>
<script>
var app = angular.module('myApp', ["dynamicNumber","ui.bootstrap","duScroll"]);
app.controller('customersCtrl', function($scope, $http, $location, $anchorScroll, $locale, $document,$timeout) {
   $http.get("<?php echo base_url() ?>product_data/?tenor=<?php echo $tenor; ?>&kategory=2")
   .then(function (response) {$scope.names = response.data.records;});
    $scope.total_pinjaman = '<?php echo $pinjaman ?>';
	 $scope.radioModel = 'Middle';
	  $scope.codeloan = '<?php echo $random; ?>';
	  
	   $scope.IsHidden = false;
	    $scope.loading = true;
	  //Scroll to result
	   var section3 = angular.element(document.getElementById('cek'));
		$scope.scrollTo = function(div) {
		$scope.IsHidden = $scope.IsHidden ? false : true;
		$scope.loading = $scope.loading ? false : true;
		$timeout(function () { $scope.IsHidden = false; $scope.loading = true; }, 1000);  
		 $document.scrollToElementAnimated(section3);
		}
		
		 //P2P Calculate
		$scope.bunga=20/100;
		$scope.bulan=12;
		$scope.percent=(15* $scope.bulan)/12;
		$scope.percentnew=(20* $scope.bulan)/12;
	  
		$scope.isCollapsed = true;
	    $scope.dogs = [
        {
            name: "Sparky",
            breed: "Parson Russell Terrier"
        }, {
            name: "Shep",
            breed: "German Shepard"
        }
    ];
	   
	   
	$scope.items =  [];
	$scope.ajukan = true;
	$scope.close_multiple = function(){
	
		$scope.items.length = 0; 
		$scope.ajukan = true;
		$scope.checkedStatus=false;		
	
	}
	$scope.checkedStatus=[];
	
	//Remove item in multiple choice 
	$scope.remove = function(index_checbox,index) { 
	 
	  //remove item in multiple choice
	  $scope.items.splice(index, 1);   
	  
	  //unchecbox
	  $scope.checkedStatus[index_checbox] = false;	
	  
		if (typeof $scope.items[0] == 'undefined') {	
			$scope.ajukan = true;
		}
	  
	}
	
		//Add Ajukan
		$scope.addItem = function(company_product_id,nama_produk,image,indexs){
			
		
				$scope.ajukan = $scope.ajukan ? false : false;

							var index = -1;
							$scope.items.forEach(function(obj, i) {
								if (obj.company_product_id === company_product_id) index = i;
							});
							
							// is currently selected
							if (index > -1) {
								$scope.items.splice(index, 1);
							}
							// is newly selected
							else {
								
								if ($scope.items.length < 3){
								 $scope.items.push({
									company_product_id:company_product_id,	
									nama_produk: nama_produk,
									company_image: image,
									index: indexs,									
								});
								}else{
									alert('maximal tiga produk');
								}
							
							
							}
							
							
							if (typeof $scope.items[0] == 'undefined') {	
							$scope.ajukan = true;
							}
			
				//Set Cookie
			//	$cookieStore.put('items', $scope.items);

		}
	   	//Show modal Register 
		$scope.Modalregister = false;
		$scope.showregisterModal = function(){
		$scope.Modalregister = !$scope.Modalregister;
		$scope.ajukan = true;
		$scope.reg.loan = $scope.total_pinjaman;
		$scope.reg.codeloan=$scope.codeloan;
		};
		//Close modal
		$scope.cancel = function () {
		$scope.ajukan = false;
		};
		
		$scope.reg = {};
		$scope.reg.item=$scope.items;
		$scope.submitRegister = function() {
	
		$scope.ajukan = true;

        $http({
          method  : 'POST',
          url     : '<?php echo base_url(); ?>add_order_multiple',
         data    : $scope.reg, //forms user object
         headers : {'Content-Type': undefined}  
         })
		 .success(function(data) {
            if (data.status) {
              // Showing errors.
			 $scope.Modalregister = false;
            $scope.Modalthanks = !$scope.Modalthanks;
            } else {
             // $scope.message = data.message;
            }
          });
		
        };
		$scope.submitThanks = function() {
	
			 
             window.location = "<?php echo base_url(); ?>";
         
        };
		
	   
		//Show Modal
		$scope.showModal = false;
		$scope.toggleModal = function(id){
        $scope.showModal = !$scope.showModal;
		$scope.order.loan = $scope.total_pinjaman;
		$scope.order.codeloan=$scope.codeloan;
		
		$scope.order.company_product_id = id;
		url="<?php echo base_url() ?>product_data/?company_product_id="+id;
		 $http.get(url)
   .then(function (response) {$scope.name = response.data.records;});
  // $scope.order.order_payment_month = $scope.total_pinjaman * '1000';
   $scope.names1 = name.interest_rate;
    };
	
	 $scope.order = {};
	 $scope.submitForm = function() {
		 //alert('gagal');
		  $scope.showModal = false;
        // Posting data to php file
        $http({
          method  : 'POST',
          url     : '<?php echo base_url(); ?>add_order',
         data    : $scope.order, //forms user object
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         }) 
		 .success(function(data) {
            if (data.status) {
              // Showing errors.
			 
             window.location = "<?php echo base_url(); ?>konfirmasi-refinance/"+$scope.order.codeloan+"/Konfirmasi";
            } else {
             // $scope.message = data.message;
            }
          });
        };
   
	
	$scope.currencyVal;
	 $scope.months = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25'];
	 
	 //	$(".InsuredPrice").length > 0 && $(".InsuredPrice").autoNumeric("init");
	 $scope.cssPre="testing";
	   $scope.$watch('cssPre', function(cssPre) {
       console.log(cssPre);
    });
	
	//  $scope.value= 'foo';
     $scope.active = 'breakfast';
    $scope.setActive = function(type) {
        $scope.active = type;
    };
    $scope.isActive = function(type) {
        return type === $scope.active;
    };
    
	 
	
	$scope.sortType     = ['interest_rate','down_payment']; // set the default sort type
	
  $scope.sortReverse  = false;  // set the default sort order
  $scope.searchFish   = '';     // set the default search/filter term

  $scope.condition = function(kondisi) {
	  //alert(kondisi+' = ' + $scope.selected);
      $http.get("<?php echo base_url() ?>product_data/?pinalty="+kondisi+"&tenor="+$scope.selected+"&kategory=2")
  .then(function (response) {$scope.names = response.data.records;});
    $scope.total_pinjaman;
	$scope.kondisi=kondisi;
	// alert("<?php echo base_url() ?>/product_data/?pinalty="+kondisi+"&tenor="+$scope.selected+"&kategory=2");
    };
	
		$scope.change = function(tahun) {
			var kondisix;
			if($scope.kondisi != null){
				kondisix="&condition="+$scope.kondisi;
			}else{
				kondisix=null;
			}
      $http.get("<?php echo base_url() ?>product_data/?tenor="+tahun+kondisix+"&kategory=2")
   .then(function (response) {$scope.names = response.data.records;});
   // $scope.total_pinjaman = '100000000000';
   
	//alert(kondisix);
    };
	
	
		
});

//app.$inject = ['$scope'];
 

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

app.directive('modal', function () {
    return {
      template: '<div class="modal fade" id="modal-2">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title"><h3 align="center">{{ title }}</h3></h4>' + 
              '</div>' + 
              '<div class="modal-body" ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
        scope.title = attrs.title;

        scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });
        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  });


</script>

 