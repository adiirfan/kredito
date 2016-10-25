        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pengajuan Pinjaman Bisnis </h3>
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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
						<th>No</th>
                        <th>Referensi</th>
                        <th>Nama</th>
						<th>Kontak</th>
						<th>Pinjaman</th>
						<th>Total Bid</th>
						<th>Bid Tersedia</th>
						<th>Bid</th>
						<th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($loan as $row){
						 $jumlahbid= $this->model_bid->get_sum_bid($row['loan_id'],1);
						$status= $this->model_backend->status_submission($row['status']);
						$rupiah= $this->model_backend->rupiah($row['amount']);
						//$persentasi=round(($jumlahbid['sum(bid_amount)'] * 100) / $row['amount']);
							$doc= $this->model_backend->check_doc_upload($row['loan_id']);
					?>
                     <tr>
                        <td><?php echo $z; ?></td>
                        <td><?php echo $row['code']; ?></td>
                        <td><?php echo $row['b_full_name']; ?></td>
						 <td><?php echo '<p>'.$row['b_email'].'</p>'.$row['b_mobile_phone']; ?></td>
                        <td>Rp <?php echo $rupiah; ?>
						<p> <?php echo $row['period']; ?> Bulan</p>
						</td>
						 <td><?php echo $this->model_backend->rupiah($row['total_bid_amount']); ?></td>
						  <td><?php echo $this->model_backend->rupiah($row['available_bid_amount']); ?></td>
						 <td>
						 <div class="progress">  
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $row['progress_percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row['progress_percent']; ?>%"><?php echo $row['progress_percent']; ?>% Complete
                                </div>
                            </div>
						</td>
						<td>
						 <?php 
                        	switch ($row['status_suggest'])
                        	{
                        		case 0: { echo '<span class="label label-danger">Belum disuggest</span>'; break; }
                        		case 1: { echo '<span class="label label-danger">Telah disuggest</span>'; break; }
								case 2: { echo '<span class="label label-success">Disetujui</span>'; break; }
                        	}
                        ?>
						
						</td>
						<td>
						<!--
						<a href="javascript:;" onclick="detail_data('<?php// echo $row['loan_id'] ?>','edit')">
						<i class="fa fa-fw fa-pencil" style="font-size:20px;color:yellow;"></i>
						<a href="javascript:;" onclick="detail_data('<?php// echo $row['loan_id'] ?>','detail')">
						<i class="fa fa-fw fa-search" style="font-size:20px;color:blue;"></i>
						<?php if($doc['count(loan_id)']!=0){ ?>
						<a href="javascript:;" onclick="detail_data('<?php //echo $row['loan_id'] ?>','download')">
						<i class="fa fa-fw fa-download" style="font-size:20px;color:red;"></i>
						<?php } ?>
						<a href="javascript:;" onclick="detail_data('<?php //echo $row['loan_id'] ?>','delete')">
						<i class="fa fa-fw fa-trash" style="font-size:20px;color:red;"></i>
						-->
						<a href="<?php echo base_url(); ?>backend/bid/detail/<?php echo  $row['code'] ?>" class="btn btn-info btn-xs btn-block" >Review</a>
						<?php if($aksi != 0){ ?>
						<button class="btn btn-success btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_id'] ?>','edit')">Suggest</button>
						<button class="btn btn-success btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_id'] ?>','accept')">Accept</button>
						<?php } ?>
						
						
						
						
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
 <!-- Modal -->
  <div class="modal fade custom-width" id="form-status" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Klik suggest untuk info status bid ke peminjam</h4>
		
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
			<label class="control-label col-md-3"></label>
              <div class="col-md-6">
			   <input name="loan_id" placeholder="" READONLY class="form-control" type="hidden">
                <input name="code" placeholder="" READONLY class="form-control" type="hidden">
				<input name="borrower_id" placeholder="" READONLY class="form-control" type="hidden">
				
              </div>
            </div>
			
			<div class="form-group">
             <input name="bid_status" placeholder="" READONLY class="form-control"  type="hidden">
              </div>
          
			
			
			
		</div>
		  </div>
		 </form>
        
        <div class="modal-footer">
		   <button type="button" id="btnSave" onclick="save('edit')" class="btn btn-primary">Suggest</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</div>
		</div>
     </div>


<!-- Modal -->
<!-- Modal -->	
<div class="modal fade custom-width" id="accept-bid">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Anda yakin peminjam telah menyetujui dana untuk pinjaman tersebut?</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="loan_id" placeholder="" READONLY class="form-control" > 
				<input name="bid_status" placeholder="" READONLY class="form-control" type="hidden">
              </div>
			 <div class="form-group"> 
			<label class="control-label col-md-3"></label>
              <div class="col-md-6">
                <input name="xx" placeholder="" READONLY class="form-control" type="hidden">
              </div>
            </div>
			 <div class="form-group"> 
			<label class="control-label col-md-3">Kode Pinjaman</label>
              <div class="col-md-6">
                <input name="code" placeholder="" READONLY class="form-control" type="text">
              </div>
            </div>
			 <div class="form-group"> 
			<label class="control-label col-md-3">Peminjam</label>
              <div class="col-md-6">
                <input name="b_full_name" placeholder="" READONLY class="form-control" type="text">
              </div>
            </div>
			 <div class="form-group"> 
			<label class="control-label col-md-3">Jumlah Pinjaman</label>
              <div class="col-md-6">
                <input name="amount" placeholder="" READONLY class="form-control" type="text">
              </div>
            </div>
			<div class="form-group"> 
			<label class="control-label col-md-3">Pinjaman yang di danai</label>
              <div class="col-md-6">
                <input name="total_bid_amount" placeholder="" READONLY class="form-control" type="text">
              </div>
            </div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="save('accept')" class="btn btn-danger">Accept</button>
			</div>
		</div>
	</div>
</div>
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
		
	  var tes=null;
	  var tes2='11';
	  var urlaksi;
	 // $('[name="loan_id"]').val(data.loan_id);
	  
	  if(aksi == 'download'){
		  urlaksi="<?php echo base_url('backend/submission_loan/show_document_loan/')?>/";
	  }else if (aksi == 'edit'){
		  
		  urlaksi="<?php echo base_url('backend/submission_loan/show_submission_loan_business2')?>/";
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
			
				$('[name="loan_id"]').val(data.loan_id);
				$('[name="loan"]').val(data.loan);
				$('[name="loan_name"]').val(data.loan_name);
				 $("#loan_status").val(data.loan_status);
				 $('[name="code"]').val(data.code);
				 $('[name="borrower_id"]').val(data.borrower_id);
				  $('[name="b_full_name"]').val(data.b_full_name);
				   $('[name="total_bid_amount"]').val(data.total_bid_amount);
				   $('[name="amount"]').val(data.amount);
				
			// alert('Error get data from ajax');
						
			if(aksi == 'accept'){
			 $('[name="bid_status"]').val(2);
				jQuery('#accept-bid').modal('show'); 
				
				
			}else if(aksi == 'edit'){
				//$('[name="loan_id"]').val(data.loan_id);
				 $('[name="bid_status"]').val(1);
				 $("#loan_status").val(data.status);
				jQuery('#form-status').modal('show'); 
				 
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
		
	//	alert(aksi);
      var url;
        if(aksi == 'edit') 
      {
        url = "<?php echo site_url('backend/bid/update_bid')?>";
	  }else if(aksi == 'accept'){
		   url = "<?php echo site_url('backend/bid/update_bid')?>";
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
			
		//	alert(data.status2);
			
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

     
     