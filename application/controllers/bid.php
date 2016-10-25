<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Bid extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	//
    }
   public function application($pParam=null)
    {
		$data['title']="bid";
    	switch ($pParam)
    	{
    		case null:
    		{
				
				if (get_cookie("user_id") != null)
				{
					if (get_cookie("user_group") == "I")
					{
						$this->load->model("model_user");
						$row = $this->model_user->get(get_cookie("user_id"));

						switch ($row->status)
						{
							case 1:
							{
								//After verification need to continue submit document
								$data["folder_code"] = $row->folder_code;

								$data['title']="Upload Dokumen";
								$this->load->view('view_header', $data);
								$this->load->view('view_investor_document', $data);
								$this->load->view('view_footer');

								break;
							}
							case 2:
							{
								$data['title']="Pending Investor";
								$this->load->view('view_header', $data);
								$this->load->view('view_investor_pending');
								$this->load->view('view_footer');
								break;
							}
							case "3":
							{
										//$this->load->model("model_bid");
								//$this->load->model("model_backend");
							  //  $data["loan"] = $this->model_bid->get_loan(null);
								 $this->load->model("model_backend");
								 $this->load->model("model_loan");
								$data["loan_list"] = $this->model_loan->listing_for_investor();

								$this->load->model("model_investment");
								$this->load->model("model_bid");
								//$this->load->model("model_credit");
								
								$fund= $this->model_investment->get_total_fund(get_cookie("user_id"));
								$bid= $this->model_bid->get_total_bid(get_cookie("user_id"));
								$data['totaldeposit']= $this->model_bid->min_bid_fund($fund->total,$bid->total);
								
								

							  //  $this->load->model("model_bid");
								$data["bids"] = $this->model_bid->get_bids(get_cookie("user_id"));
								
								$this->load->view('view_header', $data);
								$this->load->view('view_bid_list2', $data);
								$this->load->view('view_footer');
								break;
							   
							}
							default:
							{
								redirect("investor/application");    
								break;
							}
						}
					}
					else
					{
						$data['title']="Harap login investor";
						$this->load->view('view_header', $data);
						$this->load->view('view_investor_not');
						$this->load->view('view_footer');	
					}
					}
					else
					{
						redirect("investor/login");
					}

    			break;
    		}
    		
    		case "success":
    		{
    			$this->load->model('model_loan');
    			$row = $this->model_loan->get_loan(get_cookie("loan_id"));

    			$this->load->library('send_mail');
                $this->send_mail->new_loan_request_to_borrower(get_cookie("loan_id"));
                $this->send_mail->new_loan_request_to_admin(get_cookie("loan_id"));

    			$data["code"] = $row->code;
    			$data["balloon_message"] = "Check your loan request status here";
    			$this->load->view('view_header', $data);
				$this->load->view('view_borrower_submit');
				$this->load->view('view_footer');

    			break;
    		}
			case "submitbid":
    		{
    			$this->load->model('model_loan');
    			$row = $this->model_loan->get_loan(get_cookie("loan_id"));

    			$this->load->library('send_mail');
                $this->send_mail->new_loan_request_to_borrower(get_cookie("loan_id"));
                $this->send_mail->new_loan_request_to_admin(get_cookie("loan_id"));

    			$data["code"] = $row->code;
    			$data["balloon_message"] = "Check your loan request status here";
    			$this->load->view('view_header', $data);
				$this->load->view('view_borrower_submit');
				$this->load->view('view_footer');

    			break;
    		}
    		
    	}
    }
	public function show_bid_data($id=NULL)
	{ 
	$this->load->model('model_bid');
	$data=$this->model_bid->show_bid_data($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	public function tes($id=NULL)
	{ 
	
	//echo $this->input->post('h_selected_tujuan',true);
	echo $this->input->post('h_amount',true);
//	echo $this->input->post('h_selected_month',true);
	//echo $this->input->post('h_siapa',true);
	
	echo $this->input->post('pinjaman',true);
	echo $this->input->post('tenor',true);
	//echo $this->input->post('tujuan',true);
	echo $this->input->post('h_waktu_rumah',true);
	//echo $this->input->post('h_siapa',true);
		
	}
	public function add_bid($id=NULL)
	{ 
	$id=$this->input->post('loan_id',true);
	$amount=$this->input->post('amount_bid');
	$nilai= preg_replace("/[^0-9]/", "", $amount);
		$data = array(
				'loan_id' => $this->input->post('loan_id'),
				'bid_amount' => $nilai,
				'user_id' => get_cookie("user_id"),
                
				
				
				
		);

		$this->db->insert('bid', $data);

		echo json_encode(array("status" => TRUE,"id" => $nilai));
		
	}
	


}
