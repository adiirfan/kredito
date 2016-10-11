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

</style>
<link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" media="screen">   

<div class="konten">
<div class="container panel panel-default">
<br>
<div class="process">
    <div class="process-row">
       
        <div class="process-step">
            <button type="button" class="btn btn-warning btn-circle"><i class="fa fa-info fa-3x"></i></button>
            <p>Ringkasan Pinjaman</p>
        </div>
         <img src="http://www.rajakredit.co.id/temp/assets/img/man_running.png" style="width:30px; ">
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
<h2 align="center">Silahkan isi data pengajuan pinjaman anda <?php //echo get_cookie("user_id") ?></h2>
<br><br>
	<form method="post" action="<?php echo base_url(); ?>add_loan" enctype="multipart/form-data"  id="form">

								<div class="row">
											<div class="col-md-2">
											
											</div>
											<div class="col-md-4">
										    	<div class="form-group">
													<label class="control-label">
														Nomor Ktp <?php //echo $k; ?> <span class="symbol required"></span>
													</label>
													<?php
													$maxidloan=$this->model_credit-> max_idloan();
													
													?>
													<input  type="hidden"  name="loan_code" value="<?php echo $this->uri->segment(2); ?>"  class="form-control" >
													<input  type="text" maxlength="16" required="required" name="loan_nik" onkeyup="nikAda(this.value)" id="nik" value="<?php echo $user['loan_name'] ?>"  class="form-control" >
												</div>
												
												<div class="form-group">
												<label class="control-label">
												Nama Lengkap <span class="symbol required"></span>
												</label>
												<input  type="text" name="loan_name" value="<?php echo $user['loan_name'] ?>"  class="form-control" >
												</div>
												<div class="form-group">
												<p>
												Jenis Kelamin
												</p>
												<label class="radio-inline">
												<input type="radio" required="required" <?php if($user['loan_gender']=="L") echo "checked"; ?> value="L" name="loan_gender"  class="square-red">
												Laki-laki
												</label>
												<label class="radio-inline">    
												<input type="radio" value="P" <?php if($user['loan_gender']=="P") echo "checked"; ?> name="loan_gender"   class="square-red">
												Perempuan                                         
												</label>
												</div>
												<div class="form-group">
												<label class="control-label">
												Tempat Lahir <span class="symbol required"></span>
												</label>
												<input type="text" value="<?php echo $user['loan_pod'] ?>"  name="loan_pod" class="form-control" required="required" >
												</div>
												<div class="form-group">
												<label for="form-field-mask-1">
												Tanggal Lahir <small class="text-success"></small>
										        </label>
												<br>
												<br>
												<?php
												$tgl=$user['loan_bod'] ;
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
											<div class="col-md-4">
												<div class="form-group">
												<label class="control-label">
												Email <?php if($k == 1){?><font style="color:red;font-size:10pt">Your Email Already Used Click <a href="/kredit/security/forgot_my_password" target="_blank"> Here</a> to Restore Your Password</font><?php } ?>
												</label>
													<input  type="text" value="<?php echo $user['loan_email'] ?>" name="email" id="email"  class="form-control" >
												</div>
												<div class="form-group">
												<label class="control-label">
												Telepon
												</label>
													<input  type="text" value="<?php echo $user['loan_phone'] ?>" name="phone" id="phone"  class="form-control" >
												</div>
												<div class="form-group">
												<label for="form-field-22">
												Alamat
												</label>
												<textarea placeholder="Alamat" id="form-field-22" name="loan_address" class="form-control"><?php echo $user['loan_address'] ?></textarea>
												</div>
												<div class="form-group">
													<label class="control-label">
														Kota<span class="symbol required"></span>
													</label>
												<input  type="text" value="<?php echo $user['loan_city'] ?>" name="loan_city"   class="form-control" >
													
												</div>
												<div class="form-group">
													<label class="control-label">
														Kode Pos<span class="symbol required"></span> : 
													</label>	
												<input  type="text" value="<?php echo $user['loan_postal_code'] ?>" name="loan_postal_code"   class="form-control" >
												
												</div>
												
												
												
												</div>	
								</div>
											
									
										<div class="row">
											<div class="col-md-4">
											
											</div>
											<div class="col-md-4">
											<button  class="btn btn-cek btn-block" name="submit" type="submit">
													Ajukan <i class="fa fa-arrow-circle-right"></i>
											</button>
<br>

											</div>
											<div class="col-md-4">
											</div>
										</div>
										
	</div>	
		</div>	
			
<!-- Modal -->
