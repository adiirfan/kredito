
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Company Product</h3><br><br>
				  <div class="row">
				
					<div class="col-md-3">
					  <!--
					<select onchange="getKategory(this.value);" class="form-control col-xs-2"  name="kategory"    required="required">
							<option value="">--Select Product Category</option>
							<?php //foreach($product as $data){ ?>
							<option value="<?php //echo $data['product_id'] ?>"><?php //echo $data['product_name']; ?></option>
							<?php //} ?>
					</select>
					-->
					</div>
					
					<div class="col-md-2 col-md-push-7">
					<a href="javascript:;" onclick="detail_data('0','add')">
				<button class="btn btn-block btn-info btn-flat" >Add New</button>
				</a>
					</div>
				  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
				<div id="kategori">
                  <table id="<?php echo $table; ?>" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
						<th>No</th>
						<th>Company</th>
                        <th>Product name</th>
						   <th>Interest Rate</th>
						<?php if($table=='tableproperty'){
							?>
							  <th>Plafon</th>
                        <th>Pinalty Periode</th>
							<?php
						}else if($table=='tableproduct') { ?>
                        <th>Down Payment</th>
                     
						  <th>Condition</th>
						<?php } ?>
                      
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					
                   
                    </tbody>
                   
                  </table>
				  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		

   
 <!-- Modal -->
  <div class="modal fade" id="add-company-product" role="dialog">
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
                <input name="company_product_id" placeholder="" READONLY class="form-control" type="hidden">
              </div>
            </div>
			<div class="form-group">
			<label class="control-label col-md-3">Company Name</label>
			<div class="col-md-6">
			<select class="form-control col-md-3" name="company" id="company">
			 <option value="0">-- Select Company --</option>
			<?php foreach($company as $row){ ?>
			<option value="<?php echo $row['company_id'] ?>"><?php echo $row['company_name'] ?></option>
			<?php } ?>
			</select>
			</div>
			</div>
			<div class="form-group">
              <label class="control-label col-md-3">Product Name</label>
              <div class="col-md-6">
                <input name="product_name" placeholder="Product name" class="form-control" type="text">
              </div>
            </div>
			<div class="form-group">
			<label class="control-label col-md-3">Kategory Product</label>
			<div class="col-md-6">
			<select class="form-control col-md-3" name="product" id="product">
			<?php foreach($product as $row){ ?>
			<option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></option>
			
			<?php } ?>
			</select>
			</div>
			</div>
			<div class="form-group">
              <label class="control-label col-md-3">Interest Rate</label>
              <div class="col-md-6">
                <input name="interest_rate" id="interest_rate" placeholder="Interest Rate"  class="form-control" type="text">
              </div>
            </div>
			<?php if($table=='tableproduct'){
							?>
			<div class="form-group">
              <label class="control-label col-md-3">Down Payment</label>
              <div class="col-md-6">
                <input name="down_payment" placeholder="Down Payment" id="down_payment"  class="form-control" type="text">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Tenor</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="tenor" id="tenor">
			   <option value="0">-- Select Tenor --</option>
			<option value="1">1 Tahun</option>
			<option value="2">2 Tahun</option>
			<option value="3">3 Tahun</option>
			<option value="4">4 Tahun</option>
			<option value="5">5 Tahun</option>
			</select>
              </div>
            </div>
			<div class="form-group">
			<label class="control-label col-md-3">Condition</label>
			<div class="col-md-6">
			<select class="form-control col-md-3" name="condition" id="condition">
			 <option value="0">-- Select Condition --</option>
			<option value="1">Baru</option>
			<option value="2">Bekas</option>
			</select>
			</div>
			</div>
			<?php }else if($table=='tableproperty'){
				?>
				<div class="form-group">
              <label class="control-label col-md-3">Plafon Loan</label>
              <div class="col-md-6">
                <input name="plafon_loan" placeholder="Plafon Loan" required id="plafon_loan" class="form-control" type="text">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Tenor</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="tenor" id="tenor">
			   <option value="0">-- Select Tenor --</option>
			   <?php $i=1; while ($i <= 25){ ?>
			    <option value="<?php echo $i ?>"><?php echo $i ?> Tahun</option>
				<?php 
				$i++;				   
			   } ?>
			</select>
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Pinalty Periode</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="pinalty" id="pinalty">
			   <option value="0">-- Free Periode Pinalty --</option>
			   
			    <?php $i=1; while ($i <= 15){ ?>
			    <option value="<?php echo $i ?>"><?php echo $i ?> Tahun</option>
				<?php 
				$i++;				   
			   } ?>
			</select>
              </div>
            </div>
			<?php
			} ?>
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

<!-- Modal Delete -->
<div class="modal fade custom-width" id="delete-product">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Are You Sure Delete This Data</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="company_product_id" placeholder="ID License" READONLY class="form-control" type="text"> 
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
<!--
<button type="button" onclick="reload_table()" class="btn btn-danger">Delete</button>-->
 <script>
  
    </script>



<script>
 function reload_table()
    {
      table11.ajax.reload(null, false); //reload datatable ajax 
	  alert('tes');
    }
function getKategory(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("kategori").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>"+"backend/company_product2/?product_id="+id, true);
  xhttp.send();
}
</script>

<script>
function detail_data(id,aksi)
    {
		//save_method = 'update';
      //$('#form')[0].reset(); // reset form on modals
	  var tes=null;
	  var tes2=0;
			  $('[name="interest_rate"]').val(tes);
			  $("#company").val(tes2);
			  $('[name="company_product_id"]').val(tes);
			  $('[name="interest_rate"]').val(tes);
			 
			  $('[name="product_name"]').val(tes);
			   $('[name="plafon_loan"]').val(tes);
			  $("#tenor").val(tes2);
			   $("#condition").val(tes2);
			     $("#pinalty").val(tes2);
			  $("#product").val(tes);
			   document.getElementById("button").innerHTML = 'Add';
	   

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('backend/company_product/edit_company_product/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			// alert('Error get data from ajax');
						
			if(aksi == 'add'){
			
				jQuery('#add-company-product').modal('show'); 
				
				
			}else if(aksi == 'edit'){
				 $("#company").val(data.company_id);
			  $('[name="company_product_id"]').val(data.company_product_id);
			  $('[name="interest_rate"]').val(data.interest_rate);
			  $('[name="down_payment"]').val(data.down_payment);
			  $('[name="product_name"]').val(data.company_product_name);
			  $("#tenor").val(data.company_product_tenor);
			   $("#condition").val(data.company_product_condition);
			  $('[name="plafon_loan"]').val(data.plafon_loan);
			  $("#product").val(data.product_id);
			   $("#pinalty").val(data.periode_pinalty);
			   
				jQuery('#add-company-product').modal('show'); 
				 document.getElementById("button").innerHTML = 'Edit';
			}else{
				 $('[name="company_product_id"]').val(data.company_product_id);
				jQuery('#delete-product').modal('show'); 
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
        url = "<?php echo site_url('backend/company_product/add_company_product')?>";
	  }else if(aksi == 'delete'){
		   url = "<?php echo site_url('backend/company_product/delete_company_product')?>";
	  }else if(aksi == 'add'){
		  url = "<?php echo site_url('backend/company_product/add_company_product')?>";
		 
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
					 jQuery('#add-company-product').modal('hide'); 
			} if(aksi == 'add') 
			{
					 jQuery('#add-company-product').modal('hide'); 
			}else{
					jQuery('#delete-company-product').modal('hide'); 
			}
            //reload_table();
			     location.reload();
			   
              
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
</script>


