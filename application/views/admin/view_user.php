<script type="text/javascript">

    $(document).ready(function() {

        $("#popupForm").draggable();

        var table = $('#tbl').DataTable({
            "dom": '<"dataTables_CustomFilter">lrtip'
        });

        $("div.dataTables_CustomFilter").html(
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl"></label>' +
            '<label>Status:<select id="cbo_filter_status" class="form-control" aria-controls="tbl"><option value="">All</option><option value="1">Active</option><option value="0">In-active</option></select></label>');

        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
            save_filter(1001, $('#txt_filter').val(), $('#cbo_filter_status').val());
        });

        $('#cbo_filter_status').on( 'change', function () {
            table.columns(7).search( this.value ).draw();
            save_filter(1001, $('#txt_filter').val(), $('#cbo_filter_status').val());
        });

        load_filter(1001);

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
            $("#lbl_message").hide();
            
            var message = "";
            if ($("#txt_email").val().trim() == "")
            {
                message = "The Email field is required. <br />";
            }
            else
            {
                if (!isValidEmailAddress($("#txt_email").val()))
                {
                    message = "The Email field is not valid. <br />";
                }
            }
            if ($("#txt_full_name").val().trim() == "")
            {
                message = message + "The Full Name field is required. <br />";
            }
            if ($("#cbo_user_group").val() == "0")
            {
                message = message + "The User Group field is required. <br />";
            }
            if (message != "")
            {
                $("#lbl_message").html(message);
                $("#lbl_message").show();
                return;
            }

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/user_profile/check",
                dataType: 'json',
                data: {
                    sys_user_id: $('#h_sys_user_id').val(),
                    email: $('#txt_email').val(),
                    full_name: '',
                    is_myprofile: 0},
                success: function(res) {
                    if (res)
                    {
                        if (res.is_exist == true)
                        {
                            $("#lbl_message").text("The Email has been used. Please try another Email.");
                            $("#lbl_message").show();
                            return;   
                        }
                        else
                        {
                            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                                $(".modal-overlay").remove();
                            });

                            $("#h_email").val($("#txt_email").val());
                            $("#h_full_name").val($("#txt_full_name").val());
                            $("#h_sys_user_group_id").val($("#cbo_user_group").val());
                            document.getElementById("myform").submit(); 
                        }
                    }
                }
            });
        });

        $("#btnDelete").click(function() 
        {
            $(this).unbind('myform').submit();

            $('#myform').attr('action', '<?php echo base_url(); ?>admin/user_profile/delete');
            document.getElementById("myform").submit(); 
        });

    });

    function clear()
    {
        $("#lbl_message").hide();
        $("#h_sys_user_id").val("0");
        $("#h_email").val("");
        $("#txt_email").val("");
        $("#h_full_name").val("");
        $("#txt_full_name").val("");
        $("#cbo_user_group").val("0");
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
            url: "<?php echo base_url(); ?>" + "admin/user_profile/get",
            dataType: 'json',
            data: {
                sys_user_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_sys_user_id").val(pID);
                    $("#txt_email").val(res.email);
                    $("#txt_full_name").val(res.full_name);
                    $("#cbo_user_group").val(res.sys_user_group_id);
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
            url: "<?php echo base_url(); ?>" + "admin/user_profile/get",
            dataType: 'json',
            data: {
                sys_user_id: pID},
            success: function(res) {
                if (res)
                {
                    $("#h_sys_user_id").val(pID);
                    $("#h_full_name").val(res.full_name);
                    $("#txt_email").val(res.email);
                    $("#txt_full_name").val(res.full_name);
                    $("#cbo_user_group").val(res.sys_user_group_id);
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
            <h1 class="page-header">User Profile
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
                        <th class="all">Email</th>
                        <th>Full Name</th>
                        <th>User Group</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th class="hidden">Status(Hidden)</th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($userlist); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $userlist[$i]->email; ?></td>
                        <td><?php echo $userlist[$i]->full_name; ?></td>
                        <td><?php echo $userlist[$i]->group_name; ?></td>
                        <td><?php if ($userlist[$i]->status == 1) {echo '<span class="text-active">Active</span>';} else {echo '<span class="text-inactive">In-active</span>';} ?></td>
                        <td><?php echo $userlist[$i]->created_user; ?></td>
                        <td><?php echo $userlist[$i]->created_date; ?></td>
                        <td class="hidden"><?php echo $userlist[$i]->status; ?></td>
                        <td class="all">
                            <button class="btn btn-success btn-xs" onclick="edit(<?php echo $userlist[$i]->sys_user_id; ?>);">Edit</button>
                            <button class="btn btn-danger btn-xs" onclick="del(<?php echo $userlist[$i]->sys_user_id; ?>);">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<form action="<?php echo base_url(); ?>admin/user_profile/add" id="myform" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Add new record</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body">
        <div class="row">
            <p id="lbl_message" class="alert alert-danger">The Email field is required.</p>
            <p id="lbl_confirm" class="alert alert-warning">Are you sure you want to delete this record?</p>
        </div>
        <div class="row">
            <div class="col-sm-3">
                Email:
            </div>            
            <div class="col-sm-9">
                <input type="text" id="txt_email" name="txt_email" onkeydown="keydown(event);" maxlength="255" class="form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-3">
                Full Name:
            </div>            
            <div class="col-sm-9">
                <input type="text" id="txt_full_name" name="txt_full_name" onkeydown="keydown(event);" maxlength="255" class="form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-3">
                User Group:
            </div>            
            <div class="col-sm-9">
                <select id="cbo_user_group" class="form-control">
                    <?php 
                    echo '<option value="0">- Select -</option>';
                    for ($i = 0; $i < count($usergrouplist); ++$i)
                    { 
                      echo '<option value="'.$usergrouplist[$i]->sys_user_group_id.'">'.$usergrouplist[$i]->group_name.'</option>';
                    }
                    ?>
                </select>
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-3">
                Status: 
            </div>            
            <div class="col-sm-9">
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
<input type="hidden" id="h_sys_user_id" name="h_sys_user_id" value="0">
<input type="hidden" id="h_email" name="h_email" value="">
<input type="hidden" id="h_full_name" name="h_full_name" value="">
<input type="hidden" id="h_sys_user_group_id" name="h_sys_user_group_id" value="0">
</form>