<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class company extends CI_Controller {

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
	$data['company'] =$this->model_backend->view_company();
	$this->template->display('company',$data);	
		
	}

	public function company_form($id=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	
	$data['company_product'] =$this->model_backend->form_company($id);
	
	$this->template->display('company_form',$data);
		
	}
	public function action_company($id=NULL)
	{ 
	$config['upload_path']          = './uploads/company';
    $config['allowed_types']        = 'gif|jpg|png';
	$config['max_size']             = 100000;
    $config['max_width']            = 10000;
    $config['max_height']           = 10000;

    $this->load->library('upload', $config);
	
		/* test handling for image upload edu */
                if ( ! $this->upload->do_upload('logo'))
                {
					$upload = $this->upload->data();
                        $error = array('error' => $this->upload->display_errors());
						
						
                }
                else
                {
					
                        $upload = $this->upload->data();
						
						$data['company_image']=$upload['file_name'];
                        
                }
	$id=$this->input->post('company_id',true);
	$data['company_code']=$this->input->post('company_code',true);
	$data['company_name']=$this->input->post('company_name',true);
	$data['company_email']=$this->input->post('company_email',true);
	$data['company_phone']=$this->input->post('company_phone',true);
	$data['company_address']=$this->input->post('company_address',true);
			
	if($id != NULL){
		
		$where ='company_id ='.$this->input->post('company_id');
		$this->db->update('company', $data, $where );
		
		
	}else{
		$this->db->insert('company', $data);
		
		
		
	}
	/*
		$this->session->set_flashdata('pesan','<div class="alert alert-success">
										<button data-dismiss="alert" class="close">
										&times;
										</button>
										<i class="fa fa-check-circle"></i>
										<strong>Success adding Data !</strong>
										</div>');
		*/						
		redirect ('/backend/company/');	
				
		
	}
	public function show_company($id=NULL)
	{ 
	
	$data=$this->model_backend->form_company_modal($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	
	public function delete_company()
	{
		$tables = array('company');
		$this->db->where('company_id', $this->input->post('company_id'));
		$this->db->delete($tables);
		echo json_encode(array("status" => TRUE));
	}


}