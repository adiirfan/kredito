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
		 <div class="row">
        <div class="col-lg-9">
            <h3>Daftar Bid Anda</h3>
            <hr>
        </div>      
        <div class="col-lg-3 col-xs-12 well well-sm" style="margin: 25px 0px 0px;">
            <span style="font-size:15px">Saldo</span>
            <br>
           <small>Rp</small>
            <span style="font-size: 35px"><?php echo $this->model_backend->rupiah($totaldeposit); ?></span>
            <a href="<?php echo base_url();?>investor/tambah-saldo"" class="btn btn-info btn-block">Tambah Saldo</a>
        </div>
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
        <div class="col-lg-12">
		<table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th class="desktop">No</th>
                        <th class="desktop">Id Bid</th>
                        <th class="desktop">Id Pinjaman</th>
						<th class="desktop">Pinjaman</th>
                        <th class="desktop">Jumlah Bid</th>
						 <th class="desktop">Status</th>
						  <th class="desktop"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($bid as  $row) {
                 $status=$this->model_backend->status_bid($row['bid_status']);
					?>
                     <tr>
                        <td><?php echo $i; ?></td>
						 <td><?php echo $row['bid_code']; ?></td>
						  <td><?php echo $row['code']; ?></td>
						   <td>Rp. <?php echo $this->model_backend->rupiah($row['amount']); ?></td>
                        <td>Rp. <?php echo $this->model_backend->rupiah($row['bid_amount']); ?></td>
                        <td><?php echo $status; ?></td>
					
						 
                        <td class="desktop">

							<?php// }?>
							<button class="btn btn-success btn-xs" onclick="detail_data('<?php echo $row['loan_id'] ?>','detail')">Detail</button>
	                        <?php //} ?>
	                        <?php //if ($loan_list[$i]->status == 1) { ?>
	                        	<!-- <form action="<?php //echo base_url(); ?>borrower/application/edit" id="myform" method="post" accept-charset="utf-8">
	                        		<button class="btn btn-info btn-xs">Edit</button>
	                        		<input type="hidden" id="h_code" name="h_code" value="<?php //echo $loan_list[$i]->code; ?>" />
	                        	</form> -->
	                        <?php //} ?>
                        </td>
                     
                        	
                       
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
		
		
		
		</div>
		</div>
		</div>