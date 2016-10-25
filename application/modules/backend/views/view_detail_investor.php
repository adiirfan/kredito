<section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>0</h3>
                  <p>Total Bid</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>0<sup style="font-size: 20px">%</sup></h3>
                  <p>Saldo</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
		  
		  
		  <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
			<div class="box box-default">
				<div class="box-body">
		    <!-- TO DO List -->
                 
                  <h3 class="box-title"> <i class="ion ion-clipboard"></i> Personal Information</h3>
                 
              
               <section class="col-lg-7 connectedSortable">
                <div class="form-group">
				<label>Nama Lengkap</label>
				<div style="display:block">
				<?php echo $user->full_name; ?>
				</div>
				</div>
				
				 <div class="form-group">
				<label>Email</label>
				<div style="display:block">
				<?php echo $user->email; ?>
				</div>
				</div>
				
				 <div class="form-group">
				<label>Nomor Telepon</label>
				<div style="display:block">
				<?php echo $user->mobile_phone; ?>
				</div>
				</div>
				
				 <div class="form-group">
				<label>Nama Lengkap</label>
				<div style="display:block">
				<?php echo $user->address; ?>
				</div>
				</div>
				
				 <div class="form-group">
				<label>Tanggal Registrasi</label>
				<div style="display:block">
				<?php echo $user->created_date; ?>
				</div>
				</div>
				</section>
				
				 <section class="col-lg-5 connectedSortable">
				<?php foreach($user_document as $document){ ?>
				<img src="<?php echo base_url(); ?>upload/investment/<?php echo $user->folder_code; ?>/<?php echo $document['document_type'] ?>/files/<?php echo $document['file_name']; ?>" width="150px" height="150px">
				<br>
				<a href="<?php echo base_url(); ?>upload/investment/<?php echo $user->folder_code; ?>/<?php echo $document['document_type'] ?>/files/<?php echo $document['file_name']; ?>">Download</a>
				<br>
				<?php } ?>
				</section>
				</div><!-- /.box-header -->
				</div>
			 </section>
			  
			  <section class="col-lg-5 connectedSortable">

            <div class="box box-default">
				<div class="box-body">
		    <!-- TO DO List -->
                 
                  <h3 class="box-title"> <i class="ion ion-clipboard"></i> Arus Kas</h3>
                 
              <table class="table">
			  <thead>
			  <tr>
			  <td>Waktu</td>
			  <td>Mutasi</td>
			  <td>Saldo</td>
			  <td></td>
			  </tr>
			  </thead>
			  
			  <tbody>
			  <?php foreach($kas as $row){ ?>
			  <tr>
			   <td><?php echo $row['submitted_date'] ?></td>
			  <td><?php echo '('.$row['minus_or_plus'].') '.$row['nilai'] ?></td>
			  <td><?php echo $row['saldo'] ?></td>
			  <td>
			  <?php if($row['bid_id'] == 0){ ?>
				
				Investasi dengan nomor #<?php echo $row['code_investment']; ?>
				
			  <?php } else if($row['bid_id'] != 0){ ?>
			  
			  Bid dengan nomor #<?php echo $row['bid_code']; ?>
			  <?php } ?>
			  
			  	
			  </td>
			  </tr>
			  
			  <?php } ?>
			  </tbody>
			  </table>
				
				
				
				</div><!-- /.box-header -->
				</div>
			  </section>
		  </div>
		</section>