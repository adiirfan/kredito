<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Configuration extends CI_Controller {

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
                                    SALUTATION
    *********************************************************************************/
    public function salutation($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->model("model_salutation");
                $param["status"] = -1;
                $data["salutationlist"] = $this->model_salutation->listing($param);
                $data["pConfiguration"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_salutation');
                $this->load->view('admin/view_footer');
                break;
            }
            case "add":
            {
                $param["salutation_id"] = $this->input->post("h_salutation_id");
                $param["salutation_name"] = $this->input->post("h_salutation_name");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_salutation");
                if ($this->input->post("h_salutation_id") == "0")
                {
                    $return = $this->model_salutation->add($param);   
                    $this->log(2001, "Add", $return["salutation_id"], $this->input->post("h_salutation_name"));

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("configuration/salutation"); 
                }
                else
                {
                    $this->model_salutation->update($param);   
                    $this->log(2001, "Update", $this->input->post("h_salutation_id"), $this->input->post("h_salutation_name"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("configuration/salutation"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_salutation");
                $this->model_salutation->delete($this->input->post("h_salutation_id"));
                $this->log(2001, "Delete", $this->input->post("h_salutation_id"), $this->input->post("h_salutation_name"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("configuration/salutation"); 
                break;
            }
            case "check":
            {
                $param["salutation_id"] = $this->input->post('salutation_id');
                $param["salutation_name"] = $this->input->post('salutation_name');

                $this->load->model('model_salutation');
                $is_exist = $this->model_salutation->check($param);

                $data = array(
                    'is_exist' => $is_exist
                );
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_salutation');
                $row = $this->model_salutation->get($this->input->post('salutation_id'));

                $data = array(
                    'salutation_name' => $row->salutation_name,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }

    /********************************************************************************
                                    LOAN PURPOSE
    *********************************************************************************/
    public function loan_purpose($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->model("model_loan_purpose");
                $param["status"] = -1;
                $data["loan_purposelist"] = $this->model_loan_purpose->listing($param);
                $data["pConfiguration"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_loan_purpose');
                $this->load->view('admin/view_footer');
                break;
            }
            case "add":
            {
                $param["loan_purpose_id"] = $this->input->post("h_loan_purpose_id");
                $param["loan_purpose_name"] = $this->input->post("h_loan_purpose_name");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_loan_purpose");
                if ($this->input->post("h_loan_purpose_id") == "0")
                {
                    $return = $this->model_loan_purpose->add($param);   
                    $this->log(2002, "Add", $return["loan_purpose_id"], $this->input->post("h_loan_purpose_name"));

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("configuration/loan_purpose"); 
                }
                else
                {
                    $this->model_loan_purpose->update($param);   
                    $this->log(2002, "Update", $this->input->post("h_loan_purpose_id"), $this->input->post("h_loan_purpose_name"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("configuration/loan_purpose"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_loan_purpose");
                $this->model_loan_purpose->delete($this->input->post("h_loan_purpose_id"));
                $this->log(2002, "Delete", $this->input->post("h_loan_purpose_id"), $this->input->post("h_loan_purpose_name"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("configuration/loan_purpose"); 
                break;
            }
            case "check":
            {
                $param["loan_purpose_id"] = $this->input->post('loan_purpose_id');
                $param["loan_purpose_name"] = $this->input->post('loan_purpose_name');

                $this->load->model('model_loan_purpose');
                $is_exist = $this->model_loan_purpose->check($param);

                $data = array(
                    'is_exist' => $is_exist
                );
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_loan_purpose');
                $row = $this->model_loan_purpose->get($this->input->post('loan_purpose_id'));

                $data = array(
                    'loan_purpose_name' => $row->loan_purpose_name,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }


    /********************************************************************************
                                    PAID UP CAPITAL
    *********************************************************************************/
    public function paid_up_capital($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->model("model_paid_up_capital");
                $param["status"] = -1;
                $data["paid_up_capitallist"] = $this->model_paid_up_capital->listing($param);
                $data["pConfiguration"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_paid_up_capital');
                $this->load->view('admin/view_footer');
                break;
            }
            case "add":
            {
                $param["paid_up_capital_id"] = $this->input->post("h_paid_up_capital_id");
                $param["from"] = $this->input->post("h_from");
                $param["to"] = $this->input->post("h_to");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_paid_up_capital");
                if ($this->input->post("h_paid_up_capital_id") == "0")
                {
                    $return = $this->model_paid_up_capital->add($param);   
                    $this->log(2003, "Add", $return["paid_up_capital_id"], $this->input->post("h_From")."-".$this->input->post("h_To"));

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("configuration/paid_up_capital"); 
                }
                else
                {
                    $this->model_paid_up_capital->update($param);   
                    $this->log(2003, "Update", $this->input->post("h_paid_up_capital_id"), $this->input->post("h_From")."-".$this->input->post("h_To"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("configuration/paid_up_capital"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_paid_up_capital");
                $this->model_paid_up_capital->delete($this->input->post("h_paid_up_capital_id"));
                $this->log(2003, "Delete", $this->input->post("h_paid_up_capital_id"), $this->input->post("h_From")."-".$this->input->post("h_To"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("configuration/paid_up_capital"); 
                break;
            }
            case "check":
            {
                $param["paid_up_capital_id"] = $this->input->post('paid_up_capital_id');
                $param["from"] = $this->input->post('from');
                $param["to"] = $this->input->post('to');

                $this->load->model('model_paid_up_capital');
                $is_exist = $this->model_paid_up_capital->check($param);

                $data = array(
                    'is_exist' => $is_exist
                );
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_paid_up_capital');
                $row = $this->model_paid_up_capital->get($this->input->post('paid_up_capital_id'));

                $data = array(
                    'from' => $row->from,
                    'to' => $row->to,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }


    /********************************************************************************
                                    MAN POWER
    *********************************************************************************/
    public function man_power($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->model("model_man_power");
                $param["status"] = -1;
                $data["man_powerlist"] = $this->model_man_power->listing($param);
                $data["pConfiguration"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_man_power');
                $this->load->view('admin/view_footer');
                break;
            }
            case "add":
            {
                $param["man_power_id"] = $this->input->post("h_man_power_id");
                $param["from"] = $this->input->post("h_from");
                $param["to"] = $this->input->post("h_to");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_man_power");
                if ($this->input->post("h_man_power_id") == "0")
                {
                    $return = $this->model_man_power->add($param);   
                    $this->log(2004, "Add", $return["man_power_id"], $this->input->post("h_From")."-".$this->input->post("h_To"));

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("configuration/man_power"); 
                }
                else
                {
                    $this->model_man_power->update($param);   
                    $this->log(2004, "Update", $this->input->post("h_man_power_id"), $this->input->post("h_From")."-".$this->input->post("h_To"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("configuration/man_power"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_man_power");
                $this->model_man_power->delete($this->input->post("h_man_power_id"));
                $this->log(2004, "Delete", $this->input->post("h_man_power_id"), $this->input->post("h_From")."-".$this->input->post("h_To"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("configuration/man_power"); 
                break;
            }
            case "check":
            {
                $param["man_power_id"] = $this->input->post('man_power_id');
                $param["from"] = $this->input->post('from');
                $param["to"] = $this->input->post('to');

                $this->load->model('model_man_power');
                $is_exist = $this->model_man_power->check($param);

                $data = array(
                    'is_exist' => $is_exist
                );
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_man_power');
                $row = $this->model_man_power->get($this->input->post('man_power_id'));

                $data = array(
                    'from' => $row->from,
                    'to' => $row->to,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }

    /********************************************************************************
                                    REVENUE
    *********************************************************************************/
    public function revenue($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->model("model_revenue");
                $param["status"] = -1;
                $data["revenuelist"] = $this->model_revenue->listing($param);
                $data["pConfiguration"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_revenue');
                $this->load->view('admin/view_footer');
                break;
            }
            case "add":
            {
                $param["revenue_id"] = $this->input->post("h_revenue_id");
                $param["from"] = $this->input->post("h_from");
                $param["to"] = $this->input->post("h_to");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_revenue");
                if ($this->input->post("h_revenue_id") == "0")
                {
                    $return = $this->model_revenue->add($param);   
                    $this->log(2005, "Add", $return["revenue_id"], $this->input->post("h_From")."-".$this->input->post("h_To"));

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("configuration/revenue"); 
                }
                else
                {
                    $this->model_revenue->update($param);   
                    $this->log(2005, "Update", $this->input->post("h_revenue_id"), $this->input->post("h_From")."-".$this->input->post("h_To"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("configuration/revenue"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_revenue");
                $this->model_revenue->delete($this->input->post("h_revenue_id"));
                $this->log(2005, "Delete", $this->input->post("h_revenue_id"), $this->input->post("h_From")."-".$this->input->post("h_To"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("configuration/revenue"); 
                break;
            }
            case "check":
            {
                $param["revenue_id"] = $this->input->post('revenue_id');
                $param["from"] = $this->input->post('from');
                $param["to"] = $this->input->post('to');

                $this->load->model('model_revenue');
                $is_exist = $this->model_revenue->check($param);

                $data = array(
                    'is_exist' => $is_exist
                );
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_revenue');
                $row = $this->model_revenue->get($this->input->post('revenue_id'));

                $data = array(
                    'from' => $row->from,
                    'to' => $row->to,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }

}