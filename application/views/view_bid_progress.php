<link href="<?php echo base_url(); ?>assets/jquery/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/custom/css/admin-datatable.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/custom/css/web-grid.css" rel="stylesheet" type="text/css">

<!-- <link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css " rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js " type="text/javascript"></script>
 -->
<script src="<?php echo base_url();?>assets/jquery/js/jquery.dataTables.min.js" type="text/javascript"></script>
<style>
    .top-border{
        border-top: 1px solid #5C5C76 !important;
    }

    #tbl_loan_list thead tr th {
        border-bottom: 1px solid #B0B0B0;
    }

    .bottom-border{
        border-bottom: 1px solid #5C5C76 !important;
    }

    #tbl_loan_list {
        border-bottom: 1px solid #B0B0B0;
    }

    #popupForm {
        position: fixed;
        top: 50%;
        left: 50%;
        margin-left: -100px;
        margin-top: -50px;
    }
</style>
<script type="text/javascript">
    /* Formatting function for row details - modify as you need */
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table class="tbl_detail" cellpadding="5" cellspacing="0" border="0" >'+
            '<tr >'+
                '<td colspan="4"><h4>Ringkasan Pinjaman</h4></td>'+
            '</tr>'+
            '<tr >'+
                '<td><b>Jumlah Pinjaman:</b></td>'+
                '<td>'+d.amount+'</td>'+
                '<td><b>Id Pinjaman:</b></td>'+
                '<td>'+d.code+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td><b>Tenor:</b></td>'+
                '<td>'+d.period+'</td>'+
                '<td><b>Tanggal penutupan pendanaan:</b></td>'+
                '<td>'+d.closing_date+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td><b>Interest Return:</b></td>'+
                '<td>'+d.eir_percent+'</td>'+
                '<td><b>Schema Start Date:</b></td>'+
                '<td style="color:red">???</td>'+
            '</tr>'+
            '<tr>'+
                '<td><b>Investor Fee:</b></td>'+
                '<td style="color:red">???</td>'+
                '<td><b>Type:</b></td>'+
                '<td style="color:red">???</td>'+
            '</tr>'+
            '<tr>'+
                '<td><b>Penilaian resiko:</b></td>'+
                '<td>'+d.risk_name+'</td>'+
                '<td><b>Tujuan peminjaman:</b></td>'+
                '<td>'+d.loan_purpose_name+'</td>'+
            '</tr>'+
            '<tr><td colspan="4"><br/></td></tr>' +
            '<tr >'+
                '<td colspan="2"><h4>Detail Peminjam</h4></td>'+
                '<td colspan="2"><h4>Jadwal Pembayaran</h4></td>'+
            '</tr>'+
            '<tr>'+
                // '<td><b>Borrower ID:</b></td>'+
                // '<td>'+d.borrower_code+'</td>'+
                '<td colspan="2" style="vertical-align: text-top; text-align: left; padding-left: 0px !important;">'+
                    '<table>'+
                        '<tbody>'+
                            '<tr>'+
                                '<td><b>Kode Peminjam:</b></td>'+
                                '<td>'+d.borrower_code+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><b>Modal usaha:</b></td>'+
                                '<td>'+d.b_company_paid_up_capital+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><b>Jumlah karyawan:</b></td>'+
                                '<td>'+d.b_company_man_power+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><b>Pendapatan perusahaan pertahun:</b></td>'+
                                '<td>'+d.b_company_revenue+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td><b>Ini perusahaan baru?</b></td>'+
                                '<td>'+(d.b_company_is_new==1?'Ya':'Tidak')+'</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</td>'+
                '<td colspan="2">'+
                    '<table id="repay_'+ d.loan_id +'">'+
                        '<thead>'+
                            '<th class="bottom-border">Bulan ke 1</th>'+
                            '<th class="bottom-border">Pinjaman (Rp)</th>'+
                            '<th class="bottom-border">Sukubunga (Rp)</th>'+
                            '<th class="bottom-border">Dibayarkan (Rp)</th>'+
                            '<th class="bottom-border">Sisa Pembayaran (Rp)</th>'+
                            '<th class="bottom-border">Status</th>'+
                        '</thead>'+
                        '<tfoot>'+
                           ' <tr>'+
                                '<th class="top-border">Total: </th>'+
                                '<th class="top-border"></th>'+
                                '<th class="top-border"></th>'+
                                '<th class="top-border"></th>'+
                                '<th class="top-border"></th>'+
                                '<th class="top-border"></th>'+
                            '</tr>'+
                        '</tfoot>'+
                    '</table>'+
                '</td>'+
                // '<td></td>'+
            '</tr>'+
            // '<tr>'+
                // '<td><b>Company Paid Up Capital:</b></td>'+
                // '<td>'+d.b_company_paid_up_capital+'</td>'+
                // '<td></td>'+
                // '<td></td>'+
            // '</tr>'+
            // '<tr>'+
                // '<td><b>Company Man Power:</b></td>'+
                // '<td>'+d.b_company_man_power+'</td>'+
                // '<td></td>'+
                // '<td></td>'+
            // '</tr>'+
            // '<tr>'+
                // '<td><b>Company Revenue:</b></td>'+
                // '<td>'+d.b_company_revenue+'</td>'+
                // '<td></td>'+
                // '<td></td>'+
            // '</tr>'+
            // '<tr>'+
                // '<td><b>This is a New Company:</b></td>'+
                // '<td>'+(d.b_company_is_new==1?'Yes':'No')+'</td>'+
                // '<td></td>'+
                // '<td></td>'+
            // '</tr>'+
            '<tr><td colspan="4"><br /></td></tr>' +
        '</table>';
    }
     //"ajax": "<?php echo base_url();?>assets/expandable-table/js//objects.txt",
    $(document).ready(function() {
        var table = $('#tbl_loan_list').DataTable( {
            "columns": [
                { "data": "loan_id" },
                { "data": "period" },
                { "data": "eir_percent" },
                { "data": "borrower_code" },
                { "data": "b_company_paid_up_capital" },
                { "data": "b_company_man_power" },
                { "data": "b_company_revenue" },
                { "data": "b_company_is_new" },
                { "data": "total_bid_amount" },
                { "data": "loan_purpose_name" },
                { "data": "closing_date" },
                { "data": "investment" },
                { "data": "code" },
                { "data": "risk_name" },
                { "data": "amount" },
                { "data": "available_bid_amount" },
                { "data": "period" },
                { "data": "progress" },
                { "data": "time_left" },
                {
                    "className"     : 'details-control',
                    "orderable"     : false,
                    "data"          : null,
                    "defaultContent": ''
                }
            ],
            "columnDefs": [{ //No sorting for investment column
                "orderable": false,
                "targets": [ "no-sort" ]
            }],
            "order"     : [[1, 'asc']],
            // "responsive": true,
            "dom"       : '<"dataTables_CustomFilter">rtip'
        } );

        $("div.dataTables_CustomFilter").html(
            '<label>Terms:</label>'+
            '<input id="chk_period_all" name="chk_period_all" type="checkbox" class="chk_period" value="" /><label for="chk_period_all">All</label>'+
            '<input id="chk_period_3" name="chk_period_3" type="checkbox" class="chk_period" value="3" /><label for="chk_period_3">3 bulan</label>'+
            '<input id="chk_period_6" name="chk_period_6" type="checkbox" class="chk_period" value="6" /><label for="chk_period_6">6 bulan</label>'+
            '<input id="chk_period_9" name="chk_period_9" type="checkbox" class="chk_period" value="9" /><label for="chk_period_9">9 bulan</label>'+
            '<input id="chk_period_12" name="chk_period_12" type="checkbox" class="chk_period" value="12" /><label for="chk_period_12">12 bulan</label>'+
            '<input id="chk_period_18" name="chk_period_18" type="checkbox" class="chk_period" value="18" /><label for="chk_period_18">18 bulan</label>'+
            '<input id="chk_period_24" name="chk_period_24" type="checkbox" class="chk_period" value="24" /><label for="chk_period_24">24 bulan</label>'+

            '<br />' +
            '<label>Search:<input id="txt_filter" type="search" class="form-control input-sm" placeholder="" aria-controls="tbl_loan_list"></label>');

        $('#txt_filter').on( 'keyup', function () {
            table.search( this.value ).draw();
        });

        $('.chk_period').on( 'change', function () {
            table.columns( 0 ).search("^(?=.*?(" + generate_reg_exp() + ")).*?", true, false, true).draw();
        });

        function generate_reg_exp()
        {
            var l_value = "";
            if ($('#chk_period_all').prop("checked"))
            {
                $('#chk_period_3').prop('checked', true);
                $('#chk_period_6').prop('checked', true);
                $('#chk_period_9').prop('checked', true);
                $('#chk_period_12').prop('checked', true);
                $('#chk_period_18').prop('checked', true);
                $('#chk_period_24').prop('checked', true);
            }
            else
            {
                if ($('#chk_period_3').prop("checked"))
                    l_value = l_value + "3|";

                if ($('#chk_period_6').prop("checked"))
                    l_value = l_value + "6|";

                if ($('#chk_period_9').prop("checked"))
                    l_value = l_value + "9|";

                if ($('#chk_period_12').prop("checked"))
                    l_value = l_value + "12|";
                
                if ($('#chk_period_18').prop("checked"))
                    l_value = l_value + "18|";

                if ($('#chk_period_24').prop("checked"))
                    l_value = l_value + "24|";

                if (l_value != "")
                {
                    l_value = l_value.substring(0, l_value.length - 1);
                }
            }
            return l_value;
        }

        // Add event listener for opening and closing details
        $('#tbl_loan_list tbody').on('click', 'td.expand', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
     
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
                $("#repay_" + row.data().loan_id).DataTable().destroy();
            }
            else
            {
                // Open this row
                row.child(format(row.data()) ).show();
                tr.addClass('shown');
                // Render repayment table
                $("#repay_" + row.data().loan_id).DataTable({
                    'searching'   : false,
                    'lengthMenu'  : [-1],
                    'lengthChange': false,
                    'paging'      : false,
                    'ordering'    : false,
                    'info'        : false,
                    'destroy'     : true,
                    // 'responsive'  : true,
                    'ajax'        : {                                        
                        "type"      : "POST",
                        "url"       : "<?php echo base_url(); ?>" + "investor/application/get_repayment_listing",
                        "data"      : {loan_id : row.data().loan_id},
                        "processing": true,
                        "dataSrc"   : function (json) {
                            var return_data = new Array();
                            for(var i=0;i< json.length; i++){
                                return_data.push({
                                    'schedule'  : json[i].schedule,
                                    'principal' : json[i].principal,
                                    'interest'  : json[i].interest,
                                    'instalment': json[i].instalment,
                                    'balance'   : json[i].balance,
                                    'status'    : json[i].status
                                })
                            }
                            return return_data;
                        }
                    },
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(), data;
 
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        total_principle = api
                            .column( 1 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        total_interest = api
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        total_instalment = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Update footer
                        $( api.column( 1 ).footer() ).html(
                            'Rp ' + total_principle.toFixed(2)
                        );
                        $( api.column( 2 ).footer() ).html(
                            'Rp ' + total_interest.toFixed(2)
                        );
                        $( api.column( 3 ).footer() ).html(
                            'Rp ' + total_instalment.toFixed(2)
                        );
                    },
                    "columns"     : [                                        
                        {'data': 'schedule'},
                        {'data': 'principal'},
                        {'data': 'interest'},
                        {'data': 'instalment'},
                        {'data': 'balance'},
                        {'data': 'status'}
                    ]
                });
            }
        });
    });
    
    function bid(pID){
        $("#h_loan_id").val(pID);
    }

    $(document).ready(function() {
        $("#popupForm").draggable();
    } );
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
    function add_bid(pID,nilai,sisa)
    {
        $(this).unbind('myform').submit();
var text='#txt_amount'+nilai;
        $("#h_loan_id").val(pID);
        $("#h_amount").val($(text).val());
		 $("#h_sisa").val(sisa);
		document.getElementById('x_amount').innerHTML = toRp($(text).val());
        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        $(".modal-overlay").fadeTo(500, 0.7);
        $('#popupForm').fadeIn($(this).data());
    }

    $(function(){
        $("#btnOK").click(function() 
        {
            $(this).unbind('myform').submit();

            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

            $('#myform').attr('action', '<?php echo base_url(); ?>investor/application/bid');
            document.getElementById("myform").submit();
        });
    });

</script>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h3>Bid anda<span class="small"> </span></h3>
            <hr>
        </div>      
         <div class="col-lg-3 col-xs-12 well well-sm" style="margin: 25px 0px 0px;">
            <span style="font-size:15px">Saldo</span>
            <br>
           <small>Rp</small>
            <span style="font-size: 35px"><?php echo $this->model_backend->rupiah($totaldeposit); ?></span>
            <a href="<?php echo base_url();?>investor/tambah-saldo"" class="btn btn-info btn-block">Tambah Saldo</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
		
           <?php if (!empty($this->session->flashdata('gagal'))) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert" id="lbl_Success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong><?php echo ($this->session->flashdata('gagal')); ?></strong>
				</div>
	    <?php } ?>
        </div>
    </div>

	<div class="row">
        <div class="col-lg-12">
            <table id="tbl_loan_list" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="hidden">Kode Pinjaman</th>
                        <th class="hidden">Tenor</th>
                        <th class="hidden">EIR</th>
                        <th class="hidden">Kode Pinjaman</th>
                        <th class="hidden">Company Paid Up Capital</th>
                        <th class="hidden">Jumlah Karyawan</th>
                        <th class="hidden">Pendapatan Perusahaan</th>
                        <th class="hidden">Perusahaan baru?</th>
                        <th class="hidden">Total bid</th>
                        <th class="hidden">Tujuan</th>
                        <th class="hidden">Tanggal Closing</th>
                        <th class="desktop no-sort">Investasi</th> <!-- no-sort disables the sorting for this column -->
                        <th class="desktop">Id Pinjaman</th>
                        <th class="desktop text-center">Resiko</th>
                        <th class="desktop text-center">Pinjaman</th>
                        <th class="desktop text-center">Bid tersedia</th>
                        <th class="desktop text-center">Tenor</th>
                        <th class="desktop text-center">Progres %</th>
                        <th class="desktop text-center">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					// $this->load->model("model_backend");
					// $this->load->model("model_bid");
					 
					for ($i = 0; $i < count($loan_list); ++$i) { 
					
					$jumlahbid= $this->model_bid->get_sum_bid($loan_list[$i]->loan_id,1);
					$jumlahbiduser= $this->model_bid->get_sum_bid($loan_list[$i]->loan_id,1,get_cookie("user_id"));
					$persentasi=round(($jumlahbid['sum(bid_amount)'] * 100) / $loan_list[$i]->amount);
					$sisa=($loan_list[$i]->amount - $jumlahbid['sum(bid_amount)']);
					
					if($jumlahbiduser['sum(bid_amount)'] != 0){
					?>
                    <tr>
                        <td class="hidden"><?php echo $loan_list[$i]->loan_id; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->period; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->eir_percent.'%'; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->borrower_code; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->b_company_paid_up_capital; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->b_company_man_power; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->b_company_revenue; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->b_company_is_new; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->total_bid_amount; ?></td>
                        <td class="hidden"><?php 
                            if ($loan_list[$i]->loan_purpose_id == 0)
                                echo $loan_list[$i]->loan_purpose_other;
                            else
                                echo $loan_list[$i]->loan_purpose_name;
                            ?>
                        </td>
                        <td class="hidden"><?php echo date ("d-M-Y",strtotime($loan_list[$i]->closing_date)); ?></td>
                        <td class="desktop">
                            <b>Bid Saya: Rp 
                            <?php
                               
                               echo $this->model_backend->rupiah($jumlahbiduser['sum(bid_amount)']);
                            ?>
                            </b><br/>
                            <span class="small"></span>
                        </td>
                        <td class="desktop expand"><?php echo $loan_list[$i]->code; ?></td>
                        <td class="desktop text-center expand"><?php echo $loan_list[$i]->risk_name; ?></td>
                        <td class="desktop text-center expand">Rp <?php echo number_format($loan_list[$i]->amount, 0); ?></td>
                        <td class="desktop text-center expand">Rp <?php echo number_format($sisa,0); ?></td>
                        <td class="desktop text-center expand"><?php echo $loan_list[$i]->period; ?> bulan</td>
                        <td class="desktop text-center expand">
                            <div class="progress">
                                <?php 
                                    if($loan_list[$i]->time_left < 0)
                                        $progress_percent = 100;
                                    else
                                        $progress_percent = 8;
                                ?>
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persentasi; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $persentasi; ?>%"><?php echo $persentasi; ?>% Complete
                                </div>
                            </div>
                        </td>
                        <td class="desktop text-center expand">
                            <?php 
                              
                                    switch ($loan_list[$i]->status_suggest)
                                    {
                                        case 1:
                                        {
                                            echo "Penawaran";
                                            break;
                                        }
                                        case 2:
                                        {
                                            echo "Telah disetujui";
                                            break;
                                        }
                                        default:
                                        {
                                            echo 'Proses BID';
                                            break;
                                        }
                                    }
                                
                            ?>
                        </td>
                        <td class="desktop expand"></td>
                    </tr>
					
                    <?php }
					} ?>
                </tbody>
            </table>           
        </div>
    </div>  
</div>	

				
		
<form action="<?php echo base_url(); ?>investor/bid" id="myform" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Konfirmasi Bid</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body" style="max-height:300px;overflow-y: auto">
        <div class="row">
            <!-- <div class="alert alert-warning" role="alert"></div> -->
        </div>
        <div class="row">
           <h4 align="center"> Anda yakin ingin melakukan bid sebesar</h4><h3 align="center"><p id="x_amount"><p></h3>
            <br /><br /><br /><br /><br />
            <input type="hidden" id="h_loan_id" name="h_loan_id" value="">
            <input type="hidden" id="h_amount" name="h_amount" value="">
			 <input type="hidden" id="h_sisa" name="h_sisa" value="">
        </div>
    </div>
    <footer> 
      <button type="submit" class="js-modal-close btn btn-info" onclick="proceed();">Submit Bid</button>
    </footer>
</div>
</form>

<script>


function proceed () {
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', '<?php echo base_url(); ?>investor/bid');
    form.style.display = 'hidden';
    document.body.appendChild(form)
    form.submit();
}
</script>
