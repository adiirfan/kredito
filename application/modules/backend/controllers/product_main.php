<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_main extends CI_Controller {

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
	$this->template->display('main_product',$data);
		
	}
	public function show_product_main($id=NULL)
	{ 
	
	$data=$this->model_backend->form_product_main($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	public function delete_product_main()
	{
		$tables = array('product_main');
		$this->db->where('product_main_id', $this->input->post('product_main_id'));
		$this->db->delete($tables);
		echo json_encode(array("status" => TRUE));
	}
	public function delete_product_main2()
	{
		
		echo json_encode(array("status" => $this->input->post('product_main_id')));
	}
	public function add_product_main($id=NULL)
	{ 
	$id=$this->input->post('product_main_id',true);
		$data = array(
				'product_main_code' => $this->input->post('product_main_code'),
                'product_main_id' => $this->input->post('product_main_id'),
				'product_main_name' => $this->input->post('product_main_name'),
				
				
				
		);
	if($id != NULL){
		
		$where ='product_main_id ='.$this->input->post('product_main_id');
		$this->db->update('product_main', $data, $where );
		
	}else{
		$this->db->insert('product_main', $data);
	}
		echo json_encode(array("status" => TRUE));
		
	}

}