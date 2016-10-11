 <div class="row">

            <div class="col-md-3">
                <p class="lead"><img class="img-responsive" src="<?php echo base_url() ?>assets/img/logo-unj.png" alt=""></p>
                <div class="list-group">
             <a href="<?php echo base_url() ?>/admin" class="list-group-item ">Beranda</a>
                    <a href="<?php echo base_url() ?>admin/pertanyaan" class="list-group-item">Master Pertanyaan</a>
					  <a href="<?php echo base_url() ?>admin/matakuliah" class="list-group-item">Master Matakuliah</a>
					   <a href="<?php echo base_url() ?>admin/dosen" class="list-group-item">Master Dosen</a>
					    <a href="<?php echo base_url() ?>admin/MAHASISWA" class="list-group-item">Master Mahasiswa</a>
                    <a href="<?php echo base_url() ?>ubah_password" class="list-group-item">Ubah Password</a>
					<a href="<?php echo base_url() ?>ubah_password/admin_ubah" class="list-group-item active">Ubah Password User</a>
					
					
					 <a href="<?php echo base_url() ?>all/logout" class="list-group-item">Logout</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="thumbnail">
                  	<?php echo $this->session->flashdata('pesan'); ?>
                    <div class="caption-full">
                     <form method="post" action="<?php echo base_url() ?>ubah_password/ganti_password_admin" >
					  <br>
					  	<div class="form-group">
							<label class="control-label">
							Masukan NIM <span class="symbol required"></span>
							</label>
							<input  type="nim" name="nim" value=""  class="form-control" >
						</div>
					  	<div class="form-group">
							<label class="control-label">
							Password Lama <span class="symbol required"></span>
							</label>
							<input  type="password" name="password_lama" value=""  class="form-control" >
						</div>
							<div class="form-group">
							<label class="control-label">
							Password Baru <span class="symbol required"></span>
							</label>
							<input  type="password" name="password_baru" value=""  class="form-control" >
						</div>
						<button class="btn btn-primary" type="submit">
						Ubah <i class="fa fa-arrow-circle-right"></i>
						</button>
                    </div>
					</form>
                 
                </div>
            </div>

        </div>