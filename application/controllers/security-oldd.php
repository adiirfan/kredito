<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class security extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	//
    }

    /********************************************************************************
                                    LOGIN
    *********************************************************************************/
    public function login($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                break;
            }
            case "check":
            {
                $this->load->model('model_user');
                $return_user = $this->model_user->login($this->input->post('email'), $this->input->post('password'));

                if ($return_user == false)
                {
                    $data = array(
                        'status' => false
                    );
                }
                else
                {
                    $data = array(
                        'status' => true
                    );
                
                    $this->load->library("set_cookies");
                    $this->set_cookies->setUserID($return_user->user_id);
                    $this->set_cookies->setEmail($return_user->email);
                    $this->set_cookies->setUserGroup($return_user->user_group);
                    $this->set_cookies->setFullName($return_user->full_name);
                    $this->set_cookies->setIType($return_user->investor_type);

                    if ($this->input->post('remember') == "1")
                    {
                        $this->set_cookies->setREmail($return_user->email);
                        $this->set_cookies->setRPassword($this->input->post("password"));
                    }

                } 
                echo json_encode($data);
                break;
            }
            case "success":
            {
                redirect("./");
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        delete_cookie('user_id');
        delete_cookie('email');
        delete_cookie('user_group');
        delete_cookie('full_name');
        delete_cookie('r_email');
        delete_cookie('r_password');
        //Borrower
        delete_cookie('loan_id');
        delete_cookie('b_amount');
        delete_cookie('b_month');
        //Investor
        delete_cookie('investment_id');
        delete_cookie('i_type');
        
        redirect("./");
    }

    /********************************************************************************
                                    REGISTRATION
    *********************************************************************************/
    public function register($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->view('view_header');
                $this->load->view('view_register');
                $this->load->view('view_footer');
                break;
            }
            case "add":
            {
                //$this->load->library('form_validation');

                $this->form_validation->set_rules('txt_full_name', 'Full Name', 'trim|required|max_length[255]');
                $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|max_length[255]|valid_email|callback_check_email_exists');

                if ($this->form_validation->run() == False)
                {
                    $this->load->view('view_header');
                    $this->load->view('view_register');
                    $this->load->view('view_footer');
                }
                else
                {
                    $param["email"] = $this->input->post("txt_email");
                    $param["password"] = "abcd1234";
                    $param["full_name"] = $this->input->post("txt_full_name");
                    $param["user_group"] = $this->input->post("h_user_group");
                    $param["salutation_id"] = "0";
                    $param["mobile_phone"] = "";
                    $param["company_name"] = "";
                    $param["company_registration"] = "";
                    $param["company_paid_up_capital"] = "0";
                    $param["company_man_power"] = "0";
                    $param["company_revenue"] = "0";
                    if ($this->input->post("h_user_group") == "B")
                        $param["investor_type"] = "";
                    else
                        $param["investor_type"] = "I";  //default Individual
                    $param["address"] = "";
                    $param["status"] = "0";

                    $this->load->model("model_user");
                    $return = $this->model_user->add($param); 

                    $this->load->library('send_mail');
                    $this->send_mail->new_registration_to_user($return["user_id"]);

                    $data["email"] = $this->input->post("txt_email");
                    $this->load->view('view_header');
                    $this->load->view('view_register_submit', $data);
                    $this->load->view('view_footer');
                }
                break;
            }
        }
    }

    function check_email_exists($pEmail)
    {
        $param["email"] = $pEmail;
        $param["user_id"] = "0";
        $this->load->model('model_user');
        $email_exists = $this->model_user->check($param);

        if ($email_exists){
            return false;
        }
        else{
            return true;
        }
    }
	function tes($pEmail)
    {
       echo "edu";
    }

    public function activation($pDynamicCode)
    {
        $this->load->model('model_user');
        $row = $this->model_user->get_by_code($pDynamicCode);

        if ($row == false)
        {
            redirect("./");
        }
        else
        {
            $data["full_name"] = $row->full_name;
            $data["dynamic_code"] = $pDynamicCode;
            $this->load->view('view_header');
            $this->load->view("view_activation", $data);
            $this->load->view('view_footer');
        }
    }

    public function reset_password($pParam=null)
    {
        if ($pParam == null)
        {
            //$this->load->library("form_validation");

            $this->form_validation->set_rules("txt_password", "Password", "trim|required");
            $this->form_validation->set_rules('txt_confirm_password', 'Confirm Password', 'trim|required|matches[txt_password]');

            if ($this->form_validation->run() == False)
            {
                $data["full_name"] = $this->input->post("h_full_name");
                $data["dynamic_code"] = $this->input->post("h_dynamic_code");
                $this->load->view('view_header');
                $this->load->view("view_activation", $data);
                $this->load->view('view_footer');
            }
            else
            {
                //here no cookies yet
                $this->load->model("model_user");
                $data["dynamic_code"] = $this->input->post("h_dynamic_code");
                $row = $this->model_user->get_by_code($data["dynamic_code"]);

                if ($row == false)
                {
                    redirect("./");
                }
                else
                {
                    $param["user_id"] = $row->user_id;
                    $this->model_user->activate($param);

                    $param["user_id"] = $row->user_id;
                    $param["password"] = $this->input->post("txt_password");
                    $this->model_user->update_password($param);

                    $this->load->library("set_cookies");
                    $this->set_cookies->setUserID($row->user_id);
                    $this->set_cookies->setEmail($row->email);
                    $this->set_cookies->setUserGroup($row->user_group);
                    $this->set_cookies->setFullName($row->full_name);
                    $this->set_cookies->setIType($row->investor_type);

                    redirect("security/reset_password/success");
                }
            } 
        }
        else
        {
            $this->load->view('view_header');
            $this->load->view("view_activation_success");
            $this->load->view('view_footer');
        }
    }

    public function forgot_my_password($pParam=null)
    {
        switch ($pParam)
        {
            case null:
            {
                $this->load->view('view_header');
                $this->load->view('view_forgot_my_password');
                $this->load->view('view_footer');
                break;
            }
            case "reset":
            {
                $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|max_length[255]|valid_email');

                if ($this->form_validation->run() == False)
                {
                    $this->load->view('view_header');
                    $this->load->view('view_forgot_my_password');
                    $this->load->view('view_footer');
                }
                else
                {
                    $param["email"] = $this->input->post("txt_email");
                    $this->load->model("model_user");
                    $this->model_user->update_dynamic_code($param);

                    $this->load->library('send_mail');
                    $this->send_mail->request_password_to_web_user($this->input->post("txt_email"));

                    redirect("security/forgot_my_password/sent");
                }
                break;
            }
            case "sent":
            {
                $this->load->view('view_header');
                $this->load->view("view_forgot_my_password_sent");
                $this->load->view('view_footer');
                break;
            }
        }
    }

    public function forgot_my_password_reset($pDynamicCode)
    {
        $this->load->model('model_user');
        $row = $this->model_user->get_by_code($pDynamicCode);

        if ($row == false)
        {
            redirect("./");
        }
        else
        {
            $data["full_name"] = $row->full_name;
            $data["dynamic_code"] = $pDynamicCode;
            $this->load->view('view_header');
            $this->load->view("view_forgot_my_password_reset", $data);
            $this->load->view('view_footer');
        }
    }

    public function forgot_my_password_reset_done($pParam=null)
    {
        if ($pParam == null)
        {
            //$this->load->library("form_validation");

            $this->form_validation->set_rules("txt_password", "Password", "trim|required");
            $this->form_validation->set_rules('txt_confirm_password', 'Confirm Password', 'trim|required|matches[txt_password]');

            if ($this->form_validation->run() == False)
            {
                $data["full_name"] = $this->input->post("h_full_name");
                $data["dynamic_code"] = $this->input->post("h_dynamic_code");
                $this->load->view('view_header');
                $this->load->view("view_forgot_my_password_reset", $data);
                $this->load->view('view_footer');
            }
            else
            {
                //here no cookies yet
                $this->load->model("model_user");
                $data["dynamic_code"] = $this->input->post("h_dynamic_code");
                $row = $this->model_user->get_by_code($data["dynamic_code"]);

                if ($row == false)
                {
                    redirect("./");
                }
                else
                {
                    $param["user_id"] = $row->user_id;
                    $this->model_user->activate($param);

                    $param["user_id"] = $row->user_id;
                    $param["password"] = $this->input->post("txt_password");
                    $this->model_user->update_password($param);

                    $this->load->library("set_cookies");
                    $this->set_cookies->setUserID($row->user_id);
                    $this->set_cookies->setEmail($row->email);
                    $this->set_cookies->setUserGroup($row->user_group);
                    $this->set_cookies->setFullName($row->full_name);
                    $this->set_cookies->setIType($row->investor_type);

                    redirect("security/forgot_my_password_reset_done/success");
                }
            } 
        }
        else
        {
            $this->load->view('view_header');
            $this->load->view("view_forgot_my_password_reset_success");
            $this->load->view('view_footer');
        }
    }

    public function update_myprofile()
    {
        
        $param["user_id"] = $this->input->post('user_id');
        $param["email"] = $this->input->post('email');

        $this->load->model('model_user');
        $is_exist = $this->model_user->check($param);

        if ($is_exist == false)
        {
            $investor_type = "";

            $param2["email"] = $this->input->post('email');
            $param2["full_name"] = $this->input->post('full_name');
            $param2["full_name"] = $this->input->post('full_name');
            if (get_cookie("user_group") == "I")
            {
                $investor_type = $this->input->post('investor_type');
            }
            $param2["investor_type"] = $investor_type;
        
            $this->model_user->update_profile($param2);

            $this->load->library("set_cookies");
            $this->set_cookies->setEmail($this->input->post('email'));
            $this->set_cookies->setFullName($this->input->post('full_name'));
            $this->set_cookies->setIType($investor_type);
        }

        $data = array(
            'is_exist' => $is_exist
        );    
                
        echo json_encode($data);
    }

    public function update_mypassword()
    {
        $this->load->model('model_user');
        $return_user = $this->model_user->login(get_cookie("email"), $this->input->post('old_password'));
        if ($return_user == false)
        {
            $data = array(
                'return' => false
            );      
        }
        else
        {
            $param["user_id"] = $this->input->post('user_id');
            $param["password"] = $this->input->post('password');
            $this->model_user->update_password($param);

            $data = array(
                'return' => true
            );  
        }
        
        echo json_encode($data);
    }
   
}