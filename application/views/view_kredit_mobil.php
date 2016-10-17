<!-- <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>-->

     <script src="<?php echo base_url() ?>assets/angular/angular.min.js"></script>
	<!-- <script src="https://code.angularjs.org/1.2.5/i18n/angular-locale_id-id.js"></script> -->
	<script src="<?php echo base_url() ?>assets/angular/angular-locale_id-id.js"></script>
	  <script src="<?php echo base_url() ?>assets/angular/dynamic-number.js"></script> 
	  <script src="<?php echo base_url() ?>assets/angular/angular-scroll.js"></script>

     <script data-require="angular-bootstrap@0.12.0" data-semver="0.12.0" src="<?php echo base_url() ?>assets/bootstrap/ui-bootstrap-tpls-0.12.0.min.js"></script>
	
 <script src="<?php echo base_url() ?>assets/custom/js/table_top.js"></script> 
 <script src="<?php echo base_url() ?>assets/custom/js/table_head_click.js"></script>


	 
  
 <style>
 a {
    color: #000;
    text-decoration: none;
}
		body { background: #e7ebed; color: #808080; font-family: 'PT Sans', sans-serif; font-size: 14px; font-style: normal; font-weight: normal; margin: 0; position: relative;}
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
			@media (min-width: 992px)
.col-md-4 {
    width: 32%;
}
#sticky {
  
}

.th-1:hover {
    background: red;
}

		</style>
 <script>




$(document).ready(function () {
	

    $(".sticky-header").floatThead({
        scrollingTop: 71
    });
	
	
	 $(".company_filter").click(function(){
		// alert('tes');
        $(".company").toggle();
	
    });
	
	 $(".dp_filter").click(function(){
		// alert('tes');
        $(".dp").toggle();
	
    });
	
	
	/* filter mouseleave
	$(".company").mouseenter(function(){
         $(".company").css("display", "block");
		 
		  $(" .company").mouseleave(function(){
			$(".company").toggle();
			});
	
   });
	*/
	//Hide filter company after cllick outside element
	   $(document).mouseup(function (e)
		{
			var container = $(".company ");

			if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				container.hide();
			}
			
			
			var containerdp = $(".dp");
			var containerfil = $(".dp_filter");

			if (!containerdp.is(e.target) // if the target of the click isn't the container...
				&& containerdp.has(e.target).length === 0 || containerdp == containerfil   ) // ... nor a descendant of the container
			{
				containerdp.hide();
			}
			
		});

});
</script>

<div class="konten">
	<div class="content-section-b">
		<div class="container panel panel-default"  >
            <div class="row">
                <div class="col-lg-12 hidden-xs">
				<?php $random=$this->model_credit->random_generator(10);
				?>
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Bandingkan Kredit Mobil Baru dan Bekas Termurah  </h2>
			
                    <p class="lead">
                   Untuk kemudahan Anda, kami membantu Anda dengan menyediakan informasi ciri khas dari setiap kredit mobil di Indonesia, baik dari kredit mobil baru ataupun kredit mobil bekas yang termurah. Gunakan kalkulator simulasi kredit mobil kami untuk perbandingan cicilan dan bunga masing-masing produk. Ketika Anda telah menentukan pilihan kredit mobil termurah, terbaik dan terpercaya Anda, cukup Click "Ajukan" untuk meneruskan aplikasi ke pihak terkait.
                    </p>
                </div>
              
            </div>
			<br>
			
				<ul class="nav nav-tabs hidden-xs">
				<li class="active"><a data-toggle="tab" href="#bandingkan"><i class="fa fa-calculator" aria-hidden="true"></i> Bandingkan Kredit Termurah Untuk Anda</a></li>
				<li><a data-toggle="tab" href="#faq"<i class="fa fa-comment-o" aria-hidden="true"></i> FAQ</a></li>
				<li><a data-toggle="tab" href="#tanya"><i class="fa fa-question-circle" aria-hidden="true"></i> Tanya Kami</a></li>
			    </ul>
			    <div class="tab-content">
				<div id="bandingkan" class="tab-pane fade in active">
				<div ng-app="myApp" ng-controller="customersCtrl" ng-init="code_loan=<?php echo $random; ?>;quantity=1;cost=5;value_total=50000000" autoscroll="false">
				
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


				<br>
				<!-- FILTER SEARCH
				<div class="row">
				<div class="col-lg-5 hidden-xs"  >
				<form>
				<div class="form-group">
				  <div class="input-group">
					<div class="input-group-addon"><i class="fa fa-search"></i></div>
					<input type="text" class="form-control group-input" placeholder="Nama Bank" ng-model="searchFish">
				  </div>      
				</div>
				
			   </form>
			   </div>
				</div>
				-->
			<div class="row">
				<div class="col-lg-4 ">	
				  <div class="panel panel-default">
				  <div class="panel-body">
				  
					<div class="form-group">
							<label>1. Jumlah Pinjaman    </label>
							<div class="input-group">
							<div class="input-group-addon">Rp</div>
								<input type="text" class="form-control group-input" ng-model="total_pinjaman" ng-trim=false ng-model="value7" class="form-control" awnum num-sep="," num-int=10 num-fract=2 num-thousand='true' placeholder='Jumlah pinjaman'>
							  <div class="input-group-addon">,00</div>
							</div>
					</div>
				   </div>
				  </div>
				</div>
				<div class="col-lg-4 ">
					<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<label>2. Jangka Waktu Pinjaman</label>
							  <div class="input-group">
							  <select class="form-control group-input" ng-model="selected"  ng-options="opt as opt for opt in months" ng-init="selected='<?php echo $tenor; ?>'" ng-change="change(selected)"></select>
							  <div class="input-group-addon">Tahun</div>
							  </div>
						</div>
						
					</div>
					</div>
				</div>
				<div class="col-lg-4 ">
					<div class="panel panel-default">
					<div class="panel-body">
						<label for="exampleInputPassword1">3. Jenis Kredit Mobil</label><br>
						<!--
						<div class="btn-group">
							<a class="btn btn-primary" ng-click="condition('3')" href="javascript:void(0)" ng-click="button = 'red'" ng-class="{ 'active' : button == 'red' }" class="btn">Semua</a>
							<a class="btn btn-primary"  ng-click="condition('1')" href="javascript:void(0)" ng-click="button = 'blue'" ng-class="{ 'active' : button == 'blue' }" class="btn">Baru</a>
							<a class="btn btn-primary"  ng-click="condition('2')" href="javascript:void(0)" ng-click="button = 'green'" ng-class="{ 'active' : button == 'green' }" class="btn">Bekas</a>
						</div>
						-->
						
						<form role="form" style="padding-top:17px">
							<label class="radio-inline">
							<input type="radio" checked ng-click="condition('3')" name="optradio">Semua
							</label>
							<label class="radio-inline">
							<input type="radio" ng-click="condition('1')" name="optradio">Baru
							</label>
							<label class="radio-inline">
							<input type="radio" ng-click="condition('2')" name="optradio">Bekas
							</label>
						</form>
						<br>
						
						
					</div>
					</div>
				</div>	
			</div>
				<br><br>
				<button type="submit" ng-click="scrollTo(1)" name="submit" class="btn btn-cek center-block longer"><i class="fa fa-refresh" aria-hidden="true"></i> Cek Pinjaman</button>
				<div id="cek">
				</div>	
				<div id="cek2">
				</div>	
			<div class="row">
				<div class="col-md-5  hidden-sm hidden-xs">
					
				</div>
				<div class="col-md-6  hidden-sm hidden-xs" style="align:right;">
					
				</div>
			</div>
			
			
				<div class="col-md-12  hidden-sm hidden-xs" style=" margin-top: 50px; box-shadow: 0 0 0px black; padding:0 0px 0 0px;">
				
				
					<style>
					table {
						border-collapse: collapse;
						border: 1px solid black;
						 border-style: solid;
						border-color: #25A8E0;
					}
					</style>
					<!--
					<ul ng-repeat="card in names | orderBy:firstpayment_filter">
					<li> {{value3(card)}}</li>
					</ul>
					-->
					
						<label align="left" class="company_filter">Perusahaan <span class="glyphicon glyphicon-chevron-down"></span></label>
			
							<div class="company" style="position:absolute;z-index:1000; display:none;">
								<div class="panel panel-default">
									<div ng-repeat="company in getCompany()">
										<div align="left">
										<div class="checkbox">
										<label><input type="checkbox" ng-model="filter[company]"  /> {{company}} </label>
										</div>
										</div>
									</div>
								</div>
							</div>
							<label align="left" class="dp_filter">Uang Muka <span class="glyphicon glyphicon-chevron-down"></span></label>
							&nbsp;
							&nbsp;
							<div class="dp" style="position:absolute;z-index:1000; display:none; margin-left:100px">
								<div class="panel panel-default">
									<div ng-repeat="dp in getDP()">
										<div align="left">
										<div class="checkbox">
										<label><input type="checkbox" ng-model="filterdp[dp]"  /> {{dp}} % </label>
										</div>
										</div>
									</div>
								</div>
							</div>
			<h5 align="right">	<label align="right">Menampilkan {{filtered.length}} data Kredit Kendaraan Mobil</label></h5>
				
					<table class="table table-hover table-responsive hidden-sm hidden-xs table-striped sticky-header"  id="example">
						<thead>
						  <tr align="center">
							<th class="th-1" style="width:15%;height:20%; cursor:pointer;">
							<a href="#" ng-click="sortType = 'company_product_name'; sortReverse = !sortReverse">
							 <i class="glyphicon glyphicon-so"></i>
							<center><b><font color="#000">Produk </font></b></center>
							<i class="glyphicon glyphicon-sort"></i>
							</th>
							<th class="th-2"  style="width:15%;height:20%; cursor:pointer;">
							<a href="#" ng-click="sortType = 'interest_rate'; sortReverse = !sortReverse">
							 <i class="glyphicon glyphicon-so"></i>
							<center><b><font color="#000">Suku Bunga</font></b></center>
							 <i class="glyphicon glyphicon-sort"></i>
							</th>
							<th class="th-3" style="width:15%;height:20%; cursor:pointer;">
							<a href="#" ng-click="sortType = 'down_payment'; sortReverse = !sortReverse">
							 <i class="glyphicon glyphicon-so"></i>
							<center><b><font color="#000">Uang Muka</font></b></center>
							 <i class="glyphicon glyphicon-sort"></i>
							</th>
							<th class="th-4" style="width:15%;height:20%; cursor:pointer;">
							<i class="glyphicon glyphicon-so"></i>
							<a href="#" ng-click="sortType = 'cicilanbulan_filter'; sortReverse = !sortReverse">
							<center><b><font color="#000">Cicilan Perbulan</font></b></center>
							<i class="glyphicon glyphicon-sort"></i>
							</th>
							<th class="th-5" style="width:15%;height:20%; cursor:pointer;">
							<i class="glyphicon glyphicon-so"></i>
							<a href="#" ng-click="sortType = 'filter_first_payment'; sortReverse = !sortReverse">
							<center><b><font color="#000">Pembayaran Pertama</font></b></center>
							<i class="glyphicon glyphicon-sort"></i>
							</th>
							<!--
							<th class="th-6" style="width:15%;height:20%; cursor:pointer;">
							<i class="glyphicon glyphicon-so"></i>
							<a href="#" ng-click="sortType = 'filter_sum_bunga'; sortReverse = !sortReverse">
							<center><b><font color="#000">Total Jumlah Bunga Dibayarkan </font></b></center>
							 <i class="glyphicon glyphicon-sort"></i>
							</th>
							-->
							<th class="th-6" style="width:5%;height:20%; cursor:pointer;">
							
							</th>
							 <th style="width:15%;height:20%;"><center><b><font color="#000">Ajukan</font></th>
						  </tr>
						</thead>
						
						<tbody ng-hide="loading">
						<tr ><td colspan="7"><center> <img  src="<?php echo base_url() ?>assets/img/loader.gif"></img></center></td></tr>
						</tbody>
						<tbody ng-hide="IsHidden">
						<style>
						.pending-delete { bgcolor: pink }
						</style>
						<tr  ng-repeat-start="x in filtered = (names | filter:filterByCompany | filter:filterByDP )  |  orderBy:firstpayment_filter | orderBy:sortType:sortReverse | filter:filterByCompany | filter:filterByDP | filter:searchFish " ng-click="showDetail(x.company_product_id)" ng-class-odd="'alt'" ng-class="{'pending-delete': checkedStatus}">
							<th><img src="<?php echo base_url();?>assets/img/{{ x.company_image }}" width="90px" height="35px" ><p>{{ x.company_product_name }}</p>
							 
							<span ng-if="x.company_product_condition === 1">
							<span class="label label-warning">Baru</span>
							</span>
							<span ng-if="x.company_product_condition !== 1">
							<span class="label label-info">Bekas</span>
							</span>
							</th> 
						<th align="justify"><h3><font color="3E70C6">{{ x.interest_rate }}%</font></h3><br></p></th> 
						<td align="justify"><h4><font color="3E70C6">{{ x.down_payment }}%</font></h4><br>
						<b>{{uangmuka(x.down_payment,total_pinjaman) | currency:"Rp. ":0 }}</b>
						</td> 
						<td><br>
						<b>{{cicilanbulan(total_pinjaman,x.down_payment,x.interest_rate,selected) | currency:"Rp. ":0}}</b>
						</td> 
						<td>
						<b>
						{{firstpayment(total_pinjaman,uangmuka(x.down_payment,total_pinjaman),x.asuransi_rate,x.administrasi,cicilanbulan(total_pinjaman,x.down_payment,x.interest_rate,selected)) | currency:"Rp. ":0}}
						</b>
						</td> 
						<!--
						<td><b>{{totalbunga(total_pinjaman,x.down_payment,x.interest_rate)  | currency:"Rp. ":0}}</b>
						</td>
						-->
						<td>
							<div class="checkbox">
								<label><input type="checkbox" value=""  ng-click="addItem(x.company_product_id,x.company_product_name,x.company_image,$index)"
								
								ng-model="checkedStatus[$index]"
								></label>
							</div>
							
						</td>
						<td>
						<span title="Details" ng-click="toggleModal(x.company_product_id)" data-href="http://google.com" class="btn btn-cek button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE;">Ajukan</span>
						<br><br>
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
								 <tr><td>Jumlah Pinjaman</td><td> {{ total_pinjaman | currency:"Rp. ":0  }} <br></td></tr>
								 <tr><td>Cicilan Tiap Bulan</td><td> {{ (((total_pinjaman-(x.down_payment / 100 * total_pinjaman)) + (3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman)))/ 36) | currency:"Rp. ":0 }}</td></tr>
								 <tr><td>Suku Bunga </td><td> {{ x.interest_rate }}%</td></tr>
								 <tr><td>Tenor Pinjaman</td><td> {{ selected }} Tahun</td></tr>
								  <tr><td>Pembayaran Pertama</td><td> {{firstpayment(total_pinjaman,uangmuka(x.down_payment,total_pinjaman),3.85,1700000,cicilanbulan(total_pinjaman,x.down_payment,x.interest_rate,selected)) | currency:"Rp. ":0}}</td></tr>
								 <tr><td>Jumlah Bunga yang dibayarkan </td><td> {{ ((3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman))) | currency:"Rp. ":0 }}</td></tr>
								 </table>
								</div>
							 </div>
							</td>
						  </tr>
						  <!--
						  <tr class="row" ng-repeat-end="" ng-show="active==u.user.username" ng-class-odd="'alt'">
						  
						  <td>1</td><td>1</td><td>1</td><td></td><td></td><td></td>
						  </tr>
						  -->
						</tbody>	
					</table>
				</div>
				<div id="batas-scroll" class="batas-scroll">	</div>
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
					<span title="Details"  ng-click="toggleModal()" data-href="http://google.com" class="btn btn-cek button tbl custombtncom" style="width: 100%; margin-right: 2px; backgrond-color=93E3EE;">Ajukan</span>
					</td>
					</tr>
					<tr><td><p>Suku Bunga</p><p><font color="3E70C6">{{ x.interest_rate }}%</font></p></td><td><p>Cicilan Perbulan</p><p>{{ (((total_pinjaman-(x.down_payment / 100 * total_pinjaman)) + (3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman)))/ 36) | currency:"Rp. ":0 }}</p></td></tr>
					</table>
					<table class="table table-condensed" width="100%">
					<tr class="active"><td>Uang Muka</td><td><b>{{ x.down_payment / 100 * total_pinjaman | currency:"Rp. ":0 }}</b></td></tr>
					<tr class="active"><td>Total Jumlah Bunga Dibayarkan</td><td>{{ ((3 * x.interest_rate / 100) *  (total_pinjaman-(x.down_payment / 100 * total_pinjaman))) | currency:"Rp. ":0 }}</td></tr>
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
							<img src="<?php echo base_url();?>assets/img/{{ x.company_image }}" class="img-responsive" width="40px" height="20px" ><p>{{ x.company_product_name }}
							<span ng-if="x.company_product_condition === '1'">
							<span class="label label-warning">Baru</span>
							</span>
							<span ng-if="x.company_product_condition !== '1'">
							<span class="label label-info">Bekas</span>
							</span></p>
							</td>
							
							</tr>
							<tr><td><p>Suku Bunga</p><p><font color="3E70C6">{{ x.interest_rate }}%</font></p></td><td><p>Cicilan Perbulan</p><p>{{ (((order.loan-(x.down_payment / 100 * order.loan)) + (3 * x.interest_rate / 100) *  (order.loan-(x.down_payment / 100 * order.loan)))/ 36) | currency:"Rp. ":0 }}</p></td></tr>
							</table>
							<table class="table table-condensed" width="100%">
							<tr class="active"><td>Uang Muka</td><td><b>{{ x.down_payment / 100 * order.loan | currency:"Rp. ":0 }}</b></td></tr>
							<tr class="active"><td>Total Jumlah Bunga Dibayarkan</td><td>{{ ((3 * x.interest_rate / 100) *  (order.loan-(x.down_payment / 100 * order.loan))) | currency:"Rp. ":0 }}</td></tr>
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
<div class="ajukan" ng-hide="ajukan">
<button type="button" ng-click="close_multiple()" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

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

var app = angular.module('myApp', ["dynamicNumber","ui.bootstrap","duScroll"]);
app.controller('customersCtrl', function($scope, $http, $location, $anchorScroll, $locale, $document,$timeout) {
   $http.get("<?php echo base_url() ?>product_data/?tenor=3&kategory=1")
   .then(function (response) {$scope.names = response.data.records;});
    $scope.total_pinjaman = <?php echo $pinjaman ?>;
	$scope.radioModel = 'Middle';
	$scope.codeloan = '<?php echo $random; ?>';
	$scope.base_url = '<?php echo base_url(); ?>';
	//alert($scope.names[0].product_id);
	$scope.items =  [];
	$scope.ite =  ['tes','y','z'];
	//alert($scope.ite.indexOf("y"));
	 $scope.providers = [{
        Id: 5
    }, {
        Id: 6
    }, {
        Id: 8
    }, {
        Id: 10
    }];
	//alert($scope.providers.indexOf(6));
	//$scope.itemz =  ite.indexOf("tes");
	
	
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
	
		//Scroll to show result
	var section3 = angular.element(document.getElementById('cek2'));
	$scope.scrollTo = function(div) {
	$scope.IsHidden = $scope.IsHidden ? false : true;
	$scope.loading = $scope.loading ? false : true;
	$timeout(function () { $scope.IsHidden = false; $scope.loading = true; }, 1000);  
	$document.scrollToElementAnimated(section3);	
	}
	
	//Filter by company name
	$scope.filter = {};
	$scope.getCompany = function () {
    return ($scope.names || []).map(function (w) {
    return w.company_name;
    }).filter(function (w, idx, arr) {
    return arr.indexOf(w) === idx;
	});
	};
	
	//Filter by company name
	$scope.filterByCompany = function (wine) {
    return $scope.filter[wine.company_name] || noFilter($scope.filter);
	};
	
	//Filter by DP
	$scope.filterdp = {};
	$scope.getDP = function () {
    return ($scope.names || []).map(function (w) {
    return w.down_payment;
    }).filter(function (w, idx, arr) {
    return arr.indexOf(w) === idx;
	});
	};
	
	//Filter by company name
	$scope.filterByDP = function (wine) {
    return $scope.filterdp[wine.down_payment] || noFilter($scope.filterdp);
	};
	
	
	//If no filter	
	function noFilter(filterObj) {
		for (var key in filterObj) {
				if (filterObj[key]) {
					return false;
				}
			}
			return true;
		}
	  
	$scope.isCollapsed = true;
	$scope.isCollapsed_2 = true;
 
	
    $scope.ShowAjukan = function () {
                //If DIV is hidden it will be visible and vice versa.
                
				 $scope.ajukan = $scope.ajukan ? false : false;
				 //$timeout(function () { $scope.ajukan = true; }, 1000);  
            }
			
	  //ng hide for loading
	$scope.IsHidden = false;
	$scope.loading = true;
    $scope.ShowHide = function () {
                //If DIV is hidden it will be visible and vice versa.
                $scope.IsHidden = $scope.IsHidden ? false : true;
				 $scope.loading = $scope.loading ? false : true;
				 $timeout(function () { $scope.IsHidden = false; $scope.loading = true; }, 1000);  
            }
	  
	  //P2P Calculate
	$scope.bunga=20/100;
	$scope.bulan=12;
	
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
	
	
	//Show Modal for confirmaton  
	$scope.showModal = false;
    $scope.toggleModal = function(id){
    $scope.showModal = !$scope.showModal;
	$scope.order.loan = $scope.total_pinjaman;
	$scope.order.codeloan=$scope.codeloan;
		
	$scope.order.company_product_id = id;
	url="<?php echo base_url() ?>product_data/?company_product_id="+id;
	$http.get(url)
   .then(function (response) {$scope.name = response.data.records;});
  
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
         headers : {'Content-Type': undefined}  
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
		$scope.reg = {};
		$scope.reg.item=$scope.items;
		 $scope.submitRegister = function() {
		 //alert('gagal');
		 // $scope.Modalregister = false;
		  $scope.ajukan = true;
		  //$scope.Modalthanks = !$scope.Modalthanks;
		
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
		
   
	
	$scope.currencyVal;
	$scope.months = ['1','2','3','4','5'];
	 
	
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
    
	 
	//Sorting data 
	$scope.sortType     = ''; // set the default sort type
	$scope.sortReverse  = false;  // set the default sort order
	$scope.searchFish   = '';     // set the default search/filter term
	
	$scope.valuebunga = function(i) {
        return i * 5;
		
    }
	//Calculated Down Payment
	$scope.uangmuka = function(dp,pinjaman) {
        return dp / 100 * pinjaman;
		
    }
	//Calculated payment per-month
	$scope.cicilanbulan = function(pinjaman,dp,interest_rate,selected) {

		var cicil =(((pinjaman-(dp/100*pinjaman)) + (3 * interest_rate/100) * (pinjaman-(dp/100*pinjaman)))/(selected*12));

        return cicil;
    }
	//Calculated sum payment interest rate
	$scope.totalbunga = function(pinjaman,dp,interest_rate) {
      
		return ((3 * interest_rate / 100) *  (pinjaman-(dp / 100 * pinjaman)));
		
    }
	
	//Calculated firstpayment
	$scope.firstpayment = function(pinjaman,dp,ass_rate,administrasi,cicilan) {
      
		return (dp+administrasi+cicilan)+(((pinjaman/100)* ass_rate));
	
		
    }
	
	$scope.myValueFunction = function(card) {
        return card.interest_rate / card.down_payment;
    }
	
	$scope.filtertotal_bunga = function(card) {
		return ((3 * card.interest_rate / 100) *  (100000000-(card.down_payment / 100 * 100000000)));
      
    }
	
	$scope.cicilanbulan_filter = function(card) {

        return (((100000000-(card.down_payment/100*100000000)) + (3 * card.interest_rate/100) * (100000000-(card.down_payment/100*100000000)))/(3*12));
    }
	
	$scope.firstpayment_filter = function(card) {
      
		var cicilan=(((100000000-(card.down_payment/100*100000000)) + (3 * card.interest_rate/100) * (100000000-(card.down_payment/100*100000000)))/(3*12));
		return (card.down_payment+1700000+cicilan)+(((100000/100)* 3.87));
    }
    
  //  $scope.value = function(card) {
     //    return card.interest_rate / card.down_payment;
 //   }
	
	$scope.value2 = function(card) {
		var cicilan=(((100000000-(card.down_payment/100*100000000)) + (3 * card.interest_rate/100) * (100000000-(card.down_payment/100*100000000)))/(3*12));
		return (card.down_payment+1700000+cicilan)+(((100000/100)* 3.87));
       
    }
	
	$scope.value3 = function(card) {

		var cicil =(((100000000-(card.down_payment/100*100000000)) + (3 * card.interest_rate/100) * (100000000-(card.down_payment/100*100000000)))/(3*12));

        return cicil;
    }
	
   
	//IF klik kondition new or second
	$scope.condition = function(kondisi) {
      $http.get("<?php echo base_url() ?>product_data/?condition="+kondisi+"&tenor="+$scope.selected)
   .then(function (response) {$scope.names = response.data.records;});
    $scope.total_pinjaman;
	$scope.kondisi=kondisi;
	//alert( $scope.selected);
    };
	
	//IF klik tenor
	$scope.change = function(tahun) {
			var kondisix;
			if($scope.kondisi != null){
				kondisix="&condition="+$scope.kondisi;
			}else{
				kondisix=null;
			}
    $http.get("<?php echo base_url() ?>product_data/?tenor="+tahun+kondisix)
	.then(function (response) {$scope.names = response.data.records;});
    };
	
	
		
	});



	//Show Modal 
	app.directive('modal', function () {
		return {
		  template: '<div class="modal fade" id="modal-2">' + 
			  '<div class="modal-dialog">' + 
				'<div class="modal-content">' + 
				  '<div class="modal-header">' + 
					'<button type="button" ng-click="cancel()" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
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


			
   


<!-- EDU ELSE IF SAMPLE VARIABEL
 <span class="label label-warning">{{x.company_product_condition === "1" ? "Baru" : "Bekas"}}</span> -->
 
 
 