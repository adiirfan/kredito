<?php
$k = 0;
if ( isset($_SESSION['pesan'] ) )
{$k = 1;
unset( $_SESSION['pesan'] );
}
?>
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
			
			.process-row {
    display: table-row;
}

.process {
    display: table;     
    width: 100%;
    position: relative;
}

.process-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.process-row:before {
    top: 20px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
    
}

.process-step {    
    display: table-cell;
    text-align: center;
    position: relative;
    padding-left: 0%;
    padding-right: 5%;
}

.process-step p {
    margin-top:10px;
    
}

.btn-circle {
  width: 40px;
  height: 40px;
  text-align: center;
  padding: 6% 0;
  font-size: 6px;
  line-height: 0.6;
  border-radius: 100%;
}

.btn-circle.active {
    border: 2px solid #cc0;
}

@media (min-width:480px) {
    .btn-circle {
        width: 60px;
        height: 60px;
        font-size: 8px;
        line-height: 0.8;
    }
    
    .process-row:before {
        top: 30px;
    }
    
    .process-step {
        padding-left: 5%;
        padding-right: 5%;
    }
}

@media (min-width:768px) {
    .btn-circle {
        width: 80px;
        height: 80px;
        font-size: 10px;
        line-height: 1;
    }
    
    .process-row:before {
        top: 40px;
    }
    
    .process-step {
        padding-left: 5%;
        padding-right: 5%;
    }
}

@media (min-width:992px) {
    .btn-circle {
        width: 100px;
        height: 100px;
        font-size: 12px;
        line-height: 1.428571429;
    }
    
    .process-row:before {
        top: 50px;
    }
    
    .process-step {
        padding-left: 5%;
        padding-right: 5%;
    }
}
@media (min-width: 1200px)
.col-lg-8 {
    width: 70%;
}

</style>
<link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" media="screen">    
<div class="konten">
<div class="container  panel panel-default" >
<br>
<div class="process">
    <div class="process-row">
        <img src="http://www.rajakredit.co.id/temp/assets/img/man_running.png" style="width:30px; ">
        <div class="process-step">
            <button type="button" class="btn btn-warning btn-circle"><i class="fa fa-info fa-3x"></i></button>
            <p>Ringkasan Pinjaman</p>
        </div>
        
        <div class="process-step">
            <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-user fa-3x"></i></button>
            <p>Data Pengajuan</p>
        </div> 
         <div class="process-step">
            <button type="button" class="btn btn-success btn-circle" active><i class="fa fa-thumbs-up fa-3x"></i></button>
            <p>Selesai</p>
        </div> 
    </div>
    <div id="results"></div>
</div>


	<form method="post" action="<?php echo base_url(); ?>konfirmasi-refinance/<?php echo $this->uri->segment(2); ?>" enctype="multipart/form-data"  id="form">

								<div class="row">
		  <div class="col-lg-2">
		   </div>
			<div class="col-lg-8">
			<div class="panel panel-default">
			<div class="panel-body">
			<h2 align="center">Ringkasan Pinjaman <?php //echo get_cookie("user_id") ?></h2>
			<div style="display:inline-block;">
			<div align="left">
			
			
			</div>
			<div align="right">
			<strong align="right"><img src="<?php echo base_url(); ?>assets/img/<?php echo $loan['company_image']; ?>" width="100px" height="100px"></img> </strong>
			</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-lg-6">
				
				 <div class="form-group">
				<label>Pinjaman</label>
				<div style="display:block">
				<?php echo 'Rp. '.$this->model_backend->rupiah($loan['loan']); ?>
				</div>
				</div>
				
				<div class="form-group">
				<label>Jangka Waktu</label>
				<div style="display:block">
				<?php echo $loan['company_product_tenor']?> Tahun
				</div>
				</div>
				
				<div class="form-group">
				<label>Suku Bunga per-tahun</label>
				<div style="display:block">
				<?php echo $loan['interest_rate']." %"?>
				</div>
				</div>
				<div class="form-group">
				<label>Uang Muka</label>
				<div style="display:block">
				
				<?php echo 'Rp. '.$this->model_backend->rupiah($loan['loan_down_payment'])?>
				</div>
				</div>
				<div class="form-group">
				<label>Cicilan per bulan</label>
				<div style="display:block">
				
				<?php echo 'Rp. '.$this->model_backend->rupiah($loan['loan_payment_month'])?>
				</div>
				</div>
				
				<div class="form-group">
				<label>Total bunga dibayar</label>
				<div style="display:block">
				<?php echo 'Rp. '.$this->model_backend->rupiah($loan['loan_sum_interest_rate'])?>
				</div>
				</div>
					
				
				</div>
				<div class="col-lg-6">
				<div class="form-group">
				<label>Jenis Pinjaman</label>
				<div style="display:block">
				<?php echo $loan['product_name']?>
				</div>
				</div>
				
				<div class="form-group">
				<label>Nama Produk</label>
				<div style="display:block">
				<?php echo $loan['company_product_name']?>
				</div>
				</div>
				
				<div class="form-group">
				<label>Proses Verifikasi</label>
				<div style="display:block">
				10 Hari Kerja
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
				
				</div>
			</div>
			
			</div>
			</div>
		  
		  </div>
		  <div class="col-lg-1">
		   </div>
		</div>
											
									
										<div class="row">
											<div class="col-md-4">
											
											</div>
											<div class="col-md-4">
											<button  class="btn btn-cek btn-block" name="submit" type="submit">
													Selanjutnya <i class="fa fa-arrow-circle-right"></i>
											</button>
											<br>
											</div>
											<div class="col-md-4">
											</div>
										</div>
										
</div>
</div>
		
			
			
<!-- Modal -->
