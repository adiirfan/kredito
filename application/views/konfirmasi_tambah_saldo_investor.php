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
			<h2 align="center">Konfirmasi Penambahan Saldo</h2>
			<hr>
		</div>		
	</div>
	<form method="post" id="form" action="<?php echo base_url(); ?>investor/action_konfirmasi_tambah_saldo" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-2 register">
			<?php echo validation_errors('<p class="alert alert-danger">');?>
		</div>
	</div>
	
	<div class="row">
	<div class="panel panel-default">
	<div class="panel-body">
		<div class="col-lg-4 col-lg-offset-2 register">
		
			<div class="form-group">
				<label>Nama pemilik rekening</label>
				<input type="text"  name="nama" id="nama_rek" class="form-control">
				
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text"  name="bank" id="bank" class="form-control">
			</div>
			<div class="form-group">
				<label>Jumlah Dana</label>
				<input type="text" required="required" value="<?php echo $fund ?>" name="fund" class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="1000000000" data-a-dec="," data-a-sep=".">
			</div>
			<div class="form-group" style="padding:0px 0px;">
				<label for="form-field-mask-1">
				Tanggal Pembayaran <small class="text-success"></small>
				</label>
				<br>
				<br>
				<?php
				$this->load->model('model_tanggal');
				$tgl=date('Y-m-d') ;
				$pecha=str_replace("-"," ",$tgl); 
				$tanggal=substr($pecha,-2);
				$tahun=substr($pecha,0,4);
				$bulan=substr($pecha,5,2);
				$tahun_sekarang = (integer) date("Y");
				$this->model_tanggal->pilihan_tanggal("selecttg", "selectbl", "selectth",
				1900, $tahun_sekarang, $tanggal, $bulan, $tahun);	 
				?>
			</div>
			
		</div>
		
		<div class="col-lg-4 register">
		<div class="form-group">
				<label>Nomor Pengajuan</label>
				<input type="text"  name="no_pengajuan" required="required" id="no_pengajuan" value="<?php echo $code ?>" class="form-control">
				
			</div>
			 <div class="form-group">
                    <label>Transfer ke</label>
                    <select name="tujuan_transfer" class="form-control">
					<option value="1">BCA a.n Rajakredit (000999)</option>
					<option value="2">BNI a.n Rajakredit (000999)</option>
					<option value="3">MANDIRI a.n Rajakredit (000999)</option>
					</select>
             </div>
			 <div class="form-group">
                    <label>Bukti Transfer</label>
                    <input type="file"   class="form-control" id="bukti_transfer" name="bukti_transfer">
             </div>
		
			<div class="form-group">
				<label>Catatan</label>
				<textarea name="note" rows="3" class="form-control"></textarea>
			</div>	
		</div>
	</div>
	</div>
	</div>
	
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<p align="center"><button name="submit" class="btn btn-info longer">Konfirmasi</button></p>
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
