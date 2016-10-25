<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Pinjaman extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('model_credit');
		$this->load->model('model_tanggal');
    }

    public function index($pParam=null)
    {
		
   

    }

    public function tenor()
    {
		$pinjaman=$this->input->get("pinjaman");
		//echo $this->input->get("satuan");
			if($pinjaman == 1){
				$batas=5;
				$waktu="Tahun";
			}else if ($pinjaman == 2){
				$batas=25;
				$waktu="Tahun";
			}else if ($pinjaman == 4){
				$batas=12;
				$waktu="Bulan";
			}		
			echo '<select  name="tenor_ku" id="tenor_ku" class="form-control">';
		echo "<option value=\"\" selected=\"selected\">- Silahkan Pilih  -</option>";
						for ($x = 1; $x <= $batas; $x++) {
						
						if ($pinjaman == 4){
							if($x % 3 == 0){
							echo '<option value="'.$x.'">'.$x.'</option>';
							}
						
						}else{
							echo '<option value="'.$x.'">'.$x.'</option>';	
						}
						
						}
			echo "</select>";
			
			echo '<select  name="tess" id="tess" class="form-control">';
		echo "<option value=\"\" selected=\"selected\">- Silahkan Pilih Kecamatan -</option>";
		
			echo '<option value="ngok">waw</option>';
		
			echo '</select>';
			
			echo '<select  name="tujuan1" id="tujuan1" class="form-control">
						
						<option value="0">Pilih</option>
						<option value="1">Kredit Mobil</option>
						<option value="2">Kredit Pimilikan Rumah</option>
						<option value="3">Kredit Motor</option>
						<option value="4">Modal Usaha</option>
						<option value="5">Lain - lain</option>
						</select>';
		
	}
	
   
}