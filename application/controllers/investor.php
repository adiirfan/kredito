<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Investor extends CI_Controller {

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
		//$this->create_investment();
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
						//CR
                        //redirect("investor/application/list"); 
						redirect("bid/application");  
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
    }

    public function login($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $title['title']="Investor Login";
				$this->load->view('view_header',$title);
                $this->load->view('view_investor_login');
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
					$title['title']="Investor";
                    $this->load->view('view_header',$title);
                    $this->load->view('view_investor_login');
                    $this->load->view('view_footer');
                }
                else
                {
                    $this->load->model("model_user");
                    $return_user = $this->model_user->login($this->input->post("txt_email"), $this->input->post("txt_password"));

                    if ($return_user != false)
                    {
                        if ($return_user->user_group == "I")
                        {
                            $this->load->library("set_cookies");
                            $this->set_cookies->setUserID($return_user->user_id);
                            $this->set_cookies->setEmail($return_user->email);
                            $this->set_cookies->setUserGroup($return_user->user_group);
                            $this->set_cookies->setFullName($return_user->full_name);
                            $this->set_cookies->setIType($return_user->investor_type);

                            if ($this->input->post('chk_remember_me') == "1")
                            {
                                $this->set_cookies->setREmail($this->input->post("txt_email"));
                                $this->set_cookies->setRPassword($this->input->post("txt_password"));
                            }

                           // $this->update_investment_from_user($return_user->user_id);

                            redirect("investor/saldo");
                        }
                        else
                        {
                            $data["pMessage"] = "You're registered as Borrower, not an Investor. Please contact our Support Center";
							$title['title']="Investor";
							$this->load->view('view_header',$title);
                            $this->load->view('view_investor_login', $data);
                            $this->load->view('view_footer');
                        }
                    }
                    else
                    {
                        $data["pMessage"] = "Email not exist, or invalid password";
                        $title['title']="Investor";
						$this->load->view('view_header',$title);
                        $this->load->view('view_investor_login', $data);
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
                $data["salutation_id"] = "";
                $data["investment_type"] = "I";
                $data["fund"] = "50000";
                $data["address"] = "";

                $this->load->model("model_salutation");
                $param["status"] = 1;
                $data["salutation_list"] = $this->model_salutation->listing($param);
/*
                $this->load->model("model_paid_up_capital");
                $param["status"] = 1;
                $data["paid_up_capital_list"] = $this->model_paid_up_capital->listing($param);

                $this->load->model("model_man_power");
                $param["status"] = 1;
                $data["man_power_list"] = $this->model_man_power->listing($param);

                $this->load->model("model_revenue");
                $param["status"] = 1;
                $data["revenue_list"] = $this->model_revenue->listing($param);

                $this->load->model("model_loan_purpose");
                $param["status"] = 1;
                $data["loan_purpose_list"] = $this->model_loan_purpose->listing($param);
*/				$title['title']="Pendaftaran";
				 $this->load->view('view_header',$title);
                $this->load->view('view_investor_application', $data);
                $this->load->view('view_footer');

                break;
            }
            case "next":
            {
                //$this->load->library('form_validation');
                $this->load->library('send_mail');
                $this->form_validation->set_rules('cbo_salutation', 'Panggilan Anda', 'required');
                $this->form_validation->set_rules('txt_full_name', 'Nama Lengkap', 'trim|required|max_length[255]');
                $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|max_length[255]|valid_email|callback_check_email_exists');
                $this->form_validation->set_rules('txt_mobile_phone', 'Nomor Telepon', 'trim|required|max_length[50]');
                $this->form_validation->set_rules('txt_address', 'Alamat', 'trim|required|max_length[255]');
              
                if ($this->input->post("h_investor_type") == "C")
                {
                    $this->form_validation->set_rules('txt_company_name', 'Company Name', 'trim|required|max_length[255]');
                    $this->form_validation->set_rules('txt_company_registration', 'Registration No.', 'trim|required|max_length[10]');    
                }

                if ($this->form_validation->run() == False)
                {
                    $data["salutation_id"] = $this->input->post("cbo_salutation");
                    $data["full_name"] = "";
                    $data["email"] = "";
                    $data["mobile_phone"] = "";
                    $data["address"] = $this->input->post("txt_address");
                    $data["fund"] = "";
                    $data["company_name"] = "";
                    $data["company_registration"] = "";
                    $data["investment_type"] = $this->input->post("h_investor_type");

                    $this->load->model("model_salutation");
                    $param["status"] = 1;
                    $data["salutation_list"] = $this->model_salutation->listing($param);
					$title['title']="Pendaftaran";
                    $this->load->view('view_header',$title);
                    $this->load->view('view_investor_application', $data);
                    $this->load->view('view_footer');
                }
                else
                {
                    $param["salutation_id"] = $this->input->post("cbo_salutation");
                    $param["email"] = $this->input->post("txt_email");
                    $param["password"] = "abcd1234";
                    $param["full_name"] = $this->input->post("txt_full_name");
                    $param["user_group"] = "I";
                    $param["mobile_phone"] = $this->input->post("txt_mobile_phone");
                    $param["address"] = $this->input->post("txt_address");
                    $param["company_name"] = $this->input->post("txt_company_name");
                    $param["company_registration"] = $this->input->post("txt_company_registration");
                    $param["company_paid_up_capital"] = 0;
                    $param["company_man_power"] = 0;
                    $param["company_revenue"] = 0;
                    $param["investor_type"] = $this->input->post("h_investor_type");
                    $param["address"] = "";
                    $param["fund"] = $this->input->post("txt_fund");
                    $param["status"] = 0; //Removed ""
                    $this->load->model("model_user");
                    $return = $this->model_user->add($param);

                    $this->load->library('send_mail');
                    $this->send_mail->new_registration_to_user($return["user_id"]);

                    //$this->update_investment_period();
                    $data["folder_code"] = $this->create_folder($return["user_id"]);
					
                    $title['title']="Pendaftaran";
                    $this->load->view('view_header',$title);
                    //$this->load->view('view_investor_document', $data);
                    $this->load->view('view_investor_submit_activation', $data);
                    $this->load->view('view_footer');
                }
                
                break;
            } 
            case "submit":
            {
                $i = 0;
                $document_type_each = '';
                $document_type_array = explode(",", $this->input->post("h_document_type_list"));
                $file_name_array = explode(",", $this->input->post("h_file_name_list"));

                $this->load->model('model_investor_document');
                $param["user_id"] = get_cookie("user_id");
                foreach($document_type_array as $document_type_each) 
                {
                    $param["document_type"] = $document_type_array[$i];
                    $param["file_name"] = $file_name_array[$i]; 

                    $this->model_investor_document->add($param);
                    $i++;
                }

                //Save & Submit later - > upload User status = 1
                //Submit Now -> upload User status = 2
                $this->load->model('model_user');
                $param2["user_id"] = get_cookie("user_id");
                $param2["status"] = $this->input->post("h_status");
                $this->model_user->update_status($param2);

                if ($this->input->post("h_status") == "1")
                {
                    redirect("investor/application/later"); 
                }
                else
                {
                    redirect("investor/application/success");
                }

                break;
            }
            case "success":
            {
                $this->load->model('model_user');
                $row = $this->model_user->get(get_cookie("user_id"));

                $this->load->library('send_mail');
                $this->send_mail->new_investor_upload_document_register(get_cookie("user_id"));
                $this->send_mail->new_investor_application_to_admin(get_cookie("user_id"));
				$data['title']="investor";
                $data["code"] = $row->user_code;
               // $data["balloon_message"] = "Check your application status here";
                $this->load->view('view_header', $data);
                $this->load->view('view_investor_submit');
                $this->load->view('view_footer');

                break;
            }
            case "get_repayment_listing":
            {
                $param["loan_id"] = $this->input->post("loan_id");
                $this->load->model('model_loan_repayment');
                $repay = $this->model_loan_repayment->repayment_for_investor($param);
                echo json_encode($repay);
                break;
            }
            case "list":
            {
                $this->load->model("model_loan");
                $data["loan_list"] = $this->model_loan->listing_for_investor();

                $this->load->model("model_bid");
                $data["bids"] = $this->model_bid->get_bids(get_cookie("user_id"));

				$data['title']="Investor";
				$this->load->view('view_header', $data);
                $this->load->view('view_investor_make_listing', $data);
                $this->load->view('view_footer');
                // print_r($data);
                break;
            }
            case "later":
            {
                // $this->load->view('view_header', $data);
                $this->load->view('view_header');
                $this->load->view('view_investor_submit_later');
                $this->load->view('view_footer');

                break;
            }
            case "edit":
            {
                $this->load->model('model_investment');
                $row = $this->model_investment->get_by_code($this->input->post("h_code"));

                $this->load->library("set_cookies");
                $this->set_cookies->setInvestmentID($row->investment_id);

                redirect("investor/application");
            }
            case "cancel":
            {
                $this->load->model('model_investment');
                $row = $this->model_investment->get_by_code($this->input->post("txt_code"));

                $param["investment_id"] = $row->investment_id;
                $param["status"] = 6;
                $this->model_investment->update_status($param); 

                redirect("investor/application/list");
            }
			
            //Original bid
            // case "bid":
            // {
            //     $this->load->view('view_header');
            //     $this->load->view('view_bidding');
            //     $this->load->view('view_footer');
            //     return;

            //     $this->load->model("model_loan");
            //     $data["loan_list"] = $this->model_loan->listing_for_investor();

            //     $this->load->model("model_bid");
            //     $data["bids"] = $this->model_bid->get_bids(get_cookie("user_id"));

            //     $this->form_validation->set_rules('amount', 'bid number', 'required|is_natural_no_zero');

            //     if ($this->form_validation->run() == FALSE)
            //     {
            //         $this->load->view('view_header');
            //         $this->load->view('view_investor_make_listing', $data);
            //         $this->load->view('view_footer');
            //     }
            //     else
            //     {
            //         $param["loan_id"] = $this->input->post("h_loan_id");
            //         $param["amount"] = $this->input->post("amount") * 1000;
            //         $param["investor_id"] = get_cookie("user_id");

            //         $loan = $this->model_loan->get($param["loan_id"]);
            //         $param["total_bid_amount"] = $loan->total_bid_amount + $param["amount"];
            //         $param["available_bid_amount"] = $loan->available_bid_amount - $param["amount"];
            //         $param["progress_percent"] = ($param["total_bid_amount"] / $loan->amount) * 100;

            //         $this->model_loan->update_bid($param);
            //         $this->model_bid->add($param);
            //         redirect("investor/application/list");
            //     }
            // }
            case "bid":
            {
                $this->load->model("model_loan");
                $data["loan_list"] = $this->model_loan->listing_for_investor();

                $this->load->model("model_bid");
                $data["bids"] = $this->model_bid->get_bids(get_cookie("user_id"));

                $param["loan_id"] = $this->input->post("h_loan_id");
                $param["amount"] = $this->input->post("h_amount") * 1000;
                $param["investor_id"] = get_cookie("user_id");

                $loan = $this->model_loan->get($param["loan_id"]);
                $param["total_bid_amount"] = $loan->total_bid_amount + $param["amount"];
                $param["available_bid_amount"] = $loan->available_bid_amount - $param["amount"];
                $param["progress_percent"] = ($param["total_bid_amount"] / $loan->amount) * 100;

                $this->model_loan->update_bid($param);
                $this->model_bid->add($param);
                
                $this->load->view('view_header');
                $this->load->view('view_bidding');
                $this->load->view('view_footer');
            }
        }
    }

    function create_investment()
    {
    	if (get_cookie("user_id") == "")
    	{
    		$param["investor_id"] = 0;
            $param["i_salutation_id"] = 0;
            $param["i_full_name"] = "";
            $param["i_email"] = "";
            $param["i_mobile_phone"] = "";
            $param["i_address"] = "";
            $param["i_investor_type"] = "I";
            $param["i_company_name"] = "";
            $param["i_company_registration"] = "";
            $param["fund"] = 50000;
            $param["fund_used"] = 0;
            $param["pref_paid_up_capital_id"] = 0;
            $param["pref_paid_up_capital_from"] = 0;
            $param["pref_paid_up_capital_to"] = 0;
            $param["pref_man_power_id"] = 0;
            $param["pref_man_power_from"] = 0;
            $param["pref_man_power_to"] = 0;
            $param["pref_revenue_id"] = 0;
            $param["pref_revenue_from"] = 0;
            $param["pref_revenue_to"] = 0;
    	}
    	else
    	{
    		$this->load->model('model_user');
		    $row_user = $this->model_user->get(get_cookie("user_id"));

			$param["investor_id"] = get_cookie("user_id");
            $param["i_salutation_id"] = $row_user->salutation_id;
            $param["i_full_name"] = $row_user->full_name;
            $param["i_email"] = $row_user->email;
            $param["i_mobile_phone"] = $row_user->mobile_phone;
            $param["i_address"] = $row_user->address;
            $param["i_investor_type"] = $row_user->investor_type;
            $param["i_company_name"] = $row_user->company_name;
            $param["i_company_registration"] = $row_user->company_registration;
            $param["fund"] = 50000;
            $param["fund_used"] = 0;
            $param["pref_paid_up_capital_id"] = 0;
            $param["pref_paid_up_capital_from"] = 0;
            $param["pref_paid_up_capital_to"] = 0;
            $param["pref_man_power_id"] = 0;
            $param["pref_man_power_from"] = 0;
            $param["pref_man_power_to"] = 0;
            $param["pref_revenue_id"] = 0;
            $param["pref_revenue_from"] = 0;
            $param["pref_revenue_to"] = 0;
    	}

    	$this->load->model("model_investment");
    	$data = $this->model_investment->add($param); 

    	$this->load->library("set_cookies");
        $this->set_cookies->setInvestmentID($data["investment_id"]);
		
    }

    function update_investment($user_id)
    {
        $param["investment_id"] = get_cookie("investment_id");
        $param["investor_id"] = $user_id;
        $param["i_salutation_id"] = $this->input->post("cbo_salutation");
        $param["i_full_name"] = $this->input->post("txt_full_name");
        $param["i_email"] = $this->input->post("txt_email");
        $param["i_mobile_phone"] = $this->input->post("txt_mobile_phone");
        $param["i_address"] = $this->input->post("txt_address");
        $param["i_investor_type"] = $this->input->post("h_investor_type");
        $param["i_company_name"] = $this->input->post("txt_company_name");
        $param["i_company_registration"] = $this->input->post("txt_company_registration");
        $param["fund"] = $this->input->post("txt_fund");

        if ($this->input->post('cbo_pref_paid_up_capital') == "0")
        {
            $param["pref_paid_up_capital_id"] = 0;
            $param["pref_paid_up_capital_from"] = 0;
            $param["pref_paid_up_capital_to"] = 0;    
        }
        else
        {
            $this->load->model('model_paid_up_capital');
            $row = $this->model_paid_up_capital->get($this->input->post('cbo_pref_paid_up_capital'));
            $param["pref_paid_up_capital_id"] = $this->input->post("cbo_pref_paid_up_capital");
            $param["pref_paid_up_capital_from"] = $row->from;
            $param["pref_paid_up_capital_to"] = $row->to;    
        }
        
        if ($this->input->post('cbo_pref_man_power') == "0")
        {
            $param["pref_man_power_id"] = 0;
            $param["pref_man_power_from"] = 0;
            $param["pref_man_power_to"] = 0;
        }
        else
        {
            $this->load->model('model_man_power');
            $row = $this->model_man_power->get($this->input->post('cbo_pref_man_power'));
            $param["pref_man_power_id"] = $this->input->post("cbo_pref_man_power");
            $param["pref_man_power_from"] = $row->from;
            $param["pref_man_power_to"] = $row->to;    
        }
        
        if ($this->input->post('cbo_pref_revenue') == "0")
        {
            $param["pref_revenue_id"] = 0;
            $param["pref_revenue_from"] = 0;
            $param["pref_revenue_to"] = 0;    
        }
        else
        {
            $this->load->model('model_revenue');
            $row = $this->model_revenue->get($this->input->post('cbo_pref_revenue'));
            $param["pref_revenue_id"] = $this->input->post("cbo_pref_revenue");
            $param["pref_revenue_from"] = $row->from;
            $param["pref_revenue_to"] = $row->to;    
        }
     
        $this->load->model("model_investment");
        $this->model_investment->update($param);   
    }

    function update_investment_from_user($user_id)
    {
        $this->load->model("model_user");
        $row = $this->model_user->get($user_id);

        $param["investment_id"] = get_cookie("investment_id");
        $param["investor_id"] = $user_id;
        $param["i_salutation_id"] = $row->salutation_id;
        $param["i_full_name"] = $row->full_name;
        $param["i_email"] = $row->email;
        $param["i_mobile_phone"] = $row->mobile_phone;
        $param["i_address"] = $row->address;
        $param["i_company_name"] = $row->company_name;
        $param["i_company_registration"] = $row->company_registration;
        $param["fund"] = 10000;
        $param["pref_paid_up_capital_id"] = 0;
        $param["pref_paid_up_capital_from"] = 0;
        $param["pref_paid_up_capital_to"] = 0;  
        $param["pref_man_power_id"] = 0;
        $param["pref_man_power_from"] = 0;
        $param["pref_man_power_to"] = 0;  
        $param["pref_revenue_id"] = 0;
        $param["pref_revenue_from"] = 0;
        $param["pref_revenue_to"] = 0;    
        
        $this->load->model("model_investment");
        $this->model_investment->update($param);  
    }

    function create_folder($user_id)
    {
         $this->load->model("model_user");
        $row = $this->model_user->get($user_id);
        $upload_folder = getcwd()."/upload/investment/".$row->folder_code;
        if(!is_dir($upload_folder))
        {
            mkdir($upload_folder,0755,TRUE); 
        }
        
        $this->create_sub_folder("ic", $row->folder_code);
        $this->create_sub_folder("pa", $row->folder_code);
		$this->create_sub_folder("konfirmasi", $row->folder_code);
        
        return $row->folder_code;
    }


    function create_sub_folder($sub_folder_name, $code)
    {
        //Create "aa", "ma", "la" folder
        $sub_folder = getcwd()."/upload/investment/".$code."/".$sub_folder_name;
        if(!is_dir($sub_folder))
        {
          mkdir($sub_folder,0755,TRUE);
        }

        //Create "files" folder
        $files_folder = getcwd()."/upload/investment/".$code."/".$sub_folder_name."/files";
        if(!is_dir($files_folder))
        {
          mkdir($files_folder,0755,TRUE);
        }

        //Create "thumbnail" folder
        $thumbnail_folder = getcwd()."/upload/investment/".$code."/".$sub_folder_name."/files/thumbnail";
        if(!is_dir($thumbnail_folder))
        {
          mkdir($thumbnail_folder,0755,TRUE);
        }

        //Copy php files
        $file = getcwd()."/upload/index.php";
        $newfile = getcwd()."/upload/investment/".$code."/".$sub_folder_name."/index.php";
        copy($file, $newfile);
        if (!copy($file, $newfile)) 
        {
            redirect("./");
        }

        $file = getcwd()."/upload/UploadHandler.php";
        $newfile = getcwd()."/upload/investment/".$code."/".$sub_folder_name."/UploadHandler.php";
        copy($file, $newfile);
        if (!copy($file, $newfile)) 
        {
            redirect("./");
        }
    }

    function update_investment_period()
    {
        $this->load->model('model_investment_period');
        $this->model_investment_period->delete_all(get_cookie("investment_id"));

        if ($this->input->post('chk_period_3') != "")
        {
            $this->update_investment_period_each(3);    
        }
        if ($this->input->post('chk_period_6') != "")
        {
            $this->update_investment_period_each(6);    
        }
        if ($this->input->post('chk_period_9') != "")
        {
            $this->update_investment_period_each(9);    
        }
        if ($this->input->post('chk_period_12') != "")
        {
            $this->update_investment_period_each(12);    
        }
        if ($this->input->post('chk_period_18') != "")
        {
            $this->update_investment_period_each(18);    
        }
        if ($this->input->post('chk_period_24') != "")
        {
            $this->update_investment_period_each(24);    
        }
    }

    function update_investment_period_each($period)
    {
        $this->load->model('model_investment_period');
        $row = $this->model_investment_period->get(get_cookie("investment_id"), $period);

        $param["investment_id"] = get_cookie("investment_id");
        $param["period"] = $period;

        if ($row == false)
        {
            $this->model_investment_period->add($param);
        }
        else
        {
            $this->model_investment_period->update($param);
        }

    }

    public function bid($pParam=null,$activation=null)
    {
     switch ($pParam)
        {
            case null:
            {
				$this->load->model("model_investment");
				$this->load->model("model_bid");
				$this->load->model("model_credit");
			 
				$fund= $this->model_investment->get_total_fund(get_cookie("user_id"));
			
				$bid= $this->model_bid->get_total_bid(get_cookie("user_id"));
				$total= $this->model_bid->min_bid_fund($fund->total,$bid->total);
			  
				$nilaibid= $this->input->post('h_amount');
				$sisa= $this->input->post('h_sisa');
				$check=$total - $nilaibid;
			
					$this->load->library('send_mail');
					 $random = strtoupper(random_string('alpha', 20));
					 $randomcode=$this->model_credit->random_generator(10);
					 $id=$this->input->post('loan_id',true);
						$amount=$this->input->post('h_amount');
						$nilai= preg_replace("/[^0-9]/", "", $amount);
						$data = array(
							'loan_id' => $this->input->post('h_loan_id'),
							'bid_amount' => $this->input->post('h_amount'),
							'user_id' => get_cookie("user_id"),	
							'activation_code' => $random,
							'bid_code' => $randomcode,								
					);
					$this->db->insert('bid', $data);
					$this->send_mail->activation_bid(get_cookie("user_id"),$this->input->post('h_loan_id'),$random,$amount);
					$this->session->set_flashdata('berhasil', "Berhasil bid calon peminjam, cek email anda untuk konfirmasi bid anda !!");
					redirect('/investor/bid/list/');
				
				break;
			}
			case "tes":
            {
				echo $this->input->post('h_amount').'tes';
				echo  $this->input->post('h_sisa').'loan id = '.$this->input->post('h_loan_id');
				break;
			}
			case "list":
            {
				$this->load->model("model_bid");
				$this->load->model("model_backend");
				$this->load->model("model_investment");
				$data['bid']=$this->model_bid->get_bids(get_cookie("user_id"));
				$fund= $this->model_investment->get_total_fund(get_cookie("user_id"));
				$bid= $this->model_bid->get_total_bid(get_cookie("user_id"));
				$data['totaldeposit']= $this->model_bid->min_bid_fund($fund->total,$bid->total);
				$data['title']="investor";
				$this->load->view('view_header', $data);
                $this->load->view('view_bid_investor');
                $this->load->view('view_footer');
			//$this->template->display('list_bid_investor',$data);	
				break;
			}
			case "listprogress":
            {
				 $this->load->model("model_backend");
				 $this->load->model("model_loan");
                $data["loan_list"] = $this->model_loan->listing_for_investor();

				$this->load->model("model_investment");
				$this->load->model("model_bid");
				//$this->load->model("model_credit");
				
				$fund= $this->model_investment->get_total_fund(get_cookie("user_id"));
				$bid= $this->model_bid->get_total_bid(get_cookie("user_id"));
				$data['totaldeposit']= $this->model_bid->min_bid_fund($fund->total,$bid->total);
				
				$data['title']="Bid Anda";

              //  $this->load->model("model_bid");
                $data["bids"] = $this->model_bid->get_bids(get_cookie("user_id"));
				$title['title']="Bid Saya";
    			$this->load->view('view_header', $title);
				$this->load->view('view_bid_progress', $data);
				$this->load->view('view_footer');
    			break;
			}
			case "activation":
            {
				
				$this->load->model("model_bid");
				$this->load->model("model_user");
				$this->load->model("model_loan");
				$this->load->model("model_kas");
				$this->model_bid->activation_bid($activation);
				$kode=$this->model_bid->select_by_activation($activation);
				
				$loan=$this->model_loan->get_loan($kode->loan_id);
				
					$row = $this->model_user->get($kode->user_id);
					$this->load->library("set_cookies");
                    $this->set_cookies->setUserID($row->user_id);
                    $this->set_cookies->setEmail($row->email);
                    $this->set_cookies->setUserGroup($row->user_group);
                    $this->set_cookies->setFullName($row->full_name);
					$this->set_cookies->setStatus(3);
                   // $this->set_cookies->setCode($row->code);
                    $this->set_cookies->setIType($row->investor_type);
					//get total bid
					$total_bid=$this->model_bid->get_total_bid_by_loan($kode->loan_id);
					//update nilai bid di tabel loan
					$this->model_bid->update_total_loan_bid($total_bid->total,$kode->loan_id,$loan->amount);
					
					//module kas
					$cek=$this->model_kas->cek_idbid_in_kas($kode->bid_id);
					
					if($cek == 0 ){
					//insert bid to kas
					$data['nilai']=$kode->bid_amount;
					$data['bid_id']=$kode->bid_id;
					$data['user_id']=$kode->user_id;
					$this->model_kas->add_bid($data); 
					
					/// update saldo
					$jumlah_investment=$this->model_kas->jumlah_investment($kode->user_id);
					$jumlah_bid=$this->model_kas->jumlah_bid($kode->user_id);
					
					$data['saldo']=$jumlah_investment['sum(nilai)'] - $jumlah_bid['sum(nilai)'];
					$this->model_kas->update_saldo_bid($data);		
							//batas insert bid to kas
					}

					
				
				$this->session->set_flashdata('berhasil', "Terimakasih telah mengkonfirmasi".$loan->amount." BID dengan id ". $kode->bid_code."");
				redirect('/investor/bid/listprogress');
			//$this->template->display('list_bid_investor',$data);	
				break;
			}
			case "loan_detail":
            {
                $param["loan_id"] = $this->input->post("loan_id");
                $this->load->model('model_loan');
                $repay = $this->model_loan->get_loan($activation);
			//   $repay['edu']="tes";
                echo json_encode($repay);
                break;
            }
			
		}	
    }
	 public function tambah_saldo()
    {
		$data['title']="Tambah Saldo";
		$this->load->model("model_investment");
		$this->load->model("model_bid");
		$this->load->model("model_backend");
		$this->load->model("model_tanggal");
		$this->load->view('view_header', $data);
				$this->load->view('tambah_saldo_investor');
				$this->load->view('view_footer');
	}
	 public function konfirmasi_tambah_saldo($code=null,$fund=null)
    {
		$data['title']="Tambah Saldo";
		$data['code']=$code;
		$data['fund']=$fund;
		$this->load->view('view_header', $data);
				$this->load->view('konfirmasi_tambah_saldo_investor');
				$this->load->view('view_footer');
	}
	public function action_tambah_saldo($id=NULL)
	{ 
			$this->load->model('model_user');
		    $row_user = $this->model_user->get(get_cookie("user_id"));
			$this->load->model('model_tanggal');
			
			$param["investor_id"] = get_cookie("user_id");
            $param["i_salutation_id"] = $row_user->salutation_id;
            $param["i_full_name"] = $row_user->full_name;
            $param["i_email"] = $row_user->email;
            $param["i_mobile_phone"] = $row_user->mobile_phone;
            $param["i_address"] = $row_user->address;
            $param["i_investor_type"] = $row_user->investor_type;
            $param["i_company_name"] = $row_user->company_name;
            $param["i_company_registration"] = $row_user->company_registration;
			//EDU add
            $param["fund"] = $nilai= preg_replace("/[^0-9]/", "", $this->input->post('fund',true));
			
			 //Batas/
			 
            $param["fund_used"] = 0;
            $param["pref_paid_up_capital_id"] = 0;
            $param["pref_paid_up_capital_from"] = 0;
            $param["pref_paid_up_capital_to"] = 0;
            $param["pref_man_power_id"] = 0;
            $param["pref_man_power_from"] = 0;
            $param["pref_man_power_to"] = 0;
            $param["pref_revenue_id"] = 0;
            $param["pref_revenue_from"] = 0;
            $param["pref_revenue_to"] = 0;
    	
		
		

    	$this->load->model("model_investment");
		$this->load->model("model_kas");
    	$data = $this->model_investment->add2($param); 
		$data['user_id']=get_cookie("user_id");
		$title['title']="Rincian Tagihan Saldo";
		
		//tambah kas
		$this->model_kas->add_investment($data); 
		//tambah kas
		$this->load->view('view_header', $title);
		$this->load->view('tambah_saldo_investor_2', $data);
		$this->load->view('view_footer');
				
		
	}
	public function tes($id=NULL){
		$data="tes";
		$title="tes";
		$this->load->view('view_header', $title);
		$this->load->view('tambah_saldo_investor_2', $data);
		$this->load->view('view_footer');
	}
	
	public function action_konfirmasi_tambah_saldo($id=NULL)
	{ 

			$this->load->model('model_user');
		    $row_user = $this->model_user->get(get_cookie("user_id"));
			$this->load->model('model_tanggal');
			
			//update status kas
			$this->load->model("model_kas");
			$this->load->model("model_investment");
			$data_investment = $this->model_investment->get_by_code($this->input->post('no_pengajuan',true)); 
			$data['status']=1;
			$data['investor_id']=$data_investment->investor_id;
			$data['investment_id']=$data_investment->investment_id;
			$this->model_kas->update_kas_investment($data); 
			//Batas update status kas
			
			
			
			$config['upload_path']          = "./upload/investment/".$row_user->folder_code.'/konfirmasi/files';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000000;
			$config['max_width']            = 100000;
			$config['max_height']           = 100000;

			$this->load->library('upload', $config);
		
			/* test handling for image upload edu */
					if ( ! $this->upload->do_upload('bukti_transfer'))
					{
						$upload = $this->upload->data();
							$error = array('error' => $this->upload->display_errors());
							
							echo "<pre>";
							print_r($error);
							echo "</pre>";       
							
					}
					else
					{
						
							$upload = $this->upload->data();
							echo "<pre>";
							//print_r($data);
							echo "</pre>";	
							//$data['company_image']="";
							$data['company_image']=$upload['file_name'];
							
					}

			$tg=$this->input->post('selecttg',true);
			$bl=$this->input->post('selectbl',true);
			$th=$this->input->post('selectth',true);
			$tgl =$this->model_tanggal->tgl_ke_my($tg, $bl, $th);
			
			//EDU add
			$param["code_investment"] = $this->input->post('no_pengajuan',true);
			$param["bank_rk_id"] = $this->input->post('tujuan_transfer',true);
            $param["fund"] = $nilai= preg_replace("/[^0-9]/", "", $this->input->post('fund',true));
			$param["bank_trf"] = $this->input->post('bank',true);
			$param["tgl_trf"] = $tgl;
			$param["name_account_bank"] = $this->input->post('nama',true);
			$param["notes"] = $this->input->post('note',true);
			$param["bukti_trf"] = $upload['file_name'];
			$param["submitted_date"] =  date('Y-m-d H:i:s');
			$param["status"] =  2;
			
			 //Batas/
			 //update status investment
			$where ="code_investment ='".$param["code_investment"]."'";
			$this->db->update('investment', $param, $where );
			
			
			
			//$query = $this->db->query("UPDATE kas SET ".
		//	"status='1', ".
			//"submitted_date='".date('Y-m-d h:i:s')."' ".
		//	"WHERE user_id='".$data["investor_id"]."' AND investment_id='".$data["investment_id"]."' ");
		
			$data['title']="Verifikasi Pendanaan";
			$this->load->view('view_header', $data);
			$this->load->view('wait_verification_invesment');
			$this->load->view('view_footer');
			
				
		
	}
	public function menunggu_konfirmasi_pembayaran($id=NULL)
	{ 
		//$code=$this->input->post('code',true);
	
		
		$data = array(
					'status' => 1		
			);
		
		$where ="code_investment ='".$this->input->post('code',true)."'";
		$this->db->update('investment', $data, $where );
		
			$data['code']=$this->input->post('code',true);
		$data['title']="Verifikasi Pendanaan";
		
		$this->load->library('send_mail');
        $this->send_mail->pengajuan_penambahan_saldo($this->input->post('code',true));
		
		$this->load->view('view_header', $data);
		$this->load->view('wait_confimation_invesment',$data);
		$this->load->view('view_footer');
	}
	public function submit_pendanaan($id=NULL)
	{ 
	$data['title']="Verifikasi Pendanaan";
		$this->load->view('view_header', $data);
				$this->load->view('wait_verification_invesment');
				$this->load->view('view_footer');
	}
	
	public function saldo()
    {
		$data['title']="Tambah Saldo";
		$this->load->model("model_investment");
		$this->load->model("model_bid");
		$this->load->model("model_backend");
		$this->load->model("model_tanggal");
		$this->load->model("model_kas");
		
		$data["kas"] = $this->model_kas->get(get_cookie("user_id"));
		$data["saldo"] = $this->model_kas->get_saldo(get_cookie("user_id"));
		
		$this->load->view('view_header', $data);
				$this->load->view('view_saldo');
				$this->load->view('view_footer');
	}
	public function konfirmasi_saldo()
    {
		$data['title']="Tambah Saldo";
		$this->load->model("model_investment");
		$this->load->model("model_bid");
		$this->load->model("model_backend");
		$this->load->model("model_tanggal");
		$this->load->model("model_kas");
		
		$data["kas"] = $this->model_kas->get(get_cookie("user_id"),1);
		$data["saldo"] = $this->model_kas->get_saldo(get_cookie("user_id"));
		
		$this->load->view('view_header', $data);
				$this->load->view('view_saldo');
				$this->load->view('view_footer');
	}
	
	
}