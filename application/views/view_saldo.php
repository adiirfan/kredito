<link href="<?php echo base_url(); ?>assets/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<!--<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">-->
<link href="<?php echo base_url(); ?>assets/custom/css/admin-datatable.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url();?>assets/jquery/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">

  /* Custom filtering function which will search data in column four between two values */


    $(document).ready(function() {

        $("#popupForm").draggable();

        var table = $('#tbl').DataTable({
            "dom": '<"dataTables_CustomFilter">lrtip'
        });

        $("div.dataTables_CustomFilter").html(
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl"></label>' +
            '');

        // Event listener to the two range filtering inputs to redraw on input
        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
        });

        $('#cbo_filter_status').on( 'change', function () {
            table.columns(7).search( this.value ).draw();
        });


    } );
    
</script>

			
			
	   
		<div class="container">
		     
       <div class="col-lg-3 col-xs-12 well well-sm" style="margin: 25px 0px 0px;">
           <?php 
			$saldoku=$saldo;
			
			if($saldoku == null){
				$saldoku=0;
			}else{
				$saldoku=$saldo->saldo;
			}
			?>
			  <span style="font-size:15px">Saldo</span>
            <br>
           <small>Rp</small>
            <span style="font-size: 35px"><?php echo $this->model_backend->rupiah($saldoku); ?></span>
            <a href="<?php echo base_url();?>investor/tambah-saldo"" class="btn btn-info btn-block">Tambah Saldo</a>
        </div>
		<br>
		<a class="btn btn-default btn-lg small button-apply pull-right" href="<?php echo base_url();?>bid/application"><i class="fa fa-dollar fa-fw"></i> <span class="network-name">Investasi</span></a>
		</div>
		<br>
		<?php if (!empty($this->session->flashdata('berhasil'))) { ?>
			
				<div class="alert alert-success alert-dismissible" role="alert" id="lbl_Success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong></strong>
					<?php echo ($this->session->flashdata('berhasil')); ?>
				</div>
			
			
	    <?php } ?>
		 <div class="row">
        <div class="col-lg-12"  style="padding-left:200px;padding-right:200px;">
            <h3>Saldo per  <?php echo $this->model_tanggal->formatdate(date('Y-m-d')); ?> : <font color="#390"><?php echo 'Rp '.$this->model_backend->rupiah($saldoku); ?></font></h3>
			<p align="right">
			<a href="<?php echo base_url();?>investor/saldo">
			<button name="submit" class="btn btn-info longer">Cek Saldo</button>
			</a>
			<a href="<?php echo base_url();?>investor/tambah-saldo">
			<button name="submit" class="btn btn-info longer">Tambah Saldo</button>
			</a>
			<a href="<?php echo base_url();?>investor/konfirmasi-saldo">
			<button name="submit" class="btn btn-info longer">Konfimasi</button>
			</a>
			
			<button name="submit" class="btn btn-default longer">Cairkan dana</button></p>
		   <hr>
        </div> 
		</div>
		<div class="row">
        <div class="col-lg-12" style="padding-left:200px;padding-right:200px;">
		 <table class="table hover"  style="padding:10px;">
			  <thead>
			  <tr style="background-color:#fff;">
			  <td>Waktu</td>
			  <td>Mutasi</td>
			  <td>Saldo</td>
			  <td></td>
			  </tr>
			  </thead>
			  <tbody>
			  <?php foreach($kas as $row){ ?>
			  <tr style="padding:20px;">
			   <td style="padding:20px;"><?php echo $row['submitted_date'] ?></td>
			  <td><?php echo '('.$row['minus_or_plus'].') Rp '.$this->model_backend->rupiah($row['nilai']) ?></td>
			  <td><?php
			  if($row['saldo'] == null){
				  ?>
				Menunggu Konfirmasi
				  <?php
			  }else{

			  echo $this->model_backend->rupiah($row['saldo']) ;
			  }
			  ?></td>
			  <td>
			  
			  <?php
				if($row['saldo'] != null){
			  if($row['bid_id'] == 0){ ?>
				
				Investasi dengan nomor #<?php echo $row['code_investment']; ?>
				
			  <?php } else if($row['bid_id'] != 0){ ?>
			  
			  Bid dengan nomor #<?php echo $row['bid_code']; ?>
			  <?php } ?>
			  
			  	
			  </td>
			  </tr>
			  
			  <?php }else{
				  
				  if($row['status'] == 0){
					  ?>
					   <a href="<?php echo base_url(); ?>investor/konfirmasi-tambah-saldo/<?php echo $row['code_investment'].'/'.$row['fund']; ?>">Konfirmasi Disini</a>
					  
					  <?php
					  
					
				  }else{
					   echo "Dalam Proses Verifikasi";
				  }
				  
				 
				  
			  } 
			  
			  }
			  
			  ?>
			  </tbody>
			  </table>
		
		
		
		</div>
		</div>
		</div>