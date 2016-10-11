
<script type="text/javascript">

  /* Custom filtering function which will search data in column four between two values */


    $(document).ready(function() {

        var table = $('#tbl').DataTable({
            "dom": '<"dataTables_CustomFilter">lrtip'
        });


        $("div.dataTables_CustomFilter").html(
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl"></label>' +
            '<label>Menu:<select id="cbo_filter_menu" class="form-control" aria-controls="tbl"><?php echo $option_menu; ?></select></label>' +
            '<label>User:<select id="cbo_filter_user" class="form-control" aria-controls="tbl"><?php echo $option_user; ?></select></label>');

        // Event listener to the two range filtering inputs to redraw on input
        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
            save_filter(1003, $('#txt_filter').val(), $('#cbo_filter_menu').val(), $('#cbo_filter_user').val());
        });

        $('#cbo_filter_menu').on( 'change', function () {
            table.columns(6).search( this.value ).draw();
            save_filter(1003, $('#txt_filter').val(), $('#cbo_filter_menu').val(), $('#cbo_filter_user').val());
        });

        $('#cbo_filter_user').on( 'change', function () {
            table.columns(7).search( this.value ).draw();
            save_filter(1003, $('#txt_filter').val(), $('#cbo_filter_menu').val(), $('#cbo_filter_user').val());
        });

        load_filter(1003);

    } );

    function get_filter(pArray)
    {
        $('#txt_filter').val(pArray[0]);
        $('#cbo_filter_menu').val(pArray[1]);
        $('#cbo_filter_user').val(pArray[3]);

        var table = $('#tbl').DataTable();
        table.search(pArray[0]).draw();
        table.columns(6).search(pArray[1]).draw();
        table.columns(7).search(pArray[2]).draw();
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
            <h1 class="page-header">Activity Log
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="all">Menu</th>
                        <th class="all">Action</th>
                        <th>Record</th>
                        <th>User</th>
                        <th>Date</th>
                        <th class="hidden">Menu ID</th>
                        <th class="hidden">User ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($activityloglist); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $activityloglist[$i]->menu_name; ?></td>
                        <td class="all"><?php echo $activityloglist[$i]->action; ?></td>
                        <td><?php echo $activityloglist[$i]->action_name; ?></td>
                        <td><?php echo $activityloglist[$i]->created_user; ?></td>
                        <td><?php echo $activityloglist[$i]->date; ?></td>
                        <td class="hidden"><?php echo $activityloglist[$i]->menu_id; ?></td>
                        <td class="hidden"><?php echo $activityloglist[$i]->user_id; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
         
