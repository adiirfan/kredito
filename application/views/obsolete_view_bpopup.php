
<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>bPopup || A jQuery modal popup plugin</title>
  <link href="<?php echo base_url(); ?>assets/bpopup/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <span class="b-button small pop1" data-bpopup='{"transition":"slideDown","speed":850,"easing":"easeOutBack"}'>Pop it up</span>
	
    <div id="popup">
        <span class="b-button b-close"><span>X</span></span>
        If you can't get it up use<br>
        halo
    </div>
    <script src="<?php echo base_url();?>assets/jquery/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/bpopup/js/jquery.bpopup-0.11.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/bpopup/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo base_url();?>assets/bpopup/js/scripting.min.js"></script>
</body>
</html>