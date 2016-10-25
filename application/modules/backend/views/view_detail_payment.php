        <section class="content">
          <div class="row">
            <div class="col-xs-6">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Jadwal Pembayaran  </h3>
				   <div class="row">
					<div class="col-md-3">
				
					</div>
					<div class="col-md-2 col-md-push-7">
					<a href="javascript:;" onclick="detail_data('0','add')">
				
				</a>
					</div>
				  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
							<th>No</th>
                        <th>Jadwal</th>
                        <th>Pinjaman</th>
						<th>Suku bunga</th>
						<th>Cicilan</th>
						<th>Jumlah Bunga</th>
						<th>Bayar</th>
						
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($repayment as $row){
						 
					?>
                     <tr>
                        <td><?php echo $z; ?></td>
						 <td><?php echo $row['schedule']; ?></td>
						  <td><?php echo $row['total_bid_amount']; ?></td>
						   <td>
						<?php echo $row['interest'].' %'; ?>
						</td>
						<td>Rp <?php echo $row['balance']; ?></td>
						<td> <?php echo $row['balance']; ?></td>
						<td><button class="btn btn-success btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_repayment_id'] ?>','bayar')">Bayar</button></td>
                     </tr>
					<?php $z++; }?>
                     
                   
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
			   <div class="col-xs-6">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pembayaran</h3>
				   <div class="row">
					<div class="col-md-3">
				
					</div>
					<div class="col-md-2 col-md-push-7">
					<a href="javascript:;" onclick="detail_data('0','add')">
				
				</a>
					</div>
				  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
							<th>No</th>
                        <th>Dibayar</th>
                        <th>Pinjaman</th>
						<th>Suku bunga</th>
						<th>Dibayarkan</th>
						<th>Sisa Pembayaran</th>
						
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($repayment as $row){
					?>
                     <tr>
                        <td><?php echo $z; ?></td>
						 <td><?php echo $row['schedule_2']; ?></td>
						  <td><?php echo $row['total_bid_amount']; ?></td>
						   <td>
						<?php echo $row['interest']; ?>
						</td>
						<td>Rp <?php echo $row['instalment_2']; ?></td>
						<td> <?php echo $row['balance_2']; ?></td>
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
 <!-- Modal -->
  <div class="modal fade custom-width" id="form-payment" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Status Pengajuan</h4>
		
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
			<label class="control-label col-md-3"></label>
              <div class="col-md-6">
			   <input name="loan_repayment_id" placeholder="" READONLY class="form-control" type="hidden">
              
				
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Pinjaman</label>
              <div class="col-md-6">
               <input name="principal" placeholder="" READONLY class="form-control" type="text">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Tanggal dibayar</label>
              <div class="col-md-6">
               <input name="schedule_2" placeholder=""  class="form-control" type="text">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Jumalah bayar</label>
              <div class="col-md-6">
               <input name="instalment_2" placeholder="" class="form-control" type="text">
              </div>
            </div>
			
		</div>
		  </div>
		 </form>
        
        <div class="modal-footer">
		   <button type="button" id="btnSave" onclick="save('edit')" class="btn btn-primary">Update Status</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</div>
		</div>
     </div>


<!-- Modal -->	

<!-- Modal -->
 
		<script>
		function toRp(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp. ' + rev2.split('').reverse().join('') + '';
}
function detail_data(id,aksi)
    {
		//alert(id);
	  var tes=null;
	  var tes2='11';
	  var urlaksi;
	 // $('[name="loan_id"]').val(data.loan_id);
	  
	  if(aksi == 'download'){
		  urlaksi="<?php echo base_url('backend/submission_loan/show_document_loan/')?>/";
	  }else if (aksi == 'bayar'){
		  
		  urlaksi="<?php echo base_url('backend/payment/show_payment')?>/";
	  }else{
		   urlaksi="<?php echo base_url('backend/submission_loan/show_submission_loan_business/')?>/";
	  }
//alert(aksi+id);
      //Ajax Load data from ajax
      $.ajax({
        url : urlaksi + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
				$('[name="loan_repayment_id"]').val(data.loan_repayment_id);
				$('[name="schedule_2"]').val(data.schedule_2);
				$('[name="principal_2"]').val(data.principal_2);
				$('[name="principal"]').val(data.principal);
				
				 $('[name="interest_2"]').val(data.interest);
				 $('[name="instalment_2"]').val(data.instalment_2);
			// alert('Error get data from ajax');
						
			if(aksi == 'detail'){
				
				
				
			}else if(aksi == 'bayar'){
				
				jQuery('#form-payment').modal('show'); 
				 
			}else if(aksi == 'download'){
				
				$.each(data, function(i, item){
               datafoldercode = item.folder_code;
			
              
            });
				$.each(data, function(i, item){
               data[i] = item.file_name;
            });
				
				//alert(data[2]+'- '+datafoldercode);
				
				
			document.getElementById('ktp').innerHTML ='<a href="<?php echo base_url();?>upload/loan/'+datafoldercode+'/aa/files/'+data[0]+'">Download KTP</a>';
			document.getElementById('npwp').innerHTML ='<a href="<?php echo base_url();?>upload/loan/'+datafoldercode+'/la/files/'+data[1]+'">Download NPWP</a>';
			document.getElementById('siup').innerHTML ='<a href="<?php echo base_url();?>upload/loan/'+datafoldercode+'/ma/files/'+data[2]+'">Download SIUP</a>';
				jQuery('#form-download-document').modal('show'); 
			}
			else{
				//$('[name="loan_id"]').val(data.loan_id);
				document.getElementById('amount').innerHTML = data.amount;
				jQuery('#delete-submission').modal('show'); 
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
		
		//alert(aksi);
      var url;
        if(aksi == 'edit') 
      {
        url = "<?php echo site_url('backend/payment/update_payment')?>";
	  }else if(aksi == 'delete'){
		   url = "<?php echo site_url('backend/submission_loan/delete_submission_business/')?>";
	  }else if(aksi == 'add'){
		  url = "<?php echo site_url('backend/submission_loan/add_product_main')?>";
		 
	  }
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
             //get value json  
			
			//alert(data.status2);
			 
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

     
     