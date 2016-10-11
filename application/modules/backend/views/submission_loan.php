
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pengajuan Pinjaman Refinance</h3>
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
						 <th>No Ref</th>
                        <th>Nama</th>
                       
						<th>Kontak</th>
						<th>Pinjaman</th>
						<th>Refinance</th>
						<th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($loan as $row){
						$status= $this->model_backend->status_submission($row['loan_status']);
						$rupiah= $this->model_backend->rupiah($row['loan']);
					?>
                     <tr>
                        <td><?php echo $z; ?></td>
						<td><?php echo $row['loan_code']; ?></td>
                        <td><?php echo $row['loan_name']; ?></td>
                        <td><p><?php echo $row['loan_phone']; ?></p><?php echo $row['loan_email']; ?></td>
						 
                        <td><?php echo $rupiah; ?></td>
						
						 <td><?php echo $row['company_product_name']; ?></td>
						 <td><?php echo $status ?></td>
						<td>
						<a href="javascript:;" onclick="detail_data('<?php echo $row['loan_id'] ?>','edit')">
						<i class="fa fa-fw fa-pencil" style="font-size:20px;color:yellow;"></i>
						<a href="javascript:;" onclick="detail_data('<?php echo $row['loan_id'] ?>','detail')">
						<i class="fa fa-fw fa-search" style="font-size:20px;color:blue;"></i>
						<a href="javascript:;" onclick="detail_data('<?php echo $row['loan_id'] ?>','delete')">
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
  <div class="modal fade custom-width" id="form-submission" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Status</h4>
        </div>
        <div class="modal-body">
		 <form action="#" id="form" class="form-horizontal">
		 <div class="form-body">
			<div class="form-group"> 
              <div class="col-md-6">
                <input name="loan_id" placeholder="" READONLY class="form-control" type="hidden">
				 <input name="user_id" placeholder="" READONLY class="form-control" type="hidden">
				  <input name="product_name" placeholder="" READONLY class="form-control" type="hidden">
				    <input name="loan_code" placeholder="" READONLY class="form-control" type="hidden">
              </div>
            </div>
			<div class="form-group">
              <label class="control-label col-md-3">Status Pengajuan</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="loan_status" id="loan_status">
			
			
				<option value="2">Diajukan</option>
				<option value="3">Sedang di proses</option>
				<option value="4">Berhasil</option>
				<option value="5">Ditolak</option>
				
			</select>
			</select>
              </div>
            </div>
		</div>
		  </div>
		 </form>
        
        <div class="modal-footer">
		   <button type="button" id="btnSave" onclick="save('edit')" class="btn btn-primary">Update</button>
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
				<h4 class="modal-title">Apakah anda yakin ingin menghapus data ini</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="loan_id" placeholder="" READONLY class="form-control" > 
              </div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" onclick="save('delete')" class="btn btn-danger">Hapus</button>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Peminjam</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Refinance</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Pinjaman</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				<?php $bod='<h4 id="loan_bod"></h4>'; ?>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
				  <table align="center">
					<tr><td width="200px"><h4>Nomor KTP </h4></td><td width="20px">:</td>  <td><h4 id="loan_nik"></h4></td></tr>
					<tr><td><h4>Name </h4></td> <td>:</td>  <td><h4 id="loan_name"></h4></td></tr>
					<tr><td><h4>Jenis Kelamin</h4> </td><td>:</td>   <td><h4 id="loan_gender"></h4></td></tr>
					<tr><td><h4>Phone </h4></td> <td>:</td>  <td><h4 id="loan_phone"></h4></td></tr>
					<tr><td><h4>Email </h4></td> <td>:</td>  <td><h4 id="loan_email"></h4></td></tr>
					<tr><td><h4>Alamat </h4></td><td>:</td>   <td><h4 id="loan_address"></h4></td></tr>
					<tr><td><h4>Kota	</h4> </td> <td>:</td>  <td><h4 id="loan_city"></h4></td></tr>
					<tr><td><h4>Tempat Lahir </h4></td> <td>:</td>  <td><h4 id="loan_pod"></h4><?php echo $bod; ?><?php //echo $this->model_tanggal->validasitanggal(date());?></td></tr>
					<tr><td><h4>Kode Pos</h4> </td><td>:</td><td><h4 id="loan_postal_code"></h4></td></tr>
				  </table>
				  <h4 id="loan_id"></h4>
				
                  
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
				  
				    <table align="center">
					<tr><td width="200px"><h4>Refinance	 </h4></td><td width="20px">:</td>  <td width="200px"><h4 id="company_product_name"></h4></td></tr>
					<tr><td><h4>Kategori Refinance</h4></td> <td>:</td>  <td><h4 id="product_name"></h4></td></tr>
					<tr><td><h4><h4 id="label1"></h4>	</h4> </td><td>:</td>   <td><h4 id="hasillabel1"></h4></td></tr>
					<tr><td><h4>Suku Bunga </h4></td> <td>:</td>  <td><h4 id="interest_rate"></h4></td></tr>
					<tr><td><h4>Tenor </h4></td> <td>:</td>  <td><h4 id="company_product_tenor"></h4></td></tr>
					<tr><td><h4><h4 id="label2"></h4></h4></td><td>:</td>   <td><h4 id="hasillabel2"></h4></td></tr>
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
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				
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
	  var tes2=0;
	  
	  
	
	   
//alert(aksi+id);
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('backend/submission_loan/show_submission_loan/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
				$('[name="loan_id"]').val(data.loan_id);
				$('[name="user_id"]').val(data.user_id);
				$('[name="loan"]').val(data.loan);
				$('[name="loan_code"]').val(data.loan_code);
				$('[name="product_name"]').val(data.product_name);
				$('[name="loan_name"]').val(data.loan_name);
				 $("#loan_status").val(data.loan_status);
			// alert('Error get data from ajax');
						
			if(aksi == 'detail'){
				var kondisi;
				if(data.company_product_condition='1'){
					kondisi="Baru";
					kondisi2='<span class="label label-warning">Baru</span>';
				}else{
					kondisi="Bekas";
					kondisi2='<span class="label label-danger">Bekas</span>';
					
				}
				if(data.loan_gender='L'){
					gender="Laki - Laki";
				}else{
					gender="Perempuan";
				}
				var c=data.product_id;
				//alert(data.product_id);
				if(c=='2'){
					label1="Plafon Loan";
					label2="Pinalty Periode";
					label11="Plafon Loan";
					label22="Pinalty Periode";
					hasillabel1=data.plafon_loan+' %';
					hasillabel2=data.periode_pinalty+' Tahun';
					hasillabel11=data.plafon_loan+' %';
					hasillabel22=data.periode_pinalty+' Tahun';
					
				}else{
					label1="Down Payment";
					label2="Condition";
					label11="Down Payment";
					label22="Jumlah bunga yang harus dibayar";
					hasillabel1=data.down_payment+' %';
					hasillabel2=kondisi;
					hasillabel11=toRp(data.loan_down_payment);
					hasillabel22=toRp(data.loan_sum_interest_rate);
				}
				
					//var label1;
					//alert(data.product_id);
				//tab product
				document.getElementById('label1').innerHTML = label1;
				document.getElementById('label2').innerHTML = label2;
				document.getElementById('hasillabel1').innerHTML = hasillabel1;
				document.getElementById('hasillabel2').innerHTML = hasillabel2;
				//tab Loan
				document.getElementById('label11').innerHTML = label11;
				document.getElementById('label22').innerHTML = label22;
				document.getElementById('hasillabel11').innerHTML = hasillabel11;
				document.getElementById('hasillabel22').innerHTML = hasillabel22;
				
			//document.getElementById('loan_id').innerHTML = data.loan_id;
			document.getElementById('loan_nik').innerHTML = data.loan_nik;
			document.getElementById('loan_name').innerHTML = data.loan_name;
			document.getElementById('loan_pod').innerHTML = data.loan_pod;
			document.getElementById('loan_bod').innerHTML = data.loan_bod;
			document.getElementById('loan_address').innerHTML = data.loan_address;
			document.getElementById('loan_city').innerHTML = data.loan_city;
			document.getElementById('loan_postal_code').innerHTML = data.loan_postal_code;
			document.getElementById('loan_gender').innerHTML = gender;
			document.getElementById('loan_email').innerHTML = data.loan_email;
			document.getElementById('loan_phone').innerHTML = data.loan_phone;
			
			document.getElementById('loan').innerHTML = toRp(data.loan);
			
			document.getElementById('company_product_name').innerHTML = data.company_product_name;
			document.getElementById('loan_payment_month').innerHTML = toRp(data.loan_payment_month);
			//document.getElementById('loan_sum_interest_rate').innerHTML = toRp(data.loan_sum_interest_rate);
			//document.getElementById('loan_down_payment').innerHTML = toRp(data.loan_down_payment);
			//document.getElementById('loan_status').innerHTML = data.loan_status;
			
		
			document.getElementById('product_name').innerHTML = data.product_name;
			//document.getElementById('company_product_condition').innerHTML = kondisi;
			document.getElementById('company_product_condition2').innerHTML = kondisi2;
			//document.getElementById('down_payment').innerHTML = data.down_payment+' %';
			document.getElementById('interest_rate').innerHTML = data.interest_rate+' %';
			document.getElementById('interest_rate2').innerHTML = data.interest_rate;
			document.getElementById('company_product_tenor').innerHTML = data.company_product_tenor+' Tahun';
			
			document.getElementById('company_image').innerHTML ='<img src="<?php echo base_url();?>assets/img/'+data.company_image+'" class="img-responsive" width="80px" height="40px" >';;
				jQuery('#detail-submission').modal('show'); 
				
				
			}else if(aksi == 'edit'){
				
				jQuery('#form-submission').modal('show'); 
				 
			}else{
				//$('[name="loan_id"]').val(data.loan_id);
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
        url = "<?php echo site_url('backend/submission_loan/update_submission')?>";
	  }else if(aksi == 'delete'){
		   url = "<?php echo site_url('backend/submission_loan/delete_submission/')?>";
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
			//alert(data.status);
			//alert(data.id);
			 if(aksi == 'edit') 
			{
					 jQuery('#form-company-product').modal('hide'); 
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

     
     