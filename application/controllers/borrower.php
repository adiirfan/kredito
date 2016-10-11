<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Borrower extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	//
    }

     public function option()
    {
    	$this->create_loan();

    	if (get_cookie("user_id") != null)
    	{
    		if (get_cookie("user_group") == "B")
    		{
    			$this->load->model("model_user");
                $row = $this->model_user->get(get_cookie("user_id"));

                redirect("borrower/application/info");
    		}
    		else
    		{
    			$title['title']="Bukan Peminjam";
				$this->load->view('view_header',$title);
		        $this->load->view('view_borrower_not');
		        $this->load->view('view_footer');	
    		}
    	}
    	else
    	{
    		redirect("borrower/login");
    	}
    }

     public function login($pParam=null)
    {
    	switch ($pParam)
    	{
    		case null:
    		{
    			$title['title']="Login";
				$this->load->view('view_header',$title);
		        $this->load->view('view_borrower_login');
		        $this->load->view('view_footer');
		        break;
    		}
    		case "validation":
    		{
    			//$this->load->library("form_validation");
    			$this->form_validation->set_rules('txt_email', 'Email', 'trim|required|max_length[255]|valid_email');
    			$this->form_validation->set_rules("txt_password", "Password", "trim|required");

    			if ($this->form_validation->run() == False)
		        {
		           $title['title']="Login Peminjam";
					$this->load->view('view_header',$title);
			        $this->load->view('view_borrower_login');
			        $this->load->view('view_footer');
		        }
		        else
		        {
		            $this->load->model("model_user");
		            $return_user = $this->model_user->login($this->input->post("txt_email"), $this->input->post("txt_password"));

		            if ($return_user != false)
		            {
		            	if ($return_user->user_group == "B")
		            	{
		            		$this->load->library("set_cookies");
			                $this->set_cookies->setUserID($return_user->user_id);
		                    $this->set_cookies->setEmail($return_user->email);
		                    $this->set_cookies->setUserGroup($return_user->user_group);
		                    $this->set_cookies->setFullName($return_user->full_name);
		                   // $this->set_cookies->setCode($return_user->code);
		                    $this->set_cookies->setIType("");

		                    if ($this->input->post('chk_remember_me') == "1")
		                    {
		                        $this->set_cookies->setREmail($this->input->post("txt_email"));
		                        $this->set_cookies->setRPassword($this->input->post("txt_password"));
		                    }

		                    $this->update_loan_from_user($return_user->user_id);

			                redirect("borrower/application");
		            	}
		            	else
		            	{
		            		$data["pMessage"] = "Anda terregistrasi sebagai Investor, bukan sebagai Peminjam.";
							$title['title']="Login Peminjam";
							$this->load->view('view_header',$title);
					        $this->load->view('view_borrower_login', $data);
					        $this->load->view('view_footer');
		            	}
		            }
		            else
		            {
		                $data["pMessage"] = "Email tidak terdaftar, atau password salah";
						$title['title']="Login Peminjam";
						$this->load->view('view_header',$title);
				        $this->load->view('view_borrower_login', $data);
				        $this->load->view('view_footer');
		            }
		        }

    			break;
    		}
    	}
    }

   public function application($pParam=null)
    {
    	switch ($pParam)
    	{
    		case null:
    		{

    			$this->load->model('model_loan');
		        $row_loan = $this->model_loan->get_loan(get_cookie("loan_id"));	

		    	$data["salutation_id"] = $row_loan->b_salutation_id;
		    	$data["full_name"] = $row_loan->b_full_name;
		    	$data["email"] = $row_loan->b_email;
				$data["ktp"] = $row_loan->b_ktp;
				$data["address"] = $row_loan->b_address;
				
				$data["provinsi"] = $row_loan->b_provinsi;
				$data["city"] = $row_loan->b_city;
				$data["postal_code"] = $row_loan->b_postal_code;
		    	$data["mobile_phone"] = $row_loan->b_mobile_phone;
		    	$data["company_name"] = $row_loan->b_company_name;
		    	$data["company_registration"] = $row_loan->b_company_registration;
				$data["company_location"] = $row_loan->b_company_location;
				$data["company_address"] = $row_loan->b_company_address;
				$data["company_postal_code"] = $row_loan->b_company_postal_code;
		    	$data["company_paid_up_capital"] = $row_loan->b_company_paid_up_capital;
		    	$data["company_man_power"] = $row_loan->b_company_man_power;
		    	$data["company_revenue"] = $row_loan->b_company_revenue;
		    	$data["company_is_new"] = $row_loan->b_company_is_new;
		    	$data["loan_purpose_id"] = $row_loan->loan_purpose_id;
		    	$data["loan_purpose_other"] = $row_loan->loan_purpose_other;
;
		    	$this->load->model("model_salutation");
                $param["status"] = 1;
                $data["salutation_list"] = $this->model_salutation->listing($param);

                $this->load->model("model_loan_purpose");
                $param["status"] = 1;
                $data["loan_purpose_list"] = $this->model_loan_purpose->listing($param);

		    	$title['title']="Form pengajuan pinjaman";
				$this->load->view('view_header',$title);
				$this->load->view('view_borrower_application', $data);
				$this->load->view('view_footer');
    			break;
    		}
    		case "next":
    		{
    			//$this->load->library('form_validation');
				
    			$this->load->library('send_mail');
    			$this->form_validation->set_rules('cbo_salutation', 'Panggilan anda', 'required');
				$this->form_validation->set_rules('txt_address', 'Alamat anda', 'required');
				
				$this->form_validation->set_rules('txt_ktp', 'KTP anda', 'required|numeric');
				$this->form_validation->set_rules('txt_city', 'Kota', 'required');
				$this->form_validation->set_rules('txt_provinsi', 'Provinsi', 'required');
				$this->form_validation->set_rules('txt_postal_code', 'Kode Pos', 'required');
    			$this->form_validation->set_rules('txt_full_name', 'Nama lengkap', 'trim|required|max_length[255]');
    			$this->form_validation->set_rules('txt_email', 'Email', 'trim|required|max_length[255]|valid_email|callback_check_email_exists');
    			$this->form_validation->set_rules('txt_mobile_phone', 'Nomor Handphone', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('txt_company_address', 'Alamat Perusahaan', 'required');
				$this->form_validation->set_rules('txt_company_postal_code', 'Kode Pos Perusahaan', 'required');
    			$this->form_validation->set_rules('txt_company_name', 'Nama Perusahaan', 'trim|required|max_length[255]');
    			$this->form_validation->set_rules('txt_company_registration', 'No NPWP', 'trim|required|max_length[20]');
				$this->form_validation->set_rules('txt_company_location', 'Lokasi Usaha', 'trim|required|max_length[20]');
    			$this->form_validation->set_rules('txt_company_paid_up_capital', 'Modal Usaha', 'required');
    			$this->form_validation->set_rules('txt_company_revenue', 'Pendapatan pertahun', 'required');
    			$this->form_validation->set_rules('txt_amount', 'Jumlah Pinjaman', 'required');
    			$this->form_validation->set_rules('cbo_loan_purpose', 'Tujuan peminjaman', 'required');
    			if ($this->input->post("cbo_loan_purpose") == "-1")
    			{
				
    				$this->form_validation->set_rules('txt_loan_purpose_other', 'Purpose', 'required');	
    			}

    			if ($this->form_validation->run() == False)
	            {
						
	                $data["salutation_id"] = $this->input->post("cbo_salutation");
	                $data["full_name"] = "";
				    $data["email"] = "";
				    $data["mobile_phone"] = "";
				    $data["company_name"] = "";
				    $data["company_registration"] = "";
				    $data["company_paid_up_capital"] = "";
				    $data["company_man_power"] = "";
				    $data["company_revenue"] = "";
					$data["company_address"] = "";
					$data["company_postal_code"] = "";
					//TAMBAHAN EDU
					$data["ktp"] = "";
					$data["address"] = "";
					$data["provinsi"] = "";
					$data["city"] = "";
					$data["postal_code"] = "";
					$data["company_location"] = "";
					
				    $data["company_is_new"] = $this->input->post("chk_company_is_new");
				    $data["loan_purpose_id"] = $this->input->post("cbo_loan_purpose");
				    $data["loan_purpose_other"] = "";

				    $this->load->model("model_salutation");
		            $param["status"] = 1;
		            $data["salutation_list"] = $this->model_salutation->listing($param);

		            $this->load->model("model_loan_purpose");
	                $param["status"] = 1;
	                $data["loan_purpose_list"] = $this->model_loan_purpose->listing($param);

	               $title['title']="Form Pengajuan Peminjam";
						$this->load->view('view_header',$title);
	                $this->load->view('view_borrower_application', $data);
	                $this->load->view('view_footer');
				
	            }
	            else
	            {
					
	            	if (get_cookie("user_id") == "")
	    			{
						
	    				$param["salutation_id"] = $this->input->post("cbo_salutation");
	    				$param["email"] = $this->input->post("txt_email");
	    				$param["password"] = "abcd1234";
	    				$param["full_name"] = $this->input->post("txt_full_name");
	    				$param["user_group"] = "B";
		                $param["mobile_phone"] = $this->input->post("txt_mobile_phone");
		                $param["company_name"] = $this->input->post("txt_company_name");
		                $param["company_registration"] = $this->input->post("txt_company_registration");
		                $param["company_paid_up_capital"] = $this->input->post("txt_company_paid_up_capital");
		                $param["company_man_power"] = $this->input->post("cbo_man_power");
		                $param["company_revenue"] = $this->input->post("txt_company_revenue");
		                $param["investor_type"] = "";
	                    $param["address"] = "";
	                    $param["fund"] = "0";
		                $param["status"] = "0";
		                $this->load->model("model_user");
		                $return = $this->model_user->add($param);
						

		                $this->load->library('send_mail');
						$this->send_mail->new_registration_to_user($return["user_id"]);
						//bemasalah
		                $this->update_loan($return["user_id"]);
						//bermasalah

		                $data["folder_code"] = $this->create_folder();
						
			    		$title['title']="Aktivasi Pinjaman";
						$this->load->view('view_header',$title);
						//$this->load->view('view_borrower_document', $data);
						$this->load->view('view_borrower_submit_activation', $data);
						$this->load->view('view_footer');
	    			}
	    			else
	    			{
						//echo "EDUUU";
	    				$param["user_id"] = get_cookie("user_id");
		                $param["salutation_id"] = $this->input->post("cbo_salutation");
		                $param["mobile_phone"] = $this->input->post("txt_mobile_phone");
		                $param["address"] = "";
		                $param["company_name"] = $this->input->post("txt_company_name");
		                $param["company_registration"] = $this->input->post("txt_company_registration");
		                $param["company_paid_up_capital"] = $this->input->post("txt_company_paid_up_capital");
		                $param["company_man_power"] = $this->input->post("cbo_man_power");
		                $param["company_revenue"] = $this->input->post("txt_company_revenue");
		                $param["investor_type"] = "";
		                $this->load->model("model_user");
						
						//dihilangkan edu
		                //$this->model_user->update_other($param);
						//dihilangkan edu

		                $this->update_loan(get_cookie("user_id"));

		                $data["folder_code"] = $this->create_folder();

			    		$title['title']="Dokumen Peminjam";
						$this->load->view('view_header',$title);
						$this->load->view('view_borrower_document', $data);
						$this->load->view('view_footer');
	    			}
	            }
    			
    			break;
    		}
			case "info":
    		{

    			
				$data['tes']="10000";
		    	$title['title']="Info pengajuan pinjaman";
				$this->load->view('view_header',$title);
				$this->load->view('view_borrower_info', $data);
				$this->load->view('view_footer');
    			break;
    		}
			
    		case "submit":
    		{
    			$i = 0;
    			$document_type_each = '';
				$document_type_array = explode(",", $this->input->post("h_document_type_list"));
				$file_name_array = explode(",", $this->input->post("h_file_name_list"));

				$this->load->model('model_loan_document');
				$param["loan_id"] = get_cookie("loan_id");
				foreach($document_type_array as $document_type_each) 
				{
			    	$param["document_type"] = $document_type_array[$i];
			    	$param["file_name"] = $file_name_array[$i];	

				   	$this->model_loan_document->add($param);
				    $i++;
				}

				//Save & Submit later - > upload loan status = 1
				//Submit loan -> upload loan status = 2
				$this->load->model('model_loan');
				$param2["loan_id"] = get_cookie("loan_id");
				$param2["status"] = $this->input->post("h_status");
				$this->model_loan->update_status($param2);

				if ($this->input->post("h_status") == "1")
				{
					if (get_cookie("user_id") == "")
					{
						redirect("borrower/application/later");
					}
					else
					{
						redirect("borrower/application/list");	
					}
				}
				else
				{
					redirect("borrower/application/success");
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
				$data['title']="Peminjam";
    			$data["balloon_message"] = "Cek pinjaman anda disini";
    			$this->load->view('view_header', $data);
				$this->load->view('view_borrower_submit');
				$this->load->view('view_footer');

    			break;
    		}
    		case "list":
    		{
    			$this->load->model("model_loan");
				$this->load->model("model_backend");
                $data["loan_list"] = $this->model_loan->listing_my();

    			$title['title']="Daftar Pinjaman";
				$this->load->view('view_header',$title);
				$this->load->view('view_borrower_list', $data);
				$this->load->view('view_footer');
    			break;
    		}
			case "listproduct":
    		{
    			$this->load->model("model_credit");
				$this->load->model("model_backend");
                $data["loan_list"] = $this->model_credit->view_sumbmission_loan_2(get_cookie("user_id"),get_cookie("email"));

    			$title['title']="Daftar Pinjaman Refinance";
				$this->load->view('view_header',$title);
				$this->load->view('view_borrower_list_product', $data);
				$this->load->view('view_footer');

    			break;
    		}
    		case "later":
    		{
    			$data["balloon_message"] = "Cek pinjaman anda disini";
				$data['title']="Submit Pinjaman";
    			$this->load->view('view_header', $data);
				$this->load->view('view_borrower_submit_later');
				$this->load->view('view_footer');

    			break;
    		}
    		case "edit":
    		{
    			$this->load->model('model_loan');
    			$row = $this->model_loan->get_by_code($this->input->post("h_code"));

    			$this->load->library("set_cookies");
		        $this->set_cookies->setLoanID($row->loan_id);
		        $this->set_cookies->setBAmount($row->amount);
				$this->set_cookies->setBMonnth($row->period);

				redirect("borrower/application");
    		}

    		case "cancel":
    		{
    			$this->load->model('model_loan');
    			$row = $this->model_loan->get_by_code($this->input->post("txt_code"));

				$param["loan_id"] = $row->loan_id;
				$param["status"] = 6;
				$this->model_loan->update_status($param); 

				redirect("borrower/application/list");   			
    		}
    	}
    }
	public function show_submission_loan($id=NULL)
	{ 
	$this->load->model('model_backend');
	$data=$this->model_backend->form_submission_loan($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
		public function update_submission_loan()
	{
		//$tables = array('loan','loan_detail');
		//$this->db->where('loan_id', $this->input->post('loan_id'));
		//$this->db->delete($tables);
		$data = array(
				'loan_status' => "6",
		);
		$where ='loan_id ='.$this->input->post('loan_id');
		$this->db->update('loan', $data, $where );
		
		echo json_encode(array("status" => TRUE,"id" => '1'.$this->input->post('loan_id').'edu'));
	}
    function check_email_exists($email)
	{
		if (get_cookie("user_id") == "")
		{
			//get the borrower_id from loan, to handle case when:
			//	- it is a newly registered borrower
			//	- and user click "Back" from Document Upload page
 			$this->load->model("model_loan");
			$row = $this->model_loan->get_loan(get_cookie("loan_id"));

			$param["email"] = $this->input->post("txt_email");
			$param["user_id"] = $row->borrower_id;
			$this->load->model('model_user');
			$email_exists = $this->model_user->check($param);

			if ($email_exists){
				return false;
			}
			else{
				return true;
			}
		}
		else
		{
			return true;
		}
	}

	function create_loan($status=null)
	{
		if (get_cookie("user_id") == "")
		{
			$param["borrower_id"] = 0;
	    	$param["b_salutation_id"] = 0;
	    	$param["b_full_name"] = "";
	    	$param["b_email"] = "";
			$param["b_mobile_phone"] = "";
			$param["b_company_name"] = "";
			$param["b_company_registration"] = "";
			$param["b_company_paid_up_capital"] = 0;
			$param["b_company_man_power"] = 0;
			$param["b_company_revenue"] = 0;
			$param["amount"] = $this->input->post("h_amount");
			$param["period"] = $this->input->post("h_selected_month");
			$param["loan_purpose_id"] = 0;
			$param["loan_purpose_other"] = "";
		}
		else
		{
			$this->load->model('model_user');
		    $row_user = $this->model_user->get(get_cookie("user_id"));

			$param["borrower_id"] = get_cookie("user_id");
	    	$param["b_salutation_id"] = $row_user->salutation_id;
	    	$param["b_full_name"] = $row_user->full_name;
	    	$param["b_email"] = $row_user->email;
			$param["b_mobile_phone"] = $row_user->mobile_phone;
			$param["b_company_name"] = $row_user->company_name;
			$param["b_company_registration"] = $row_user->company_registration;
			$param["b_company_paid_up_capital"] = $row_user->company_paid_up_capital;
			$param["b_company_man_power"] = $row_user->company_man_power;
			$param["b_company_revenue"] = $row_user->company_revenue;
			$param["amount"] = $this->input->post("h_amount");
			$param["period"] = $this->input->post("h_selected_month");
			$param["loan_purpose_id"] = 0;
			$param["loan_purpose_other"] = "";
		}

		$this->load->model("model_loan");
    	$data = $this->model_loan->add($param);   

    	$this->load->library("set_cookies");
        $this->set_cookies->setLoanID($data["loan_id"]);
       if($this->input->post("h_amount") != null){
        $this->set_cookies->setBAmount($this->input->post("h_amount"));
		$this->set_cookies->setBMonnth($this->input->post("h_selected_month"));
		}else{
		$this->set_cookies->setBAmount('100000000');
		$this->set_cookies->setBMonnth('3');
		}
	}

	function update_loan($user_id)
	{
		$param["loan_id"] = get_cookie("loan_id");
		$param["borrower_id"] = $user_id;
	    $param["b_salutation_id"] = $this->input->post("cbo_salutation");
	    $param["b_full_name"] = $this->input->post("txt_full_name");
	    $param["b_email"] = $this->input->post("txt_email");
		$param["b_mobile_phone"] = $this->input->post("txt_mobile_phone");
		$param["b_company_name"] = $this->input->post("txt_company_name");
		$param["b_company_registration"] = $this->input->post("txt_company_registration");
		$param["b_company_paid_up_capital"] = $this->input->post("txt_company_paid_up_capital");
		$param["b_company_man_power"] = $this->input->post("cbo_man_power");
		$param["b_company_revenue"] = $this->input->post("txt_company_revenue");
		$param["b_company_address"] = $this->input->post("txt_company_address");
		$param["b_company_postal_code"] = $this->input->post("txt_company_postal_code");
		
		
		$param["amount"] = $this->input->post("txt_amount");
		
		//Tambahan Edu
		 $param["b_ktp"] = $this->input->post("txt_ktp");
	    $param["b_address"] = $this->input->post("txt_address");
		
	    $param["b_provinsi"] = $this->input->post("txt_provinsi");
		$param["b_city"] = $this->input->post("txt_city");
		$param["b_postal_code"] = $this->input->post("txt_postal_code");
		$param["b_company_location"] = $this->input->post("txt_company_location");
		
		//$param["period"] = $this->input->post("period");
		//old period parameter edu
		///$param["period"] = substr($this->input->post("period"),7);;
		//batas period old
		$param["period"] = $this->input->post("period");
		$param["loan_purpose_id"] = $this->input->post("cbo_loan_purpose");
		$param["loan_purpose_other"] = $this->input->post("txt_loan_purpose_other");

		$this->load->model("model_loan");
    	$this->model_loan->update($param);   
		
    	$this->load->library("set_cookies");
		$this->set_cookies->setBAmount($this->input->post("txt_amount"));
		$this->set_cookies->setBMonnth($this->input->post("h_selected_month"));

	}

	function update_loan_from_user($user_id)
	{
		$this->load->model("model_user");
		$row = $this->model_user->get($user_id);

		$param["loan_id"] = get_cookie("loan_id");
		$param["borrower_id"] = $user_id;
	    $param["b_salutation_id"] = $row->salutation_id;
	    $param["b_full_name"] = $row->full_name;
	    $param["b_email"] = $row->email;
		$param["b_mobile_phone"] = $row->mobile_phone;
		$param["b_company_name"] = $row->company_name;
		$param["b_company_registration"] = $row->company_registration;
		$param["b_company_paid_up_capital"] =$row->company_paid_up_capital;
		$param["b_company_man_power"] =$row->company_man_power;
		$param["b_company_revenue"] =$row->company_revenue;
		$param["amount"] = get_cookie("b_amount");
		$param["period"] = get_cookie("b_month");
		$param["loan_purpose_id"] = 0;
		$param["loan_purpose_other"] = "";

		$this->load->model("model_loan");
    	$this->model_loan->update_loan_user($param);   
	}


    function create_folder()
    {
        $this->load->model("model_loan");
        $row = $this->model_loan->get_loan(get_cookie("loan_id"));
        $upload_folder = getcwd()."/upload/loan/".$row->folder_code;
	    if(!is_dir($upload_folder))
	    {
	     	mkdir($upload_folder,0755,TRUE); 
	    }
	    
	    $this->create_sub_folder("aa", $row->folder_code);
	    $this->create_sub_folder("ma", $row->folder_code);
	    $this->create_sub_folder("la", $row->folder_code);
	    
	    return $row->folder_code;
    }


    function create_sub_folder($sub_folder_name, $code)
    {
    	//Create "aa", "ma", "la" folder
	    $sub_folder = getcwd()."/upload/loan/".$code."/".$sub_folder_name;
	    if(!is_dir($sub_folder))
	    {
	      mkdir($sub_folder,0755,TRUE);
	    }

	    //Create "files" folder
	    $files_folder = getcwd()."/upload/loan/".$code."/".$sub_folder_name."/files";
	    if(!is_dir($files_folder))
	    {
	      mkdir($files_folder,0755,TRUE);
	    }

	    //Create "thumbnail" folder
	    $thumbnail_folder = getcwd()."/upload/loan/".$code."/".$sub_folder_name."/files/thumbnail";
	    if(!is_dir($thumbnail_folder))
	    {
	      mkdir($thumbnail_folder,0755,TRUE);
	    }

	    //Copy php files
	    $file = getcwd()."/upload/index.php";
		$newfile = getcwd()."/upload/loan/".$code."/".$sub_folder_name."/index.php";
		copy($file, $newfile);
		if (!copy($file, $newfile)) 
		{
		    redirect("./");
		}

		$file = getcwd()."/upload/UploadHandler.php";
		$newfile = getcwd()."/upload/loan/".$code."/".$sub_folder_name."/UploadHandler.php";
		copy($file, $newfile);
		if (!copy($file, $newfile)) 
		{
		    redirect("./");
		}

    }
	public function perhitungan()
	    {
	  $pinjaman=$this->input->get('pinjaman',true);
	  echo $pinjaman;
		}
		
		public function tes()
	    {
	   $this->load->view("tes");
		}
		
		

}
