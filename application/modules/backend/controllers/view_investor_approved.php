
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
            save_filter(6002, $('#txt_filter').val());
        });
        
        load_filter(6002);

    } );

    function get_filter(pArray)
    {
        $('#txt_filter').val(pArray[0]);

        var table = $('#tbl').DataTable();
        table.search(pArray[0]).draw();
    }
</script>

<script>

    $(function(){

        $("#lbl_message").hide();
        $("#lbl_Success").fadeOut(2000);

        $("#btnOK").click(function() 
        {
            $(this).unbind('myform').submit();
            $("#lbl_message").hide();
            
            if ($("#txt_remarks").val().trim() == "")
            {
                $("#lbl_message").text("The Remarks field is required.");
                $("#lbl_message").show();
                return;   
            }

            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });
            $("#h_code").val($("#lbl_code").text());
            $("#h_status").val($("#cbo_status").val());
            $("#h_remarks").val($("#txt_remarks").val());
            document.getElementById("myform").submit(); 

        });

    });

    function edit(pID)
    {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "workspace/investor/get",
            dataType: 'json',
            data: {
                investor_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_investor_id").val(pID);
                    $("#lbl_code").text(res.code);
                    $("#lbl_full_name").text(res.full_name);
                    $("#cbo_status").val(res.status);
                    $("#txt_remarks").val(res.remarks);

                    var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
                    $("body").append(appendthis);
                    $(".modal-overlay").fadeTo(500, 0.7);
                    $('#popupForm').fadeIn($(this).data());

                }
            }
        });
    }
  </script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('pMessage') != ""){ ?>
            <div class="alert alert-success" id="lbl_Success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Success</h4>
                <?php print_r($this->session->flashdata('pMessage')); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Investor - Approved
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="all">Ref Code</th>
                        <th>Investor</th>
                        <th>Contact</th>
                        <th>Fund</th>
                        <th>Submitted Date</th>
                        <th>Remarks</th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($investor_list); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $investor_list[$i]->code; ?></td>
                        <td><?php echo $investor_list[$i]->full_name; ?></td>
                        <td><?php echo $investor_list[$i]->mobile_phone; ?><br /><?php echo $investor_list[$i]->email; ?></td>
                        <td>MYR <?php echo number_format($investor_list[$i]->fund, 0); ?></td>
                        <td><?php echo $investor_list[$i]->created_date; ?></td>
                        <td><?php echo $investor_list[$i]->remarks; ?></td>
                        <td class="all">
                            <a href="<?php echo base_url(); ?>workspace/investor/detail/<?php echo $investor_list[$i]->code; ?>" class="btn btn-success btn-xs btn-block" target="_blank">View Detail</a>
                            <button class="btn btn-info btn-xs btn-block" onclick="edit(<?php echo $investor_list[$i]->user_id; ?>);">Update Status</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>    


<form action="<?php echo base_url(); ?>workspace/investor/status" id="myform" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Update Status</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body" style="max-height:300px;overflow-y: auto">
        <div class="row">
            <p id="lbl_message" class="alert alert-danger">The Remarks field is required.</p>
        </div>
        <div class="row">
            <div class="col-sm-4">
                Code:
            </div>            
            <div class="col-sm-8">
                <label class="normal" id="lbl_code"></label>
            </div>    
        </div>  
        <div class="row">
            <div class="col-sm-4">
                Investor:
            </div>            
            <div class="col-sm-8">
                <label class="normal" id="lbl_full_name"></label>
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Status: 
            </div>            
            <div class="col-sm-8">
                <select id="cbo_status" name="cbo_status" class="form-control">
                    <option value="2">Newly Submitted</option>
                    <option value="3">Approved</option>
                    <option value="4">Rejected</option>
                </select>
            </div>    
        </div>     
        <div class="row">
            <div class="col-sm-4">
                Remarks: 
            </div>            
            <div class="col-sm-8">
                <?php 
                $data = array(
                  'name'        => 'txt_remarks',
                  'id'          => 'txt_remarks',
                  'rows'        => '5',
                  'class'       => 'form-control',
                  'maxlength'   => 255
                );
                echo form_textarea($data); ?>
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-12">
                Once you update the status to "Approved" or "Rejected", and email will be sent to the applicant.
            </div>
        </div>       
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK">Update</button>
    </footer>
</div>
<input type="hidden" id="h_investor_id" name="h_investor_id" value="0">
<input type="hidden" id="h_code" name="h_code" value="">
<input type="hidden" id="h_status" name="h_status" value="">
<input type="hidden" id="h_remarks" name="h_remarks" value="">
<input type="hidden" id="h_menu_id" name="h_menu_id" value="6002">
<input type="hidden" id="h_menu_name" name="h_menu_name" value="approved">
</form>
