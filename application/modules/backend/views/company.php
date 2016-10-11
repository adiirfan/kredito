
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Company <?php echo $segment; ?></h3>
				   <div class="row">
					<div class="col-md-3">
					
					</div>
					<div class="col-md-2 col-md-push-7">
				<a href="<?php echo base_url() ?>backend/company/company_form">	<button class="btn btn-block btn-info btn-flat" >Add New</button></a>
					</div>
				  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
						<th>No</th>
                        <th>Company Code</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>Company Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($company as $row){
					?>
                      <tr>
                        <td><?php echo $z; ?></td>
                        <td><?php echo $row['company_code']; ?></td>
                        <td><?php echo $row['company_name']; ?></td>
                        <td><?php echo $row['company_email']; ?></td>
                        <td><img src="<?php echo base_url(); ?>uploads/company/<?php echo $row['company_image']; ?>" width="50px" height="20px"></td>
						<td>
						<a href="<?php echo base_url() ?>backend/company/company_form/<?php echo $row['company_id']  ?>">
						<i class="fa fa-fw fa-pencil" style="font-size:20px;color:yellow;"></i>
						
						<a href="javascript:;" onclick="detail_data('<?php echo $row['company_id'] ?>','delete')">
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
<div class="modal fade custom-width" id="delete-company">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Are You Sure Delete This Data</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="company_id" placeholder="" READONLY class="form-control" > 
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
		//jQuery('#delete-company').modal('show'); 
//alert(aksi+id);
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('backend/company/show_company/')?>/" + id,
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
				 $('[name="company_id"]').val(data.company_id);
				jQuery('#delete-company').modal('show'); 
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
        url = "<?php echo site_url('product_main/add_product_main/')?>";
	  }else if(aksi == 'delete'){
		   url = "<?php echo site_url('backend/company/delete_company/')?>";
	  }else if(aksi == 'add'){
		  url = "<?php echo site_url('product_main/add_p roduct_main')?>";
		 
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

     