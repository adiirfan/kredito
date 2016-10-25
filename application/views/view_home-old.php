<!-- b popup -->
<link href="<?php echo base_url(); ?>assets/bpopup/css/style.css" rel="stylesheet" type="text/css">

<!-- range slider -->

<link href="<?php echo base_url(); ?>assets/range-slider/css/simple-slider.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/range-slider/js/simple-slider.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    
    	$('.btn-month').on('click', function(){
		    $(".btn-month").removeClass('active');
		    $(this).addClass('active');

		    $("#h_selected_month").val($(this).val());

		    calculate_repayment();
		}); 

		$("#txt_amount").on('change', function(){
            var lAmount = $("#txt_amount").val().replaceAll(',', '');

			if (!$.isNumeric( lAmount ))
			{
				$("#txt_amount").val($("#range-slider").val());
			}
            else
            {
                //Pending here, the slider need to follow the value entered by user
                //$("#range-slider").("setValue", lAmount);
            }
			calculate_repayment();
		}); 

	});

  	function calculate_repayment(){
  		var lAmount = $("#txt_amount").val().replaceAll(',', '');
  		var lRepaymentMonth = $("#h_selected_month").val();
  		var lPercent = 10 / 100;
  		var lInterest = lPercent * lAmount;
  		var lTotalRepaymentAmount = eval(lAmount) + eval(lInterest);
  		var lMonthlyRepaymentAmount = lTotalRepaymentAmount / lRepaymentMonth;
  		
  		//var lValueString = Number(lMonthlyRepaymentAmount).toLocaleString('en', { style: 'currency', currency: 'MYR' });
        var str = lMonthlyRepaymentAmount.formatMoney(2, '.', ',');
        var lValueString = "MYR " + str;
  		$("#span-repayment").text(lValueString);

        $("#h_amount").val(lAmount);
  	}
  

</script>

<script>

    $(document).ready(function() {
        //trigger the login popup from header page
        $("#lbl-login").click(function(ev) {
            $("a.dropdown-toggle").dropdown("toggle");
            return false;
        });      
    });
</script>

	<!-- Header 
    <a name="about"></a>
    -->
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Solusi pendanaan anda yang terbaik</h1>
                        <h3>Mudah, efisien dan yang terbaik bersama kami</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <!--
                                <a class="btn btn-default btn-lg small pop2" data-bpopup='{"transition":"slideDown","speed":850,"easing":"easeOutBack"}'><i class="fa fa-line-chart fa-fw"></i> <span class="network-name">MAKE AN INVESTMENT</span></a>
                                -->
                            </li>
                                <a class="btn btn-default btn-lg small pop2" href="<?php echo base_url();?>investor/option"><i class="fa fa-line-chart fa-fw"></i> <span class="network-name">Anda ingin investasi</span></a>
                            <li>
                                <a class="btn btn-default btn-lg small pop1" data-bpopup='{"transition":"slideDown","speed":850,"easing":"easeOutBack"}'><i class="fa fa-dollar fa-fw"></i> <span class="network-name">Anda ingin meminjam</span></a>
                            </li>
                        </ul>
                        <!--
                        <h4>Loans funded to date: MYR <?php echo number_format($total_investment_used, 2); ?></h4>
                        -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </div>

    <div id="popup">
        <span class="b-button b-close"><span>X</span></span>
        <h5>Berapa banyak uang yang ingin anda pinjam?</h5>
        <div class="row">
        	<div class="col-sm-6">
        		<div class="input-group">
					<span class="input-group-addon">RP</span>
					<input type="text"  id="txt_amount" name="txt_amount" maxlength="20" class="form-control group-input" READONLY />
				</div>
        	</div>
        	<div class="col-sm-6">
        		<div class="row">
        			<input type="text" id="range-slider" value="500000" data-slider="true" data-slider-range="10000,500000000" data-slider-step="1000">	
        		</div>
        		<div class="row">
        			<span class="output">100k</span>
        			<span class="pull-right">5000000k</span>
        		</div>
       		</div>
       	</div>
       	<br />
       	<h5>How long(months) you want it for?</h5>
       	<div class="btn-group" role="group" aria-label="...">
		  <button type="button" class="btn btn-default btn-month" value="3">3</button>
		  <button type="button" class="btn btn-default btn-month" value="6">6</button>
		  <button type="button" class="btn btn-default btn-month" value="9">9</button>
		  <button type="button" class="btn btn-default btn-month active" value="12">12</button>
		  <button type="button" class="btn btn-default btn-month" value="18">18</button>
		  <button type="button" class="btn btn-default btn-month" value="24">24</button>
		</div>
		<br /><br />
		<span class="span-normal">Cicilan perbulan:</span>
		<span id="span-repayment">RP 0.00</span>
		<br /><br />
		<div class="col-sm-12 text-center"> 
            <form id="apply-form-1" action="<?php echo base_url();?>borrower/option" method="post" accept-charset="UTF-8">
                <button name="submit" class="btn btn-info center-block longer">Apply Now</button>
                <input type="hidden" id="h_amount" name="h_amount" value="50000" />
                <input type="hidden" id="h_selected_month" name="h_selected_month" value="12" />
            </form>
		</div>
    </div>

    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">What We Do</h2>

                        <p class="lead">
                            We aim to reinvent the lending industry by putting you first!<br /><br />
                            <b>To the Investors :</b><br />
                            We aims to provide alternative investment option allowing you diversify and build a portfolio that fits your financial goals, all at lower cost as compared to traditional investment products.
                            <br /><br />
                            <b>To the Borrowers :</b><br />
                            Rajakredit is completely online and we maximise the wonder of technology to lower costs as compared to the traditional banks. We aim to provide quick, simple and most affordable rate to you.

                        </p>

                    </div>
                </div>
                <br /><br /><br />
            </div>
        </div>
    </div>

    <div class="content-section-a2">

        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Rajakredit to:</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 why-invest">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-xs-9 col-xs-offset-3">
                                    <div class="why-wrap">
                                        <p class="lead"><b><u>Investors</u></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3">
                                    <div class="btn btn-warning btn-lg blue-circle"><i class="fa fa-dollar" style="font-size:28px;"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Remarkable investment return! </b></p>
                                        <p class="text">you can earn return ranging from 12 – 18%* per year.</p>
                                        <br /><br />
                                    </div>
                                </div>
                            </div>      
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 why-invest">
                                    <div class="btn btn-warning btn-lg blue-circle"><i class="fa fa-life-bouy" style="font-size:28px; margin-left:-5px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9 why-invest">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Steady income stream</b></p>
                                        <p class="text">Whenever payments were made by the borrowers in each month, the funds will be fully distributed to investors. It is up to the investors to reinvest or withdraw at any time.</p>
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <div class="col-lg-6 col-xs-12 why-invest lead">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-xs-9 col-xs-offset-3">
                                    <div class="why-wrap">
                                        <p class="lead"><b><u>Borrowers</u></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3">
                                    <div class="btn btn-warning btn-lg orange-circle"><i class="fa fa-thumbs-o-up" style="font-size:28px; margin-left:-3px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Lowest cost</b></p>
                                        <p class="text">All loans feature an affordable fixed rate and no hidden cost, which means your monthly payment is fixed and you will never receive unpleasant surprises!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-xs-3 why-invest">
                                    <div class="btn btn-warning btn-lg orange-circle"><i class="fa fa-lightbulb-o" style="font-size:28px; margin-left:1px"></i></div>
                                </div>
                                <div class="col-lg-8 col-xs-9 why-invest">
                                    <div class="why-wrap">
                                        <p class="lead"><b>Easy, Simple and Efficient</b></p>
                                        <p class="text">You get your quote in an immediate manner because we understand that time is money and an automatic payment system makes maintaining your loan hassle-free.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->


    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-sm-12">
                    <div class="div-center">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">We are Transparent</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-2 col-xs-12 div-center">
                            <h4>2.5% platform fee</h4>
                            <span class="text">We charges 2.5% to the interest rate based on total interest charge.</span>
                            <br /><br />
                        </div>
                        <div class="col-lg-4 col-xs-12 div-center">
                            <h4>1% administration fee</h4>
                            <span class="text">We are fully online but one of our main cost is to ensure that thorough credit assessment process is being undertaken diligently to protect the interest for all parties.</span>
                        </span>
                    </div>
                </div>
                <br />
                <div class="col-lg-12 col-sm-12 div-center">
                    <a class="btn btn-info btn-lg btn-outline" href="<?php echo base_url();?>investor/option">Start Making Investment</a>
                </div>
            </div>
        </div>
    </div>

	
<script>
  $("[data-slider]")
    .bind("slider:ready slider:changed", function (event, data) {
      	//$("#txt_amount").val(data.value.toFixed(0));
        //$("#txt_amount").val(parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

        var str = data.value.formatMoney(0, '.', ',');
        $("#txt_amount").val(str);

      	calculate_repayment();
    });


    Number.prototype.formatMoney = function(c, d, t){
    var n = this, 
        c = isNaN(c = Math.abs(c)) ? 2 : c, 
        d = d == undefined ? "." : d, 
        t = t == undefined ? "," : t, 
        s = n < 0 ? "-" : "", 
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
        j = (j = i.length) > 3 ? j % 3 : 0;
       return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
     };

     String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };

  </script>
    