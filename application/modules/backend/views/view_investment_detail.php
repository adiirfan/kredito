
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css">



	<div class="container-fluid">
		<?php if (!empty($this->session->flashdata('Success'))) { ?>
			<div class="row" id="lbl_message">
				<div class="alert alert-success alert-dismissible" role="alert" id="lbl_Success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Success</strong>
					<?php print_r($this->session->flashdata('Success')); ?>
				</div>
			</div>
	    <?php } 
	    if (!empty($this->session->flashdata('Error'))) { ?>
			<div class="row" id="lbl_message">
				<div class="alert alert-danger alert-dismissible" role="alert" id="lbl_Success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Error</strong>
					<?php print_r($this->session->flashdata('Error')); ?>
				</div>
			</div>
	    <?php } ?>
	</div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Pijaman - <?php echo $row->code ?> (<?php echo $status_name ?>)
            	<?php
            		if ($row->status == 5 OR $row->status == 6){ ?>
            			&nbsp;&nbsp;&nbsp;
            			<input id="chk_has_follow_up" name="chk_has_follow_up" type="checkbox" value="1" <?php if ($row->has_follow_up) echo "checked=true"?> />&nbsp;<label class="text" for="chk_has_follow_up"> Already follow up</label>
            	<?php } ?>
            </h3>
        </div>
    </div>

    <div class="row">
	
       <div class="col-md-6" style="padding-left:29px;">
			<div class="box box-default">
        	<h4><i class="fa fa-user"></i>&nbsp;&nbsp;Informasi Pribadi</h4>
			<div class="form-group">
				<label>Nomor KTP</label>
				<div style="display:block">
				<?php echo $row->b_ktp; ?>
				</div>
			</div>
        	<div class="form-group">
				<label>Nama Lengkap</label>
				<div style="display:block">
				<?php echo $salutation_name.' '.$row->b_full_name; ?>
				</div>
			</div>
			
			<div class="form-group">
				<label>Email</label>
				<div style="display:block">
				<?php echo $row->b_email; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Telepon</label>
				<div style="display:block">
				<?php echo $row->b_mobile_phone; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<div style="display:block">
				<?php echo $row->b_address; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Kota</label>
				<div style="display:block">
				<?php echo $row->b_city; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Provinsi</label>
				<div style="display:block">
				<?php echo $row->b_provinsi; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Kode Pos</label>
				<div style="display:block">
				<?php echo $row->b_postal_code; ?>
				</div>
			</div>
			<br />
			<h4><i class="fa fa-building-o"></i>&nbsp;&nbsp;Company Information</h4>
			<div class="form-group">
				<label>Nama Perusahaan</label>
				<div style="display:block">
				<?php echo $row->b_company_name; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Nomor NPWP</label>
				<div style="display:block">
				<?php echo $row->b_company_registration; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Modal Usaha</label>
				<div style="display:block">
				<?php echo number_format($row->b_company_paid_up_capital, 2); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Jumlah Karyawan</label>
				<div style="display:block">
				<?php echo $row->b_company_man_power; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Pendapatan pertahun</label>
				<div style="display:block">
				<?php echo number_format($row->b_company_revenue, 2); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Ini usaha baru</label>
				<div style="display:block">
				<?php if ($row->b_company_is_new == "1"){echo "Yes";}else{echo "No";}?>
				</div>
			</div>
			<br />
			<h4><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Dokumen</h4>
<?php $scan=$this->model_backend->view_document_loan($row->loan_id);
$nama_doc=array('KTP','NPWP','SIUP');
$i=0;
foreach($scan as $doc){
?>
		
		    <br>
		    <form id="fileupload-ma" action="upload" method="POST" enctype="multipart/form-data">
		        <div class="row">
		            <div class="col-lg-10 col-lg-offset-1 register">
		                <div class="row fileupload-buttonbar">
		                    <div class="col-lg-12" style="display:inline-block">
		                        <b><?php echo $nama_doc[$i]; ?></b>
		                    </div>
		                </div>
		              <img src="<?php echo base_url()  ?>upload/loan/<?php echo $row->folder_code ?>/aa/files/<?php echo $doc['file_name']; ?>" width="100px" height="100px" >
		            </div>
		        </div>
		    </form>
		    <br />
		   
<?php $i++;} ?>
		    <br />
			</div>
        </div>
        <div class="col-lg-6">
		<div class="box box-default">
			<h4><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Kebutuhan Pinjaman</h4>
			<div class="form-group">
				<label>Pinjaman</label>
				<div style="display:block">
				Rp <?php echo number_format($row->amount, 2); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Tenor</label>
				<div style="display:block">
				<?php echo $row->period; ?> bulan
				</div>
			</div>
			<div class="form-group">
				<label>Tujuan Peminjaman</label>
				<div style="display:block">
				<?php echo $loan_purpose; ?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Review Pinjaman
				</div>
				<?php echo form_open('backend/submission-loan/update_info_detail'); ?>
				<div class="panel-body">
		            
		            <?php echo validation_errors('<p class="alert alert-danger">');?>

					<div class="form-group">
						<label>Nilai Resiko</label>
						<div style="display:block">
							<select id="cbo_risk" name="cbo_risk" class="form-control">
			                    <?php 
			                        echo '<option value="0" disabled selected>Select</option>';
			                        for ($i = 0; $i < count($risk_list); ++$i)
			                        { 
			                        	if ($risk_list[$i]->risk_id == $row->risk_id)
			                        	{
			                        		echo '<option value="'.$risk_list[$i]->risk_id.'" selected="true">'.$risk_list[$i]->risk_name.'</option>';
			                        	}
			                        	else
			                        	{
			                        		echo '<option value="'.$risk_list[$i]->risk_id.'">'.$risk_list[$i]->risk_name.'</option>';	
			                        	}
			                        }
			                    ?>
			                </select>
						</div>
					</div>
					<div class="form-group">
						<label>Annual Percentage Rate (APR)</label>
						<div style="display:block">
						<?php echo form_input('txt_apr_percent', set_value('txt_apr_percent', $row->apr_percent), 'name="txt_apr_percent" class="form-control" ');?>
						</div>
					</div>
					<div class="form-group">
						<label>Effetive Interest Rate (EIR)</label>
						<div style="display:block">
						<?php echo form_input('txt_eir_percent', set_value('txt_eir_percent', $row->eir_percent), 'name="txt_eir_percent" class="form-control" ');?>
						</div>
					</div>
					<div class="form-group">
						<div style="display:block">
						<input id="chk_document_prepared" name="chk_document_prepared" type="checkbox" value="1" <?php if ($row->document_prepared) echo "checked=true"?> />&nbsp;<label class="text" for="chk_document_prepared">Dokumen Lengkap</label>
						</div>
					</div>
					<div class="form-group">
						<div style="display:block">
						<input id="chk_contract_signed" name="chk_contract_signed" type="checkbox" value="1" <?php if ($row->contract_signed) echo "checked=true"?> />&nbsp;<label class="text" for="chk_contract_signed">Data Valid</label>
						</div>
					</div>

					<input type="hidden" id="h_loan_id" name="h_loan_id" value="<?php echo $row->loan_id ?>">
					<input type="hidden" id="h_code" name="h_code" value="<?php echo $row->code ?>">
				</div>
				<div class="panel-footer div-right">
					<button name="submit" class="btn btn-info">Update Review</button>
				</div>
				<?php echo form_close();?>
			</div>
			<br/>
			<!-- Status Table-->
			<div class="form-group">
				<h4><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Status&nbsp;&nbsp;
					<button class="btn btn-info" onclick="detail_data('<?php echo $row->loan_id; ?>','edit')">Update</button>
				</h4>
			    <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
	                <thead>
	                    <tr>
	                        <th>#</th>
	                        <th class="all">Keterangan</th>
	                        <th>Status</th>
	                        <th>Direview oleh</th>
	                        <th>Tanggal</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php for ($i = 0; $i < count($loan_status_list); ++$i) { ?>
	                    <tr>
	                        <td><?php echo ($i+1); ?></td>
	                        <td class="all"><?php echo $loan_status_list[$i]->remarks; ?></td>
	                        <td><?php 
							$status= $this->model_backend->status_submission($loan_status_list[$i]->status);
	                        	echo $status;
	                         ?></td>
	                        <td><?php echo $loan_status_list[$i]->created_user; ?></td>
	                        <td><?php echo $loan_status_list[$i]->created_date; ?></td>
	                    </tr>
	                    <?php } ?>
	                </tbody>
	            </table>
	        </div>
	        <br/>
	        <!-- Repayment Table-->
			<!--
			<div class="form-group">
				<h4><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;Manual Schedule Repayment&nbsp;&nbsp;
					<button class="btn btn-info" onclick="add_repayment();">Create</button>
				</h4>
			    <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
	                <thead>
	                    <tr>
	                        <th>#</th>
	                        <th class="all">Schedule</th>
	                        <th>Principal</th>
	                        <th>Interest</th>
	                        <th>Instalment</th>
	                        <th>Balance</th>
	                        <th>Status</th>
	                        <th></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php //for ($i = 0; $i < count($loan_repayment_list); ++$i) { ?>
		                    <tr>
		                        <td><?php //echo ($i+1); ?></td>
		                        <td><?php //echo $loan_repayment_list[$i]->schedule ?></td>
		                        <td><?php //echo number_format($loan_repayment_list[$i]->principal) ?></td>
		                        <td><?php //echo number_format($loan_repayment_list[$i]->interest) ?></td>
		                        <td><?php //echo number_format($loan_repayment_list[$i]->instalment) ?></td>
		                        <td><?php //echo number_format($loan_repayment_list[$i]->balance) ?></td>
		                        <td><?php //echo $loan_repayment_list[$i]->status ?></td>
		                        <td>
		                        	<button class="btn btn-success btn-xs btn-block" onclick="edit_repayment(<?//= $loan_repayment_list[$i]->loan_repayment_id; ?>);">Edit</button>
	                            	<button class="btn btn-danger btn-xs btn-block" onclick="delete_repayment(<?//= $loan_repayment_list[$i]->loan_repayment_id; ?>, <?= $loan_repayment_list[$i]->loan_id; ?>);">Delete</button>
		                        </td>
		                    </tr>
	                    <?php// } ?>
	                </tbody>
	            </table>
	        </div>
			-->
		</div>
		</div>
    </div>
	<script>
	function detail_data(id,aksi)
    {
		
	  var tes=null;
	  var tes2='11';
	  var urlaksi;
	 // $('[name="loan_id"]').val(data.loan_id);
	  
	  if(aksi == 'download'){
		  urlaksi="<?php echo base_url('backend/submission_loan/show_document_loan/')?>/";
	  }else{
		   urlaksi="<?php echo base_url('backend/submission_loan/show_submission_loan_business2/')?>/";
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
				$('[name="code"]').val(data.code);
				$('[name="loan_name"]').val(data.loan_name);
				 $("#loan_status").val(data.loan_status);
			// alert('Error get data from ajax');
						
			if(aksi == 'detail'){
				
				
				
			}else if(aksi == 'edit'){
				//$('[name="loan_id"]').val(data.loan_id);
				
				  $("#loan_status").val(data.status);
				jQuery('#form-status').modal('show'); 
				 
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
		
		alert(aksi);
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
			
			alert(data.status2);
		
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
				
              </div>
            </div>
			
			<div class="form-group">
              <label class="control-label col-md-3">Status Pengajuan</label>
              <div class="col-md-6">
               <select class="form-control col-md-3" name="loan_status" id="loan_status">
			
				<option value="3">Dalam Proses</option>
				<option <?php $status=$row->status; if( $status == '4'){echo 'selected';} ?> value="4">Telah Diverfikasi <?php echo $row->status;  ?></option>
				<option selected value="5">Dibatalkan</option>
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
 