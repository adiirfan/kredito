<?php
class Model_user extends CI_Model{

	function activate($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"status=1 ".
			"WHERE user_id=".$param["user_id"]);
	}
	function adding($param)
	{
		//Have to detele all user acount with the same email before add
		//Although there is screencheck for the duplicate email, if user refresh the Upload Document page,
		//the user with the same email will be created twice
		$this->db->query("UPDATE user SET is_deleted=1 ".
			"WHERE email='".$param["email"]."'");

		
		$random = strtoupper(random_string('alpha', 20));
		$folder_code = strtoupper(random_string('alpha', 20));
		$query = array(
			"email" => $param["email"],
			"password" => md5($param["password"]),
			"password_orig" => $param["password"],
			"full_name" => $param["full_name"],
			"user_group" => $param["user_group"],	//B: Borrower; I:Investor
			"has_reset_password" => 0,
			"dynamic_code" => $random,
			"salutation_id" => $param["salutation_id"],
			"mobile_phone" => $param["mobile_phone"],
			"company_name" => $param["company_name"],
			"company_registration" => $param["company_registration"],
			"company_paid_up_capital" => $param["company_paid_up_capital"],
			"company_man_power" => $param["company_man_power"],
			"company_revenue" => $param["company_revenue"],
			"investor_type" => $param["investor_type"],		//I: Individual; C:Corporate
			"address" => $param["address"],
			"folder_code" => $folder_code,
			"total_fund" => 0,
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('user', $query);
		$data["user_id"] = $this->db->insert_id();
		$code = $this->generate_code($data["user_id"], $param["user_group"]);
		$this->db->query("UPDATE user SET ".
			"user_code='".$code."' ".
			"WHERE user_id=".$data["user_id"]);
		
		$this->db->query("UPDATE loan_product SET user_id =".$data["user_id"]." ".
			"WHERE loan_id='".$param["loan_id"]."'");	
		return $data;
	}

	function add($param)
	{
		//Have to detele all user acount with the same email before add
		//Although there is screencheck for the duplicate email, if user refresh the Upload Document page,
		//the user with the same email will be created twice
		$this->db->query("UPDATE user SET is_deleted=1 ".
			"WHERE email='".$param["email"]."'");
			$folder_code = strtoupper(random_string('alpha', 20));
		$random = strtoupper(random_string('alpha', 20));
		$query = array(
			"email" => $param["email"],
			"password" => md5($param["password"]),
			"password_orig" => $param["password"],
			"full_name" => $param["full_name"],
			"user_group" => $param["user_group"],	//B: Borrower; I:Investor
			"has_reset_password" => 0,
			"dynamic_code" => $random,
			"salutation_id" => $param["salutation_id"],
			"mobile_phone" => $param["mobile_phone"],
			"company_name" => $param["company_name"],
			"company_registration" => $param["company_registration"],
			"company_paid_up_capital" => $param["company_paid_up_capital"],
			"company_man_power" => $param["company_man_power"],
			"company_revenue" => $param["company_revenue"],
			"investor_type" => $param["investor_type"],		//I: Individual; C:Corporate
			"address" => $param["address"],
			"folder_code" => $folder_code,
			"total_fund" => 0,
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('user', $query);
		$data["user_id"] = $this->db->insert_id();
		
		$code = $this->generate_code($data["user_id"], $param["user_group"]);
		$this->db->query("UPDATE user SET ".
			"user_code='".$code."' ".
			"WHERE user_id=".$data["user_id"]);
		return $data;
	}
	function generate_code($user_id, $user_group)
	{
		$zero = "";
		if ($user_id < 10)
			$zero = "00000";
		else
		{
			if ($user_id < 100)
				$zero = "0000";
			else
			{
				if ($user_id < 1000)
					$zero = "000";
				else
				{
					if ($user_id < 10000)
						$zero = "00";
					else
					{
						if ($user_id < 100000)
							$zero = "0";
						else
							$zero = "";
					}
				}
			}
		}
		return "CDA".$user_group.$zero.$user_id;
	}

	function check($param,$get_userid=null)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("email", $param["email"]);
		$this->db->where("user_id !=", $param["user_id"]);
		$this->db->where("is_deleted", 0);
		$query = $this->db->get();
		
		if ($query->num_rows >= 1){
			
			if($get_userid != null){
				return $query->row();
			}else{
			
   			return 1;
			}
		}
		else
		{
			return null;
		}
	}

	function delete($user_id)
	{
		$query = $this->db->query("UPDATE user SET is_deleted=1 ".
			"WHERE user_id=".$user_id);
	}

	function get($user_id)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("user_id", $user_id);
		$query = $this->db->get();
		
		if ($query->num_rows == 1){
			$row = $query->row(); 
   			return $row;
		}
		else
		{
			return false;
		}
	}

	function get_by_code($dynamic_code)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("dynamic_code", $dynamic_code);
		$this->db->where("is_deleted", 0);
		$query = $this->db->get();
		
		if ($query->num_rows == 1){
			$row = $query->row(); 
   			return $row;
		}
		else
		{
			return false;
		}
	}

	function get_by_email($email)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("email", $email);
		$this->db->where("status >=", 1);
		//$this->db->or_where("status", 3);
		$this->db->where("is_deleted", 0);
		$query = $this->db->get();
		
		if ($query->num_rows == 1){
			$row = $query->row(); 
   			return $row;
		}
		else
		{
			return false;
		}
	}
	function get_by_email_2($email)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where("email", $email);
		//$this->db->where("status >=", 1);
		//$this->db->or_where("status", 3);
		$this->db->where("is_deleted", 0);
		$query = $this->db->get();
		
		if ($query->num_rows == 1){
			$row = $query->row(); 
   			return $row;
		}
		else
		{
			return false;
		}
	}

	function listing($param)
	{
		$this->db->select("u.user_id, u.email, s.salutation_name, u.full_name, u.mobile_phone, u.email, u.user_group, u.investor_type, u.company_name, u.company_registration, u.total_fund, u.status, u.created_date");
		$this->db->from("user u");
		$this->db->join("salutation AS s", "u.salutation_id=s.salutation_id", "LEFT OUTER");
		$this->db->where("u.is_deleted", 0);
		if ($param["status"] != "-1")
		{
			$this->db->where("u.status >=", $param["status"]);
		}
		if ($param["user_group"] != "")
		{
			$this->db->where("u.user_group", $param["user_group"]);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	function login($pEmail, $pPassword)
	{
		$this->db->select("u.user_id,u.status, u.user_code, u.email, u.full_name, u.user_group, u.investor_type");
		$this->db->from("user u");
		$this->db->where("u.email", $pEmail);
		$this->db->where("u.password", md5($pPassword));
		$this->db->where("u.status >=", 1);
		//$this->db->or_where("u.status", 3);
		$this->db->where("u.is_deleted", 0);
		$query = $this->db->get();

		if ($query->num_rows == 1){
			$row = $query->row(); 
			return $row;
		}
		else
		{
			return false;
		}
	}

	/*
	function update($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"email='".$this->db->escape_str($param["email"])."', ".
			"full_name='".$this->db->escape_str($param["full_name"])."', ".
			"user_group='".$param["user_group"]."', ".
			"status=".$param["status"]." ".
			"WHERE user_id=".$param["user_id"]);
	}
	*/

	function update_dynamic_code($param)
	{
		$random = strtoupper(random_string('alpha', 20));
		$query = $this->db->query("UPDATE user SET ".
			"dynamic_code='".$random."' ".
			"WHERE email='".$param["email"]."' AND status>=1   AND is_deleted=0");
	}

	function update_other($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"salutation_id=".$param["salutation_id"].", ".
			"mobile_phone='".$this->db->escape_str($param["mobile_phone"])."', ".
			"address='".$this->db->escape_str($param["address"])."', ".
			"company_name='".$this->db->escape_str($param["company_name"])."', ".
			"company_registration='".$this->db->escape_str($param["company_registration"])."', ".
			"company_paid_up_capital=".$param["company_paid_up_capital"].", ".
			"company_man_power=".$param["company_man_power"].", ".
			"company_revenue=".$param["company_revenue"].", ".
			"investor_type='".$param["investor_type"]."' ".
			"WHERE user_id=".$param["user_id"]);
	}

	function update_password($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"password='".md5($param["password"])."', ".
			"password_orig='".$param["password"]."', ".
			"has_reset_password=1, ".
			"dynamic_code='' ".
			"WHERE user_id=".$param["user_id"]);
	}

	function update_profile($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"email='".$this->db->escape_str($param["email"])."', ".
			"full_name='".$this->db->escape_str($param["full_name"])."', ".
			"investor_type='".$param["investor_type"]."' ".
			"WHERE user_id=".get_cookie("user_id"));
	}

	function update_status($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"status=".$param["status"]." ".
			"WHERE user_id=".$param["user_id"]);
	}

	function update_total_fund_borrower($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"total_fund= (SELECT SUM(amount) from loan_product WHERE borrower_id=".$param["user_id"]." AND status=4) ".
			"WHERE user_id=".$param["user_id"]);
	}

	function update_total_fund_investor($param)
	{
		$query = $this->db->query("UPDATE user SET ".
			"total_fund= (SELECT SUM(fund) from investment WHERE investor_id=".$param["user_id"]." AND status=4) ".
			"WHERE user_id=".$param["user_id"]);
	}

}
?>