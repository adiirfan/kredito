<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
         
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>backend">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
             
            </li>
            <li class="<?php if($segment == 'category-product' || $segment == 'product-main' || $segment == 'company'){ echo "active treeview";} ?>  ">
              <a href="#">
                <i class="fa fa-table"></i> <span>Master Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class="<?php if($segment == 'company'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/company"><i class="fa fa-circle-o"></i>Company</a></li>
                <li class="<?php if($segment == 'product-main'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/product-main"><i class="fa fa-circle-o"></i>Main Product</a></li>
				<li class="<?php if($segment == 'category-product'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/category-product"><i class="fa fa-circle-o"></i>Product Category</a></li>
              </ul>
            </li>
			<!--
			<li class="<?php //if($segment == 'company-product'){ echo "active";} ?>">
              <a href="<?php //echo base_url(); ?>backend/company-product">
                <i class="fa fa-table"></i> <span>Product</span>
              </a>
            </li>
			-->
			<li class="<?php if($segment == 'company-product' || $segment == 'car-refinancing' || $segment == 'property-refinancing'){ echo "active treeview";} ?>  ">
              <a href="#">
                <i class="fa fa-table"></i> <span>Refinance</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class="<?php if( $this->uri->segment(3) == 'car-refinancing'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/company-product/car-refinancing"><i class="fa fa-circle-o"></i>Car Refinancing</a></li>
				<li class="<?php if( $this->uri->segment(3) == 'property-refinancing'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/company-product/property-refinancing"><i class="fa fa-circle-o"></i>KPR</a></li>
               
              </ul>
            </li>
			<li class="<?php if($segment == 'investor'){ echo "active treeview";} ?>">
              <a href="<?php echo base_url(); ?>backend/investor">
                <i class="fa fa-caret-square-o-left"></i> <span>Investor</span></i>
              </a>
            </li><li class="<?php if($segment == 'investment'){ echo "active treeview";} ?>">
              <a href="<?php echo base_url(); ?>backend/investment">
                <i class="fa fa-caret-square-o-left"></i> <span>Top Up</span></i>
              </a>
            </li>
			<li class="<?php if($segment == 'submission-loan' && $this->uri->segment(3) != 'business' && $this->uri->segment(3) != 'detail'){ echo "active treeview";} ?>">
              <a href="<?php echo base_url(); ?>backend/submission-loan">
                <i class="fa fa-caret-square-o-left"></i> <span>Pinjaman Refinance</span></i>
              </a>
            </li>
			<li class="<?php if($this->uri->segment(3) == 'business' || $this->uri->segment(3) == 'detail' ){ echo "active treeview";} ?>">
              <a href="<?php echo base_url(); ?>backend/submission-loan/business">
                <i class="fa fa-caret-square-o-left"></i> <span>Pinjaman Usaha</span></i>
              </a>
            </li>
			<li class="<?php if($segment == 'bid' || $segment == 'car-refinancing' || $segment == 'property-refinancing'){ echo "active treeview";} ?>  ">
              <a href="#">
                <i class="fa fa-table"></i> <span>BID</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class="<?php if( $this->uri->segment(3) == ''){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/bid"><i class="fa fa-circle-o"></i>BID on progress</a></li>
				<li class="<?php if( $this->uri->segment(3) == 'bid-more-80'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/bid/bid-more-80"><i class="fa fa-circle-o"></i>BID > 80%</a></li>
               <li class="<?php if( $this->uri->segment(3) == 'bid-agreement'){ echo "active";} ?>"><a href="<?php echo base_url(); ?>backend/bid/bid-agreement"><i class="fa fa-circle-o"></i>BID Agreement</a></li>
              </ul>
            </li>
			<li class="<?php if($segment == 'payment'  ){ echo "active treeview";} ?>">
              <a href="<?php echo base_url(); ?>backend/payment">
                <i class="fa fa-table"></i> <span>Payment</span></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Report</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i>Customer register </a></li>
                <li><a href="<?php echo base_url(); ?>backend/submission-loan"><i class="fa fa-circle-o"></i>Submission Loan </a></li>
                <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>backend/logout">
                <i class="fa fa-caret-square-o-left"></i> <span>Logout</span></i>
              </a>
             
            </li>
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>