<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	if(get_cookie("r_admin_email") != Null && get_cookie("r_admin_password") != Null)
        {
            $this->load->model("model_sys_user");
            $return_sys_user = $this->model_sys_user->login(get_cookie("r_admin_email"), get_cookie("r_admin_password"));
            
            if ($return_sys_user != false)
            {
                $this->load->library("set_cookies");
                $this->set_cookies->setAdminUserID($return_sys_user->sys_user_id);
                $this->set_cookies->setAdminEmail($return_sys_user->email);
                $this->set_cookies->setAdminFullName($return_sys_user->full_name);
                $this->set_cookies->setAdminGroupName($return_sys_user->group_name);

                redirect("admin/home");
            }
            else
            {
                /*If not able to login, maybe the acocunt has been suspended, or etc. So need to clear the 
                  Remember Me cookies.
                */
                $this->session->sess_destroy();
                delete_cookie("admin_userid");
                delete_cookie("admin_email");
                delete_cookie("admin_fullname");
                delete_cookie("r_admin_email");
                delete_cookie("r_admin_password");

                $this->load->view("admin/view_login");
            }
        }
        else
        {
            $this->load->view("admin/view_login");
        }
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

    public function signin()
    {
    	//$this->load->library("form_validation");

		$this->form_validation->set_rules("txtEmail", "Email", "trim|required|max_length[255]|valid_email");
		$this->form_validation->set_rules("txtPassword", "Password", "trim|required");

        if ($this->form_validation->run() == False)
        {
            $this->load->view("admin/view_login");
        }
        else
        {
            $this->load->model("model_sys_user");
            $return_sys_user = $this->model_sys_user->login($this->input->post("txtEmail"), $this->input->post("txtPassword"));

            if ($return_sys_user != false)
            {
                $this->log(0, "Sign In", $return_sys_user->sys_user_id, $return_sys_user->email);
                
                $this->load->library("set_cookies");
                $this->set_cookies->setAdminUserID($return_sys_user->sys_user_id);
                $this->set_cookies->setAdminEmail($return_sys_user->email);
                $this->set_cookies->setAdminFullName($return_sys_user->full_name);
                $this->set_cookies->setAdminGroupName($return_sys_user->group_name);

                if ($this->input->post("chkRememberMe") == "1")
                {
                    $this->set_cookies->setAdminREmail($return_sys_user->email);
                    $this->set_cookies->setAdminRPassword($this->input->post("txtPassword"));
                }

                redirect("admin/home");
            }
            else
            {
                $this->log(0, "Sign In (Fail)", 0, $this->input->post("txtEmail"));

                $data["pMessage"] = "Email not exist, or invalid password";
                $this->load->view("admin/view_login", $data);
            }
            
        }
    }

    public function home()
    {
        $this->load->model("model_loan");
        $loan_count = $this->model_loan->get_count(2);

        $this->load->model("model_investment");
        $investment_count = $this->model_investment->get_count(2);

        $this->load->model("model_statistic");
        $row = $this->model_statistic->get();

        $data["loan_count"] = $loan_count;
        $data["investment_count"] = $investment_count;
        $data["total_loan"] = $row->total_loan;
        $data["total_investment"] = $row->total_investment;
        $data["total_investment_used"] = $row->total_investment_used;
        $data["pDashboard"] = "active";
        $this->load->view("admin/view_header", $data);
        $this->load->view("admin/view_home");
        $this->load->view("admin/view_footer");
    }

    public function signout()
    {
        $this->session->sess_destroy();
        delete_cookie('admin_userid');
        delete_cookie('admin_email');
        delete_cookie('admin_fullname');
        delete_cookie('admin_groupname');
        delete_cookie('r_admin_email');
        delete_cookie('r_admin_password');
        
        redirect('admin');
    }

    /********************************************************************************
                                    USER GROUP
    *********************************************************************************/

    public function user_group($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->model("model_sys_user_group");
                $param["status"] = -1;
                $data["usergrouplist"] = $this->model_sys_user_group->listing($param);
                $data["pAdministration"] = "active";

                
                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_user_group');
                $this->load->view('admin/view_footer');
                
                break;
            }
            case "add":
            {
                $param["sys_user_group_id"] = $this->input->post("h_sys_group_id");
                $param["group_name"] = $this->input->post("h_group_name");
                $param["loan_request_notification"] = $this->input->post("h_loan_request_notification");
                $param["investment_notification"] = $this->input->post("h_investment_notification");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_sys_user_group");
                if ($this->input->post("h_sys_group_id") == "0")
                {
                    $return = $this->model_sys_user_group->add($param);   
                    $this->log(1002, "Add", $return["sys_user_group_id"], $this->input->post("h_group_name"));

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("admin/user_group"); 
                }
                else
                {
                    $this->model_sys_user_group->update($param);   
                    $this->log(1002, "Update", $this->input->post("h_sys_group_id"), $this->input->post("h_group_name"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("admin/user_group"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_sys_user_group");
                $this->model_sys_user_group->delete($this->input->post("h_sys_group_id"));
                $this->log(1002, "Delete", $this->input->post("h_sys_group_id"), $this->input->post("h_group_name"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("admin/user_group"); 
                break;
            }
            case "check":
            {
                $param["sys_user_group_id"] = $this->input->post('sys_user_group_id');
                $param["group_name"] = $this->input->post('group_name');

                $this->load->model('model_sys_user_group');
                $is_exist = $this->model_sys_user_group->check($param);

                $data = array(
                    'is_exist' => $is_exist
                );
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_sys_user_group');
                $row = $this->model_sys_user_group->get($this->input->post('sys_user_group_id'));

                $data = array(
                    'group_name' => $row->group_name,
                    'loan_request_notification' => $row->loan_request_notification,
                    'investment_notification' => $row->investment_notification,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }


    /********************************************************************************
                                    USER PROFILE
    *********************************************************************************/

    public function user_profile($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $param["status"] = -1;
                $this->load->model("model_sys_user");
                $data["userlist"] = $this->model_sys_user->listing($param);

                $this->load->model("model_sys_user_group");
                $param["status"] = 1;
                $data["usergrouplist"] = $this->model_sys_user_group->listing($param);

                $data["pAdministration"] = "active";

                $this->load->view('admin/view_header', $data);
                $this->load->view('admin/view_user');
                $this->load->view('admin/view_footer');
                break;
            }
            case "add":
            {
                $param["sys_user_id"] = $this->input->post("h_sys_user_id");
                $param["email"] = $this->input->post("h_email");
                $param["password"] = "abcd1234";
                $param["full_name"] = $this->input->post("h_full_name");
                $param["sys_user_group_id"] = $this->input->post("h_sys_user_group_id");
                $param["status"] = $this->input->post("rdb_status");
                
                $this->load->model("model_sys_user");
                if ($this->input->post("h_sys_user_id") == "0")
                {
                    $return = $this->model_sys_user->add($param); 
                    $this->log(1001, "Add", $return["sys_user_id"], $this->input->post("h_full_name"));

                    $this->load->library('send_mail');
                    $this->send_mail->new_admin_to_user($return["sys_user_id"]);

                    $this->session->set_flashdata('pMessage', "The record has been added successfully");
                    redirect("admin/user_profile"); 
                }
                else
                {
                    $this->model_sys_user->update($param);   
                    $this->log(1001, "Update", $return["sys_user_id"], $this->input->post("h_full_name"));

                    $this->session->set_flashdata('pMessage', "The record has been updated successfully");
                    redirect("admin/user_profile"); 
                }
                break;
            }
            case "delete":
            {
                $this->load->model("model_sys_user");
                $this->model_sys_user->delete($this->input->post("h_sys_user_id"));
                $this->log(1001, "Delete", $this->input->post("h_sys_user_id"), $this->input->post("h_full_name"));

                $this->session->set_flashdata('pMessage', "The record has been deleted successfully");
                redirect("admin/user_profile"); 
                break;
            }
            case "check":
            {
                $param["sys_user_id"] = $this->input->post('sys_user_id');
                $param["email"] = $this->input->post('email');

                $this->load->model('model_sys_user');
                $is_exist = $this->model_sys_user->check($param);

                if ($this->input->post('is_myprofile') == 1)
                {
                    //Checking, plus if it is from MyProfile, then update directly
                    if ($is_exist == false)
                    {
                        $param2["email"] = $this->input->post('email');
                        $param2["full_name"] = $this->input->post('full_name');
                        $this->model_sys_user->update_profile($param2);

                        $this->log(1004, "Update", get_cookie("admin_userid"), $this->input->post('full_name'));

                        $this->load->library("set_cookies");
                        $this->set_cookies->setAdminEmail($this->input->post('email'));
                        $this->set_cookies->setAdminFullName($this->input->post('full_name'));
                    }
                }

                $data = array(
                    'is_exist' => $is_exist
                );    
                
                echo json_encode($data);
                break;
            }
            case "get":
            {
                $this->load->model('model_sys_user');
                $row = $this->model_sys_user->get($this->input->post('sys_user_id'));

                $data = array(
                    'email' => $row->email,
                    'full_name' => $row->full_name,
                    'sys_user_group_id' => $row->sys_user_group_id,
                    'status' => $row->status
                );
                echo json_encode($data);
                break;
            }
        }
    }

    public function update_password()
    {
        //call from My Password
        $param["sys_user_id"] = $this->input->post('sys_user_id');
        $param["password"] = $this->input->post('password');

        $this->load->model('model_sys_user');
        $this->model_sys_user->update_password($param);

        $this->log(1005, "Update", get_cookie("admin_userid"), get_cookie("admin_fullname"));

        $data = array(
            'return' => true
        );    
        
        echo json_encode($data);

    }

    public function activation($pDynamicCode)
    {
        $this->load->model('model_sys_user');
        $row = $this->model_sys_user->get_by_code($pDynamicCode);

        if ($row == false)
        {
            $this->load->view("admin/view_login");
        }
        else
        {
            $data["email"] = $row->email;
            $data["dynamic_code"] = $pDynamicCode;
            $this->load->view("admin/view_user_password", $data);
        }
    }

    public function reset_password($pParam=null)
    {
        if ($pParam == null)
        {
            //$this->load->library("form_validation");

            $this->form_validation->set_rules("txtPassword", "Password", "trim|required");
            $this->form_validation->set_rules('txtConfirmPassword', 'Confirm Password', 'trim|required|matches[txtPassword]');

            if ($this->form_validation->run() == False)
            {
                $data["email"] = $this->input->post("h_email");
                $data["dynamic_code"] = $this->input->post("h_dynamic_code");
                $this->load->view("admin/view_user_password", $data);
            }
            else
            {
                //here no cookies yet
                $this->load->model("model_sys_user");
                $data["dynamic_code"] = $this->input->post("h_dynamic_code");
                $row = $this->model_sys_user->get_by_code($data["dynamic_code"]);

                if ($row == false)
                {
                    $this->load->view("admin/view_login");
                }
                else
                {
                    $param["sys_user_id"] = $row->sys_user_id;
                    $param["password"] = $this->input->post("txtPassword");
                    $this->model_sys_user->update_password($param);

                    $this->log(0, "Reset Password", $row->sys_user_id, $row->full_name);

                    redirect("admin/password_set");
                }
            } 
        }
        else
        {
            $this->load->model("model_sys_user");
            $row = $this->model_sys_user->get_by_code($pParam);

            if ($row == false)
            {
                $this->load->view("admin/view_login");
            }
            else
            {
                $data["email"] = $row->email;
                $data["dynamic_code"] = $pParam;
                $this->load->view("admin/view_user_password", $data);
            }
        }
    }

    public function forgot_password($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->view("admin/view_user_forgot_password");
                break;
            }
            case "request":
            {
                //$this->load->library("form_validation");
                $this->form_validation->set_rules("txtEmail", "Email", "trim|required|max_length[255]|valid_email|callback_validate_email");

                if ($this->form_validation->run() == False)
                {
                    $this->load->view("admin/view_user_forgot_password");
                }
                else
                {
                    $param["email"] = $this->input->post("txtEmail");
                    $this->load->model("model_sys_user");
                    $this->model_sys_user->update_dynamic_code($param);

                    $this->load->library('send_mail');
                    $this->send_mail->request_password_to_user($this->input->post("txtEmail"));


                    $data["email"] = $this->input->post("txtEmail");
                    $this->load->view("admin/view_user_password_sent", $data);
                }
            }
        }
    }

    function validate_email($pEmail)
    {
        $this->load->model("model_sys_user");
        $row = $this->model_sys_user->get_by_email($pEmail);

        if ($row == false){
            return false;
        }
        else{
            return true;
        }
    }

    public function password_set()
    {
        $this->load->view("admin/view_user_password_set");
    }

    /********************************************************************************
                                    ACTIVITY LOG
    *********************************************************************************/

    public function activity_log()
    {
        $this->load->model("model_activity_log");
        $param["user_id"] = 0;
        $data["activityloglist"] = $this->model_activity_log->listing($param);
        $data["pAdministration"] = "active";
        $data["option_menu"] = $this->generate_menu_option(0);
        $data["option_user"] = $this->generate_user_option();

        $this->load->view('admin/view_header', $data);
        $this->load->view("admin/view_activity_log");
        $this->load->view('admin/view_footer');
    }

    function generate_menu_option($parent_id)
    {
        $return = '<option value="">All</option>';
        $param["parent_id"] = $parent_id;
        $this->load->model("model_menu");
        $row = $this->model_menu->listing($param);

        for ($i = 0; $i < count($row); ++$i)
        {
            if ($row[$i]->menu_id == 0)
            {
                //System
                $return = $return.'<option value="'.$row[$i]->menu_id.'">'.$row[$i]->menu_name.'</option>';
            }
            else
            {
                //Parent Menu
                $return = $return.'<optgroup label="'.$row[$i]->menu_name.'">';
                $param_detail["parent_id"] = $row[$i]->menu_id;
                $row_detail = $this->model_menu->listing($param_detail);
                for ($j = 0; $j < count($row_detail); ++$j)
                {
                    $return = $return.'<option value="'.$row_detail[$j]->menu_id.'">'.$row_detail[$j]->menu_name.'</option>';
                }
                $return = $return.'</optgroup>';
            }
            
            
        }
        return $return;
    }

    function generate_user_option()
    {
        $return = '<option value="">All</option>';
        $param["status"] = 1;
        $this->load->model("model_sys_user");
        $row = $this->model_sys_user->listing($param);

        for ($i = 0; $i < count($row); ++$i)
        {
            $return = $return.'<option value="'.$row[$i]->sys_user_id.'">'.$row[$i]->full_name.'</option>';
        }
        return $return;
    }

    /********************************************************************************
                                    FILTER
    *********************************************************************************/

    public function filter($pParam=null)
    {
        switch ($pParam)
        {
            case "add":
            {
                $param["menu_id"] = $this->input->post('menu_id');
                $param["value1"] = $this->input->post('value1');
                $param["value2"] = $this->input->post('value2');
                $param["value3"] = $this->input->post('value3');
                $param["value4"] = $this->input->post('value4');
                $param["value5"] = $this->input->post('value5');
                $param["value6"] = $this->input->post('value6');
                $param["value7"] = $this->input->post('value7');
                $param["value8"] = $this->input->post('value8');
                $param["value9"] = $this->input->post('value9');
                $param["value10"] = $this->input->post('value10');

                $this->load->model('model_filter');
                $this->model_filter->add($param);

                /*
                $data = array(
                    'row_count' => $row_count
                );
                echo json_encode($data);
                */

                break;
            }   
            case "get":
            {
                $this->load->model('model_filter');
                $row = $this->model_filter->get($this->input->post('menu_id'));

                if ($row != false)
                {
                    $data = array(
                        'value1' => $row->value1,
                        'value2' => $row->value2,
                        'value3' => $row->value3,
                        'value4' => $row->value4,
                        'value5' => $row->value5,
                        'value6' => $row->value6,
                        'value7' => $row->value7,
                        'value8' => $row->value8,
                        'value9' => $row->value9,
                        'value10' => $row->value10
                    );
                }
                else
                {
                    $data = array(
                        'value1' => '',
                        'value2' => '',
                        'value3' => '',
                        'value4' => '',
                        'value5' => '',
                        'value6' => '',
                        'value7' => '',
                        'value8' => '',
                        'value9' => '',
                        'value10' => ''
                    );
                }
                
                echo json_encode($data);
                break;

                break;
            }   
        }
        
    }


}