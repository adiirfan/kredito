
<style>
      #map {
        width: 100%;
        height: 350px;
      }
    </style>

<div class="content-section-b">

        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-lg-offset-1">
                    <h2 class="section-heading">Kontak Kami </h2>
                    <p class="lead">
                       Kami siap untuk menjawab semua pertanyaan Anda dan pertanyaan mengenai RajaKredit. RajaKredit secara online dan kami akan merespon pertanyaan secepat kami bisa!
                        <br /><br />

                        <?php echo form_open('index/inquiry'); ?>
                        <?php echo validation_errors('<p class="alert alert-danger">');?>
                        <div class="form-group">
                            <label class="inquiry-text">Apa yang ingin anda lakukan?</label>
                            <select id="cbo_to_do" name="cbo_to_do" class="form-control">
                                <option value="">Silahkan Pilih</option>
                                <option value="1" <?php if ($to_do=='1') { echo "selected='selected'";} ?> >Ingin investasi</option>
                                <option value="2" <?php if ($to_do=='2') { echo "selected='selected'";} ?> >Ingin melakukan pinjaman</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="inquiry-text">Apakah anda memiliki akun RajaKredit?</label>
                            <select id="cbo_account" name="cbo_account" class="form-control">
                                <option value="">Silahkan Pilih</option>
                                <option value="1" <?php if ($account=='1') { echo "selected='selected'";} ?> >Ya, Saya memiliki akun</option>
                                <option value="2" <?php if ($account=='1') { echo "selected='selected'";} ?> >Tidak, Saya belum registrasi akun</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="inquiry-text">Nama Lengkap</label>
                            <?php echo form_input('txt_full_name', set_value('txt_full_name', ''), 'name="txt_full_name" class="form-control"');?>
                        </div>
                        <div class="form-group">
                            <label class="inquiry-text">Email</label>
                            <?php echo form_input('txt_email', set_value('txt_email', ''), 'name="txt_email" class="form-control"');?>
                        </div>
                        <div class="form-group">
                            <label class="inquiry-text">Telepon</label>
                            <?php echo form_input('txt_mobile_phone', set_value('txt_mobile_phone', ''), 'name="txt_mobile_phone" class="form-control"');?>
                        </div>
                        <div class="form-group">
                            <label class="inquiry-text">Keterangan</label>
                            <?php 
                            $data = array(
                              'name'        => 'txt_description',
                              'id'          => 'txt_description',
                              'value'       =>  set_value('txt_description', ''),
                              'rows'        => '5',
                              'class'       => 'form-control'
                            );
                            echo form_textarea($data); ?>
                        </div>


                        <button name="submit" class="btn btn-info center-block longer">Daftar</button>
                        <?php echo form_close();?>

                    </p>

                </div>
                <div class="col-lg-3 contact-right-item">
                    <br /><br />
                    <div class="form-group">
                        <i class="fa fa-phone fa-2x"></i>
                        <label class="contact-item">Telepon</label><br />
                        (021) 8899887
                    </div>
                    <br />
                    <div class="form-group">
                        <i class="fa fa-envelope fa-2x"></i>
                        <label class="contact-item">Email</label><br />
                        <a href="mailto:customerservice@creditdirect.my">cs@rajakredit.co.id</a>
                    </div>
                    <br />
                   
                    <br />
                    <div class="form-group">
                        <i class="fa fa-home fa-2x"></i>
                        <label class="contact-item">Alamat</label><br />
                        Wisma Semeru 3rd Floor,<br />
                        JL. Taman Kemang No. 18,<br />
                        Kemang, Jakarta, 12720<br />
                       
						Indonesia.<br />
                    </div>
                    
                </div>

            </div>

<!--
            <div class="row">
                
                <div class="col-lg-10 col-lg-offset-1">
                    <br /><br />
                    <p class="lead">Lokasi Kami </p>
                    <div id="map"></div>
                    <script>
                      function initMap() {

                        var myLatLng = {lat: -6.2557062, lng: 106.8104172};

                        var map = new google.maps.Map(document.getElementById('map'), {
                          center: myLatLng,
                          zoom: 14
                        });

                        var marker = new google.maps.Marker({
                          position: myLatLng,
                          map: map,
                          title: 'Credit Direct Head Quater'
                        });

                      }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
                        async defer></script>
                </div>
            </div>
-->
        </div>
        <!-- /.container -->

    </div>