

        <!-- Main content -->
        <section class="content">

          <!-- SELECT2 EXAMPLE -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Fill Company Data</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
			<form method="post" id="form" action="<?php echo base_url(); ?>backend/company/action_company" enctype="multipart/form-data">
            <div class="box-body">
				<?php echo $this->session->flashdata('pesan'); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Company Code</label>
					<input type="hidden" class="form-control" value="<?php echo $company_product['company_id'] ?>" name="company_id">
					<input type="text" class="form-control" value="<?php echo $company_product['company_code'] ?>" name="company_code">
                  </div><!-- /.form-group -->
				   <div class="form-group">
                    <label>Company Name</label>
					<input type="text" class="form-control" value="<?php echo $company_product['company_name'] ?>" name="company_name">
                  </div><!-- /.form-group -->
				   <div class="form-group">
                    <label>Company Email</label>
					<input type="text" class="form-control" value="<?php echo $company_product['company_email'] ?>" id="email" name="company_email">
                  </div><!-- /.form-group -->
				   <div class="form-group">
                    <label>Company Phone</label>
					<input type="text" class="form-control" value="<?php echo $company_product['company_phone'] ?>" name="company_phone">
                  </div><!-- /.form-group -->
				    
                 
                </div><!-- /.col -->
                <div class="col-md-6">
                 <div class="form-group">
                    <label>Company Address</label>
					<textarea class="form-control" value="" name="company_address"><?php echo $company_product['company_address'] ?></textarea>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <label>Logo</label>
                    <input type="file" class="form-control" name="logo">
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
				
              </div><!-- /.row -->
			  <div class="row">
				 <div class="col-md-12">
				<h2 align="center"><button type="submit" class="btn btn-info pull-right">Submit</button></h2>
				</div>
				</div>
            </div><!-- /.box-body -->
			
			</form>
           
          </div><!-- /.box -->
 </section><!-- /.content -->
 

