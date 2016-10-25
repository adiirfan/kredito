
<!--
https://github.com/blueimp/jQuery-File-Upload/wiki/jQuery-File-Upload-9.5-with-CodeIgniter-2.1.4
https://github.com/blueimp/jQuery-File-Upload
-->
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Upload Dokumen</h2>
            <hr>
        </div>      
    </div>
    <form id="fileupload-ic" action="upload" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 register">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-12" style="display:inline-block">
                        <p id="lbl_message_ic" class="alert alert-danger hidden">Silahkan Upload KTP</p>
                        <h4>Scan KTP</span></h4>
                        <span class="btn btn-success fileinput-button longer">
                            <span>Tambah file</span>
                            <i class="glyphicon glyphicon-plus"></i>
                            <input type="file" name="files[]" multiple>
                        </span>
                    </div>
                </div>
                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
            </div>
        </div>
    </form>
    <br>
    <form id="fileupload-pa" action="upload" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 register">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-12" style="display:inline-block">
                        <p id="lbl_message_pa" class="alert alert-danger hidden">Silahkan upload scan struk transfer</p>
                        <h4>Scan Struk Tranfer Pendanaan</h4>
                        <span class="btn btn-success fileinput-button longer">
                            <span>Tambah File</span>
                            <i class="glyphicon glyphicon-plus"></i>
                            <input type="file" name="files[]" multiple>
                        </span>
                    </div>
                </div>
                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
            </div>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
		  <button id="btn_submit" name="btn_submit" onclick="return tes();" class="btn btn-info pull-right" style="margin-right:5px;margin-bottom:5px">TEs <i class="fa fa-chevron-right"></i></button>
            <hr>
            <?php echo form_open('investor/application/submit'); ?>
            <a href="<?php echo base_url(); ?>investor/application" class="btn btn-info" style="margin-bottom:5px"><i class="fa fa-chevron-left"></i> Back</a>
            <button id="btn_submit" name="btn_submit" onclick="return form_submit();" class="btn btn-info pull-right" style="margin-right:5px;margin-bottom:5px">Submit  <i class="fa fa-chevron-right"></i></button>
            <button id="btn_save" name="btn_save" onclick="form_save();" class="btn btn-info pull-right" style="margin-right:5px;margin-bottom:5px">Simpan & Submit Nanti </button>
            <input type="hidden" name="h_file_name_list" id="h_file_name_list" value="">
            <input type="hidden" name="h_document_type_list" id="h_document_type_list" value="">
            <input type="hidden" name="h_status" id="h_status" value="">
			
            <?php echo form_close();?>
        </div>      
    </div>
    
</div>

<script>
function tes(){
	$("#btn_start").click();
	
}
    $(function () {
		 
        'use strict';

        $('#fileupload-ic').fileupload({
            url: '<?php echo base_url(); ?>upload/investment/<?php echo $folder_code?>/ic/'
			
        });
		

        $('#fileupload-pa').fileupload({
            url: '<?php echo base_url(); ?>upload/investment/<?php echo $folder_code?>/pa/'
        });

    });

    function form_submit()
    {
		
		$("#btn_start").click();
        var l_return = true;
        $("#lbl_message_ic").addClass('hidden');
        $("#lbl_message_pa").addClass('hidden');

        var file_name_list = $('.new_file_name').map(function(){return $(this).val()}).get();
        var document_type_list = $('.document_type').map(function(){return $(this).val()}).get();
      
        if (document_type_list.lastIndexOf("ic") == -1)
        {
            $("#lbl_message_ic").removeClass('hidden');
            l_return = false;
        }
        if (document_type_list.lastIndexOf("pa") == -1)
        {
            $("#lbl_message_pa").removeClass('hidden');
            l_return = false;
        }
        
        $("#h_file_name_list").val(file_name_list);
        $("#h_document_type_list").val(document_type_list);
        $("#h_status").val("2");
        return l_return;
    }

    function form_save()
    {
        var file_name_list = $('.new_file_name').map(function(){return $(this).val()}).get();
        var document_type_list = $('.document_type').map(function(){return $(this).val()}).get();
      
        $("#h_file_name_list").val(file_name_list);
        $("#h_document_type_list").val(document_type_list);
        $("#h_status").val("1");
    }


</script>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% 
//$("#btn_start").click();


    for (var i=0, file; file=o.files[i]; i++) {  %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
           
			
                <button id="btn_start" class="btn btn-primary start pull-right hidden" enabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Upload</span>
                </button>
            
                <button class="btn btn-warning cancel pull-right " style="margin-right:5px">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Batal</span>
                </button>
           
        </td>
    </tr>
{% } $("#btn_start").click(); %}
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


/*
    var file_name = file.name;
    var pos = file_name.lastIndexOf(".");
    var extension = file.name.substring(pos, file.name.length);
    var file_name = file.name.substring(0, pos - 11) + extension;
*/
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
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete pull-right" onclick="delete_document('{%=file.name%}');" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
            {% } else { %}
                <button class="btn btn-warning cancel pull-right">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
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
