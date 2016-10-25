
<script type="text/javascript">

  /* Custom filtering function which will search data in column four between two values */


    $(document).ready(function() {

        $("#popupForm").draggable();



    } );

   
</script>

<script>

    $(function(){

        $("#lbl_message").hide();
        $("#lbl_Success").fadeOut(2000);

        $("#btnOK").click(function() 
        {
            $(this).unbind('myform').submit();
            $("#lbl_message").hide();
            
            if ($("#cbo_investment").val() == "0")
            {
                $("#lbl_message").text("Please select an Investment.");
                $("#lbl_message").show();
                return;   
            }

            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });
            $("#h_investment_id").val($("#cbo_investment").val());
            document.getElementById("myform").submit(); 

        });

        $("#btnRemove").click(function() 
        {
            $(this).unbind('myform').submit();
            
            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });
            $("#h_investment_id").val("0");
            document.getElementById("myform").submit(); 

        });

    });


    function match(pID)
    {
        $("#lbl_confirm").hide();
        $("#btnRemove").hide();

        $("#lbl_loan_code").text("<?php echo $row->code;?>");
        $("#lbl_b_full_name").text("<?php echo $row->b_full_name;?>");
        $("#cbo_investment").val(pID);

        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        $(".modal-overlay").fadeTo(500, 0.7);
        $('#popupForm').fadeIn($(this).data());
    }

    function removematch(pID)
    {
        $("#btnOK").hide();
        $("#lbl_loan_code").text("<?php echo $row->code;?>");
        $("#lbl_b_full_name").text("<?php echo $row->b_full_name;?>");

        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
        $("body").append(appendthis);
        $(".modal-overlay").fadeTo(500, 0.7);
        $('#popupForm').fadeIn($(this).data());
    }
    
  </script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('pMessage') != ""){ ?>
            <div class="alert alert-success" id="lbl_Success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Success</h4>
                <?php print_r($this->session->flashdata('pMessage')); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Matching for Loan <?php echo $row->code; ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <h4><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Loan Requirement</h4>
            <div class="form-group">
                <label>Amount</label>
                <div style="display:block">
                MYR <?php echo number_format($row->amount, 2); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Repayment Period</label>
                <div style="display:block">
                <?php echo $row->period; ?> mths
                </div>
            </div>
            <div class="form-group">
                <label>Purpose</label>
                <div style="display:block">
                <?php echo $loan_purpose; ?>
                </div>
            </div>
            <br />
        </div>
        <div class="col-lg-5">
            <h4><i class="fa fa-building-o"></i>&nbsp;&nbsp;Company Information</h4>
            <div class="form-group">
                <label>Paid Up Capital</label>
                <div style="display:block">
                <?php echo number_format($row->b_company_paid_up_capital, 2); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Man Power</label>
                <div style="display:block">
                <?php echo $row->b_company_man_power; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Revenue</label>
                <div style="display:block">
                <?php echo number_format($row->b_company_revenue, 2); ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($row->investment_id == 0){ ?>
    <div class="row">
        <div class="col-lg-12">
            <h4>Fully Matched</h4>
        </div>
    </div>  
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="all">Ref Code</th>
                        <th>Investor</th>
                        <th>Contact</th>
                        <th>Fund Bal.</th>
                        <th>Preference</th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($investment_list); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $investment_list[$i]->code; ?></td>
                        <td><?php echo $investment_list[$i]->i_full_name; ?></td>
                        <td><?php echo $investment_list[$i]->i_mobile_phone; ?><br /><?php echo $investment_list[$i]->i_email; ?></td>
                        <td>MYR <?php echo number_format($investment_list[$i]->fund - $investment_list[$i]->fund_used, 2); ?></td>
                        <td>
                            Repayment Period:
                            <?php echo $investment_list[$i]->period_str; ?><br />
                            Paid Up Capital:
                            <?php echo number_format($investment_list[$i]->pref_paid_up_capital_from, 2).' - '.number_format($investment_list[$i]->pref_paid_up_capital_to, 2); ?><br />
                            Man Power:
                            <?php echo $investment_list[$i]->pref_man_power_from.' - '.$investment_list[$i]->pref_man_power_to; ?><br />
                            Revenue:
                            <?php echo number_format($investment_list[$i]->pref_revenue_from, 2).' - '.number_format($investment_list[$i]->pref_revenue_to, 2); ?><br />
                        </td>
                        <td class="all">
                            <button class="btn btn-info btn-xs" onclick="match(<?php echo $investment_list[$i]->investment_id; ?>);">Match</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>  
    <div class="row">
        <div class="col-lg-12">
            <h4>Partially Matched</h4>
        </div>
    </div>  
    <div class="row">
        <div class="col-lg-12">
            <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="all">Ref Code</th>
                        <th>Investor</th>
                        <th>Contact</th>
                        <th>Fund Bal.</th>
                        <th>Preference</th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($investment_list2); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $investment_list2[$i]->code; ?></td>
                        <td><?php echo $investment_list2[$i]->i_full_name; ?></td>
                        <td><?php echo $investment_list2[$i]->i_mobile_phone; ?><br /><?php echo $investment_list2[$i]->i_email; ?></td>
                        <td>MYR <?php echo number_format($investment_list2[$i]->fund - $investment_list2[$i]->fund_used, 2); ?></td>
                        <td>
                            Repayment Period:
                            <?php echo $investment_list2[$i]->period_str; ?><br />
                            Paid Up Capital:
                            <?php echo number_format($investment_list2[$i]->pref_paid_up_capital_from, 2).' - '.number_format($investment_list2[$i]->pref_paid_up_capital_to, 2); ?><br />
                            Man Power:
                            <?php echo $investment_list2[$i]->pref_man_power_from.' - '.$investment_list2[$i]->pref_man_power_to; ?><br />
                            Revenue:
                            <?php echo number_format($investment_list2[$i]->pref_revenue_from, 2).' - '.number_format($investment_list2[$i]->pref_revenue_to, 2); ?><br />
                        </td>
                        <td class="all">
                            <button class="btn btn-info btn-xs" onclick="match(<?php echo $investment_list2[$i]->investment_id; ?>);">Match</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div> 

    <?php }else{ ?>
    <div class="row">
        <div class="col-lg-5">
            <h4>Matched with <?php echo $row_investment->code ?></h4>
            <button class="btn btn-warning" onclick="removematch();">Remove Match</button>
        </div> 
    </div> 
    <?php } ?>

</div>    

<form action="<?php echo base_url(); ?>workspace/loan/match" id="myform" method="post" accept-charset="utf-8">
<div id="popupForm" class="modal-box">
    <header>
      <h4><span id="lbl_add_new">Matching</span>
        <a href="#" class="js-modal-close2 close" id="btn_close">x</a>
      </h4>
    </header>
    <div class="modal-body" style="max-height:300px;overflow-y: auto">
        <div class="row">
            <p id="lbl_message" class="alert alert-danger">The Investor field is required.</p>
            <p id="lbl_confirm" class="alert alert-warning">Are you sure you want to remove the matching?</p>
        </div>
        <div class="row">
            <div class="col-sm-4">
                Loan:
            </div>            
            <div class="col-sm-8">
                <label class="normal" id="lbl_loan_code"></label>
            </div>    
        </div>  
        <div class="row">
            <div class="col-sm-4">
                Borrower:
            </div>            
            <div class="col-sm-8">
                <label class="normal" id="lbl_b_full_name"></label>
            </div>    
        </div>   
        <div class="row">
            <div class="col-sm-4">
                Investment: 
            </div>            
            <div class="col-sm-8">
                <?php if ($row->investment_id == 0){ ?>
                    <select id="cbo_investment" name="cbo_investment" class="form-control">
                        <option value="0">- Select -</option>
                        <?php for ($i = 0; $i < count($investment_list); ++$i) { ?>
                            <option value="<?php echo $investment_list[$i]->investment_id; ?>"><?php echo $investment_list[$i]->code; ?> (MYR <?php echo number_format($investment_list[$i]->fund - $investment_list[$i]->fund_used, 2); ?>)</option>
                        <?php } ?>
                        <?php for ($i = 0; $i < count($investment_list2); ++$i) { ?>
                            <option value="<?php echo $investment_list2[$i]->investment_id; ?>"><?php echo $investment_list2[$i]->code; ?> (MYR <?php echo number_format($investment_list2[$i]->fund - $investment_list2[$i]->fund_used, 2); ?>)</option>
                        <?php } ?>
                    </select>
                <?php }else{ ?>
                    <?php echo $row_investment->code;?>
                <?php } ?>
            </div>    
        </div>     
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK">Match</button>
      <button type="button" class="js-modal-close btn btn-warning" id="btnRemove">Confirm Remove</button>
    </footer>
</div>
<input type="hidden" id="h_loan_id" name="h_loan_id" value="<?php echo $row->loan_id; ?>">
<input type="hidden" id="h_loan_code" name="h_loan_code" value="<?php echo $row->code; ?>">
<input type="hidden" id="h_investment_id" name="h_investment_id" value="0">
<input type="hidden" id="h_menu_id" name="h_menu_id" value="4003">
<input type="hidden" id="h_menu_name" name="h_menu_name" value="success">
</form>



