    $(document).ready(function() {
        $("#popup_profile").draggable();
        $("#popup_password").draggable();

    } );

    $(function(){

        $("#lbl_message_profile").hide();

        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

          $('a[data-modal-id]').click(function(e) {
            e.preventDefault();
            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(500, 0.7);
            var modalBox = $(this).attr('data-modal-id');
            $('#'+modalBox).fadeIn($(this).data());
          });  

        $("#btnOK_profile").click(function() 
        {
            $("#lbl_message_profile").hide();
            $("#lbl_message_profile").removeClass("alert-success").addClass("alert-danger");
            
            var message = "";
            if ($("#txt_email_profile").val().trim() == "")
            {
                message = "The Email field is required. <br />";
            }
            else
            {
                if (!isValidEmailAddress($("#txt_email_profile").val()))
                {
                    message = "The Email field is not valid. <br />";
                }
            }
            if ($("#txt_full_name_profile").val().trim() == "")
            {
                message = message + "The Full Name field is required. <br />";
            }
            if (message != "")
            {
                $("#lbl_message_profile").html(message);
                $("#lbl_message_profile").show();
                return;
            }

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/user_profile/check",
                dataType: 'json',
                data: {
                    sys_user_id: $('#h_sys_user_id_profile').val(),
                    email: $('#txt_email_profile').val(),
                    full_name: $('#txt_full_name_profile').val(),
                    is_myprofile: 1},
                success: function(res) {
                    if (res)
                    {
                        if (res.is_exist == true)
                        {
                            $("#lbl_message_profile").removeClass("alert-success").addClass("alert-danger");
                            $("#lbl_message_profile").text("The Email has been used. Please try another Email.");
                            $("#lbl_message_profile").show();
                            return;   
                        }
                        else
                        {
                            $("#lbl_message_profile").removeClass("alert-danger").addClass("alert-success");
                            $("#lbl_message_profile").text("Your profile has been updated successfully.");
                            $("#lbl_message_profile").show();
                            $("#popup_profile").fadeOut(2000);
                            $(".modal-overlay").fadeOut(2000);
                            $("#lbl_message_profile").fadeOut(2000);
                            return;   
                        }
                    }
                }
            });
        });

        $(".js-modal-close2").click(function() 
        {
            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

        });

        $(window).resize(function() {
            $(".modal-box").css({
              top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
              left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            });
        });

        $(window).resize();
     
    });

    function keydown_profile(e)
    {
        var code = e.which; // recommended to use e.which, it's normalized across browsers
        if(code==13){
            e.preventDefault();
            $("#btnOK_profile").click();    
        }
    }

    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }

    $(function(){

        $("#lbl_message_password").hide();

        $("#btnOK_password").click(function() 
        {
            $("#lbl_message_password").hide();
            $("#lbl_message_password").removeClass("alert-success").addClass("alert-danger");
            
            var message = "";
            if ($("#txt_password").val().trim() == "")
            {
                message = "The Password field is required. <br />";
            }
            if ($("#txt_confirm_password").val().trim() == "")
            {
                message = message + "The Confirm Password field is required. <br />";
            }
            if (message == "")
            {
                if ($("#txt_password").val() != $("#txt_confirm_password").val())
                {
                    message = message + "The Confirm Password field does not match the Password field. <br />";
                }
            }
            if (message != "")
            {
                $("#lbl_message_password").html(message);
                $("#lbl_message_password").show();
                return;
            }

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/update_password",
                dataType: 'json',
                data: {
                    sys_user_id: $('#h_sys_user_id_profile').val(),
                    password: $('#txt_password').val()},
                success: function(res) {
                    if (res)
                    {
                        if (res.return == true)
                        {
                            $("#lbl_message_password").removeClass("alert-danger").addClass("alert-success");
                            $("#lbl_message_password").text("Your password has been updated successfully.");
                            $("#lbl_message_password").show();
                            $("#popup_password").fadeOut(2000);
                            $(".modal-overlay").fadeOut(2000);
                            $("#lbl_message_password").fadeOut(2000);
                            return;   
                        }
                    }
                }
            });
        });
    });

    function keydown_password(e)
    {
        var code = e.which; // recommended to use e.which, it's normalized across browsers
        if(code==13){
            e.preventDefault();
            $("#btnOK_password").click();    
        }
    }


