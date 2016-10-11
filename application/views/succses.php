<?php
$k = 0;
if ( isset( $_SESSION['pesan'] ) )
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
<br>
<br> 
<div class="container panel panel-default">
<br><br>
<div class="process">
    <div class="process-row">
       
        <div class="process-step">
            <button type="button" class="btn btn-warning btn-circle"><i class="fa fa-comments-o fa-3x"></i></button>
            <p>Ringkasan Pinjaman</p>
        </div>
         
        <div class="process-step">
            <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-user fa-3x"></i></button>
            <p>Data Pengajuan</p>
        </div> 
		<img src="http://www.rajakredit.co.id/temp/assets/img/man_running.png" style="width:30px; ">
         <div class="process-step">
            <button type="button" class="btn btn-success btn-circle" active><i class="fa fa-thumbs-up fa-3x"></i></button>
            <p>Selesai</p>
        </div> 
    </div>
    <div id="results"></div>
</div>
<h2 align="center" style="margin-top:100px;">Selamat</h2>
<br>
<p align="center" style="margin-bottom:100px;">Pinjaman anda dengan no. ref : <?php echo $this->uri->segment(2); ?> telah kami terima, customer service kami akan berhubungan dengan anda secepat mungkin</p>

</div>	
			
			
<!-- Modal -->
