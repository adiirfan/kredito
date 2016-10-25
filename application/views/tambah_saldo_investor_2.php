<script src="http://www.rajapremi.com/assets/js/autoNumeric.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".InsuredPrice").length > 0 && $(".InsuredPrice").autoNumeric("init");
			});
		</script>



<div class="container">

	

	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
		<br>
			<h2 align="center">Nomor Pengajuan Penambahan Saldo <?php echo $code ?> </h2>
			<hr>
		</div>		
	</div>
	<form method="post" id="form" action="<?php echo base_url(); ?>investor/menunggu-konfirmasi-pembayaran" >
	<input type="hidden" value="<?php echo $code; ?>" name="code">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-2 register">
			<?php echo validation_errors('<p class="alert alert-danger">');?>
		</div>
	</div>
	
	<div class="row">
	<div class="panel panel-default">
	<div class="panel-body">

		<div class="col-lg-4">
			<div class="form-group">
				<label>Silahkan transfer ke rekening berikut</label><br>
			Mohon melakukan transfer kurang dari 24 jam<br>
			Tagihan pembayaran telah dikirimkan ke email anda.
			<ul>
			<li>
			Kode pembayaran <?php echo $code ?> digunakan untuk mengidentifikasi tambah saldo dan akan ditambah ke saldo  Anda.
			</li>
			<li>
			Tambah saldo dianggap BATAL jika <!-- sampai dengan pukul 04:13 WIB hari Selasa, 31 Mei 2016--> (1×24 jam) tidak dibayar.
			</li>
			</ul>
<br>
Klik tombol TRANSFER jika Anda telah menyetujui ketentuan tambah saldo di atas dan akan mentransfer pembayaran ke Rajakredit.
			</div>
		</div>
		<div class="row">
		<div class="col-lg-2">
		<h2 align="center"><img src="<?php echo base_url(); ?>assets/img/bca.jpg" width="100px" height="50px"></img></h2>
		<p align="center">Nomor rekening<br> 0999999<br>
		<br> PT Rajakredit <br>
		Bank BCA
		</p>
		</div>
		<div class="col-lg-2">
		<h2 align="center"><img src="<?php echo base_url(); ?>assets/img/bni.jpg" width="100px" height="50px"></img></h2>
		<p align="center">Nomor rekening<br> 0999999<br>
		<br> PT Rajakredit <br>
		Bank BNI
		</p>
		</div>
		<div class="col-lg-2">
		<h2 align="center"><img src="<?php echo base_url(); ?>assets/img/mandiri.jpg" width="100px" height="50px"></img></h2>
		<p align="center">Nomor rekening<br>0999999<br>
		<br> PT Rajakredit <br>
		Bank MANDIRI
		</p>
		</div>
		</div>
	</div>
	</div>
	</div>
	<div class="row">
		<div class="col-lg-4 ">
			<p align="center"></p>
			
			<hr>
		</div>	
		<div class="col-lg-8 ">
		<p align="center"><button name="submit" class="btn btn-info longer">Batal</button>
			<button name="submit" class="btn btn-info longer">Transfer</button></p>
			</form>
			<hr>
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
