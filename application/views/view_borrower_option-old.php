


<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h2>Apply for a Business Loan</h2>
			<hr>
			<br />
			
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 register">
			<?php echo form_open('borrower/login'); ?>
				<div class="form-group">
					<button name="submit" class="btn btn-outline btn-primary btn-lg btn-block">I already have a Credit Direct account</button>
				</div>
			<?php echo form_close();?>
			<?php echo form_open('borrower/application'); ?>
				<div class="form-group">
					<button name="submit" class="btn btn-outline btn-primary btn-lg btn-block">I am new user</button>
				</div>
			<?php echo form_close();?>
			<br /><br />
		</div>
	</div>
</div>	
