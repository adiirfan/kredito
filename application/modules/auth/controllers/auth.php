<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends MX_Controller {

	 
	  function __construct()
	 {
		 parent:: __construct();
		
		  if ($this->session->userdata('username')!="") {
			redirect('/backend');
		}
		$this->load->model('model_backend');
		
	 }
	 

	public function index($id=NULL)
	{ 
		//$this->template->displaylogin();
		
	$this->load->view('login_new');
	}
	function cek_login()
    {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		$data = $this->model_backend->user_login($username);

        if (!empty($data)) {
			  if (password_verify($password, $data['password'])) {
				$this->session->set_userdata($data);
				//echo json_encode(array("status" => TRUE));
			     echo "success";    
				} else{
				echo "gagal";
				}
		}
    }
	
	public function tes($id=NULL)
	{ 
		
				
		$this->load->view('welcome_message');
	
	//$this->template->display('home',$data);
	
	}

}