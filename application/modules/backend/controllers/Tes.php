<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	  function __construct()
	 {
		 parent:: __construct();
		 //if ($this->session->userdata('username')=="") {
			//redirect('auth');
		//}
		 $this->load->library('template');	
		
		$this->load->model('model_backend');
		 
	 }
	 
	public function index($id=NULL)
	{ 
	//$data['tes']="tes";
	//$data['segment']="";
	echo "edu";
	//$this->template->display('home',$data);
		
	}

	


}