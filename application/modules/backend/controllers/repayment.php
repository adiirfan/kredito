<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class repayment extends CI_Controller {

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
		$this->load->model('model_loan_repayment');
		 
	 }
	 
	public function index($id=NULL)
	{ 
	echo "edu";
	}
	public function generate($id=NULL,$tenor=null)
	{ 
	
	 $row = $this->model_loan->get_loan($id);
	$code= $row->code;
	$bunga=$this->input->post('interest');
	$persenbulan=12/$tenor;
		$persen1=$bunga/100;
		$cicilanpokok=( $row->amount/$tenor);
		$bunga_1=(( $row->amount*$persen1)/$tenor);
		
		$total_cicilan_1=$cicilanpokok+$bunga_1;
		
		$this->db->delete('loan_repayment', array('loan_id' => $id));
		
		for ($x = 1; $x <= $tenor; $x++) {
			//$x=1;
			$tgl1=date('Y-m-d');
			//$tgl1 = "2013-01-23";
			$date = date_create();
			$tanggal = date('Y-m-d', strtotime("+$x month", strtotime($tgl1)));
			$data = array(
						'loan_id' => $id,
						'schedule' => $tanggal,
						'principal' => $row->amount/$tenor,
						'interest' => $this->input->post('interest'),
						'instalment' => $total_cicilan_1,
						'balance' => $total_cicilan_1 - ($row->amount/$tenor) ,
						'status' => 1,
						'created_by' => $this->session->userdata('id_user'),
						'created_date' => date_format($date, 'Y-m-d h:i:s'),
						'is_deleted' => 0,
						
			
				);
				//echo "<pre>";
				//print_r($data);
				//echo "<pre>";
		$this->db->insert('loan_repayment', $data);
	
		}	
	//	echo $bunga;
		redirect("backend/submission-loan/detail/$code");
	}
	

}