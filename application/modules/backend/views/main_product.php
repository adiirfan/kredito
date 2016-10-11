
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Main Product</h3>
				   <div class="row">
					<div class="col-md-3">
				
					</div>
					<div class="col-md-2 col-md-push-7">
					<a href="javascript:;" onclick="detail_data('0','add')">
				<button class="btn btn-block btn-info btn-flat" >Add New</button>
				</a>
					</div>
				  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
						<th>No</th>
                        <th>Product Main Code</th>
                        <th>Product Main Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($main_product as $row){
					?>
                      <tr>
                        <td><?php echo $z; ?></td>
                        <td><?php echo $row['product_main_code']; ?></td>
                        <td><?php echo $row['product_main_name']; ?></td>
                       
						<td>
						<a href="javascript:;" onclick="detail_data('<?php echo $row['product_main_id'] ?>','edit')">
						<i class="fa fa-fw fa-pencil" style="font-size:20px;color:yellow;"></i>
						
						<a href="javascript:;" onclick="detail_data('<?php echo $row['product_main_id'] ?>','delete')">
						<i class="fa fa-fw fa-trash" style="font-size:20px;color:red;"></i>
						</td>
                      </tr>
					<?php $z++; }?>
                      
                   
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		
	<!-- Modal -->
  <div class="modal fade" id="form-main-product" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Product</h4>
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
              <div class="col-md-6">
                <input name="product_main_id" placeholder="" READONLY class="form-control" type="hidden">
              </div>
            </div>
			<div class="form-group">
			<label class="control-label col-md-3">Product Main Name</label>
			<div class="col-md-6">
			 <input name="product_main_name" placeholder="Product main name"  class="form-control" type="text">
			</div>
			</div>
			
			<div class="form-group">
			<label class="control-label col-md-3">Product Main Code</label>
			<div class="col-md-6">
			 <input name="product_main_code" placeholder="Product main code"  class="form-control" type="text">
			</div>
			</div>
			
		  </div>
		 </form>
        </div>
        <div class="modal-footer">
		   <button type="button" id="btnSave" onclick="save('add')" class="btn btn-primary"><div id="button">Add</div></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal -->	
<!-- Modal -->	
<div class="modal fade custom-width" id="delete-main-product">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Are You Sure Delete This Data</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="product_main_id" placeholder="" READONLY class="form-control" > 
              </div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="save('delete')" class="btn btn-danger">Delete</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->	
		<script>
function detail_data(id,aksi)
    {
		
	  var tes=null;
	  var tes2=0;
			 
			    $('[name="product_main_id"]').val(tes);
				$('[name="product_main_code"]').val(tes);
				$('[name="product_main_name"]').val(tes);
			 
			   document.getElementById("button").innerHTML = 'Add';
	   
//alert(aksi+id);
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('backend/product_main/show_product_main/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			// alert('Error get data from ajax');
						
			if(aksi == 'add'){
			
				jQuery('#form-main-product').modal('show'); 
				
				
			}else if(aksi == 'edit'){
				$('[name="product_main_id"]').val(data.product_main_id);
			    $('[name="product_main_code"]').val(data.product_main_code);
				$('[name="product_main_name"]').val(data.product_main_name);
				jQuery('#form-main-product').modal('show'); 
				 document.getElementById("button").innerHTML = 'Edit';
			}else{
				 $('[name="product_main_id"]').val(data.product_main_id);
				jQuery('#delete-main-product').modal('show'); 
			}
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
		 
    }
	
	
	 function save(aksi)
    {
		
		
      var url;
        if(aksi == 'edit') 
      {
        url = "<?php echo site_url('backend/product_main/add_product_main/')?>";
	  }else if(aksi == 'delete'){
		   url = "<?php echo site_url('backend/product_main/delete_product_main/')?>";
	  }else if(aksi == 'add'){
		  url = "<?php echo site_url('backend/product_main/add_product_main')?>";
		 
	  }
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               
   
			 if(aksi == 'edit') 
			{
					 jQuery('#form-company-product').modal('hide'); 
			} if(aksi == 'add') 
			{
					 jQuery('#form-main-product').modal('hide'); 
			}else{
					jQuery('#delete-main-product').modal('hide'); 
			}
           // reload_table();
			     location.reload();
			   
              
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
</script>

     
     