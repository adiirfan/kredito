
<script type="text/javascript">

  /* Custom filtering function which will search data in column four between two values */


    $(document).ready(function() {

        $("#popupForm").draggable();

        var table = $('#tbl').DataTable({
            "dom": '<"dataTables_CustomFilter">lrtip'
        });

        $("div.dataTables_CustomFilter").html(
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl"></label>' +
            '<label>Status:<select id="cbo_filter_status" class="form-control" aria-controls="tbl"><option value="">All</option><option value="1">Active</option><option value="0">In-active</option></select></label>');

        // Event listener to the two range filtering inputs to redraw on input
        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
            save_filter(4006, $('#txt_filter').val(), $('#cbo_filter_status').val());
        });

        $('#cbo_filter_status').on( 'change', function () {
            table.columns(7).search( this.value ).draw();
            save_filter(4006, $('#txt_filter').val(), $('#cbo_filter_status').val());
        });

        load_filter(4006);

    } );

    function get_filter(pArray)
    {
        $('#txt_filter').val(pArray[0]);
        $('#cbo_filter_status').val(pArray[1]);

        var table = $('#tbl').DataTable();
        table.search(pArray[0]).draw();
        table.columns(7).search(pArray[1]).draw();
    }
</script>

<script>

    $(function(){

        $("#btnDelete").hide();
        $("#lbl_message").hide();
        $("#lbl_confirm").hide();
        $("#lbl_Success").fadeOut(2000);

        $("#btnOK").click(function() 
        {
            $(this).unbind('myform').submit();
            
            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });
            $("#h_full_name").val($("#lbl_full_name").text());
            document.getElementById("myform").submit(); 
                
        });

        $("#btnDelete").click(function() 
        {
            $(this).unbind('myform').submit();

            $('#myform').attr('action', '<?php echo base_url(); ?>workspace/user/delete/borrower');
            document.getElementById("myform").submit(); 
        });

    });

    function clear()
    {
        $("#lbl_message").hide();
        $("#h_user_id").val("0");
        $("#h_full_name").val("");
        $("#lbl_full_name").text("");
        $('input[name="rdb_status"][value="1"]').prop('checked', true);
        $("#lbl_add_new").html("Add new record");
        $("#btnOK").text("Insert");
        $("#btnOK").show();
        $("#btnDelete").hide();
        $("#lbl_confirm").hide();
    }

    function add()
    {
        clear();
        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        $(".modal-overlay").fadeTo(500, 0.7);
        $('#popupForm').fadeIn($(this).data());
    }

    function edit(pID)
    {
        clear();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "workspace/user/get",
            dataType: 'json',
            data: {
                user_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_user_id").val(pID);
                    $("#lbl_full_name").text(res.salutation_name + " " + res.full_name);
                    $("#lbl_mobile_phone").text(res.mobile_phone);
                    $("#lbl_email").text(res.email);
                    $("#lbl_address").text(res.address);
                    $("#lbl_company_name").text(res.company_name);
                    $("#lbl_company_registration").text(res.company_registration);
                    $("#lbl_company_man_power").text(res.company_man_power);
                    $('input[name="rdb_status"][value="' + res.status + '"]').prop('checked', true);
                    $("#lbl_add_new").html("Edit record");
                    $("#btnOK").text("Update");
                    $("#btnOK").show();
                    $("#btnDelete").hide();
                    $("#lbl_confirm").hide();

                    var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
                    $("body").append(appendthis);
                    $(".modal-overlay").fadeTo(500, 0.7);
                    $('#popupForm').fadeIn($(this).data());

                }
            }
        });
    }

    function del(pID)
    {
        clear();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "workspace/user/get",
            dataType: 'json',
            data: {
                user_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_user_id").val(pID);
                    $("#lbl_full_name").text(res.salutation_name + " " + res.full_name);
                    $("#lbl_mobile_phone").text(res.mobile_phone);
                    $("#lbl_email").text(res.email);
                    $("#lbl_address").text(res.address);
                    $("#lbl_company_name").text(res.company_name);
                    $("#lbl_company_registration").text(res.company_registration);
                    $("#lbl_company_man_power").text(res.company_man_power);
                    $('input[name="rdb_status"][value="' + res.status + '"]').prop('checked', true);
                    $("#lbl_add_new").html("Delete record");
                    $("#btnOK").hide();
                    $("#btnDelete").show();
                    $("#lbl_confirm").show();
                    
                    var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
                    $("body").append(appendthis);
                    $(".modal-overlay").fadeTo(500, 0.7);
                    $('#popupForm').fadeIn($(this).data());

                }
            }
        });
    }

    function keydown(e)
    {
        var code = e.which; // recommended to use e.which, it's normalized across browsers
        if(code==13){
            e.preventDefault();
            if ($("#btnOK").is(":visible"))
            {
                $("#btnOK").click();    
            }
            else
            {
                $("#btnDelete").click();
            }
        }
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
            <h1 class="page-header">Borrower List
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Salutation</th>
                        <th class="all">Name</th>
                        <th>Contact</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="hidden">Status(Hidden)</th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($borrower_list); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td><?php echo $borrower_list[$i]->salutation_name; ?></td>
                        <td class="all"><?php echo $borrower_list[$i]->full_name; ?></td>
                        <td><?php echo $borrower_list[$i]->mobile_phone; ?><br /><?php echo $borrower_list[$i]->email; ?></td>
                        <td><?php echo $borrower_list[$i]->company_name; ?><br /><?php echo $borrower_list[$i]->company_registration; ?></td>
                        <td><?php if ($borrower_list[$i]->status == 1) {echo '<span class="text-active">Active</span>';} else {echo '<span class="text-inactive">In-active</span>';} ?></td>
                        <td><?php echo $borrower_list[$i]->created_date; ?></td>
                        <td class="hidden"><?php echo $borrower_list[$i]->status; ?></td>
                        <td class="all">
                            <button class="btn btn-success btn-xs" onclick="edit(<?php echo $borrower_list[$i]->user_id; ?>);">Edit</button>
                            <button class="btn btn-danger btn-xs" onclick="del(<?php echo $borrower_list[$i]->user_id; ?>);">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>    


<form action="<?php echo base_url(); ?>workspace/user/update/borrower" id="myform" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Add new record</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body" style="max-height:300px;overflow-y: auto">
        <div class="row">
            <p id="lbl_message" class="alert alert-danger">The Full Name field is required.</p>
            <p id="lbl_confirm" class="alert alert-warning">Are you sure you want to delete this record?</p>
        </div>
        <div class="row">
            <div class="col-sm-4">
                Full Name:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_full_name" class="normal"></label>
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Mobile Phone:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_mobile_phone" class="normal"></label>
            </div>    
        </div>
        <div class="row">
            <div class="col-sm-4">
                Email:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_email" class="normal"></label>
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Address:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_address" class="normal"></label>
            </div>    
        </div>  
        <div class="row">
            <div class="col-sm-4">
                Company Name:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_company_name" class="normal"></label>
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-4">
                Registration No.:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_company_registration" class="normal"></label>
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Man Power:
            </div>            
            <div class="col-sm-8">
                <label id="lbl_company_man_power" class="normal"></label>
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Status: 
            </div>            
            <div class="col-sm-8">
                <input type="radio" name="rdb_status" value="1" checked="checked" /> Active &nbsp;&nbsp;
                <input type="radio" name="rdb_status" value="0" /> Inactive
            </div>    
        </div>        
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK">Insert</button>
      <button type="button" class="js-modal-close btn btn-info" id="btnDelete">Confirm Delete</button>
    </footer>
</div>
<input type="hidden" id="h_user_id" name="h_user_id" value="0">
<input type="hidden" id="h_full_name" name="h_full_name" value="">
</form>
