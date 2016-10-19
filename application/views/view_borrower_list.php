
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
            '<label>Status:<select id="cbo_filter_status" class="form-control" aria-controls="tbl"><option value="">All</option><option value="1">Menunggu Dokumen</option><option value="2">Diajukan</option><option value="3">Dalam Proses</option><option value="4">Telah Diverifikasi</option><option value="5">Ditolak</option><option value="6">Dibatalkan</option></select></label>');

        // Event listener to the two range filtering inputs to redraw on input
        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
        });

        $('#cbo_filter_status').on( 'change', function () {
            table.columns(7).search( this.value ).draw();
        });


    } );
    
</script>
<script>

	function confirm_cancel()
	{
		$('#myform_cancel').attr('action', '<?php echo base_url(); ?>borrower/application/cancel');
        document.getElementById("myform_cancel").submit(); 
	}

	function cancel(pID, pCode, pAmount)
    {
    	$("#txt_code").val(pCode);
    	$("#txt_amount").val(pAmount);
    	var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
		$("body").append(appendthis);
		$(".modal-overlay").fadeTo(500, 0.7);
		$('#popupForm').fadeIn($(this).data());
    }

</script>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
		<br>
<a class="btn btn-default btn-lg small button-apply pull-right" href="<?php echo base_url();?>pilihan"><i class="fa fa-dollar fa-fw"></i> <span class="network-name">Dapatkan Pinjaman Multiguna</span></a>
			<br>
			<h3>Kelola data peminjaman multiguna</h3>

			<hr>
		</div>		
	</div>

	<div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th class="desktop">#</th>
                        <th class="desktop">No Referensi</th>
                        <th class="desktop">Nama</th>
                        <th class="desktop">Kontak</th>
                        <th class="desktop">Jumlah Pinjaman</th>
                        <th class="desktop">Status</th>
                        <th class="desktop">Tanggal Pengajuan</th>
                        <th class="hidden">Status(Hidden)</th>
                        <th class="desktop"></th>
                        <th class="hidden"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($loan_list); ++$i) { 
					$pinjaman= $this->model_backend->rupiah($loan_list[$i]->amount);
					?>
                    <tr>
                        <td class="desktop"><?php echo ($i+1); ?></td>
                        <td class="desktop"><?php echo $loan_list[$i]->code; ?></td>
                        <td class="desktop"><?php echo $loan_list[$i]->b_full_name; ?></td>
                        <td class="desktop"><?php echo $loan_list[$i]->b_mobile_phone; ?><br /><?php echo $loan_list[$i]->b_email; ?></td>
                        <td class="desktop">Rp. <?php echo $pinjaman; ?><br /><?php echo $loan_list[$i]->period; ?> tahun</td>
                        <td class="desktop">
                        <?php 
                        	switch ($loan_list[$i]->status)
                        	{
                        		case 1: { echo 'Menunggu Dokumen'; break; }
                        		case 2: { echo 'Diajukan'; break; }
                        		case 3: { echo 'Dalam Proses'; break; }
                        		case 4: { echo 'Telah Diverifikasi'; break; }
                        		case 5: { echo 'Ditolak'; break; }
                        		case 6: { echo 'Dibatalkan'; break; }
                        	}
                        ?></td>
                        <td class="desktop"><?php echo $loan_list[$i]->submitted_date; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->status; ?></td>
                        <td class="desktop">
                        	<?php if ($loan_list[$i]->status == 1 || $loan_list[$i]->status == 2) { ?>
                        	<button class="btn btn-warning btn-xs btn-block" onclick="cancel(<?php echo $loan_list[$i]->loan_id; ?>, '<?php echo $loan_list[$i]->code; ?>', <?php echo $loan_list[$i]->amount; ?>);">Cancel</button>
	                        <?php } ?>
	                        <?php if ($loan_list[$i]->status == 1) { ?>
	                        	<form action="<?php echo base_url(); ?>borrower/application/edit" id="myform" method="post" accept-charset="utf-8">
	                        		<button class="btn btn-info btn-xs btn-block">Continue</button>
	                        		<input type="hidden" id="h_code" name="h_code" value="<?php echo $loan_list[$i]->code; ?>" />
	                        	</form>
	                        <?php } ?>
                        </td>
                        <td class="mobile">
                        	<div class="form-group">
								<label>No Referensi</label><br />
								<p class="form-control-static"><?php echo $loan_list[$i]->code; ?></p>
							</div>
							<div class="form-group">
								<label>Nama</label><br />
								<p class="form-control-static"><?php echo $loan_list[$i]->b_full_name; ?></p>
							</div>
							<div class="form-group">
								<label>Kontak</label><br />
								<p class="form-control-static2"><?php echo $loan_list[$i]->b_mobile_phone; ?></p>
								<p class="form-control-static"><?php echo $loan_list[$i]->b_email; ?></p>
							</div>
							<div class="form-group">
								<label>Pinjaman</label><br />
								<p class="form-control-static2">Rp <?php echo number_format($loan_list[$i]->amount, 2); ?> (<?php echo $loan_list[$i]->period; ?> mths)</p>
							</div>
							<div class="form-group">
								<label>Status</label><br />
								<p class="form-control-static">
									<?php 
			                        	switch ($loan_list[$i]->status)
			                        	{
			                        		case 1: { echo 'Menunggu Dokumen'; break; }
											case 2: { echo 'Diajukan'; break; }
											case 3: { echo 'Dalam Proses'; break; }
											case 4: { echo 'Telah Diverifikasi'; break; }
											case 5: { echo 'Ditolak'; break; }
											case 6: { echo 'Dibatalkan'; break; }
			                        	}
			                        ?>
								</p>
							</div>
							<div class="form-group">
								<label>Tanggal Diajukan</label><br />
								<p class="form-control-static"><?php echo $loan_list[$i]->submitted_date; ?></p>
							</div>
							<?php if ($loan_list[$i]->status == 1 || $loan_list[$i]->status == 2) { ?>
							<button class="btn btn-warning btn-xs longer pull-right" onclick="cancel(<?php echo $loan_list[$i]->loan_id; ?>, '<?php echo $loan_list[$i]->code; ?>', <?php echo $loan_list[$i]->amount; ?>);">Cancel</button>
                        	<?php } ?>
                        	<?php if ($loan_list[$i]->status == 1) { ?>
	                        	<form action="<?php echo base_url(); ?>borrower/application/edit" id="myform" method="post" accept-charset="utf-8">
	                        	<button class="btn btn-info btn-xs longer pull-right" style="margin-right:5px">Edit</button>
	                        	<input type="hidden" id="h_code" name="h_code" value="<?php echo $loan_list[$i]->code; ?>" />
	                        	</form>
                        	<?php } ?>
                        	
                        </div>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>  

</div>	

<form action="<?php echo base_url(); ?>borrower/application/cancel" id="myform_cancel" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Cancel Loan Application</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body" style="max-height:300px;overflow-y: auto">
        <div class="row">
            <p id="lbl_confirm" class="alert alert-warning">Are you sure you want to cancel this record?</p>
        </div>
        <div class="row">
            <div class="col-sm-4">
                Ref No.: 
            </div>            
            <div class="col-sm-8">
            	<input type="text" id="txt_code" name="txt_code" readonly class="form-control" />
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Loan Amount: 
            </div>            
            <div class="col-sm-8">
                <input type="text" id="txt_amount" name="txt_amount" readonly class="form-control" />
            </div>    
        </div>        
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-warning" id="btn_cancel" onclick="confirm_cancel();">Confirm Cancel</button>
    </footer>
</div>
</form>

<!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.bootstrap.min.js" type="text/javascript"></script>    
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.responsive.min.js" type="text/javascript"></script>    