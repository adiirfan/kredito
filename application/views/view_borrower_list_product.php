
<link href="<?php echo base_url(); ?>assets/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<!--<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">-->
<link href="<?php echo base_url(); ?>assets/custom/css/admin-datatable.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url();?>assets/jquery/js/jquery.dataTables.min.js" type="text/javascript"></script>

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
			<h3>Pinjaman Refinance</h3>
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
                        <th class="desktop">Kontak</th>
                        <th class="desktop">Pinjaman</th>
                        <th class="desktop">Status</th>
                        <th class="desktop">Tanggal diajukan</th>
                      
                        <th class="desktop"></th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($loan_list as  $row) {
                  $status= $this->model_backend->status_submission($row['loan_status']);
						$rupiah= $this->model_backend->rupiah($row['loan']);
					?>
                     <tr>
                        <td><?php echo $i; ?></td>
						 <td><?php echo $row['loan_code']; ?></td>
                        <td><?php echo $row['loan_name']; ?></td>
                        <td><?php echo $row['loan_phone']; ?></td>
						
                        <td><?php echo $rupiah; ?></td>
						 <td>  <?php 
                        	echo $status;
                        ?></td>
						 <td><?php echo $row['loan_create_at']; ?></td>
						
						
						
                        <td class="desktop">
						
                        	<?php //if ($loan_list[$i]->status == 1 || $loan_list[$i]->status == 2) { ?>
                        	<button class="btn btn-warning btn-xs" onclick="detail_data('<?php echo $row['loan_id'] ?>','delete')">Cancel</button>
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
<div class="modal fade custom-width" id="cancel-submission">
	<div class="modal-dialog" style="width: 40%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Apakah anda yakin membatalkan pengajuan pinjaman ini?</h4>
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
				<button type="button" onclick="save('delete')" class="btn btn-danger">Batalkan</button>
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
                  <li class="active"><a href="#tab_1" data-toggle="tab">Data Diri</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Produk</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Pinjaman</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
				<?php $bod='<h4 id="loan_bod"></h4>'; ?>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
				  <table align="center">
					<tr><td width="200px"><h4>Nomor KTP </h4></td><td width="20px">:</td>  <td><h4 id="loan_nik"></h4></td></tr>
					<tr><td><h4>Nama </h4></td> <td>:</td>  <td><h4 id="loan_name"></h4></td></tr>
					<tr><td><h4>Jenis Kelamin</h4> </td><td>:</td>   <td><h4 id="loan_gender"></h4></td></tr>
					<tr><td><h4>Telepon </h4></td> <td>:</td>  <td><h4 id="loan_phone"></h4></td></tr>
					<tr><td><h4>Email </h4></td> <td>:</td>  <td><h4 id="loan_email"></h4></td></tr>
					<tr><td><h4>Alamat </h4></td><td>:</td>   <td><h4 id="loan_address"></h4></td></tr>
					<tr><td><h4>Kota	</h4> </td> <td>:</td>  <td><h4 id="loan_city"></h4></td></tr>
					<tr><td><h4>Tempat lahir </h4></td> <td>:</td>  <td><h4 id="loan_pod"></h4><?php echo $bod; ?><?php //echo $this->model_tanggal->validasitanggal(date());?></td></tr>
					<tr><td><h4>Kode Pos</h4> </td><td>:</td><td><h4 id="loan_postal_code"></h4></td></tr>
				  </table>
				  <h4 id="loan_id"></h4>
				
                  
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
				  
				    <table align="center">
						<tr><td width="200px"><h4>Refinance	 </h4></td><td width="20px">:</td>  <td width="200px"><h4 id="company_product_name"></h4></td></tr>
					<tr><td><h4>KategoriRefinance </h4></td> <td>:</td>  <td><h4 id="product_name"></h4></td></tr>
					<tr><td><h4><h4 id="label1"></h4>	</h4> </td><td>:</td>   <td><h4 id="hasillabel1"></h4></td></tr>
					<tr><td><h4>Suku Bunga </h4></td> <td>:</td>  <td><h4 id="interest_rate"></h4></td></tr>
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
	  
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('borrower/show_submission_loan/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
				$('[name="loan_id"]').val(data.loan_id);
			
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
					kondisi2=null;
					
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
			//document.getElementById('loan_sum_interest_rate').innerHTML = toRp(data.loan_sum_interest_rate);
			document.getElementById('company_product_name').innerHTML = data.company_product_name;
			document.getElementById('loan_payment_month').innerHTML = toRp(data.loan_payment_month);
			//document.getElementById('loan_down_payment').innerHTML = toRp(data.loan_down_payment);
			//document.getElementById('loan_status').innerHTML = data.loan_status;
			
			//document.getElementById('down_payment').innerHTML = data.down_payment+' %';
			document.getElementById('product_name').innerHTML = data.product_name;
			//document.getElementById('company_product_condition').innerHTML = kondisi;
			document.getElementById('company_product_condition2').innerHTML = kondisi2;
			document.getElementById('interest_rate').innerHTML = data.interest_rate+' %';
			document.getElementById('interest_rate2').innerHTML = data.interest_rate;
			document.getElementById('company_product_tenor').innerHTML = data.company_product_tenor+' Tahun';
			
			document.getElementById('company_image').innerHTML ='<img src="<?php echo base_url();?>assets/img/'+data.company_image+'" class="img-responsive" width="80px" height="40px" >';;
				
				jQuery('#detail-submission').modal('show'); 
				
				
				
			}else if(aksi == 'edit'){
				
				jQuery('#form-submission').modal('show'); 
				 
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
        if(aksi == 'edit') 
      {
        url = "<?php echo site_url('backend/submission_loan/update_submission')?>";
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

<!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.bootstrap.min.js" type="text/javascript"></script>    
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.responsive.min.js" type="text/javascript"></script>    