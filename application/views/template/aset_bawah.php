
  <script src="<?php //echo base_url('assets_backend/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets_backend/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets_backend/plugins/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets_backend/plugins/datatables/dataTables.bootstrap.min.js')?>"></script> 
  <script src="<?php echo base_url('assets_backend/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
  <script src="<?php echo base_url('assets_backend/plugins/fastclick/fastclick.min.js')?>"></script>
  <script src="<?php echo base_url('assets_backend/dist/js/app.min.js')?>"></script> 
  <script src="<?php echo base_url('assets_backend/dist/js/demo.js')?>"></script>
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
	  
    </script>
	 <script>
     $('#table1').dataTable( {
    "bProcessing": true,
    "sAjaxSource": "<?php echo site_url('company_product/get_company_product1')?>",
    "sAjaxDataProp": "data"
} );
var table11;
	  table11 =  $('#tableproduct').dataTable( {
    
	"ajax": {
            "url": "<?php echo site_url('backend/company_product/get_company_product/?kategory=1')?>",
            "type": "POST"
        },
   
    "sAjaxDataProp": "data"
} );
var table12;
	  table12 =  $('#tableproperty').dataTable( {
    
	"ajax": {
            "url": "<?php echo site_url('backend/company_product/get_company_product/?kategory=2')?>",
            "type": "POST"
        },
   
    "sAjaxDataProp": "data"
} );
setInterval( function () {
    table11.ajax.reload( null, false ); // user paging is not reset on reload
}, 10000 );


var table11;
    $(document).ready(function() {
      table11 = $('#tableproductpp').DataTable({ 
        "paging": true,
        
          "ordering": true,
          "info": true,
         
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('company_product/get_company_product')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });
	
	$(document).ready(function() {
    $('#tableproduct5').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo site_url('company_product/get_company_product')?>"
    } );
} );

    </script>
	
	
	
