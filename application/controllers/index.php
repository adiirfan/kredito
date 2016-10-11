<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('model_credit');
		$this->load->model('model_tanggal');
		$this->load->model('model_backend');
    }

    public function index($pParam=null)
    {
		
        if(get_cookie("r_email") != Null && get_cookie("r_password") != Null)
        {
            $this->load->model("model_user");
            $return_user = $this->model_user->login(get_cookie("r_email"), get_cookie("r_password"));

            if ($return_user != false)
            {
                $this->load->library("set_cookies");
                $this->set_cookies->setUserID($return_user->user_id);
                $this->set_cookies->setEmail($return_user->email);
                $this->set_cookies->setUserGroup($return_user->user_group);
                $this->set_cookies->setFullName($return_user->full_name);
                $this->set_cookies->setIType($return_user->investor_type);
            }
            else
            {
                /*If not able to login, maybe the acocunt has been suspended, or etc. So need to clear the 
                    Remember Me cookies.
                */
                $this->session->sess_destroy();
                delete_cookie('user_id');
                delete_cookie('email');
                delete_cookie('user_group');
                delete_cookie('full_name');
                delete_cookie('r_email');
                delete_cookie('r_password');
            }
        }
        else
        {
            //delete_cookie('user_id');
            //delete_cookie('email');
            //delete_cookie('user_group');
            //delete_cookie('full_name');
        }
		$title['title']='Beranda';
        $this->load->model('model_statistic');
        $row = $this->model_statistic->get();
        $data["total_investment_used"] = $row->total_investment_used;

        $this->load->view('view_header', $title);
        $this->load->view('view_home', $data);
        $this->load->view('view_footer');

    }

    public function about()
    {
		$title['title']="Tentang Kami";
        $this->load->view('view_header', $title);
        $this->load->view('view_about');
        $this->load->view('view_footer');
    }
	 public function pilihan()
    {
		$title['title']="Pinjaman Rajakredit";
		$tenor_mobil=$this->input->post('h_waktu_mobil');
		$tenor_rumah=$this->input->post('h_waktu_rumah');
	
		$pinjaman=preg_replace("/[^0-9]/", "", $this->input->post('h_amount',true));
		//echo $this->input->post('h_selected_tujuan');
		//echo $this->input->post('h_waktu_mobil');
		//echo $this->input->post('h_waktu_usaha');
		//echo $this->input->post('h_waktu_rumah');
		
		if($this->input->post('h_selected_tujuan')=='4'){
		$data['pinjaman']=preg_replace("/[^0-9]/", "", $this->input->post('h_amount',true));
		$data['tenor']=$this->input->post('h_waktu_usaha');
		$data['tujuan']=$this->input->post('h_selected_tujuan');
		$data['siapa']=$this->input->post('h_siapa');

		if($this->input->get('pinjaman')!= null){
			$data['pinjaman']=$this->input->get('pinjaman');
			
		$data['tenor']="12";
		$data['tujuan']="Modal Usaha";
		$data['siapa']="Pengusaha";
		}
		
        $this->load->view('view_header', $title);
        $this->load->view('view_pilihan_refinance_b2b',$data);
        $this->load->view('view_footer');
		}else if($this->input->post('h_selected_tujuan')=='1'){
			
			redirect("/kredit-mobil/?tenor=$tenor_mobil&pinjaman=$pinjaman");
		}
		else if($this->input->post('h_selected_tujuan')=='2'){
			
			redirect("/kredit-pemilikan-rumah/?tenor=$tenor_rumah&pinjaman=$pinjaman");
		}else{
			$data['pinjaman']="100000000";
		if($this->input->get('pinjaman')!= null){
			$data['pinjaman']=$this->input->get('pinjaman');
		}
		
		$data['tenor']="12";
		$data['tujuan']="Modal Usaha";
		$data['siapa']="Pengusaha";
		$this->load->view('view_header', $title);
        $this->load->view('view_pilihan_refinance_b2b',$data);
        $this->load->view('view_footer');
		}
		
    }

    public function contact()
    {
		$title['title']="Kontak";
        $this->load->view('view_header', $title);
        $this->load->view('view_contact');
        $this->load->view('view_footer');
    }

    public function service()
    {
		$title['title']="Layanan";
        $this->load->view('view_header', $title);
        $this->load->view('view_service');
        $this->load->view('view_footer');
    }

    public function faq()
    {
		$title['title']="FAQ";
        $this->load->view('view_header', $title);
        $this->load->view('view_faq');
        $this->load->view('view_footer');
    }
	 public function succses()
    {
		$title['title']="Sukses Ativasi Akun";
        $this->load->view('view_header', $title);
        $this->load->view('succses');
        $this->load->view('view_footer');
    }
	public function kredit_mobil()
    {
		$title['title']="Kredit Mobil";
		$data['submit']=$this->input->post('submit');
		
		if($this->input->get('pinjaman') != null){
			$data['pinjaman']=$this->input->get('pinjaman');
			if($this->input->get('tenor') != 0){
			$data['tenor']=$this->input->get('tenor');
			}else {
			$data['tenor']="3";
			}
		}else{
			$data['pinjaman']="100000000";
			$data['tenor']="3";
		}
		
        $this->load->view('view_header', $title);
        $this->load->view('view_kredit_mobil',$data);
        $this->load->view('view_footer');
    }
	
	public function kredit_perumahan()
    {
		
	
		$title['title']="Kredit Pemilikan Rumah";
		$data['submit']=$this->input->post('submit');
		
		if($this->input->get('pinjaman') != null){
			$data['pinjaman']=$this->input->get('pinjaman');
			if($this->input->get('tenor') != 0){
			$data['tenor']=$this->input->get('tenor');
			}else {
			$data['tenor']="25";
			}
		}else{
			$data['pinjaman']="500000000";
			$data['tenor']="25";
		}
		
        $this->load->view('view_header', $title);
        $this->load->view('view_property_refinancing',$data);
        $this->load->view('view_footer');
	
		
    }
	public function product_data()
    {
		$tes=array();
		$tenor=$this->input->get('tenor',true);
		$pinalty=$this->input->get('pinalty',true);
		$kategory=$this->input->get('kategory',true);
		$company_product_id=$this->input->get('company_product_id',true);
			$condition=$this->input->get('condition',true);
		if($condition=='3'){
			$condition=null;
		}
		$product = $this->model_credit->view_product($tenor,$condition,$company_product_id,$kategory,$pinalty);
		$jason= array(
					'records' => $product
					);
		
		
	//	echo "<pre>";
		//print_r($product);
		//echo "";
		echo json_encode($jason, JSON_NUMERIC_CHECK);
	}
	public function max_min_interest()
    {
		$kategory=$this->input->get('kategory',true);
		
		
		$product = $this->model_credit->max_min_interest($kategory);
		$jason= array(
					'records' => $product
					);
		echo json_encode($jason);
	}
	public function add_order($id=NULL)
	{ 
	$random=$this->model_credit->random_generator(5);
	$this->session->set_userdata('loan_code', $random);
	$this->session->userdata('loan_code');
	$_POST = json_decode(file_get_contents('php://input'), true);
	$id=$this->input->post('company_product_id',true);
	$product = $this->model_credit->select_product($id);
	$loan=$this->input->post('loan');
	
	$sum_payment_month=(($loan-($product['down_payment'] / 100 * $loan))+ (3 * $product['interest_rate'] / 100) *  ($loan-($product['down_payment'] / 100 * $loan)))/ 36 ;
	
	$sum_interest_rate=((3 * $product['interest_rate']) * ($loan-($product['down_payment'] / 100 * $loan)))/100;
	$sum_down_payment=$product['down_payment'] / 100 * $loan;
	//$this->session->unset_userdata('loan_code');
	//echo $product['interest_rate'];
	/*
		$data = array(
				
                'company_product_id' => $this->input->post('company_product_id'),
				  'loan' => $this->input->post('loan'),
				'order_down_payment' => $sum_down_payment,
				'order_payment_month' => $sum_payment_month,
				'order_sum_interest_rate' => $sum_interest_rate,
					
				'order_status' => '0',
		);

		$this->db->insert('order', $data);
		*/
		
		$data = array(
				
                'company_product_id' => $this->input->post('company_product_id'),
				  'loan' => $this->input->post('loan'),
				   'loan_code' => $this->input->post('codeloan'),
				'loan_down_payment' => $sum_down_payment,
				'loan_payment_month' => $sum_payment_month,
				'loan_sum_interest_rate' => $sum_interest_rate,
				'user_id' => get_cookie("user_id"),
				
					
				'loan_status' => '0',
		);

		$this->db->insert('loan_product', $data);
		
		echo json_encode(array("status" => TRUE));
		
	}
    public function konfirmasi_refinance($id=NULL,$step=NULL)
    {

		if($this->uri->segment(3) != NULL){
			$title['title']="Form Pengajuan Refinance";
			$data['loan']=$this->model_credit->select_id_from_code_2('loan_product','loan_id',$this->uri->segment(2),'loan_code');
	//echo $maxidloan['max(loan_id)'];
	//$this->session->set_userdata('loan_id', $maxidloan['max(loan_id)']);
	//echo  $this->session->userdata('loan_id');
	$data['user']=$this->model_credit->set_value_sumbmission(get_cookie("user_id"));
		$this->load->view('view_header',$title);
        $this->load->view('view_konfirmasi_refinance',$data);
        $this->load->view('view_footer');
		}else{
				$title['title']="Form Pengajuan Refinance";
		//echo $maxidloan['max(loan_id)'];
		//$this->session->set_userdata('loan_id', $maxidloan['max(loan_id)']);
		//echo  $this->session->userdata('loan_id');
		$data['user']=$this->model_credit->set_value_sumbmission(get_cookie("user_id"));
		$this->load->view('view_header',$title);
        $this->load->view('form_loan',$data);
        $this->load->view('view_footer');
		}
	
    }
	
	public function add_loan($id=NULL)
	{ 
	//$_POST = json_decode(file_get_contents('php://input'), true);
//$this->session->unset_userdata('loan_id');
$title['title']="Pengjuan Loan";
$loan_code=$this->input->post('loan_code');
$loanid=$this->model_credit->select_id_from_code('loan_product','loan_id',$loan_code,'loan_code');

$date = date_create();

		$tg=$this->input->post('selecttg',true);
		$bl=$this->input->post('selectbl',true);
		$th=$this->input->post('selectth',true);
		$bod =$this->model_tanggal->tgl_ke_my($tg, $bl, $th);
		$data['loan_code']=$this->input->post('loan_code');
		$loan_code=$this->input->post('loan_code');
		$data = array(
				
                'loan_id' => $loanid['loan_id'],
				
				  'loan_nik' => $this->input->post('loan_nik'),
				'loan_name' => $this->input->post('loan_name'),
				'loan_pod' => $this->input->post('loan_pod'),
				'loan_bod' => $bod,
				'loan_address' => $this->input->post('loan_address'),
				'loan_city' => $this->input->post('loan_city'),
				'loan_postal_code' => $this->input->post('loan_postal_code'),
				'loan_gender' => $this->input->post('loan_gender'),
				'loan_purpose' => $this->input->post('loan_purpose'),
				'loan_email' => $this->input->post('email'),
				'loan_phone' => $this->input->post('phone'),	
				'loan_create_at' => date_format($date, 'Y-m-d h:i:s'),	
				
		);

		//$this->db->insert('loan_detail', $data);
		
		$status= array(
							'loan_status' => '2', 
							);
		$where ="loan_code ='$loan_code'";
		$inpt = $this->db->update('loan_product', $status, $where);
		$param["email"] = $this->input->post('email');
		 $param["user_id"] = "0";
        $this->load->model('model_user');
        $email_exists = $this->model_user->check($param);
		$userid=get_cookie("user_id");
        if ($email_exists && $userid == 0 ){	
		$this->db->insert('loan_detail', $data);
			$this->load->library('send_mail');
            $this->send_mail->new_loan_to_olduser_not_login($loanid['loan_id'],$data['loan_email']);
			$row_user = $this->model_user->get_by_email($param["email"]);
			//	$user= array(
				//'user_id' => $row_user->user_id, 
				//					);
			//	$loan_id=$loanid['loan_id'];
			//	$where ="loan_id ='$loan_id'";
			//	$inpt = $this->db->update('loan_product', $user, $where);
			
			
			//redirect("success/$loan_code");
			//Before
			//$_SESSION['pesan']   = "1";
			redirect("success/$loan_code");
            
        } else if($userid != 0){
			$this->db->insert('loan_detail', $data);
			$this->load->library('send_mail');
            $this->send_mail->new_loan_to_olduser($loanid['loan_id']);
			// $this->load->view('view_header',$title);
                  //  $this->load->view('succses', $data);
                   // $this->load->view('view_footer');
			redirect("success/$loan_code");
		}
		else if($email_exists && $userid != 0){
			$this->db->insert('loan_detail', $data);
			$this->load->library('send_mail');
            $this->send_mail->new_loan_to_olduser($loanid['loan_id']);
		redirect("success/$loan_code");
		}
        else{
            
					
					$this->db->insert('loan_detail', $data);
                    $param["password"] = "abcd1234";
                    $param["full_name"] = $this->input->post('loan_name');
                    $param["user_group"] = "B";
                    $param["salutation_id"] = "0";
                    $param["mobile_phone"] = "";
                    $param["company_name"] = "";
                    $param["company_registration"] = "";
                    $param["company_paid_up_capital"] = "0";
                    $param["company_man_power"] = "0";
                    $param["company_revenue"] = "0";
                    $param["investor_type"] = "";
                    $param["loan_id"]=$loanid['loan_id'];
                    $param["address"] = "";
                    $param["status"] = "0";
                    $this->load->model("model_user");
                    $return = $this->model_user->adding($param); 
					$title['title']="Pengajuan Refinance Berhasil";
                    $this->load->library('send_mail');
                    $this->send_mail->new_loan_to_user($loanid['loan_id']);
					$this->load->library('send_mail');
					$this->send_mail->new_loan_request_to_borrower($param["loan_id"]);
                    $data["email"] = $this->input->post('email');
                    $this->load->view('view_header',$title);
                    $this->load->view('succses', $data);
                    $this->load->view('view_footer');
					redirect("success/$loan_code");
					
		}			
		//redirect('borrower/application/listproduct');
	}
	
	 public function success($kode=null)
    {
		$title['title']="Sukses";
        $this->load->view('view_header', $title);
        $this->load->view('succses');
        $this->load->view('view_footer');
    }
	
	
	
}