<link href="<?php echo base_url(); ?>assets/jquery/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/custom/css/admin-datatable.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/custom/css/web-grid.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/custom/css/investor-make-listing.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>assets/bootstrap-sweetalert-master/dist/sweetalert.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/bootstrap-sweetalert-master/dist/sweetalert.min.js" type="text/javascript"></script>


<!--
<link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css " rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js " type="text/javascript"></script>
-->
<script src="<?php echo base_url(); ?>assets/jquery/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script type="text/javascript">
	function toRp(angka){
		var str=angka;
  var rp = str.replace(/,/g, ".");
    return rp;
}
	function toRp2(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp ' + rev2.split('').reverse().join('') + '';
}
    /* Formatting function for row details - modify as you need */
    var baseUrl = "<?php echo base_url(); ?>";
    function format ( d ) {
        // `d` is the original data object for the row
        return '<div class="tabbable-panel">'+
                    '<div class="tabbable-line">'+
                        '<ul class="nav nav-tabs ">'+
                            '<li class="active">'+
                                '<a href="#overview_'+d.loan_id+'" data-toggle="tab">Overview</a>'+
                            '</li>'+
                        //    '<li>'+
                        //        '<a href="#company_'+d.loan_id+'" data-toggle="tab">Company Profile</a>'+
                       //     '</li>'+
                            '<li>'+
                                '<a href="#scheme_'+d.loan_id+'" data-toggle="tab">Skema</a>'+
                            '</li>'+
                            '<li>'+
                                '<a href="#repayment_'+d.loan_id+'" data-toggle="tab">Jadwal Pembayaran</a>'+
                            '</li>'+
                        '</ul>'+
                        '<div class="tab-content">'+
                            '<div class="tab-pane active" id="overview_'+d.loan_id+'">'+
                                '<table class="tabbed_table">'+
                                    '<tbody>'+
                                        '<tr>'+
                                            '<td><b>ID Peminjam:</b></td>'+
                                            '<td>'+d.user_code+'</td>'+
                                            '<td><b>Pendapatan per-tahun:</b></td>'+
                                            '<td>'+toRp(d.b_company_revenue_id)+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td><b>Modal usaha:</b></td>'+
                                            '<td>'+toRp(d.b_company_paid_up_capital)+'</td>'+
                                            '<td><b>Perusahaan Baru</b></td>'+
                                            '<td>'+(d.b_company_is_new==1?'Yes':'No')+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td><b>Jumlah Karyawan:</b></td>'+
                                            '<td>'+d.b_company_man_power+'</td>'+
                                            '<td></td>'+
                                            '<td></td>'+
                                        '</tr>'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                            '<div class="tab-pane" id="company_'+d.loan_id+'">'+
                                '<div class="row">'+
                                    '<div class="col-lg-12" style="padding: 0px 50px 0px 50px">'+
                                        '<div class="fb-profile">'+
                                          //  '<img align="left" class="fb-image-md" src="'+baseUrl+'assets/img/logo-rajakredit.png"/>'+
                                         //   '<img align="left" class="fb-image-profile thumbnail" src="'+baseUrl+'assets/img/profile_pict.jpg" width="100px" height="100px" alt="Profile Picture"/>'+
                                            '<div class="fb-profile-text">'+
                                                '<h1>'+d.b_company_name+'</h1>'+
                                                '<p>Google is an American multinational technology company specializing in Internet-related services and products. These include online advertising technologies, search, cloud computing, and software. Most of its profits are derived from AdWords, an online advertising service that places advertising near the list of search results.<br><br>Google was founded by Larry Page and Sergey Brin while they were Ph.D. students at Stanford University. Together, they own about 14 percent of its shares and control 56 percent of the stockholder voting power through supervoting stock. They incorporated Google as a privately held company on September 4, 1998. An initial public offering followed on August 19, 2004. Its mission statement from the outset was "to organize the world\'s information and make it universally accessible and useful," and its unofficial slogan was "Don\'t be evil". In 2004, Google moved to its new headquarters in Mountain View, California, nicknamed the Googleplex. In August 2015, Google announced plans to reorganize its interests as a holding company called Alphabet Inc. When this restructuring took place on October 2, 2015, Google became Alphabet\'s leading subsidiary, as well as the parent for Google\'s Internet interests.<br><br>Rapid growth since incorporation has triggered a chain of products, acquisitions and partnerships beyond Google\'s core search engine (Google Search). It offers online productivity software (Google Docs) including email (Gmail), a cloud storage service (Google Drive) and a social networking service (Google+). Desktop products include applications for web browsing (Google Chrome), organizing and editing photos (Google Photos), and instant messaging (Hangouts). The company leads the development of the Android mobile operating system and the browser-only Chrome OS for a class of netbooks known as Chromebooks. Google has moved increasingly into communications hardware: it partners with major electronics manufacturers in the production of its "high-quality low-cost" Nexus devices. In 2012, a fiber-optic infrastructure was installed in Kansas City to facilitate a Google Fiber broadband service.<br><br>The corporation has been estimated to run more than one million servers in data centers around the world (as of 2007). It processes over one billion search requests and about 24 petabytes of user-generated data each day (as of 2009). In December 2013, Alexa listed google.com as the most visited website in the world. Numerous Google sites in other languages figure in the top one hundred, as do several other Google-owned sites such as YouTube and Blogger. Its market dominance has led to prominent media coverage, including criticism of the company over issues such as aggressive tax avoidance, search neutrality, copyright, censorship, and privacy.</p>'+
                                                '<a href="#" class="btn btn-info pull-right">Link</a>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="tab-pane" id="scheme_'+d.loan_id+'">'+
                                '<table class="tabbed_table">'+
                                    '<tr>'+
                                        '<td><b>Pinjaman:</b></td>'+
                                        '<td>'+toRp(d.amount)+'</td>'+
                                        '<td><b>Id Pinjaman:</b></td>'+
                                        '<td>'+d.code+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>Tenor:</b></td>'+
                                        '<td>'+d.period+'</td>'+
                                        '<td><b>Closing Funding Period:</b></td>'+
                                        '<td>'+d.closing_date+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>Suku Bunga:</b></td>'+
                                        '<td>'+d.eir_percent+'</td>'+
                                        '<td><b>Scheme Start Date:</b></td>'+
                                        '<td>'+d.submitted_date+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>Investor Fee:</b></td>'+
                                        '<td>'+d.investor_fee+'</td>'+
                                      //  '<td><b>Type:</b></td>'+
                                      //  '<td>Promissory Note</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>Resiko:</b></td>'+
                                        '<td>'+d.risk_name+'</td>'+
                                        '<td><b>Tujuan Peminjaman:</b></td>'+
                                        '<td>'+d.loan_purpose_name+'</td>'+
                                    '</tr>'+
                                '</table>'+
                            '</div>'+
                            '<div class="tab-pane" id="repayment_'+d.loan_id+'">'+
                                '<table class="display compact repay_table" id="repay_'+ d.loan_id +'" cellspacing="0" width="100%">'+
                                    '<thead>'+
                                        '<th class="bottom-border">Tanggal</th>'+
                                        '<th class="bottom-border">Pinjaman</th>'+
                                        '<th class="bottom-border">Principal</th>'+
                                        '<th class="bottom-border">Bunga</th>'+
                                        '<th class="bottom-border">Cicilan-perbulan</th>'+
                                        '<th class="bottom-border">Total Dibayar</th>'+
                                        '<th class="bottom-border">Status</th>'+
                                    '</thead>'+
                                    '<tfoot>'+
                                       ' <tr>'+
                                            '<th class="top-border"><b>Total:</b> </th>'+
                                            '<th class="top-border"></th>'+
                                            '<th class="top-border"></th>'+
                                            '<th class="top-border"></th>'+
                                            '<th class="top-border"></th>'+  
                                            '<th class="top-border"></th>'+
                                            '<th class="top-border"></th>'+
                                        '</tr>'+
                                    '</tfoot>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
    }
     //"ajax": "http://52.62.6.155/credit-direct/assets/expandable-table/js//objects.txt",
    $(document).ready(function() {
        $(".alert").hide();

        var table = $('#tbl_loan_list').DataTable( {
            "columns": [
                { "data": "loan_id" },
                { "data": "period" },
                { "data": "eir_percent" },
                { "data": "investor_fee" },
                { "data": "user_code" },
                { "data": "b_company_name" },
                { "data": "b_company_paid_up_capital" },
                { "data": "b_company_man_power" },
                { "data": "b_company_revenue_id" },
                { "data": "b_company_is_new" },
                { "data": "total_bid_amount" },
                { "data": "loan_purpose_name" },
                { "data": "submitted_date" },
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
            '<input id="chk_period_3" name="chk_period_3" type="checkbox" class="chk_period" value="3" /><label for="chk_period_3">3 mths</label>'+
            '<input id="chk_period_6" name="chk_period_6" type="checkbox" class="chk_period" value="6" /><label for="chk_period_6">6 mths</label>'+
            '<input id="chk_period_9" name="chk_period_9" type="checkbox" class="chk_period" value="9" /><label for="chk_period_9">9 mths</label>'+
            '<input id="chk_period_12" name="chk_period_12" type="checkbox" class="chk_period" value="12" /><label for="chk_period_12">12 mths</label>'+
            // '<input id="chk_period_18" name="chk_period_18" type="checkbox" class="chk_period" value="18" /><label for="chk_period_18">18 mths</label>'+
            // '<input id="chk_period_24" name="chk_period_24" type="checkbox" class="chk_period" value="24" /><label for="chk_period_24">24 mths</label>'+

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
                // $('#chk_period_18').prop('checked', true);
                // $('#chk_period_24').prop('checked', true);
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
                
                // if ($('#chk_period_18').prop("checked"))
                //     l_value = l_value + "18|";

                // if ($('#chk_period_24').prop("checked"))
                //     l_value = l_value + "24|";

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
								var status;
								if(json[i].status == 1){
									status="Pending";
								}
								
                                return_data.push({
                                    'schedule'                   : json[i].schedule,
                                    'outstanding_principal'      : ''+" "+toRp2(json[i].amount),
                                    'monthly_repayment'          : ''+" "+toRp2(json[i].principal),
                                    'principal_portion'          : ''+" "+toRp2(json[i].interest)+' %',
                                    'interest_portion'           : ''+" "+toRp2(json[i].instalment),     'outstanding_principal_after': ''+" "+toRp2(json[i].instalment),
                                    'status'                     : status
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
                            i.replace(/[\'Rp ' .]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        total_outstanding_principal = api
                            .column( 1 )
                            .data()
                            .reduce( function (a, b) {
                                return '';
                            }, 0 );
                        total_monthly_repayment = api
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        total_principal_portion = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        total_interest_portion = api
                            .column( 4 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        total_outstanding_principal_after = api
                            .column( 5 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Update footer
                        $( api.column( 1 ).footer() ).html(
                            '' + ' ' + total_outstanding_principal.toLocaleString()
                        );
                        $( api.column( 2 ).footer() ).html(
                            'Rp' + ' ' + total_monthly_repayment.toLocaleString()
                        );
                      
                        $( api.column( 4 ).footer() ).html(
                            'Rp' + ' ' + total_interest_portion.toLocaleString()
                        );
                      
                        $( api.column( 5 ).footer() ).html(
                            'Rp' + ' ' + total_outstanding_principal_after.toLocaleString()
                        );
                    },
                    "columns"     : [                                        
                        {
                            'data'  : 'schedule',
                            'class' : 'table_column_center',
                            'render': function (data, type, full, meta){
                                var s=["","","",""],
                                v=data%100;
                                return data+(s[(v-20)%10]||s[v]||s[0]);
                            }
                        },
                        {
                            'data' : 'outstanding_principal',
                            'class': 'table_column_right'
                        },
                        {
                            'data' : 'monthly_repayment',
                            'class': 'table_column_right'
                        },
                        {
                            'data' : 'principal_portion',
                            'class': 'table_column_right'
                        },
                        {
                            'data' : 'interest_portion',
                            'class': 'table_column_right'
                        },
                        {
                            'data' : 'outstanding_principal_after',
                            'class': 'table_column_right table_width',
                        },
                        {
                            'data' : 'status',
                            'class': 'table_column_center'
                        }
                    ]
                });
            }
        });
    });

    $(document).ready(function() {
        $("#popupForm").draggable();
    } );

    function add_bid(pID,nilai,sisa,tenor,saldo)
    {
        $(this).unbind('myform').submit();
		var text='#txt_amount'+nilai;
		var c =toRp2($(text).val());
	//alert('<input type="text">');
		
      //  $("#h_loan_id").val(pID);
      //   $("#h_amount").val($(text).val());
		// $("#h_sisa").val(sisa);
		 $('[name="h_amount"]').val($(text).val());
		  $('[name="h_sisa"]').val(sisa);
		   $('[name="h_loan_id"]').val(pID);
		
	
		  jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "investor/bid/loan_detail/"+pID,
            dataType: 'json',
            data: {loan_id: pID},
                success: function(res) {
					//alert(res.code);
					 $("#h_loan_code").val(res.code);
					 var period=res.period+' Bulan';
					  $("#h_tenor").val(period);
					  $("#h_company_name").val(res.b_company_name);
					  
					     if (($(text).val().trim() == "")){
                            swal({
                                title             : "Error!",
                                text              : "The Bid field is required.",
                                type              : "error",
                                confirmButtonClass: "btn-info"
                            });
                            return;
                        }else if (($(text).val().trim() == 0)){
                            swal({
                                title             : "Maaf!",
                                text              : "Nilai bid tidak boleh 0",
                                type              : "error",
                                confirmButtonClass: "btn-info"
                            });
                            return;
                        }else if (($(text).val().trim() > sisa)){
                            swal({
                                title             : "Maaf!",
                                text              : "Nilai bid tidak boleh melebihi "+ sisa,
                                type              : "error",
                                confirmButtonClass: "btn-info"
                            });
                            return;
                        }else if (($(text).val().trim() > saldo)){
                            swal({
                                title             : "Maaf!",
                                text              : "Saldo anda tidak cukup",
                                type              : "error",
                                confirmButtonClass: "btn-info"
                            });
                            return;
                        }
                    
					  
					  
					  
					  // Sweet Alert
                        swal({
                            title: 'Konfirmasi Bid',
                            text:
                            '<label>Pinjaman</label>'+
                            '<br>'+
                            'Rp ' + res.amount+
                            '<br><br>'+
                            '<label>Kode Pinjaman</label>'+
                            '<br>'+
                            res.code+
                            '<br><br>'+
                            '<label>Tenor</label>'+
                            '<br>'+
                            res.period+' Bulan'+
                            '<br><br>'+
                            '<label>Perusahaan</label>'+
                            '<br>'+
                            res.b_company_name+
                            '<br><br>'+
							  '<label>Bid Anda</label>'+
                            '<br>'+(c),
                          //  '<br><br>'+
                         //   'By clicking "Confirm", you agree to be bound by the <a id="t-c" href="#">terms & conditions</a> stated in the Agreement.',
                            html               : true,
                            confirmButtonText  : 'Konfirmasi',
                            confirmButtonClass : "btn-info",
                            showCancelButton   : true,
                            closeOnConfirm     : false,
                            showLoaderOnConfirm: true
                        }, function() {
                           
						  
						 //  proceed ()
						 //alert($("#h_amount").val($(text).val()));
						
                            setTimeout(function() {
                                swal({
                                    title            : "Berhasil!",
									text			 :	'<br><label>Silahkan cek email anda untuk konfirmasi</label>',
									html               : true,	
                                    type             : "success",
                                    timer            : 4000,
                                    showConfirmButton: false
                                });
                            }, 2000);
							
							 setTimeout(function() {
                                $('#formku').attr('action', '<?php echo base_url(); ?>investor/bid');
                            document.getElementById("formku").submit();
                            }, 5000);
                                
                         
							
                        });


					  
				}
			});
		
		 
	//	document.getElementById('x_amount').innerHTML = toRp($(text).val());
     //   var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
     //   $("body").append(appendthis);
      //  $(".modal-overlay").fadeTo(500, 0.7);
      //  $('#popupForm').fadeIn($(this).data());
    }
	
	    function add_bid2(pID,nilai,sisa)
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
	
    function add_bid_(pID,nilai,sisa,tenor,company_name)
    {
		alert('tes');
        $("#txt_amount_confirm").val(0);
        $(this).unbind('myform').submit();
        $(".alert").hide();

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "investor/bid/loan_detail",
            dataType: 'json',
            data: {loan_id: pID},
                success: function(res) {
                    if (res)
                    {
                        // var message = "";
                        var message = [];

                        if ($("#txt_amount_"+res.loan_id).val().trim() == ""){
                            // message = message + "The Bid field is required.";
                            message.push("The Bid field is required.");
                        }
                        if ($("#txt_amount_"+res.loan_id).val() == 0){
                            // message = message + "The Bid amount cannot be zero.";
                            message.push("The Bid amount cannot be zero.");
                        }
                        if (($("#txt_amount_"+res.loan_id).val() * 1000) > res.available_bid_amount){
                            // message = message + "The Bid amount cannot more than available bid amount.";
                            message.push("The Bid amount cannot more than available bid amount.");
                        }
                        if (($("#txt_amount_"+res.loan_id).val() * 1000) > res.wallet_amount){
                            // message = message + "The Bid amount cannot more than wallet amount.";
                            message.push("The Bid amount cannot more than wallet amount.");
                        }
                        if ($("#txt_amount_"+res.loan_id).val() % 1 != 0){
                            // message = message + "The Bid amount must be numeric.";
                            message.push("The Bid amount must not be decimal.");
                        }
                        // if (message != "")
                        if (message.length > 0)
                        {
                            // $("#lbl_message_"+res.loan_id).html(message);
                            // $("#lbl_message_"+res.loan_id).show();
                            // $("#lbl_message_"+res.loan_id).fadeTo(4500, 0);
                            // alert(message);
                            alert(message.join("\n"));
                            return;
                        }

                        $("#h_loan_id").val(res.loan_id);
                        $("#h_amount").val($("#txt_amount_"+res.loan_id).val());
                        $("#txt_amount_confirm").val("Rp " + ($("#txt_amount_"+res.loan_id).val() * 1000).toLocaleString());
                        $("#txt_code_confirm").val(res.code);
                        $("#txt_term_confirm").val(res.period+" months");
                        $("#txt_company_name_confirm").val(res.company_name);

                        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
                        $("body").append(appendthis);
                        $(".modal-overlay").fadeTo(500, 0.7);
                        $('#popupForm').fadeIn($(this).data());
                    }
                }
        });

    }

    $(function(){
        $("#btnOK").click(function() 
        {
            $(this).unbind('myform').submit();

            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

            $('#myform').attr('action', '<?php echo base_url(); ?>investor/bid/add');
            document.getElementById("myform").submit();
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-xs-12">
		<br>
            <h3>Lakukan Investasi <span class="small"></span></h3>
            <hr>
        </div>
        <div class="col-lg-3 col-xs-12 well well-sm" style="margin: 25px 0px 0px;">
            <span style="font-size:15px">Saldo</span>
            <br>
           <small>Rp</small>
            <span style="font-size: 35px"><?php echo $this->model_backend->rupiah($totaldeposit); ?></span>
            <a href="<?php echo base_url();?>investor/tambah-saldo"" class="btn btn-info btn-block">Tambah Saldo</a>
        </div>
        <span class="col-xs-12"><BR></span>
    </div>
     <div class="row">
        <div class="col-lg-12">
		
				<div class="alert alert-danger alert-dismissible" role="alert" id="lbl_Success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong><?php //echo ($this->session->flashdata('gagal')); ?></strong>
				</div>
	  
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
						 <th class="hidden">Investor Fee</th>
                        <th class="hidden">Kode Pinjaman</th>
						   <th class="hidden">Company Name</th>
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
                        <th class="desktop text-center">Batas Waktu</th>
                        <th>&nbsp;&nbsp;</th>
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
					$sisa=($loan_list[$i]->amount - $jumlahbid['sum(bid_amount)'])-($loan_list[$i]->amount/100*70);
					?>
					
                     <tr>
                        <!-- Child -->
                         <td class="hidden"><?php echo $loan_list[$i]->loan_id; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->period; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->eir_percent.'%'; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->user_code; ?></td>
						 <td class="hidden"><?php echo $loan_list[$i]->user_code; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->b_company_man_power; ?></td>
                        <td class="hidden">Rp <?php echo $this->model_backend->rupiah($loan_list[$i]->b_company_revenue); ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->b_company_is_new; ?></td>
                        <td class="hidden">Rp <?php //echo $this->model_backend->rupiah($loan_list[$i]->total_bid_amount);
						echo $this->model_backend->rupiah($loan_list[$i]->b_company_paid_up_capital);
						?></td>
                        <td class="hidden">0</td>
                        <!-- Bids -->
                        <td class="hidden">8000.00</td>
                        <!-- Child -->
                        <td class="hidden"><?php 
                            if ($loan_list[$i]->loan_purpose_id == 0)
                                echo $loan_list[$i]->loan_purpose_other;
                            else
                                echo $loan_list[$i]->loan_purpose_name;
                            ?></td>
                        <!-- Bids -->
                        <td class="hidden"><?php echo $loan_list[$i]->submitted_date; ?></td>
                        <td class="hidden"><?php echo $loan_list[$i]->closing_date; ?></td>
                        <div id="lbl_message_28" class="alert alert-danger fixedAlert" hidden="hidden" style=""></div>
                        <td class="desktop">
						<span class="small">Bid Saya: Rp 
                            <?php 
                               echo $this->model_backend->rupiah($jumlahbiduser['sum(bid_amount)']);
						
                            ?>
						</span>
						<br/>
							   <form action="<?php echo base_url(); ?>investor/application/bid" id="myform" method="post" accept-charset="utf-8"> 
                            <?php
                                $available = $loan_list[$i]->available_bid_amount / 1000;
                                //echo form_open('investor/application/bid');
								$tes="tes";
                                if(($loan_list[$i]->total_bid_amount == $loan_list[$i]->amount) || ($loan_list[$i]->time_left < 0))
                                    echo '
                                        <input type="number" value="0" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="1" style="width:130px;display:inline" class="form-control bid-input currency" disabled="disabled"/>
                                        <button class="btn btn-info" disabled="disabled" style="display:inline">Bid &nbsp;<i class="fa fa-legal"></i></button><br/>
                                    ';
                                else
									
                                    echo '
                                        <!-- <input type="hidden" id="h_loan_id" name="h_loan_id" value="'.$loan_list[$i]->loan_id.'"> -->
										
                                        <input id="txt_amount'.$i.'" name="txt_amount"'.$i.'" type="number" value="0" min="0" max="'.$sisa.'" step="1" data-number-to-fixed="2" data-number-stepfactor="1" style="width:130px;display:inline" class="form-control bid-input currency" />
                                        <button type="button" name="submit" onclick="add_bid('.$loan_list[$i]->loan_id.','.$i.','.$sisa.','.$loan_list[$i]->period.','.$totaldeposit.');" class="btn btn-info" style="display:inline">Bid &nbsp;<i class="fa fa-legal"></i></button><br/>
                                    ';
                                echo form_close();
                            ?>
                            </form>
                        </td>
                        <td class="desktop expand"><?php echo $loan_list[$i]->code; ?></td>
                        <td class="desktop text-center expand"><?php echo $loan_list[$i]->risk_name; ?></td>
						<td class="desktop text-center expand">Rp <?php echo $this->model_backend->rupiah($loan_list[$i]->amount); ?></td>
                        <td class="desktop text-center expand">Rp <?php echo $this->model_backend->rupiah($sisa); ?></td>
                        <td class="desktop text-center expand"><?php echo $loan_list[$i]->period; ?> bulan</td>
                        <td class="desktop text-center expand">
                            <div class="progress">
                                <?php 
                                    if($loan_list[$i]->time_left < 0)
                                        $progress_percent = 100;
                                    else
                                        $progress_percent = 8;
                                ?>
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persentasi+70; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $persentasi+70; ?>%"><?php echo $persentasi+70; ?>% Complete
                                </div>
                            </div>
                        </td>
                        <td class="desktop text-center expand">
                            <?php 
                                if ($loan_list[$i]->time_left < 0)
                                {
                                    echo "Ditutup";
                                }
                                else
                                {
                                    switch ($loan_list[$i]->time_left)
                                    {
                                        case 0:
                                        {
                                            echo "Hari ini";
                                            break;
                                        }
                                        case 1:
                                        {
                                            echo $loan_list[$i]->time_left.' hari';
                                            break;
                                        }
                                        default:
                                        {
                                            echo $loan_list[$i]->time_left.' hari';
                                            break;
                                        }
                                    }
                                }
                            ?>
                        </td>
                        <td class="desktop expand"></td>
                    </tr>
					<?php } ?>
                                       
                                    </tbody>
            </table>           
        </div>
    </div>  
</div>	

  <!-- 
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
			<!--
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
      <button type="submit" class="js-modal-close btn btn-info" >Submit Bid</button>
    </footer>
</div>
</form>
-->

<form  id="formku" method="post" accept-charset="utf-8">
 <input type="hidden" id="h_loan_id" name="h_loan_id" value="">
            <input type="hidden" id="h_amount" name="h_amount" value="">
			 <input type="hidden" id="h_sisa" name="h_sisa" value="">
</form>

<form  id="tes" method="post" accept-charset="utf-8">
 <input type="hidden" id="h_loan_id" name="h_loan_id" value="">
            <input type="hidden" id="h_amount" name="h_amount" value="">
			 <input type="hidden" id="h_sisa" name="h_sisa" value="">
</form>

  



<script>

function prosess () {
	//alert('ter');
	var tes="1";
	$('[name="h_amount"]').val(tes);
	 // $("#h_amount").val(tes);
	  $('#tes').attr('action', '<?php echo base_url(); ?>investor/bid/tes');
                            document.getElementById("tes").submit();
}

function proceed () {
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', '<?php echo base_url(); ?>investor/bid/tes');
    form.style.display = 'hidden';
    document.body.appendChild(form)
    form.submit();
}
</script>



    

   