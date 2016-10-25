
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
            save_filter(2001, $('#txt_filter').val(), $('#cbo_filter_status').val());
        });

        $('#cbo_filter_status').on( 'change', function () {
            table.columns(5).search( this.value ).draw();
            save_filter(2001, $('#txt_filter').val(), $('#cbo_filter_status').val());
        });

        load_filter(2001);

    } );

    function get_filter(pArray)
    {
        $('#txt_filter').val(pArray[0]);
        $('#cbo_filter_status').val(pArray[1]);

        var table = $('#tbl').DataTable();
        table.search(pArray[0]).draw();
        table.columns(5).search(pArray[1]).draw();
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
            $("#lbl_message").hide();
            
            if ($("#txt_salutation_name").val().trim() == "")
            {
                $("#lbl_message").text("The Salutation Name field is required.");
                $("#lbl_message").show();
                return;   
            }

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "configuration/salutation/check",
                dataType: 'json',
                data: {
                    salutation_id: $('#h_salutation_id').val(),
                    salutation_name: $('#txt_salutation_name').val()},
                success: function(res) {
                    if (res)
                    {
                        if (res.is_exist == true)
                        {
                            $("#lbl_message").text("The Salutation Name is exists. Please try another Salutation Name.");
                            $("#lbl_message").show();
                            return;   
                        }
                        else
                        {
                            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                                $(".modal-overlay").remove();
                            });
                            $("#h_salutation_name").val($("#txt_salutation_name").val());
                            document.getElementById("myform").submit(); 
                        }
                    }
                }
            });
        });

        $("#btnDelete").click(function() 
        {
            $(this).unbind('myform').submit();

            $('#myform').attr('action', '<?php echo base_url(); ?>configuration/salutation/delete');
            document.getElementById("myform").submit(); 
        });

    });

    function clear()
    {
        $("#lbl_message").hide();
        $("#h_salutation_id").val("0");
        $("#h_salutation_name").val("");
        $("#txt_salutation_name").val("");
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
            url: "<?php echo base_url(); ?>" + "configuration/salutation/get",
            dataType: 'json',
            data: {
                salutation_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_salutation_id").val(pID);
                    $("#txt_salutation_name").val(res.salutation_name);
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
            url: "<?php echo base_url(); ?>" + "configuration/salutation/get",
            dataType: 'json',
            data: {
                salutation_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_salutation_id").val(pID);
                    $("#h_salutation_name").val(res.salutation_name);
                    $("#txt_salutation_name").val(res.salutation_name);
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
            <h1 class="page-header">Salutation
            <a href="#" data-modal-id="popupForm" onclick="add();" id="btn_add_new" class="btn btn-info">Add New <i class="fa fa-plus"></i></a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="all">Salutation Name</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th class="hidden">Status(Hidden)</th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($salutationlist); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $salutationlist[$i]->salutation_name; ?></td>
                        <td><?php if ($salutationlist[$i]->status == 1) {echo '<span class="text-active">Active</span>';} else {echo '<span class="text-inactive">In-active</span>';} ?></td>
                        <td><?php echo $salutationlist[$i]->created_user; ?></td>
                        <td><?php echo $salutationlist[$i]->created_date; ?></td>
                        <td class="hidden"><?php echo $salutationlist[$i]->status; ?></td>
                        <td class="all">
                            <button class="btn btn-success btn-xs" onclick="edit(<?php echo $salutationlist[$i]->salutation_id; ?>);">Edit</button>
                            <button class="btn btn-danger btn-xs" onclick="del(<?php echo $salutationlist[$i]->salutation_id; ?>);">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>    


<form action="<?php echo base_url(); ?>configuration/salutation/add" id="myform" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Add new record</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body" style="max-height:300px;overflow-y: auto">
        <div class="row">
            <p id="lbl_message" class="alert alert-danger">The Salutation Name field is required.</p>
            <p id="lbl_confirm" class="alert alert-warning">Are you sure you want to delete this record?</p>
        </div>
        <div class="row">
            <div class="col-sm-4">
                Salutation Name:
            </div>            
            <div class="col-sm-8">
                <input type="text" id="txt_salutation_name" name="txt_salutation_name" onkeydown="keydown(event);" maxlength="255" class="form-control" />
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
<input type="hidden" id="h_salutation_id" name="h_salutation_id" value="0">
<input type="hidden" id="h_salutation_name" name="h_salutation_name" value="">
</form>
