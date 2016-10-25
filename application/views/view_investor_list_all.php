
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
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl"></label>');

        // Event listener to the two range filtering inputs to redraw on input
        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
        });

    } );
    
</script>
<script>

	function confirm_cancel()
	{
		$('#myform_cancel').attr('action', '<?php echo base_url(); ?>investor/application/cancel');
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
			<h3>Available Loan Listing</h3>
			<hr>
		</div>		
	</div>

	<div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th class="desktop">#</th>
                        <th class="desktop">Ref No.</th>
                        <th class="desktop">Investor</th>
                        <th class="desktop">Fund</th>
                        <th class="hidden"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($investment_list); ++$i) { ?>
                    <tr>
                        <td class="desktop"><?php echo ($i+1); ?></td>
                        <td class="desktop"><?php echo $investment_list[$i]->code; ?></td>
                        <td class="desktop">
                            <?php if ($investment_list[$i]->i_investor_type == "C") {
                                echo $investment_list[$i]->i_company_name;
                            } 
                            else
                            {
                                echo $investment_list[$i]->i_full_name;  
                            }
                            ?></td>
                        <td class="desktop">MYR <?php echo number_format($investment_list[$i]->fund, 2); ?></td>
                        <td class="mobile">
                        	<div class="form-group">
								<label>Ref No.</label><br />
								<p class="form-control-static"><?php echo $investment_list[$i]->code; ?></p>
							</div>
							<div class="form-group">
								<label>Name</label><br />
								<p class="form-control-static"><?php echo $investment_list[$i]->i_full_name; ?></p>
							</div>
							<div class="form-group">
								<label>Fund</label><br />
								<p class="form-control-static2">MYR <?php echo number_format($investment_list[$i]->fund, 2); ?></p>
							</div>
                        	
                        </div>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>  

</div>	

<form action="<?php echo base_url(); ?>investor/application/cancel" id="myform_cancel" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Cancel Investment Application</span>
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
                Fund Amount: 
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