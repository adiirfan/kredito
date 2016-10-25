<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah_password extends MX_Controller {

	 
	  function __construct()
	 {
		 parent:: __construct();
		 if ($this->session->userdata('username')=="") {
			redirect('auth');
		}
		 $this->load->library('template');	
		
		 
	 }
	 

	public function index($id=NULL)
	{ 
	$data['ds']="tes";
		$this->template->display('ubah_password',$data);
    }
	
	public function admin_ubah($id=NULL)
	{ 
	$data['ds']="tes";
		$this->template->display('ubah_password_admin',$data);
    }
	
	public function ganti_password()
	{ 
	$id_user=$this->session->userdata('id_user');
	$passlama=$this->input->post('password_lama',true);
	$passbaru=$this->input->post('password_baru',true);
	$this->model_anggota->ganti_password($id_user,$passlama,$passbaru);
	// if (!empty($data)) {
		// echo  $data['password'];
		// echo "ada";
  //  }else{
	//	echo "ga ada";
//		
	//}
	 
	}
	public function ganti_password_admin()
	{ 
	$nim=$this->input->post('nim',true);
	echo $nim;
	$data = $this->model_anggota->cek_id_user($nim);
        if (!empty($data)) {
			echo $data['id_user'].'tes';
			$id_user=$data['id_user'];
			$passlama=$this->input->post('password_lama',true);
			$passbaru=$this->input->post('password_baru',true);
			$this->model_anggota->ganti_password($id_user,$passlama,$passbaru);
		}else{
			$this->session->set_flashdata('pesan','<div class="alert alert-danger">
										<button data-dismiss="alert" class="close">
											&times;
										</button>
										<i class="fa fa-check-circle"></i>
										<strong>NIM Tidak Ada</strong>
									</div>');
									redirect ('ubah_password/admin_ubah');
		}
	
	// if (!empty($data)) {
		// echo  $data['password'];
		// echo "ada";
  //  }else{
	//	echo "ga ada";
//		
	//}
	 
	}


}