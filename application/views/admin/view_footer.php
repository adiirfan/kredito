

    </div>
    <!-- /#wrapper --> 

<div id="popup_profile" class="modal-box">
    <header>
      <h4>My Profile
        <a href="#" class="js-modal-close2 close" id="btn_close_profile">x</a>
      </h4>
    </header>
    <div class="modal-body">
    	<div class="row">
        	<p id="lbl_message_profile" class="alert alert-danger">The Email field is required.</p>
        </div>
        <div class="row">
            <div class="col-sm-3">
                Email:
            </div>            
            <div class="col-sm-9">
                <input type="text" id="txt_email_profile" name="txt_email_profile" value="<?php echo get_cookie("admin_email")?>" onkeydown="keydown_profile(event);" maxlength="255" class="form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-3">
                Full Name:
            </div>            
            <div class="col-sm-9">
                <input type="text" id="txt_full_name_profile" name="txt_full_name_profile" value="<?php echo get_cookie("admin_fullname")?>" onkeydown="keydown_profile(event);" maxlength="255" class="form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-3">
                User Group:
            </div>            
            <div class="col-sm-9 text">
                <?php echo get_cookie("admin_groupname")?>
            </div>    
        </div> 
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK_profile">Update</button>
    </footer>
</div>
<input type="hidden" id="h_sys_user_id_profile" name="h_sys_user_id_profile" value="<?php echo get_cookie("admin_userid")?>">


<div id="popup_password" class="modal-box">
    <header>
      <h4>Change Password
        <a href="#" class="js-modal-close2 close" id="btn_close_password">x</a>
      </h4>
    </header>
    <div class="modal-body">
    	<div class="row">
        	<p id="lbl_message_password" class="alert alert-danger">The Email field is required.</p>
        </div>
        <div class="row">
            <div class="col-sm-4">
                Password:
            </div>            
            <div class="col-sm-8">
                <input type="password" id="txt_password" name="txt_password" value="" placeholder="Password" onkeydown="keydown_password(event);" maxlength="20" class="password form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-4">
                Confirm Password:
            </div>            
            <div class="col-sm-8">
                <input type="password" id="txt_confirm_password" name="txt_confirm_password" value="" placeholder="Confirm Password" onkeydown="keydown_password(event);" maxlength="20" class="password form-control" />
            </div>    
        </div> 
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK_password">Update</button>
    </footer>
</div>


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.bootstrap.min.js" type="text/javascript"></script>    
    <script src="<?php echo base_url();?>assets/bootstrap/js/dataTables.responsive.min.js" type="text/javascript"></script>    

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/metisMenu/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/custom/js/admin.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url();?>assets/morrisjs/js/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/morrisjs/js/morris.min.js"></script>
    <script src="<?php echo base_url();?>assets/morrisjs/js/morris-data.js"></script>

</body>

</html>