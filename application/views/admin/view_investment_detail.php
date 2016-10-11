
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css">


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Investment - <?php echo $row->code ?> (<?php echo $status_name ?>)
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
        	<h4><i class="fa fa-user"></i>&nbsp;&nbsp;Personal Information</h4>
        	<div class="form-group">
				<label>Full Name</label>
				<div style="display:block">
				<?php echo $salutation_name.' '.$row->i_full_name; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Email</label>
				<div style="display:block">
				<?php echo $row->i_email; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Mobile Phone</label>
				<div style="display:block">
				<?php echo $row->i_mobile_phone; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Address</label>
				<div style="display:block">
				<?php echo $row->i_address; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Type</label>
				<div style="display:block">
				<?php if ($row->i_investor_type == "I" ) {echo "Individual"; } else {echo "Corporate"; } ?>
				</div>
			</div>
			<br />
			<?php if ($row->i_investor_type == "C" ) { ?>
			<h4><i class="fa fa-building-o"></i>&nbsp;&nbsp;Company Information</h4>
			<div class="form-group">
				<label>Company Name</label>
				<div style="display:block">
				<?php echo $row->i_company_name; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Registration No.</label>
				<div style="display:block">
				<?php echo $row->i_company_registration; ?>
				</div>
			</div>
			<br />
			<?php } ?>
			<h4><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Documents</h4>

			<form id="fileupload-ic" action="upload" method="POST" enctype="multipart/form-data">
		        <div class="row">
		            <div class="col-lg-10 col-lg-offset-1 register">
		                <div class="row fileupload-buttonbar">
		                    <div class="col-lg-12" style="display:inline-block">
		                        <b>Identity Card</span></b>
		                    </div>
		                </div>
		                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
		            </div>
		        </div>
		    </form>
		    <br>
		    <form id="fileupload-pa" action="upload" method="POST" enctype="multipart/form-data">
		        <div class="row">
		            <div class="col-lg-10 col-lg-offset-1 register">
		                <div class="row fileupload-buttonbar">
		                    <div class="col-lg-12" style="display:inline-block">
		                        <b>Proft of Address</b>
		                    </div>
		                </div>
		                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
		            </div>
		        </div>
		    </form>
		    <br />

		    <h4><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Status</h4>
		    <table id="tbl" data-toolbar="#filter-bar" class="table table-striped table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="all">Remarks</th>
                        <th>Status</th>
                        <th>By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($investment_status_list); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $investment_status_list[$i]->remarks; ?></td>
                        <td><?php 
                        	switch($investment_status_list[$i]->status)
                        	{
                        		case "2": { echo "Newly Submitted"; break; }
                        		case "3": { echo "Processing"; break; }
                        		case "4": { echo "Success"; break; }
                        		case "5": { echo "Rejected"; break; }
                        		case "6": { echo "Cancelled"; break; }
                        	}
                         ?></td>
                        <td><?php echo $investment_status_list[$i]->created_user; ?></td>
                        <td><?php echo $investment_status_list[$i]->created_date; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-5">
			<h4><i class="fa fa-line-chart"></i>&nbsp;&nbsp;Investment Details</h4>
			<div class="form-group">
				<label>Fund</label>
				<div style="display:block">
				MYR <?php echo number_format($row->fund, 2); ?>
				</div>
			</div>
			<br />
			<h4><i class="fa fa-heart"></i>&nbsp;&nbsp;Preference</h4>
			<div class="form-group">
				<label>Company Paid Up Capital</label>
				<div style="display:block">
				MYR <?php echo number_format($row->pref_paid_up_capital_from, 2); ?> - <?php echo number_format($row->pref_paid_up_capital_to, 2); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Company Man Power</label>
				<div style="display:block">
				<?php echo $row->pref_man_power_from; ?> - <?php echo $row->pref_man_power_to; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Company Revenue</label>
				<div style="display:block">
				MYR <?php echo number_format($row->pref_revenue_from, 2); ?> - <?php echo number_format($row->pref_revenue_to, 2); ?>
				</div>
			</div>
			<div class="form-group">
				<label>Repayment Period</label>
				<div style="display:block">
				<?php echo $investment_period_list; ?>
				</div>
			</div>
		</div>
    </div>

</div>    

<script>

    $(function () {
        'use strict';

        $('#fileupload-ic').fileupload({
            url: '<?php echo base_url(); ?>upload/investment/<?php echo $row->folder_code?>/ic/'
        });

        $('#fileupload-pa').fileupload({
            url: '<?php echo base_url(); ?>upload/investment/<?php echo $row->folder_code?>/pa/'
        });

    });


</script>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">

</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% 
for (var i=0, file; file=o.files[i]; i++) { 

    var document_type = "";
    if (file.url.indexOf("/ic/files") != -1)
        document_type = "ic";
    if (file.url.indexOf("/pa/files") != -1)
        document_type = "pa";


%}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    <input type="hidden" class="new_file_name" name="h_file_name[]" id="h_file_name" value="{%=file.name%}">
                    <input type="hidden" class="document_type" name="h_document_type[]" id="h_document_type" value="{%=document_type%}">
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
    </tr>
{% } %}
</script>

<script src="<?php echo base_url();?>assets/file-upload/js/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/tmpl.min.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/load-image.all.min.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/canvas-to-blob.min.js"></script>

<script src="<?php echo base_url();?>assets/file-upload/js/jquery.fileupload.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/jquery.fileupload-image.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/jquery.fileupload-validate.js"></script>
<script src="<?php echo base_url();?>assets/file-upload/js/jquery.fileupload-ui.js"></script>

<script type="text/javascript"><?php include 'assets/file-upload/js/main.php'; ?></script>