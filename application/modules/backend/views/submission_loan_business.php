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
						$persentasi=round(($jumlahbid['sum(bid_amount)'] * 100) / $row['amount']);
							$doc= $this->model_backend->check_doc_upload($row['loan_id']);
					?>
                     <tr>
                        <td><?php echo $z; ?></td>
                        <td><?php echo $row['code']; ?></td>
                        <td><?php echo $row['b_full_name']; ?></td>
						 <td><?php echo '<p>'.$row['b_email'].'</p>'.$row['b_mobile_phone']; ?></td>
                        <td>Rp.<?php echo $rupiah; ?>
						<p> <?php echo $row['period']; ?> Bulan</p></td>
						
						
						
						<td><?php if($row['cs_approve']=='1' && $row['status']=='2'){ echo '<span class="label label-success">Telah diverifikasi CS</span>';  }else { echo $status;} ?></td>
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
						<a href="<?php echo base_url(); ?>backend/submission-loan/detail/<?php echo  $row['code'] ?>" class="btn btn-info btn-xs btn-block" >Review</a>
						<button class="btn btn-info btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_id'] ?>','edit')">Update Status</button>
						<button class="btn btn-success btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_id'] ?>','detail')">Detail</button>
						<button class="btn btn-danger btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_id'] ?>','download')">Download</button>
						<button class="btn btn-danger btn-xs btn-block"  onclick="detail_data('<?php echo $row['loan_id'] ?>','delete')">Delete</button>
						
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
          <h4 class="modal-title">Update Status Pengajuan</h4>
		
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
			<label class="control-label col-md-3">Kode Pinjaman</label>
              <div class="col-md-6">
			   <input name="loan_id" placeholder="" READONLY class="form-control" type="hidden">
                <input name="code" placeholder="" READONLY class="form-control" type="text">
				<input name="borrower_id" placeholder="" READONLY class="form-control" type="text">
				
              </div>
            </div>
			
			<div class="form-group">
              <label class="control-label col-md-3">Status Pengajuan</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="loan_status" id="loan_status">
			
				<option value="3">Dalam Proses</option>
				<option value="4">Telah Diverfikasi</option>
				<option value="5">Ditolak</option>
				<option value="7">Proses Pencairan Dana</option>
				<option value="8">Selesai</option>
				
			</select>
			</select>
              </div>
            </div>
			
			<div class="form-group"> 
			<label class="control-label col-md-3">Catatan</label>
              <div class="col-md-6">
			   <textarea name="remark" class="form-control" rows="4" cols="40"></textarea>
				
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
<div class="modal fade custom-width" id="delete-submission">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Anda yakin ingin menghapus data ini?</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="loan_id" placeholder="" READONLY class="form-control" > 
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
<!-- Modal -->	
<div class="modal fade custom-width" id="detail-submission">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Detail Pengajuan</h4>
			</div>
			
			<div class="modal-body">
				
				  <div class="row">
				   <div class="col-md-3">
				   </div>
            <div class="col-md-6">
              <!-- Custom Tabs -->
         <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Pinjaman</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Peminjam</a></li>
				  <li><a href="#tab_3" data-toggle="tab">Bisnis</a></li>
                <!--  <li><a href="#tab_4" data-toggle="tab">Bid</a></li> -->
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				<?php $bod='<h4 id="loan_bod"></h4>'; ?>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
				 <table align="center">
						<tr><td width="200px"><h4>Jumlah Pinjaman</h4></td><td width="20px">:</td>  <td width="200px"><h4 id="amount"></h4></td></tr>
					<tr><td><h4>Tenor </h4></td> <td>:</td>  <td><h4 id="period"></h4></td></tr>
					
					<tr><td><h4>Bunga </h4></td> <td>:</td>  <td><h4 id="interest_rate">15% sampai 20%</h4></td></tr>
					<tr><td><h4>Cicilan Perbulan Minimal </h4></td> <td>:</td>  <td><h4 id="cicilan_1"></h4></td></tr>
					<tr><td><h4>Cicilan Perbulan Maksimal </h4></td> <td>:</td>  <td> <h4 id="cicilan_2"></h4></td></tr>
				  </table>
				
                  
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
				  
				   <table align="center">
					<tr><td width="200px"><h4>Nomor KTP </h4></td><td width="20px">:</td>  <td><h4 id="b_ktp"></h4></td></tr>
					<tr><td><h4>Nama </h4></td> <td>:</td>  <td><h4 id="b_full_name"></h4></td></tr>
					<tr><td><h4>Jenis Kelamin</h4> </td><td>:</td>   <td><h4 id="b_gender"></h4></td></tr>
					<tr><td><h4>Nomor Telepon </h4></td> <td>:</td>  <td><h4 id="b_mobile_phone"></h4></td></tr>
					<tr><td><h4>Email </h4></td> <td>:</td>  <td><h4 id="b_email"></h4></td></tr>
					<tr><td><h4>Alamat </h4></td><td>:</td>   <td><h4 id="b_address"></h4></td></tr>
					<tr><td><h4>Kota	</h4> </td> <td>:</td>  <td><h4 id="b_city"></h4></td></tr>
					<tr><td><h4>Provinsi </h4></td> <td>:</td>  <td><h4 id="b_provinsi"></h4><?php //echo $this->model_tanggal->validasitanggal(date());?></td></tr>
					<tr><td><h4>Kode Pos</h4> </td><td>:</td><td><h4 id="b_postal_code"></h4></td></tr>
				  </table>
				   

                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
				  
				   <table align="center">
					<tr><td width="200px"><h4>Nama Perusahaan </h4></td><td width="20px">:</td>  <td><h4 id="b_company_name"></h4></td></tr>
					<tr><td><h4>Nomor NPWP </h4></td> <td>:</td>  <td><h4 id="b_company_registration"></h4></td></tr>
					<tr><td><h4>Modal awal usaha</h4> </td><td>:</td>   <td><h4 id="b_company_paid_up_capital"></h4></td></tr>
					<tr><td><h4>Jumlah Karyawan </h4></td> <td>:</td>  <td><h4 id="b_company_man_power"></h4></td></tr>
					<tr><td><h4>Pendapatan per-tahun </h4></td> <td>:</td>  <td><h4 id="b_company_revenue"></h4></td></tr>
					<tr><td><h4>Perusahaan Baru ? </h4></td><td>:</td>   <td><h4 id="b_company_is_new"></h4></td></tr>
					<tr><td><h4>Domisili Perusahaan	</h4> </td> <td>:</td>  <td><h4 id="b_company_location"></h4></td></tr>
					<tr><td><h4>Alamat </h4></td> <td>:</td>  <td><h4 id="b_company_address"></h4><?php echo $bod; ?><?php //echo $this->model_tanggal->validasitanggal(date());?></td></tr>
					<tr><td><h4>Kode Pos</h4> </td><td>:</td><td><h4 id="b_company_postal_code"></h4></td></tr>
					<!--
					<tr><td colspan="3"><h4>Downloan Siup</h4></td></tr>
					<tr><td colspan="3"><h4>Downloan NPWP</h4></td></tr>
					<tr><td colspan="3"><h4>Downloan Akta</h4><h4 id="company_image"></h4></td></tr>
					-->
					
				  </table>

                  </div><!-- /.tab-pane -->
				  <!--
				   <div class="tab-pane" id="tab_4">
				  
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
			// alert('Error get data from ajax');
						
			if(aksi == 'detail'){
				//alert(data.b_address);
					document.getElementById('amount').innerHTML = data.amount;
				document.getElementById('period').innerHTML = data.period+' Tahun';
				
				document.getElementById('b_full_name').innerHTML = data.b_full_name;
				document.getElementById('b_gender').innerHTML = data.b_salutation_id;
				document.getElementById('b_ktp').innerHTML = data.b_ktp;
				document.getElementById('b_address').innerHTML = data.b_address;
				document.getElementById('b_provinsi').innerHTML = data.b_provinsi;
				document.getElementById('b_city').innerHTML = data.b_city;
				document.getElementById('b_postal_code').innerHTML = data.b_postal_code;
				document.getElementById('b_email').innerHTML = data.b_email;
				
				document.getElementById('b_email').innerHTML = data.b_email;
				document.getElementById('b_mobile_phone').innerHTML = data.b_mobile_phone;
				
				document.getElementById('cicilan_1').innerHTML = toRp(data.b_cicilan_1);
				document.getElementById('cicilan_2').innerHTML = toRp(data.b_cicilan_2);
			
				document.getElementById('b_company_name').innerHTML = data.b_company_name;
				document.getElementById('b_company_location').innerHTML = data.b_company_location;
				document.getElementById('b_company_address').innerHTML = data.b_company_address;
				document.getElementById('b_company_postal_code').innerHTML = data.b_company_postal_code;
				document.getElementById('b_company_registration').innerHTML = data.b_company_registration;
				document.getElementById('b_company_is_new').innerHTML = data.b_company_is_new;
				document.getElementById('b_company_paid_up_capital').innerHTML = data.b_company_paid_up_capital;
				document.getElementById('b_company_man_power').innerHTML = data.man_power_sum;
				document.getElementById('b_company_revenue').innerHTML = data.b_company_revenue;
				jQuery('#detail-submission').modal('show'); 
				
				
			}else if(aksi == 'edit'){
				//$('[name="loan_id"]').val(data.loan_id);
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
        url = "<?php echo site_url('backend/submission_loan/update_submission_business2')?>";
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
			 if(aksi == 'edit') 
			{
					jQuery('#form-status').modal('hide'); 
			} if(aksi == 'add') 
			{
					jQuery('#form-main-product').modal('hide'); 
			}else{
					jQuery('#delete-submission').modal('hide'); 
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

     
     