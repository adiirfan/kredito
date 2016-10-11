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
			<h2 align="center">Tambah Saldo</h2>
			<hr>
			<?php 
			$fundtotal= $this->model_investment->get_total_fund(get_cookie("user_id"));
		
		//$fund= $ci->model_investment->get_total_fund(get_cookie("user_id"));
		$bid= $this->model_bid->get_total_bid(get_cookie("user_id"));
		$totaldeposit= $this->model_bid->min_bid_fund($fundtotal->total,$bid->total);
		
		
		?>
		</div>		
	</div>
	<form method="post" id="form" action="<?php echo base_url(); ?>investor/action_tambah_saldo" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-2 register">
			<?php echo validation_errors('<p class="alert alert-danger">');?>
		</div>
	</div>
	
	<div class="row">
	<div class="panel panel-default">
	<div class="panel-body">
		
		<div class="col-lg-4 col-lg-offset-2 register">
		<h3><?php echo 'Saldo anda tanggal  '.$this->model_tanggal->formatdate(date('Y-m-d')).'<br><font color="#390"> Rp '.$this->model_backend->rupiah($totaldeposit); ?></font></h3><br>
		Cermatlah dalam menambah saldo.<br>
Penambahan saldo hanya bisa dilakukan maksimal 2 kali sehari.<br>
		
			
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
		<div class="form-group">
				<label>Jumlah Dana</label>
				<input type="text" required="required" name="fund" class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep=".">
			</div>
			<hr>
		</div>		
	</div>
	</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<p align="center"><button name="submit" class="btn btn-info longer">Lanjut</button></p>
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
