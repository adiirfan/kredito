
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
						 <th>Kode</th>
                        <th>Kontak</th>
                        <th>Pendanaan</th>
						<th>Tanggal</th>
						<th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					 <?php for ($i = 0; $i < count($investor_list); ++$i) { 
					 $status= $this->model_backend->status_investment( $investor_list[$i]->status);
					// $fund= $this->model_investment->get_total_fund($investor_list[$i]->user_id);
					 ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                      
                        <td><?php echo $investor_list[$i]->i_full_name; ?></td>
						 <td><?php echo $investor_list[$i]->code_investment; ?></td>
                        <td><?php echo $investor_list[$i]->i_mobile_phone; ?><br /><?php echo $investor_list[$i]->i_email; ?></td>
                        <td>Rp <?php echo $this->model_backend->rupiah($investor_list[$i]->fund) ; ?></td>
						<td><?php echo $investor_list[$i]->created_date; ?></td>
						 <td> <?php echo $status ?></td>
                       
                   
                        <td class="all">
						
                            <button class="btn btn-info btn-xs btn-block"  onclick="detail_data('<?php echo $investor_list[$i]->investment_id; ?>','edit')">Update Status</button>
						<!--	<button class="btn btn-success btn-xs btn-block"  onclick="detail_data('<?php echo $investor_list[$i]->investment_id; ?>','detail')">Detail</button>-->
						<a href="<?php echo base_url(); ?>upload/investment/<?php echo $investor_list[$i]->folder_code;?>/konfirmasi/files/<?php echo $investor_list[$i]->bukti_trf;?>">	<button class="btn btn-danger btn-xs btn-block" >Download</button></a>
							<!-- <button class="btn btn-danger btn-xs btn-block"  onclick="detail_data('<?php// echo $investor_list[$i]->investment_id; ?>','download')">Download</button>-->
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
          <h4 class="modal-title">Form Status Investment</h4>
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
              <div class="col-md-6">
                <input name="investment_id" placeholder="" READONLY class="form-control" type="hidden">
				<input name="investor_id" placeholder="" READONLY class="form-control" type="hidden">
				 <label class="control-label col-md-3"></label>
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Jumlah Investment</label>
              <div class="col-md-6">
             <input name="fund" placeholder="" READONLY class="form-control" type="text">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Kode Investment</label>
              <div class="col-md-6">
              <input name="code_investment" placeholder="" READONLY class="form-control" type="text">
			
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Nama Rekening</label>
              <div class="col-md-6">
              <input name="name_account_bank" placeholder="" READONLY class="form-control" type="text">
			
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Bank</label>
              <div class="col-md-6">
              <input name="bank_trf" placeholder="" READONLY class="form-control" type="text">
			
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Catatan</label>
              <div class="col-md-6">
              <input name="notes" placeholder="" READONLY class="form-control" type="text">
			
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Ubah Status</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="status" id="status">
			<option value="0">Pilih Status</option>
			<option value="3">Disetujui</option>
			<option value="4">Ditolak</option>
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

		<!-- Modal -->	
		<div class="modal fade custom-width" id="detail-submission">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Detail Investasi</h4>
					</div>
					<div class="modal-body">
						
						  <div class="row">
						   <div class="col-md-3">
						   </div>
					<div class="col-md-6">
					  <!-- Custom Tabs -->
					  <div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tab_1" data-toggle="tab">Bio</a></li>
						  <li><a href="#tab_2" data-toggle="tab">Product</a></li>
						  <li><a href="#tab_3" data-toggle="tab">Loan</a></li>
						  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
						</ul>
						<?php $bod='<h4 id="loan_bod"></h4>'; ?>
						<div class="tab-content">
						  <div class="tab-pane active" id="tab_1">
						  <table align="center">
							<tr><td width="200px"><h4>Nomor KTP </h4></td><td width="20px">:</td>  <td><h4 id="loan_nik"></h4></td></tr>
							<tr><td><h4>Name </h4></td> <td>:</td>  <td><h4 id="loan_name"></h4></td></tr>
							<tr><td><h4>Gender</h4> </td><td>:</td>   <td><h4 id="loan_gender"></h4></td></tr>
							<tr><td><h4>Phone </h4></td> <td>:</td>  <td><h4 id="loan_phone"></h4></td></tr>
							<tr><td><h4>Email </h4></td> <td>:</td>  <td><h4 id="loan_email"></h4></td></tr>
							<tr><td><h4>Address </h4></td><td>:</td>   <td><h4 id="loan_address"></h4></td></tr>
							<tr><td><h4>City	</h4> </td> <td>:</td>  <td><h4 id="loan_city"></h4></td></tr>
							<tr><td><h4>Place Of Birth </h4></td> <td>:</td>  <td><h4 id="loan_pod"></h4><?php echo $bod; ?><?php //echo $this->model_tanggal->validasitanggal(date());?></td></tr>
							<tr><td><h4>Postal Code</h4> </td><td>:</td><td><h4 id="loan_postal_code"></h4></td></tr>
						  </table>
						  <h4 id="loan_id"></h4>
						
						  
						  </div><!-- /.tab-pane -->
						  <div class="tab-pane" id="tab_2">
						  
							<table align="center">
							<tr><td width="200px"><h4>Product Name	 </h4></td><td width="20px">:</td>  <td width="200px"><h4 id="company_product_name"></h4></td></tr>
							<tr><td><h4>Product Category </h4></td> <td>:</td>  <td><h4 id="product_name"></h4></td></tr>
							<tr><td><h4><h4 id="label1"></h4>	</h4> </td><td>:</td>   <td><h4 id="hasillabel1"></h4></td></tr>
							<tr><td><h4>Interest Rate </h4></td> <td>:</td>  <td><h4 id="interest_rate"></h4></td></tr>
							<tr><td><h4>Tenor </h4></td> <td>:</td>  <td><h4 id="company_product_tenor"></h4></td></tr>
							<tr><td><h4><h4 id="label2"></h4>	 </h4></td><td>:</td>   <td><h4 id="hasillabel2"></h4></td></tr>
							
						
						  </table>

						  </div><!-- /.tab-pane -->
						  <div class="tab-pane" id="tab_3">
						  
							<div style=" margin-top: 10px; box-shadow: 0 0 2px black; padding:0 0px 0 0px;">
									<table class="table table-bordered" width="100%"  style="border-collapse: collapse;
										border: 0px solid black;
										 border-style: solid;
										border-color: #000;">
									<tr>
									<td colspan="2">
									<h4><b id="loan"></b></h4>
									</td>
									<td align="center" colspan="2">
									<b id="company_image"></b>
									<b id="company_product_name"></b>
									<p id="company_product_condition2"></p>
									</td>
									</tr>
									<tr><td><h4>Suku Bunga</h4><h4><font color="3E70C6"><b id="interest_rate2"></b>%</font></h4></td><td><h4>Cicilan Perbulan</h4><h4 id="loan_payment_month"></h4></td></tr>
									</table>
									<table class="table table-condensed" width="100%">
									<tr class="active"><td><p id="label11"></p></td><td><b><h4 id="hasillabel11"></h4></b></td></tr>
									<tr class="active"><td><p id="label22"></p></td><td><h4 id="hasillabel22"></h4></td></tr>
									</table>
									
							</div>

						  </div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
					  </div><!-- nav-tabs-custom -->
					</div><!-- /.col -->
					<div class="col-md-3">
						   </div>
					</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		
		<!-- Modal -->	
<div class="modal fade custom-width" id="form-download-document">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Download dokumen</h4>
				
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="loan_id" placeholder="" READONLY class="form-control" > 
				
              </div>
			
			<br>
				 <h2 align="center"> <div id="ktp"></div></h2><br>
			  <h2 align="center"> <div id="npwp"></div></h2><br>
			  <h2 align="center"> <div id="siup"></div></h2><br>
				</form>
			</div>
			
			<div class="modal-footer">
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
	    var urlaksi;
	 // $('[name="loan_id"]').val(data.loan_id);
	  
	  if(aksi == 'download'){
		  urlaksi="<?php echo base_url('backend/investment/show_document_investment/')?>/";
	  }else if (aksi == 'edit'){
		  
		  urlaksi="<?php echo base_url('backend/investment/show_data')?>/";
	  }else{
		   urlaksi="<?php echo base_url('backend/investment/show_data')?>/";
	  }
//alert(aksi+id);
      //Ajax Load data from ajax
      $.ajax({
        url : urlaksi + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			// alert('Error get data from ajax');
						
			if(aksi == 'detail'){
			
				jQuery('#form-main-product').modal('show'); 

			}else if(aksi == 'edit'){
				$('[name="investment_id"]').val(data.investment_id);
				$('[name="investor_id"]').val(data.investor_id);
				$('[name="code_investment"]').val(data.code_investment);
				$('[name="fund"]').val(data.fund);
				$('[name="name_account_bank"]').val(data.name_account_bank);
				$('[name="tgl_trf"]').val(data.tgl_trf);
				$('[name="bank_trf"]').val(data.bank_trf);					
				$('[name="notes"]').val(data.notes);
				
			   
				jQuery('#form-investor').modal('show'); 
				 document.getElementById("button").innerHTML = 'Ubah Status';
			}else if(aksi == 'download'){
				
				$.each(data, function(i, item){
               datafoldercode = item.folder_code;
			
              
            });
				$.each(data, function(i, item){
               data[i] = item.file_name;
            });
				
				//alert(data[2]+'- '+datafoldercode);
				
				
			document.getElementById('ktp').innerHTML ='<a href="<?php echo base_url();?>upload/investment/'+datafoldercode+'/ic/files/'+data[0]+'">Download KTP</a>';
			document.getElementById('npwp').innerHTML ='<a href="<?php echo base_url();?>upload/investment/'+datafoldercode+'/pa/files/'+data[1]+'">Download Bukti Pembayaran</a>';
			
				jQuery('#form-download-document').modal('show'); 
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
		  url = "<?php echo site_url('backend/investment/update_investment/')?>";
		 
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
