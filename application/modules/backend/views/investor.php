
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data <?php echo $segment; ?></h3>
				   <div class="row">
					<div class="col-md-3">
					
					</div>
					<div class="col-md-2 col-md-push-7">
				
					</div>
				  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th>No</th>
                        
                        <th>Investor</th>
                        <th>Kontak</th>
                        <th><p>Total</p>Deposit</th>
						<th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					 <?php for ($i = 0; $i < count($investor_list); ++$i) { 
					 $status= $this->model_backend->status_investor( $investor_list[$i]->status);
					 $fund= $this->model_investment->get_total_fund($investor_list[$i]->user_id);
					
					 
					if( $fund->total == 0){
						$totalfund=0;
					}else{
						$totalfund=$fund->total;
					}
					 ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                      
                        <td><?php echo $investor_list[$i]->full_name; ?></td>
                        <td><?php echo $investor_list[$i]->mobile_phone; ?><br /><?php echo $investor_list[$i]->email; ?></td>
                        <td>Rp <?php  echo  $this->model_backend->rupiah($totalfund); ?></td>
						 <td> <?php echo $status ?></td>
                       
                   
                        <td class="all">
						
                            <button class="btn btn-info btn-xs btn-block"  onclick="detail_data('<?php echo $investor_list[$i]->user_id; ?>','edit')">Update Status</button>
							<a href="<?php echo base_url(); ?>backend/investor/detail/<?php echo $investor_list[$i]->user_id; ?>" <button class="btn btn-success btn-xs btn-block" >Detail</button>
                        </td>
                    </tr>
                    <?php } ?>
                   
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<!-- Modal -->
  <div class="modal fade" id="form-investor" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Status Investor</h4>
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
              <div class="col-md-6">
                <input name="user_id" placeholder="" READONLY class="form-control" type="hidden">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Ubah Status</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="status" id="status">
			<option value="0">Pilih Status</option>
			<option value="3">Setujui</option>
			<option value="1">Reject</option>
			</select>
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

		<script>
function detail_data(id,aksi)
    {
		
	//  var tes=null;
	 // var tes2=0;
			 
		//	    $('[name="product_main_id"]').val(tes);
		//		$('[name="product_main_code"]').val(tes);
		//		$('[name="product_main_name"]').val(tes);
			 
			   document.getElementById("button").innerHTML = 'Add';
	   
//alert(aksi+id);
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('backend/investor/show_data')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			// alert('Error get data from ajax');
						
			if(aksi == 'add'){
			
				jQuery('#form-main-product').modal('show'); 
				
				
			}else if(aksi == 'edit'){
				$('[name="user_id"]').val(data.user_id);
			   
				jQuery('#form-investor').modal('show'); 
				 document.getElementById("button").innerHTML = 'Ubah Status';
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
     url = "<?php echo site_url('backend/investor/delete_product_main/')?>";
	  }else if(aksi == 'delete'){
		 url = "<?php echo site_url('backend/investor/delete_product_main/')?>";
	  }else if(aksi == 'add'){
		  url = "<?php echo site_url('backend/investor/update_investor/')?>";
		 
	  }
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               
 //  alert(data.status2);
			
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
