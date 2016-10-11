<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Workspace extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	//
    }

    function log($menu_id, $action, $action_id, $action_name)
    {
        $param["menu_id"] = $menu_id;
        $param["action"] = $action;
        $param["action_id"] = $action_id;
        $param["action_name"] = $action_name;
        $this->load->model("model_activity_log");
        $this->model_activity_log->add($param);
    }

    /********************************************************************************
                                    LOAN
    *********************************************************************************/
    public function loan($pParam=null, $pParam2=null)
    {
    	switch ($pParam)
    	{
    		case null:
    		{
    			break;
    		}
    		case "new":
    		{
    			$this->load->model("model_loan");
                $param["status"] = 2;
                $data["loan_list"] = $this->model_loan->listing($param);
    			$data["pLoan"] = "active";

    			$this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_new');
                $this->load->view('admin/view_footer');
                
                break;
    		}
            case "processing":
            {
                $this->load->model("model_loan");
                $param["status"] = 3;
                $data["loan_list"] = $this->model_loan->listing($param);
                $data["pLoan"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_processing');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "success":
            {
                $this->load->model("model_loan");
                $param["status"] = 4;
                $data["loan_list"] = $this->model_loan->listing($param);
                $data["pLoan"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_success');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "rejected":
            {
                $this->load->model("model_loan");
                $param["status"] = 5;
                $data["loan_list"] = $this->model_loan->listing($param);
                $data["pLoan"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_rejected');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "cancelled":
            {
                $this->load->model("model_loan");
                $param["status"] = 6;
                $data["loan_list"] = $this->model_loan->listing($param);
                $data["pLoan"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_cancelled');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "detail":
            {
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

                $this->load->model("model_loan_status");
                $param["loan_id"] = $row->loan_id;
                $data["loan_status_list"] = $this->model_loan_status->listing($param);

                $status_name = "";
                switch ($row->status)
                {
                    case "2": { $status_name = "Newly Submitted"; break; }
                    case "3": { $status_name = "Processing"; break; }
                    case "4": { $status_name = "Success"; break; }
                    case "5": { $status_name = "Rejected"; break; }
                    case "6": { $status_name = "Cancelled"; break; }
                }

                $investment_code = "";
                if ($row->investment_id != 0)
                {
                    $this->load->model('model_investment');
                    $row_investment = $this->model_investment->get($row->investment_id);
                    $investment_code = $row_investment->code;
                }

                $data["pLoan"] = "active";
                $data["row"] = $row;
                $data["salutation_name"] = $row_salutation->salutation_name;
                $data["loan_purpose"] = $loan_purpose;
                $data["investment_code"] = $investment_code;
                $data["status_name"] = $status_name;

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_detail');
                $this->load->view('admin/view_footer');

                break;
            }
            case "get":
            {
                $this->load->model('model_loan');
                $row = $this->model_loan->get($this->input->post('loan_id'));

                $data = array(
                    'code' => $row->code,
                    'b_full_name' => $row->b_full_name,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
            case "matching":
            {
                $this->load->model('model_loan');
                $row = $this->model_loan->get_by_code($pParam2);  

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

                $param["amount"] = $row->amount;
                $param["period"] = $row->period;
                $param["b_company_paid_up_capital"] = $row->b_company_paid_up_capital;
                $param["b_company_man_power"] = $row->b_company_man_power;
                $param["b_company_revenue"] = $row->b_company_revenue;
                
                if ($row->investment_id == 0)
                {
                    $this->load->model("model_investment");
                    $data["investment_list"] = $this->model_investment->listing_fully_match($param);

                    $investment_id_str = "";
                    for ($i = 0; $i < count($data["investment_list"]); ++$i)
                    {
                        //exclude those fully matched
                        $investment_id_str = $investment_id_str.$data["investment_list"][$i]->investment_id.",";
                    }
                    if ($investment_id_str != "")
                    {
                        $investment_id_str = substr($investment_id_str, 0, strlen($investment_id_str) - 1);
                    }
                    else
                    {
                        $investment_id_str = "0";
                    }
                    $param["exclude_id_str"] = $investment_id_str;
                    $data["investment_list2"] = $this->model_investment->listing_partially_match($param);
                }
                else
                {
                    $this->load->model("model_investment");
                    $row_investment = $this->model_investment->get($row->investment_id);
                    $data["row_investment"] = $row_investment;
                }

                $data["row"] = $row;
                $data["loan_purpose"] = $loan_purpose;
                $data["pLoan"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_match');
                $this->load->view('admin/view_footer');

                break;
            }
            case "match":
            {
                $investment_id = 0;
                if ($this->input->post("h_investment_id") == "0")
                {
                    //Remove Match
                    $this->load->model('model_loan');
                    $row = $this->model_loan->get($this->input->post("h_loan_id"));
                    $investment_id = $row->investment_id;

                    $param["loan_id"] = $this->input->post("h_loan_id");
                    $param["investment_id"] = "0";
                    $this->model_loan->update_investment($param);      
                }
                else
                {
                    //Match
                    $investment_id = $this->input->post("h_investment_id");

                    $param["loan_id"] = $this->input->post("h_loan_id");
                    $param["investment_id"] = $this->input->post("h_investment_id");
                    $this->load->model('model_loan');
                    $this->model_loan->update_investment($param);      
                }
                
                $param2["investment_id"] = $investment_id;
                $this->load->model('model_investment');
                $this->model_investment->update_fund_used($param2);      

                redirect("workspace/loan/matching/".$this->input->post("h_loan_code"));

                break;
            }
            case "status":
            {
                $param2["loan_id"] = $this->input->post("h_loan_id");
                $param2["status"] = $this->input->post("h_status");
                $this->load->model("model_loan");
                $this->model_loan->update_status_by_admin($param2);  

                $param["loan_id"] = $this->input->post("h_loan_id");
                $param["status"] = $this->input->post("h_status");
                $param["remarks"] = $this->input->post("h_remarks");
                $param["user_id"] = get_cookie("admin_userid");
                $this->load->model("model_loan_status");
                $return = $this->model_loan_status->add($param); 

                $row = $this->model_loan->get($this->input->post('h_loan_id'));
                $param3["user_id"] = $row->borrower_id;
                $this->load->model("model_user");
                $this->model_user->update_total_fund_borrower($param3);  

                $this->load->model("model_statistic");
                $this->model_statistic->update(); 

                $this->log($this->input->post("h_menu_id"), "Update", $return["loan_status_id"], $this->input->post("h_code"));

                $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                redirect("workspace/loan/".$this->input->post("h_menu_name")); 

                break;
            }
    	}
    }
    
    /********************************************************************************
                                    INVESTMENT
    *********************************************************************************/
    public function investment($pParam=null, $pParam2=null)
    {
    	switch ($pParam)
    	{
    		case null:
    		{
    			break;
    		}
    		case "new":
    		{
    			$this->load->model("model_investment");
                $param["status"] = 2;
                $data["investment_list"] = $this->model_investment->listing($param);
    			$data["pInvestment"] = "active";

    			$this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_new');
                $this->load->view('admin/view_footer');
                
                break;
    		}
    		case "processing":
    		{
    			$this->load->model("model_investment");
                $param["status"] = 3;
                $data["investment_list"] = $this->model_investment->listing($param);
    			$data["pInvestment"] = "active";

    			$this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_processing');
                $this->load->view('admin/view_footer');
                
                break;
    		}
            case "success":
            {
                $this->load->model("model_investment");
                $param["status"] = 4;
                $data["investment_list"] = $this->model_investment->listing($param);
                $data["pInvestment"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_success');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "rejected":
            {
                $this->load->model("model_investment");
                $param["status"] = 5;
                $data["investment_list"] = $this->model_investment->listing($param);
                $data["pInvestment"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_rejected');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "cancelled":
            {
                $this->load->model("model_investment");
                $param["status"] = 6;
                $data["investment_list"] = $this->model_investment->listing($param);
                $data["pInvestment"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_cancelled');
                $this->load->view('admin/view_footer');
                
                break;
            }
    		case "detail":
    		{
    			$this->load->model('model_investment');
                $row = $this->model_investment->get_by_code($pParam2);  

                $this->load->model('model_salutation');
                $row_salutation = $this->model_salutation->get($row->i_salutation_id);  

                $this->load->model("model_investment_period");
                $param["investment_id"] = $row->investment_id;
                $row_investment_period = $this->model_investment_period->listing($param);
                $investment_period_list = "";
                for ($i = 0; $i < count($row_investment_period); ++$i)
                {
                	$investment_period_list = $investment_period_list.$row_investment_period[$i]->period.', ';
                }
                if ($investment_period_list != "")
                {
                	$investment_period_list = substr($investment_period_list, 0, strlen($investment_period_list) - 2);
                }

                $this->load->model("model_investment_status");
                $param["investment_id"] = $row->investment_id;
                $data["investment_status_list"] = $this->model_investment_status->listing($param);

                $status_name = "";
                switch ($row->status)
                {
                    case "2": { $status_name = "Newly Submitted"; break; }
                    case "3": { $status_name = "Processing"; break; }
                    case "4": { $status_name = "Success"; break; }
                    case "5": { $status_name = "Rejected"; break; }
                    case "6": { $status_name = "Cancelled"; break; }
                }

    			$data["pInvestment"] = "active";
    			$data["row"] = $row;
    			$data["salutation_name"] = $row_salutation->salutation_name;
    			$data["investment_period_list"] = $investment_period_list;
                $data["status_name"] = $status_name;

    			$this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_detail');
                $this->load->view('admin/view_footer');

    			break;
    		}
    		case "get":
            {
                $this->load->model('model_investment');
                $row = $this->model_investment->get($this->input->post('investment_id'));

                $data = array(
                    'code' => $row->code,
                    'i_full_name' => $row->i_full_name,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
            case "list":
            {
                $this->load->model("model_user");
                $row = $this->model_user->get($pParam2);

                $this->load->model("model_investment");
                $param["status"] = -1;
                $param["user_id"] = $pParam2;
                $data["investment_list"] = $this->model_investment->listing($param);
                $data["pInvestment"] = "active";  
                $data["full_name"] = $row->full_name;

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_investment_list');
                $this->load->view('admin/view_footer');
                break;
            }
            case "status":
            {
            	$param2["investment_id"] = $this->input->post("h_investment_id");
            	$param2["status"] = $this->input->post("h_status");
            	$this->load->model("model_investment");
                $this->model_investment->update_status_by_admin($param2);  

            	$param["investment_id"] = $this->input->post("h_investment_id");
                $param["status"] = $this->input->post("h_status");
                $param["remarks"] = $this->input->post("h_remarks");
                $param["user_id"] = get_cookie("admin_userid");
                $this->load->model("model_investment_status");
                $return = $this->model_investment_status->add($param); 

                $row = $this->model_investment->get($this->input->post('h_investment_id'));
                $param3["user_id"] = $row->investor_id;
                $this->load->model("model_user");
                $this->model_user->update_total_fund_investor($param3);  

                $this->load->model("model_statistic");
                $this->model_statistic->update();  


                $this->log($this->input->post("h_menu_id"), "Update", $return["investment_status_id"], $this->input->post("h_code"));

                $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                redirect("workspace/investment/".$this->input->post("h_menu_name")); 

            	break;
            }
    	}
    }

    /********************************************************************************
                                    INVESTOR / BORROWER
    *********************************************************************************/
    public function user($pParam=null, $pParam2=null)
    {
    	switch ($pParam)
    	{
    		case "borrower":
    		{
    			$this->load->model("model_user");
		    	$param["status"] = -1;
		    	$param["user_group"] = "b";
		    	$data["borrower_list"] = $this->model_user->listing($param);
		    	$data["pLoan"] = "active";

		    	$this->load->view('admin/view_header', $data);
				$this->load->view('admin/view_borrower');
				$this->load->view('admin/view_footer');

    			break;
    		}
    		case "investor":
    		{
    			$this->load->model("model_user");
		    	$param["status"] = -1;
		    	$param["user_group"] = "I";
		    	$data["investor_list"] = $this->model_user->listing($param);
		    	$data["pInvestment"] = "active";

		    	$this->load->view('admin/view_header', $data);
				$this->load->view('admin/view_investor');
				$this->load->view('admin/view_footer');

    			break;
    		}
    		case "delete":
    		{
    			$this->load->model("model_user");
                $this->model_user->delete($this->input->post("h_user_id"));
                $this->log(4006, "Delete", $this->input->post("h_user_id"), $this->input->post("h_full_name"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("workspace/user/".$pParam2); 
                
                break;
    		}
    		case "get":
    		{
    			$this->load->model('model_user');
                $row = $this->model_user->get($this->input->post('user_id'));

                $this->load->model('model_salutation');
                $row_salutation = $this->model_salutation->get($row->salutation_id);

                $data = array(
                	'salutation_name' => $row_salutation->salutation_name,
                    'full_name' => $row->full_name,
                    'mobile_phone' => $row->mobile_phone,
                    'email' => $row->email,
                    'address' => $row->address,
                    'investor_type' => $row->investor_type,
                    'company_name' => $row->company_name,
                    'company_registration' => $row->company_registration,
                    'company_man_power' => $row->company_man_power,
                    'status' => $row->status
                );
                echo json_encode($data);
    			break;
    		}
    		case "update":
    		{
    			$param["user_id"] = $this->input->post("h_user_id");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_user");
                $this->model_user->update_status($param);   
                $this->log(4006, "Update", $this->input->post("h_user_id"), $this->input->post("h_full_name"));

                $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                redirect("workspace/user/".$pParam2); 

                break;
    		}
    	}

    	

    }

}
