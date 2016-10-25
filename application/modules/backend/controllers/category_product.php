<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category_product extends CI_Controller {

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
	$data['segment'] = $this->uri->segment(2);
	
	$data['main_product'] =$this->model_backend->view_main_product();
	$data['product'] =$this->model_backend->view_product();
	$this->template->display('category_product',$data);
		
	}
	public function show_category_product($id=NULL)
	{ 
	
	$data=$this->model_backend->form_category_product($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	public function delete_category_product()
	{
		$tables = array('product');
		$this->db->where('product_id', $this->input->post('product_id'));
		$this->db->delete($tables);
		echo json_encode(array("status" => TRUE));
	}
	public function add_category_product($id=NULL)
	{ 
	$id=$this->input->post('product_id',true);
		$data = array(
				'product_code' => $this->input->post('product_code'),
                'product_main_id' => $this->input->post('product_main_id'),
				'product_name' => $this->input->post('product_name'),
				
				
				
		);
	if($id != NULL){
		
		$where ='product_id ='.$this->input->post('product_id');
		$this->db->update('product', $data, $where );
		
	}else{
		$this->db->insert('product', $data);
	}
		echo json_encode(array("status" => TRUE));
		
	}
	
	public function insert_user($id=NULL)
	{ 
	$password="supervisor2016";

$hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
	
			
		$absen=array(
							'id_user' => '4',
							'password' => $hash,
							'username' => 'supervisor',
							'id_level' => '2',
							'email' => 'supervisor@rajakredit.co.id',
							);
		$inpt=$this->db->insert('users', $absen);
		
	
	}

}