<!-- b popup -->
<link href="<?php echo base_url(); ?>assets/bpopup/css/style.css" rel="stylesheet" type="text/css">

<!-- range slider -->


<script src="http://www.rajapremi.com/assets/js/autoNumeric.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".InsuredPrice").length > 0 && $(".InsuredPrice").autoNumeric("init");
			});
		</script>

<script type="text/javascript">
  $(document).ready(function() {
	  
    
    	$('.btn-month').on('click', function(){
		    $(".btn-month").removeClass('active');
		    $(this).addClass('active');

		    $("#h_selected_month").val($(this).val());

		    calculate_repayment();
		}); 
		
	$("#tujuan").click(function() {

		    $("#h_selected_tujuan").val($(this).val());
			
			if($(this).val() == 0){
			$("#rumah").hide();
				  $("#mobil").hide();
				   $("#usaha").hide();
			}else if($(this).val() == 1){
				 $("#mobil").fadeIn("slow");
				   $("#usaha").hide();
				     $("#rumah").hide();
				
			}else if($(this).val() == 2){
				 $("#rumah").fadeIn("slow");
				  $("#mobil").hide();
				   $("#usaha").hide();
				
			}else if($(this).val() == 4){
				 $("#usaha").fadeIn("slow");
				   $("#mobil").hide();
				   $("#rumah").hide();
				
			}

		   
		}); 
		
		 $("#siapa").click(function() {

		    $("#h_siapa").val($(this).val());

		   
		}); 
		
		 $("#waktu_mobil").click(function() {

		    $("#h_waktu_mobil").val($(this).val());
//alert($(this).val());
		   
		}); 
		$("#waktu_usaha").click(function() {

		    $("#h_waktu_usaha").val($(this).val());

		   
		}); 
		$("#waktu_rumah").click(function() {

		    $("#h_waktu_rumah").val($(this).val());

		   
		}); 
		

		$("#txt_amount").on('change', function(){
            var lAmount = $("#txt_amount").val().replaceAll(',', '');
			
			alert('lAmount');
		}); 

	});


</script>

<script>

    $(document).ready(function() {
        //trigger the login popup from header page
        $("#lbl-login").click(function(ev) {
            $("a.dropdown-toggle").dropdown("toggle");
            return false;
        });      
    });
</script>
<style>
.mystyle input[type="text"] {
   height: 30px;
   font-size: 10px;
   line-height: 14px;
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

.input-group-addon {
    color: #f4f6f8;
    border-color: #2AA9E0;
    background: #337ab7;
    padding: 5px!important;
}
</style>
	<!-- Header 
    <a name="about"></a>
    -->
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
				<div class="row">
				<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6 hidden-xs" >	
				
				</div>
                
                <div class="col-lg-5 col-sm-pull-6  col-sm-6 col-xs-12" style=" margin-top: 50px; margin-bottom: 25px; padding:10px 10px 10px 10px;">
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
									<input type="text"  id="h_amount" name="h_amount" value="50000000"  data-a-sign="" data-v-min="0" data-v-max="10000000000" data-a-dec="," data-a-sep="." maxlength="20" class="form-control InsuredPrice group-input mystyle" />
									  <div class="input-group-addon">,00</div>
								</div>
						</div>
						
						<br />
						<font color="#000"><h5>Tujuan Peminjaman</h5></font>
						<select name="tujuan" id="tujuan" class="form-control">
						
						<option value="0">Pilih</option>
						<option value="1">Kredit Mobil</option>
						<option value="2">Kredit Pimilikan Rumah</option>
						<!--<option value="3">Kredit Motor</option>-->
						<option value="4">Multiguna</option>
						
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

        </div>
        <!-- /.container -->
    </div>

 
  <?php if(get_cookie('user_group') == "I"){ ?>
  <div class="content-section-a">

          <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Anda ingin melakukan pendanaan?</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-2 col-xs-12 div-center">
                            <h4> 2.5% biaya platform</h4>
                            <span class="text">Kami mengenakan biaya bunga 2.5% dari total biaya bunga.</span>
                            <br /><br />
                        </div>
                        <div class="col-lg-4 col-xs-12 div-center">
                            <h4>Return 12 - 18% per tahun </h4>
                            <span class="text">Kami memberikan return investasi anda sebesar 12 - 18%</span>
                        </span>
                    </div>
                </div>
                <br />
                <div class="col-lg-12 col-sm-12 div-center">
                    <a class="btn btn-info btn-lg btn-outline" href="<?php echo base_url();?>investor/option">Lakukan Pendanaan</a>
                </div>
            </div>
        </div>
    </div>
		
    </div>
  
  
  <?php } else { ?>
    <div class="content-section-a">

          <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Anda ingin menjadi investor?</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-2 col-xs-12 div-center">
                            <h4> 2.5% biaya platform</h4>
                            <span class="text">Kami mengenakan biaya bunga 2.5% dari total biaya bunga.</span>
                            <br /><br />
                        </div>
                        <div class="col-lg-4 col-xs-12 div-center">
                            <h4>Return 12 - 18% per tahun </h4>
                            <span class="text">Kami memberikan return investasi anda sebesar 12 - 18%</span>
                        </span>
                    </div>
                </div>
                <br />
                <div class="col-lg-12 col-sm-12 div-center">
                    <a class="btn btn-info btn-lg btn-outline" href="<?php echo base_url();?>investor/option">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
		
    </div>
	
  <?php } ?>

	<div class="container hidden-xs">
           

        </div>
	
	
    <div class="content-section-a2">

        <div class="container hidden-xs">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Marketplace Rajakredit</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 why-invest" style="padding-left:80px;">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-xs-9 col-xs-offset-3">
                                    <div class="why-wrap">
                                        <p class="lead"><b><u>Investor</u></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3">
                                    <div class="btn btn-warning btn-lg blue-circle"><i class="fa fa-dollar" style="font-size:28px;"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Investasi dengan hasil luar biasa </b></p>
                                        <p class="text">Anda akan mendapat return 12-18% per-tahun</p>
                                        <br /><br />
                                    </div>
                                </div>
                            </div>      
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 why-invest">
                                    <div class="btn btn-warning btn-lg blue-circle"><i class="fa fa-life-bouy" style="font-size:28px; margin-left:-5px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9 why-invest">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Aliran tetap</b></p>
                                        <p class="text">Setiap kali pembayaran dilakukan oleh peminjam di setiap bulan, dana akan disalurkan sepenuhnya kepada investor. Terserah investor untuk menginvestasikan kembali atau menarik setiap saat.</p>
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <div class="col-lg-6 col-xs-12 why-invest lead" style="padding-left:80px;">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-xs-9 col-xs-offset-3">
                                    <div class="why-wrap">
                                        <p class="lead"><b><u>Peminjam</u></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3">
                                    <div class="btn btn-warning btn-lg orange-circle"><i class="fa fa-thumbs-o-up" style="font-size:28px; margin-left:-3px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Biaya yang minim</b></p>
                                        <p class="text">Semua pinjaman dengan bunga yang terjangkau dan tidak ada informasi biaya  keuangan yang disembunyikan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 why-invest">
                                    <div class="btn btn-warning btn-lg orange-circle"><i class="fa fa-lightbulb-o" style="font-size:28px; margin-left:1px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9 why-invest">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Mudah dan efisien</b></p>
                                        <p class="text">Semua fasilitas proses peminjaman dapat menggunakan portal rajakredit sehingga anda dapat melakukan pengajuan pinjaman kapan pun dan dimana pun.
										</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
		
		<div class="container hidden-lg">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Marketplace Rajakredit</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 why-invest">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-xs-9 col-xs-offset-3">
                                    <div class="why-wrap">
                                        <p class="lead"><b><u>Investors</u></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3">
                                    <div class="btn btn-warning btn-lg blue-circle" style="margin-left:-20px;"><i class="fa fa-dollar" style="font-size:28px;"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Investasi dengan hasil luar biasa </b></p>
                                        <p class="text">Anda akan mendapat return 12-18% per-tahun</p>
                                        <br /><br />
                                    </div>
                                </div>
                            </div>      
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 why-invest">
                                    <div class="btn btn-warning btn-lg blue-circle" style="margin-left:-20px;"><i class="fa fa-life-bouy" style="font-size:28px; margin-left:-5px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9 why-invest">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Aliran tetap</b></p>
                                        <p class="text">Setiap kali pembayaran dilakukan oleh peminjam di setiap bulan, dana akan disalurkan sepenuhnya kepada investor. Terserah investor untuk menginvestasikan kembali atau menarik setiap saat.</p>
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <div class="col-lg-6 col-xs-12 why-invest lead">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-xs-9 col-xs-offset-3">
                                    <div class="why-wrap">
                                        <p class="lead"><b><u>Peminjam</u></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3">
                                    <div class="btn btn-warning btn-lg orange-circle" style="margin-left:-20px;"><i class="fa fa-thumbs-o-up" style="font-size:28px; margin-left:-3px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Biaya yang minim</b></p>
                                        <p class="text">Semua pinjaman dengan bunga yang terjangkau dan tidak ada informasi biaya  keuangan yang disembunyikan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 why-invest">
                                    <div class="btn btn-warning btn-lg orange-circle" style="margin-left:-20px;"><i class="fa fa-lightbulb-o" style="font-size:28px; margin-left:1px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9 why-invest">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Mudah dan efisien</b></p>
                                        <p class="text">Semua fasilitas proses peminjaman dapat menggunakan portal rajakredit sehingga anda dapat melakukan pengajuan pinjaman kapan pun dan dimana pun.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->


  
  
  <style>
  .comparePanel {
    height: 55px;
    background: #dedede;
    line-height: 2;
    color: #000;
    font-size: 14px;
    font-weight: 700;
    text-shadow: 0 1px 0 #84BAFF;
    box-shadow: 0 0 15px #00214B;
    position: relative;
    bottom: 0;
    width: 100%;
    z-index: 9999;
}
.reasonCompare {
    position: relative;
    height: 55px;
    width: 100%;
    background: #081f2b;
}
  </style>
  <div class="compareAndReason hidden-sm hidden-xs" style="position:fixed;bottom:0px;left:0px;">
		<!--Compare Bar In Here-->
		<div id="comparePanel" class="comparePanel" style="display:none"  >
			<form name="compareForm" method="post"  class="form-horizontal" id="compareForm">
			
				<div style="position: relative;">
					<div class="comparePanelClose" ><span class="fa fa-times-circle closeCompareBtn" style="color: #CB002E;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tutup panel ini dan batalkan perbandingan"></span></div>
				</div>
				<div class="container">
				  <div class="row">
					<div class="col-md-3" style="padding-top: 15px;text-align: left;">Membandingkan <span id="jumlahDibandingkan">0</span> produk :</div> 
					<div class="col-md-2" style="padding-top: 10px;"><div class="logoComp" style="height: 40px;"><img src="<?php echo base_url() ?>assets/img/logo-rajakredit.png" id="thumbCompare1" class="img-responsive" style="max-width:80px"><button class="removeCompareThumb" data-index="0" id="btnRemoveCompare1" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus produk ini dari daftar perbandingan"><i class="fa  fa-close" style="font-size: 14px;color: #B20000;"></i></button></div></div>
					<div class="col-md-2" style="padding-top: 10px;"><div class="logoComp" style="height: 40px;"><img src="<?php echo base_url() ?>assets/img/logo-rajakredit.png" id="thumbCompare2" class="img-responsive" style="max-width:80px"><button class="removeCompareThumb" data-index="1" id="btnRemoveCompare2" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus produk ini dari daftar perbandingan"><i class="fa  fa-close" style="font-size: 14px;color: #B20000;"></i></button></div></div>
					<div class="col-md-2" style="padding-top: 10px;"><div class="logoComp" style="height: 40px;"><img src="<?php echo base_url() ?>assets/img/logo-rajakredit.png" id="thumbCompare3" class="img-responsive" style="max-width:80px"><button class="removeCompareThumb" data-index="2" id="btnRemoveCompare3" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus produk ini dari daftar perbandingan"><i class="fa  fa-close" style="font-size: 14px;color: #B20000;"></i></button></div></div>
					<div class="col-md-3 pull-right" style="padding-top: 11px;" ><span data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik di sini untuk membandingkan produk di samping secara detail" class="btn btn-default btnGoCompare" onclick="validateCompare()" style="width:100%;margin-left:2px"><i class="fa  fa-send-o" style="font-size: 14px;"></i>&nbsp;&nbsp; <span id="">Bandingkan</span></span></div>
					<input type="hidden" id="companyCompare1" name="companyCompare1">
					<input type="hidden" id="companyCompare2" name="companyCompare2">
					<input type="hidden" id="companyCompare3" name="companyCompare3">
					<input type="hidden" id="typeCompare1" name="typeCompare1">
					<input type="hidden" id="typeCompare2" name="typeCompare2">
					<input type="hidden" id="typeCompare3" name="typeCompare3">
					<input type="hidden" id="countCompareDOM" value="0">
					<input type="hidden" id="currentArgument" value="<?php //echo $_GET ?>">
				  </div> 
				</div>
			</form>
		</div>
	
		<!--Compare Bar End-->	
	</div>
<script>
function getTenor(pinjaman,satuan) {
	var semester = document.getElementById("semester").value;
	//alert(e.value);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("tes").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>"+"pinjaman/tenor/?pinjaman="+pinjaman+"&satuan="+satuan, true);
  xhttp.send();
}
</script>

    