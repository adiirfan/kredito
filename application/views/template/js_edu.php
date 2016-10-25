<script type="text/javascript" src="<?php echo base_url() ?>assets/lib/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/dist/jquery.validate.js"></script>
<!-- Style Alert Rajapremi -->
<style type="text/css">
		.labelfrm {
			display:block;
			font-size:small;
			margin-top:5px;
		} .error { font-size:small; color:red; }
</style>
<!-- Style Alert Rajapremi -->
<script type="text/javascript">
		$(document).ready(function() {
			$('#frm-mhs').validate({
				rules: {
					nik : {
						digits: true,
						minlength:16,
						maxlength:16
					},
					rt : {
						digits: true,
						maxlength:3
					},
					rw : {
						digits: true,
						maxlength:3
					},
					
					tgl: {
						indonesianDate:true
					},
					
					email: {
						email: true
					},
					
				},
				messages: {
					nik: {
						required: "Nomor KTP must be filled",
						
						maxlength: "Nomor KTP must 16 digit"
					},

					email: {
						
						email: "Format email not valid"
					},
					
				}
			});
		});
		
		$.validator.addMethod(
			"indonesianDate",
			function(value, element) {
				// put your own logic here, this is just a (crappy) example
				return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
			},
			"Please enter a date in the format DD/MM/YYYY"
		);
		</script>
		
		<script>
		function getKota(provinsi) {
	
		if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
	  } else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
		  document.getElementById("kotaList").innerHTML=xmlhttp3.responseText;
		}
	  }
	  xmlhttp3.open("GET","<?php echo base_url(); ?>"+"form_anggota/get_kota/?provinsi="+provinsi,true);
	  xmlhttp3.send();
	}
	
	
	function getKecamatan(kota) {
		if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
	  } else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
		  document.getElementById("kecamatanList").innerHTML=xmlhttp3.responseText;
		}
	  }
	  xmlhttp3.open("GET","<?php echo base_url(); ?>"+"form_anggota/get_kecamatan/?kota="+kota,true);
	  xmlhttp3.send();
	}
	
	
	function getKelurahan(kecamatan) {
		if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
	  } else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
		  document.getElementById("kelurahanList").innerHTML=xmlhttp3.responseText;
		}
	  }
	  xmlhttp3.open("GET","<?php echo base_url(); ?>"+"form_anggota/get_kelurahan/?kecamatan="+kecamatan,true);
	  xmlhttp3.send();
	}
	
	
	
	



		function nikAda(nik) {
			if (nik.length == 0) { 
			   document.getElementById("txtNik").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtNik").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","<?php echo base_url(); ?>"+"form_anggota/cek_nik/?nik=" + nik, true);
				xmlhttp.send();
			}
		}

		function Usia(lahir) {
			if (lahir.length == 0) { 
			   document.getElementById("txtUsia").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtUsia").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","<?php echo base_url(); ?>"+"form_anggota/hitung_usia/?lahir=" + lahir, true);
				xmlhttp.send();
			}
		}


	
	</script>

	
