
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
				<label>Mobile Phone</label>
				<div style="display:block">
				<?php echo $row->b_mobile_phone; ?>
				</div>
			</div>
			<br />
			<h4><i class="fa fa-building-o"></i>&nbsp;&nbsp;Company Information</h4>
			<div class="form-group">
				<label>Company Name</label>
				<div style="display:block">
				<?php echo $row->b_company_name; ?>
				</div>
			</div>
			<div class="form-group">
				<label>Registration No.</label>
				<div style="display:block">
				<?php echo $row->b_company_registration; ?>
				</div>
			</div>
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
			<br />
			<h4><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Documents</h4>

			<form id="fileupload-aa" action="upload" method="POST" enctype="multipart/form-data">
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
		    <form id="fileupload-ma" action="upload" method="POST" enctype="multipart/form-data">
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
		    <form id="fileupload-la" action="upload" method="POST" enctype="multipart/form-data">
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
                    <?php for ($i = 0; $i < count($loan_status_list); ++$i) { ?>
                    <tr>
                        <td><?php echo ($i+1); ?></td>
                        <td class="all"><?php echo $loan_status_list[$i]->remarks; ?></td>
                        <td><?php 
                        	switch($loan_status_list[$i]->status)
                        	{
                        		case "2": { echo "Newly Submitted"; break; }
                        		case "3": { echo "Processing"; break; }
                        		case "4": { echo "Success"; break; }
                        		case "5": { echo "Rejected"; break; }
                        		case "6": { echo "Cancelled"; break; }
                        	}
                         ?></td>
                        <td><?php echo $loan_status_list[$i]->created_user; ?></td>
                        <td><?php echo $loan_status_list[$i]->created_date; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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
			<div class="form-group">
				<label>Matched Investment</label>
				<div style="display:block">
				<?php echo $investment_code; ?>
				</div>
			</div>
			<br />
		</div>
    </div>

</div>    

<script>

    $(function () {
        'use strict';

        $('#fileupload-aa').fileupload({
            url: '<?php echo base_url(); ?>upload/loan/<?php echo $row->folder_code?>/aa/'
        });

        $('#fileupload-ma').fileupload({
            url: '<?php echo base_url(); ?>upload/loan/<?php echo $row->folder_code?>/ma/'
        });

        $('#fileupload-la').fileupload({
            url: '<?php echo base_url(); ?>upload/loan/<?php echo $row->folder_code?>/la/'
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
    if (file.url.indexOf("/aa/files") != -1)
        document_type = "aa";
    if (file.url.indexOf("/ma/files") != -1)
        document_type = "ma";
    if (file.url.indexOf("/la/files") != -1)
        document_type = "la";


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