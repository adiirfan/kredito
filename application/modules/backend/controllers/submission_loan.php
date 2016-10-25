<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class submission_loan extends CI_Controller {

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
	$data['segment'] = $this->uri->segment(2);
	//echo "edu";
	$data['loan'] =$this->model_backend->view_sumbmission_loan();
	$this->template->display('submission_loan',$data);
		
	}
	public function business($id=NULL)
	{ 
	$this->load->model('model_bid');
	$data['segment'] = $this->uri->segment(2);
	//echo "edu";
	$data['loan'] =$this->model_backend->view_sumbmission_loan_business($this->session->userdata('id_level'));
	$this->template->display('submission_loan_business',$data);
		
	}
	public function show_submission_loan($id=NULL)
	{ 
	
	$data=$this->model_backend->form_submission_loan($id);
	echo json_encode($data);

		
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
$this->send_mail->status_pinjaman_refinance($this->input->post('loan_status'),$this->input->post('loan_code'),$this->input->post('product_name'));
		
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
	public function update_submission_business2($id=NULL)
	{
		
		if($this->session->userdata('id_level')=='1' && $this->input->post('loan_status')=='4'){
		$data1 = array(
				'cs_approve' => '1',
				
		);
		$where ='loan_id ='.$this->input->post('loan_id');
		}else if($this->session->userdata('id_level')=='2'){
			$data1 = array(
				'status' => $this->input->post('loan_status'),	
		);
		$where ='loan_id ='.$this->input->post('loan_id');
			
		}else{
			$data1 = array(
				'status' => $this->input->post('loan_status'),	
		);
		$where ='loan_id ='.$this->input->post('loan_id');
			
		}
		
		$this->db->update('loan', $data1, $where );
		
		$status=$this->input->post('loan_status');
		
		if($this->session->userdata('id_level')=='1'){
			$status='10';
		}else{
			$status=$this->input->post('loan_status');
		}
		
		$status=$this->input->post('loan_status');
		
		$data = array(
				'status' => $status,
				'loan_id' => $this->input->post('loan_id'),
				'created_by' =>$this->session->userdata('id_user'),
				'remarks' => $this->input->post('remark'),
		);
		$this->load->library('send_mail');
		if($this->input->post('loan_status')=='4' && $this->session->userdata('id_level')=='2'){
		$param["loan_id"]=$this->input->post('loan_id');
		$this->model_loan->update_closing_date($param);
		$this->send_mail->status_pinjaman($this->input->post('loan_status'),$this->input->post('borrower_id'),$this->input->post('code'));
		}
		
		$this->db->insert('loan_status', $data);
		
		echo json_encode(array("status" => TRUE,"status2" => $this->input->post('loan_status')));
	}
	public function detail($pParam2)
	{
				$data['segment'] = $this->uri->segment(2);
				$this->load->model('model_loan');
                $row = $this->model_loan->get_by_code($pParam2);

                $this->load->model('model_salutation');
                $row_salutation = $this->model_salutation->get($row->b_salutation_id);  

                $loan_purpose = "";
                if ($row->loan_purpose_id == -1)
                {
                    $loan_purpose = $row->loan_purpose_other;
                }
                else
                {
                    $this->load->model('model_loan_purpose');
                    $row_purpose = $this->model_loan_purpose->get($row->loan_purpose_id); 
                    $loan_purpose = $row_purpose->loan_purpose_name;
                }

                $this->load->model("model_risk");
                $param["status"] = 1;
                $data["risk_list"] = $this->model_risk->listing($param);

                $this->load->model("model_loan_status");
                $param["loan_id"] = $row->loan_id;
                $data["loan_status_list"] = $this->model_loan_status->listing($param);

                $this->load->model("model_loan_repayment");
                $param["loan_id"] = $row->loan_id;
                $data["loan_repayment_list"] = $this->model_loan_repayment->listing($param);

                $status_name= $this->model_backend->status_submission($row->status);

                $data["pLoan"] = "active";
                $data["row"] = $row;
                $data["salutation_name"] = $row_salutation->salutation_name;
                $data["loan_purpose"] = $loan_purpose;
                $data["status_name"] = $status_name;

                $this->template->display('view_loan_detail',$data);
					
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
		echo json_encode(array("status" => TRUE,"status2" => $this->input->post('schedule')));
		
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