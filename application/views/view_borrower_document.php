
<!--
https://github.com/blueimp/jQuery-File-Upload/wiki/jQuery-File-Upload-9.5-with-CodeIgniter-2.1.4
https://github.com/blueimp/jQuery-File-Upload
-->
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css">

<!-- process steps -->
<link href="<?php echo base_url(); ?>assets/custom/css/process-steps.css" rel="stylesheet" type="text/css">

<div class="container">

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="stepwizard">
                <div class="stepwizard-row">
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-orange btn-circle"><i class="fa fa-check"></i></li>
                        <p>Login/Register</p>
                    </div>
                  <img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-orange btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Informasi Pinjaman</p>
			        </div>
			        <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
			        <div class="stepwizard-step">
			            <li class="btn btn-grey btn-circle disabled"><i class="fa fa-info"></i></li>
			            <p>Pengajuan</p>
			        </div>
                    <img src="<?php echo base_url();?>assets/img/man_running.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-orange btn-circle disabled"><i class="fa fa-file-o"></i></li>
                        <p>Upload Dokumen</p>
                    </div>
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                    <div class="stepwizard-step">
                        <li class="btn btn-grey btn-circle disabled"><i class="fa fa-flag-checkered"></i></li>
                        <p>Proses selesai</p>
                    </div>
                    <img src="<?php echo base_url();?>assets/img/empty.png" style="width:30px; margin-left:50px">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Upload Dokumen</h2>
            <hr>
        </div>      
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
		Sebagai proses verifikasi kami membutuhkan dokumen dari anda. Silahkan upload dokumen yang dibutuhkan.
          
            <hr>
        </div>      
    </div>
    <form id="fileupload-aa" action="upload" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 register">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-12" style="display:inline-block">
                        <p id="lbl_message_aa" class="alert alert-danger hidden">Silahkan Upload KTP anda</p>
                        <h4>Kartu Keluarga <span class="small"></span></h4>
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
    <form id="fileupload-ma" action="upload" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 register">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-12" style="display:inline-block">
                        <p id="lbl_message_ma" class="alert alert-danger hidden">Silahkan upload Siup perusahaan</p>
                        <h4>BPKB / Surat Rumah / PBB </h4>
                        <span class="btn btn-success fileinput-button longer">
                            <span>Tambah FIle</span>
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
    <form id="fileupload-la" action="upload" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 register">
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-12" style="display:inline-block">
                        <p id="lbl_message_la" class="alert alert-danger hidden">Silahkan upload NPWP perusahaan anda</p>
                        <h4>NPWP - <span class="small"></span></h4>
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
            <hr>
            <?php echo form_open('borrower/application/submit'); ?>
            <a href="<?php echo base_url(); ?>borrower/application" class="btn btn-info" style="margin-bottom:5px"><i class="fa fa-chevron-left"></i> Kembali</a>
            <button id="btn_submit" name="btn_submit" onclick="return form_submit();" class="btn btn-info pull-right" style="margin-right:5px;margin-bottom:5px">Ajukan <i class="fa fa-chevron-right"></i></button>
            <button id="btn_save" name="btn_save" onclick="form_save();" class="btn btn-info pull-right" style="margin-right:5px;margin-bottom:5px">Simpan dan ajukan nanti </button>
            <input type="hidden" name="h_file_name_list" id="h_file_name_list" value="">
            <input type="hidden" name="h_document_type_list" id="h_document_type_list" value="">
            <input type="hidden" name="h_status" id="h_status" value="">
            <?php echo form_close();?>
        </div>      
    </div>
    
</div>

<script>

    $(function () {
        'use strict';

        $('#fileupload-aa').fileupload({
            url: '<?php echo base_url(); ?>upload/loan/<?php echo $folder_code?>/aa/'
        });

        $('#fileupload-ma').fileupload({
            url: '<?php echo base_url(); ?>upload/loan/<?php echo $folder_code?>/ma/'
        });

        $('#fileupload-la').fileupload({
            url: '<?php echo base_url(); ?>upload/loan/<?php echo $folder_code?>/la/'
        });
    });

    function form_submit()
    {
        var l_return = true;
        $("#lbl_message_aa").addClass('hidden');
        $("#lbl_message_ma").addClass('hidden');
        $("#lbl_message_la").addClass('hidden');

        var file_name_list = $('.new_file_name').map(function(){return $(this).val()}).get();
        var document_type_list = $('.document_type').map(function(){return $(this).val()}).get();
      
        if (document_type_list.lastIndexOf("aa") == -1)
        {
            $("#lbl_message_aa").removeClass('hidden');
            l_return = false;
        }
        if (document_type_list.lastIndexOf("ma") == -1)
        {
            $("#lbl_message_ma").removeClass('hidden');
            l_return = false;
        }
        if (document_type_list.lastIndexOf("la") == -1)
        {
            $("#lbl_message_la").removeClass('hidden');
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
    for (var i=0, file; file=o.files[i]; i++) { %}
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
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start pull-right" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Upload</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel pull-right" style="margin-right:5px">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
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
                    <span>Remove</span>
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
