<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class investor extends CI_Controller {

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
	 $this->load->model("model_user");
	 $this->load->model("model_investment");
    $param["status"] = 1;
    $param["user_group"] = "I";
    $data["investor_list"] = $this->model_user->listing($param);
    $data["pInvestor"] = "active";
	$this->template->display('investor',$data);	
	}
	public function detail($id=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	 $this->load->model("model_user");
	  $this->load->model("model_kas");
	 $this->load->model("model_investor_document");
	 $data["user"] = $this->model_user->get($id);
	 $data["user_document"] = $this->model_investor_document->get_document($id);
	 $data["kas"] = $this->model_kas->get($id);
    $data["pInvestor"] = "active";
	$this->template->display('view_detail_investor',$data);	
	}

	public function company_form($id=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	//$company_id=$this->input->get('company_id',true);
	$data['company_product'] =$this->model_backend->form_company($id);
	
	$this->template->display('company_form',$data);
		
	}

	public function show_data($id=NULL)
	{ 
	
	$data=$this->model_backend->form_investor($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	
	public function update_investor()
	{
		
	$this->load->library('send_mail');
	if($this->input->post('status') == 3){
	$this->send_mail->investor_active($this->input->post('user_id'));	
	}
		
		$data = array(
				'status' => $this->input->post('status'),
				
	
		);
		$where ='user_id ='.$this->input->post('user_id');
		$this->db->update('user', $data, $where );
		
		echo json_encode(array("status" => TRUE,"status2" => $this->input->post('status')));
	}

public function delete_product_main()
	{
		$tes=$this->input->post('user_id');
		if($tes == null){
			$tes="edu";
		}
		echo json_encode(array("status" => $tes));
	}
}