<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class backend extends CI_Controller {

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
		 if ($this->session->userdata('username')=="") {
			redirect('auth');
		}
		 $this->load->library('template');	
		
		$this->load->model('model_backend');
		 
	 }
	 
	public function index($id=NULL)
	{ 
	$data['tes']="tes";
	$data['segment']="";
	//echo "edu";
	$this->template->display('home',$data);
		
	}
	public function company($id=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	$data['company'] =$this->model_backend->view_company();
	$this->template->display('company',$data);	
	}
	function logout()
    {

        $this->session->sess_destroy();
        redirect('/');
    }
	/*
	public function main_product($id=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	$data['main_product'] =$this->model_backend->view_main_product();
	$this->template->display('main_product',$data);
		
	}
	*/
	/*
	public function product($id=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	
	$data['main_product'] =$this->model_backend->view_main_product();
	$data['product'] =$this->model_backend->view_product();
	$this->template->display('product',$data);
		
	}
	/*
	public function company_product($product=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	
	$data['product'] =$this->model_backend->view_product();
	$data['company'] =$this->model_backend->view_company();
	$data['company_product'] =$this->model_backend->view_product_company();
	$data['product'] =$this->model_backend->view_product();
	$this->template->display('company_product',$data);
		
	}
	*/
	public function company_product2($id=NULL)
	{ 
	
	$product_id=$this->input->get('product_id',true);
	$data['company_product'] =$this->model_backend->view_product_company($product_id);
	
	$this->load->view('company_product2',$data);
		
	}
	


}