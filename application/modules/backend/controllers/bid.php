<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bid extends CI_Controller {

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
		$this->load->model('model_loan');
		 
	 }
	 
	public function index($id=NULL)
	{ 
	$this->load->model('model_bid');
	$data['segment'] = $this->uri->segment(2);
	//echo "edu";
	$data['aksi'] = 1;
	$data['loan'] =$this->model_bid->get_list_bids(null);
	$this->template->display('view_bid_list',$data);	
	}
	public function bid_more_80($id=NULL)
	{ 
	$this->load->model('model_bid');
	$data['segment'] = $this->uri->segment(2);
	$data['aksi'] = 1;
	$data['loan'] =$this->model_bid->get_list_bids(80);
	$this->template->display('view_bid_list',$data);	
		
	}
	public function bid_agreement($id=NULL)
	{ 
	$this->load->model('model_bid');
	$data['segment'] = $this->uri->segment(2);
	$data['aksi'] = 0;
	$data['loan'] =$this->model_bid->get_list_bids(80,2);
	$this->template->display('view_bid_list',$data);	
		
	}
	public function show_submission_loan_business($id=NULL)
	{ 
	
	$data=$this->model_backend->form_submission_loan_business($id);
	echo json_encode($data);

		
	}
	public function show_submission_loan_business2($id=NULL)
	{ 
	
	$data=$this->model_backend->form_submission_loan_business2($id);
	echo json_encode($data);

		
	}
	public function show_document_loan($id=NULL)
	{ 
	
	$data=$this->model_backend->view_document_loan($id);
	
	echo json_encode($data);
	
	}
	public function delete_submission()
	{
		//$tables = array('loan','loan_detail');
		//$this->db->where('loan_id', $this->input->post('loan_id'));
		//$this->db->delete($tables);
		$data = array(
				'is_deleted' => "1",
	
		);
		$where ='loan_id ='.$this->input->post('loan_id');
		$this->db->update('loan_product', $data, $where );
		
		echo json_encode(array("status" => TRUE,"id" => '1'.$this->input->post('loan_id').'edu'));
	}
	public function delete_submission_business()
	{
		//$tables = array('loan','loan_detail');
		//$this->db->where('loan_id', $this->input->post('loan_id'));
		//$this->db->delete($tables);
		$data = array(
				'is_deleted' => "1",
	
		);
		$where ='loan_id ='.$this->input->post('loan_id');
		$this->db->update('loan', $data, $where );
		
		echo json_encode(array("status" => TRUE,"id" => '1'.$this->input->post('loan_id').'edu'));
	}
	public function update_submission($id=NULL)
	{ 
	$id=$this->input->post('loan_id',true);
		$data = array(
				'loan_status' => $this->input->post('loan_status'),
	
		);
	if($id != NULL){
		
		$where ='loan_id ='.$this->input->post('loan_id');
		$this->db->update('loan_product', $data, $where );
		
		$this->load->library('send_mail');
		$this->send_mail->status_pinjaman_refinance($this->input->post('loan_status'),$this->input->post('user_id'),$this->input->post('loan_code'),$this->input->post('product_name'));
		
	}else{
		$this->db->insert('product_main', $data);
	}
		echo json_encode(array("status" => TRUE));
		
	}
	
	public function update_submission_business($id=NULL)
	{
		
		$data = array(
				'status' => $this->input->post('loan_status'),
		);
		$where ='loan_id ='.$this->input->post('loan_id');
		$this->db->update('loan', $data, $where );
		
		
		echo json_encode(array("status" => TRUE));
	}
	public function update_bid($id=NULL)
	{
		
		
		
		$status=$this->input->post('bid_status');
		$data = array(
				'status_suggest' => $this->input->post('bid_status'),
		);
		$where ='loan_id ='.$this->input->post('loan_id');
		$this->db->update('loan', $data, $where );
	
		$this->load->library('send_mail');
		$this->send_mail->status_suggest($this->input->post('loan_id'),$this->input->post('bid_status'));
		
		
		//$this->db->insert('loan_status', $data);
		
		echo json_encode(array("status" => TRUE,"status2" => $this->input->post('bid_status')));
	}
	public function detail($pParam2)
	{
		$data['segment'] = $this->uri->segment(2);
				$this->load->model("model_bid");
				$this->load->model("model_backend");
				$this->load->model("model_investment");
				$loan=$this->model_loan->get_by_code($pParam2);
				$data['bid']=$this->model_bid->get_bids_by_loan($loan->loan_id);
				
				//$data['totaldeposit']= $this->model_bid->min_bid_fund($fund->total,$bid->total);

                $this->template->display('view_detail_bid',$data);
					
	}
	
	public function show_repayment($id=null)
	{
	$data=$this->model_backend->form_repayment($id);
	echo json_encode($data);	
	}
	
	public function tes($id=null)
	{
	
	echo json_encode(array("status" => TRUE,"status2" => $this->input->post('loan_id')));
	}
	
	public function update_repayment($id=NULL)
	{ 
	$date = date_create();
	$id=$this->input->post('id_repayment',true);
		$data = array(
				'loan_id' => $this->input->post('loan_id_repay'),
				'schedule' => $this->input->post('schedule'),
				'principal' => $this->input->post('principal'),
				'interest' => $this->input->post('interest'),
				'instalment' => $this->input->post('instalment'),
				'balance' => $this->input->post('balance'),
				'status' => $this->input->post('status'),
				'created_by' => $this->session->userdata('id_user'),
				'created_date' => date_format($date, 'Y-m-d h:i:s'),
				'is_deleted' => 0,
				
	
		);
	if($id != NULL){
		
		$where ='loan_repayment_id ='.$this->input->post('id_repayment');
		$this->db->update('loan_repayment', $data, $where );
		
	}else{
		$this->db->insert('loan_repayment', $data);
	}
		echo json_encode(array("status" => TRUE));
		
	}
	
	
	public function update_info_detail()
	{
	 $this->form_validation->set_rules('txt_apr_percent', 'Annual Percentage Rate (APR)', 'trim|required|numeric');
                $this->form_validation->set_rules('txt_eir_percent', 'Effetive Interest Rate (EIR)', 'trim|required|numeric');
                if ($this->form_validation->run() == False)
                {
                    $this->detail($this->input->post("h_code"));
                }
                else
                {
                    $param2["loan_id"] = $this->input->post("h_loan_id");
                    $param2["risk_id"] = $this->input->post("cbo_risk");
                    $param2["apr_percent"] = $this->input->post("txt_apr_percent");
                    $param2["eir_percent"] = $this->input->post("txt_eir_percent");
                    $param2["document_prepared"] = (int) $this->input->post('chk_document_prepared');
                    $param2["contract_signed"] = (int) $this->input->post('chk_contract_signed');
                    $this->load->model("model_loan");
                   $this->model_loan->update_info_by_admin($param2); 

                  //  $this->log(3004, "Update", $this->input->post("h_risk_id"), $this->input->post("h_code")); 
                    $this->session->set_flashdata('Success', "Berhasil update review calon peminjam");

                    redirect("backend/submission-loan/detail/".$this->input->post("h_code")); 
                }	
		
	}

}