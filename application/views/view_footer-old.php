    
    <br /><br /><br />
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-8">
                    <h2></h2>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <i class="fa fa-home fa-2x"></i>
                        <label class="contact-item">Alamat :</label><br /><br />
                        Wisma Semeru 3rd Floor,<br />
                        JL. Taman Kemang No. 18,<br />
                        Kemang, Jakarta, 12720<br />
                       
						Indonesia.<br />
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="<?php echo base_url(); ?>">Beranda</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="<?php echo base_url();?>tentang-kami">Tentang Kami</a>
                        </li>
                       
                        <li>
                            <a href="<?php echo base_url();?>kontak">Kontak</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="<?php echo base_url();?>faq">FAQ</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Rajakredit.com 2016. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>


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
                <input type="text" id="txt_email_profile" name="txt_email_profile" value="<?php echo get_cookie("email")?>" onkeydown="keydown_profile(event);" maxlength="255" class="form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-3">
                Full Name:
            </div>            
            <div class="col-sm-9">
                <input type="text" id="txt_full_name_profile" name="txt_full_name_profile" value="<?php echo get_cookie("full_name")?>" onkeydown="keydown_profile(event);" maxlength="255" class="form-control" />
            </div>    
        </div> 
        <?php if (get_cookie("user_group") == "I") {?>
        <div class="row">
            <div class="col-sm-3">
                Type:
            </div>            
            <div class="col-sm-9 text">
                <div class="btn-group" role="group" aria-label="...">
                  <button type="button" class="btn btn-default btn-type_profile <?php if(get_cookie("i_type") == "I"){echo "active";} ?>" value="I">Individual</button>
                  <button type="button" class="btn btn-default btn-type_profile <?php if(get_cookie("i_type") == "C"){echo "active";} ?>" value="C">Corporate</button>
                  <input type="hidden" id="h_investor_type_profile" name="h_investor_type_profile" value="<?php echo get_cookie("i_type")?>" />
                </div>
            </div>    
        </div> 
        <?php }?>
        <div class="row">
            <div class="col-sm-3">
                User Group:
            </div>            
            <div class="col-sm-9 text">
                <?php 
                    if (get_cookie("user_group") == "B") echo "Borrower"; else echo "Investor"; ?>
            </div>    
        </div> 
        
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK_profile">Update</button>
    </footer>
</div>
<input type="hidden" id="h_user_id_profile" name="h_user_id_profile" value="<?php echo get_cookie("user_id")?>">


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
                Old Password:
            </div>            
            <div class="col-sm-8">
                <input type="password" id="txt_old_password_profile" name="txt_old_password_profile" value="" placeholder="Old Password" onkeydown="keydown_password(event);" maxlength="20" class="password form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-4">
                New Password:
            </div>            
            <div class="col-sm-8">
                <input type="password" id="txt_password_profile" name="txt_password_profile" value="" placeholder="New Password" onkeydown="keydown_password(event);" maxlength="20" class="password form-control" />
            </div>    
        </div> 
        <div class="row">
            <div class="col-sm-4">
                Confirm Password:
            </div>            
            <div class="col-sm-8">
                <input type="password" id="txt_confirm_password_profile" name="txt_confirm_password_profile" value="" placeholder="Confirm Password" onkeydown="keydown_password(event);" maxlength="20" class="password form-control" />
            </div>    
        </div> 
    </div>
    <footer> 
      <button type="button" class="js-modal-close btn btn-info" id="btnOK_password">Update</button>
    </footer>
</div>

    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- b popup -->
    <script src="<?php echo base_url();?>assets/bpopup/js/jquery.bpopup-0.11.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/bpopup/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo base_url();?>assets/bpopup/js/scripting.min.js"></script>

    <!-- Custom -->
    <script type="text/javascript"><?php include 'assets/custom/js/myprofile.php'; ?></script>
    
</body>

</html>