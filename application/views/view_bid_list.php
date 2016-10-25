
<link href="<?php echo base_url(); ?>assets/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<!--<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">-->
<link href="<?php echo base_url(); ?>assets/custom/css/admin-datatable.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url();?>assets/jquery/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="http://www.rajapremi.com/assets/js/autoNumeric.js"></script>
<script type="text/javascript">

  /* Custom filtering function which will search data in column four between two values */


    $(document).ready(function() {

        $("#popupForm").draggable();

        var table = $('#tbl').DataTable({
            "dom": '<"dataTables_CustomFilter">lrtip'
        });

        $("div.dataTables_CustomFilter").html(
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl"></label>' +
            '');

        // Event listener to the two range filtering inputs to redraw on input
        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
        });

        $('#cbo_filter_status').on( 'change', function () {
            table.columns(7).search( this.value ).draw();
        });


    } );
    
</script>
<script>

	function confirm_cancel()
	{
		$('#myform_cancel').attr('action', '<?php echo base_url(); ?>borrower/application/cancel');
        document.getElementById("myform_cancel").submit(); 
	}

	function cancel(pID, pCode, pAmount)
    {
    	$("#txt_code").val(pCode);
    	$("#txt_amount").val(pAmount);
    	var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
		$("body").append(appendthis);
		$(".modal-overlay").fadeTo(500, 0.7);
		$('#popupForm').fadeIn($(this).data());
    }

</script>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
</html>
<br>
			<h3>Daftar pencari pinjaman</h3>
			<hr>
		</div>		
	</div>

	<div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th class="desktop">#</th>
                        <th class="desktop">No Ref</th>
                        <th class="desktop">Nama</th>
                        <th class="desktop">Pinjaman</th>
						 <th class="desktop">Jumlah Bid</th>
                        <th class="desktop">Status Bid</th>
                        <th class="desktop"></th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($loan as  $row) {
                  $jumlahbid= $this->model_bid->get_sum_bid($row['loan_id']);
						$rupiah= $this->model_backend->rupiah($row['amount']);
						$persentasi=round(($jumlahbid['sum(bid_amount)'] * 100) / $row['amount']);
						$batas=($row['amount'] - $jumlahbid['sum(bid_amount)']);
						$tes=$row['amount'].'- '.$jumlahbid['sum(bid_amount)'];
					?>
                     <tr>
                        <td><?php echo $i; ?></td>
						 <td><?php echo $row['code']; ?></td>
                        <td><?php echo $row['b_full_name']; ?></td>
                        <td><?php echo 'Rp. '.$rupiah; ?><p><?php echo $row['period'] ?>bulan</p></td>
						<td><?php echo 'Rp. '.$this->model_backend->rupiah($jumlahbid['sum(bid_amount)']); ?></td>
						 <td>
						  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="40" style="width:<?php echo $persentasi; ?>%">
     <?php echo $persentasi.' %'; ?>
    </div>
  </div>
						 </td>
                        <td class="desktop">
						
                        	<?php if($persentasi != '100'){ ?>
                        	
							<button class="btn btn-danger btn-xs" onclick="detail_data('<?php echo $row['loan_id'] ?>','bid')">Bid</button>
							<?php }//else { ?>
							
							<?php// }?>
							<button class="btn btn-success btn-xs" onclick="detail_data('<?php echo $row['loan_id'] ?>','detail')">Detail</button>
	                        <?php //} ?>
	                        <?php //if ($loan_list[$i]->status == 1) { ?>
	                        	<!-- <form action="<?php //echo base_url(); ?>borrower/application/edit" id="myform" method="post" accept-charset="utf-8">
	                        		<button class="btn btn-info btn-xs">Edit</button>
	                        		<input type="hidden" id="h_code" name="h_code" value="<?php //echo $loan_list[$i]->code; ?>" />
	                        	</form> -->
	                        <?php //} ?>
                        </td>
                     
                        	
                       
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
			 </div>
        </div>
    </div>  
	<!-- Modal -->	
<div class="modal fade custom-width" id="bid-modal">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Bid Form</h4>
			</div>
			
			<div class="modal-body">
			<form action="#" id="form" class="form-horizontal">
				 <div class="col-md-9">
                <input type="hidden" name="loan_id" placeholder="" READONLY class="form-control" > 
              </div>
			  <div class="form-group">
             
              <div class="col-md-6">
            
              </div>
			  </div>
			  <div class="form-group">
			   <p class="amounttext"></p>
              <label class="control-label col-md-3">Nilai pendanaan</label>
              <div class="col-md-6">
			  <input type="text" class="form-control InsuredPrice" data-a-sign="" data-v-min="0" data-v-max="500000000" data-a-dec="," data-a-sep="." name="amount_bid" id="InsuredPrice" placeholder="Jumlah (Rp. .......)" value="<?php echo $batas; ?>">
            <!-- <input name="amount_bid" placeholder=""  class="form-control" type="text"> -->
			
			
              </div>
            </div>
			 
			</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" onclick="save('bid')" class="btn btn-danger">Bid</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->	

<script>
$(document).ready(function() {
				$(".InsuredPrice").length > 0 && $(".InsuredPrice").autoNumeric("init");
				
				
			});
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
	 
	  $('[name="loan_id"]').val(id);
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('bid/show_bid_data/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
				
			
			// alert('Error get data from ajax');
						
			if(aksi == 'detail'){

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
	//document.getElementById('company_image').innerHTML ='<a href="<?php echo base_url();?>upload/loan/'+data.folder_code+'/aa/files/'+data.file_name+'">Download NPWP</a>';
			
				
				
				jQuery('#detail-submission').modal('show'); 
				
				
				
			}else if(aksi == 'bid'){
				//var t="tes";
				//document.getElementById('amounttext1').innerHTML = t;
				//$('[name="loan_id"]').val(data.loan_id);
				jQuery('#bid-modal').modal('show'); 
				 
			}else{
				//$('[name="loan_id"]').val(data.loan_id);
				jQuery('#cancel-submission').modal('show'); 
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
        if(aksi == 'bid') 
      {
		 
        url = "<?php echo site_url('bid/add_bid')?>";
	  }else if(aksi == 'delete'){
		   url = "<?php echo site_url('borrower/update_submission_loan/')?>";
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
			
			 if(aksi == 'bid') 
			{
					 jQuery('#bid-modal').modal('hide'); 
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

<!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.bootstrap.min.js" type="text/javascript"></script>    
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.responsive.min.js" type="text/javascript"></script>    
	
	
	
<!-- Modal -->	
<div class="modal fade custom-width" id="detail-submission">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Data Calon Peminjam</h4>
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