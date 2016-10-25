<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class investment extends CI_Controller {

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
	
	 $this->load->model("model_investment");
    $param["status"] = 2;
    $param["user_group"] = "I";
    $data["investor_list"] = $this->model_investment->listing2($param);
    $data["pInvestor"] = "active";
	$this->template->display('investment',$data);	
	}

	public function detail($kode=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	
	 $this->load->model("model_investment");
    
    $data["investment"] = $this->model_investment->get_by_code($param);
   
	$this->template->display('view_investment_detail',$data);	
	}

	public function show_data($id=NULL)
	{ 
	
	$data=$this->model_backend->form_investment($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	
	public function update_investment()
	{
		$data = array(
				'status' => $this->input->post('status'),
		);
		$where ='investment_id ='.$this->input->post('investment_id');
		$this->db->update('investment', $data, $where );
		
		$this->load->library('send_mail');
		
		//Jika di aktivasi
		if($this->input->post('status') == 3){
		$this->send_mail->investment_success($this->input->post('code'),$this->input->post('investor_id'),$this->input->post('fund'));
		//$this->send_mail->investor_active($this->input->post('investor_id'));		
		//update status kas
			$this->load->model("model_kas");
		
			$data['status']=2;
			$data['investor_id']=$this->input->post('investor_id');
			$data['investment_id']=$this->input->post('investment_id');
		//Batas update status kas
			
			$this->model_kas->update_kas_investment($data); 
			
			/// update saldo
			$jumlah_investment=$this->model_kas->jumlah_investment($this->input->post('investor_id'));
			$jumlah_bid=$this->model_kas->jumlah_bid($this->input->post('investor_id'));
			//$data['saldo']==$this->model_kas->jumlah_saldo(1,1);
			
			//pengurangan jumlah investment - jumlah bid
			$data['saldo']=$jumlah_investment['sum(nilai)'] - $jumlah_bid['sum(nilai)'];
			$this->model_kas->update_saldo($data);		
		
		}
		//Batas Jika diaktivasi
		
		
		
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
	
	public function show_document_investment($id=NULL)
	{ 
	
	$data=$this->model_backend->view_document_investment($id);
	
	echo json_encode($data);
	
	}
	
	
}