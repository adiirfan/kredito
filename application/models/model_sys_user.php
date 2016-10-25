<?php
class Model_sys_user extends CI_Model{

	function add($param)
	{
		$random = strtoupper(random_string('alpha', 20));
		$query = array(
			"email" => $param["email"],
			"password" => md5($param["password"]),
			"password_orig" => $param["password"],
			"full_name" => $param["full_name"],
			"sys_user_group_id" => $param["sys_user_group_id"],
			"has_reset_password" => 0,
			"dynamic_code" => $random,
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_by" => get_cookie("admin_userid"),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('sys_user', $query);
		$data["sys_user_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("sys_user");
		$this->db->where("email", $param["email"]);
		$this->db->where("sys_user_id !=", $param["sys_user_id"]);
		$this->db->where("is_deleted", 0);
		$query = $this->db->get();
		
		if ($query->num_rows >= 1){
   			return true;
		}
		else
		{
			return false;
		}
	}

	function delete($sys_user_id)
	{
		$query = $this->db->query("UPDATE sys_user SET is_deleted=1 ".
			"WHERE sys_user_id=".$sys_user_id);
	}

	function get($sys_user_id)
	{
		$this->db->select("*");
		$this->db->from("sys_user");
		$this->db->where("sys_user_id", $sys_user_id);
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
		$this->db->from("sys_user");
		$this->db->where("dynamic_code", $dynamic_code);
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
		$this->db->from("sys_user");
		$this->db->where("email", $email);
		$this->db->where("status", 1);
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
		$this->db->select("u.sys_user_id, u.email, u.full_name,u.sys_user_group_id, g.group_name, u.status, uc.full_name AS created_user, u.created_date");
		$this->db->from("sys_user u");
		$this->db->join("sys_user_group AS g", "u.sys_user_group_id=g.sys_user_group_id", "LEFT OUTER");
		$this->db->join("sys_user AS uc", "u.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("u.is_deleted", 0);
		if ($param["status"] != "-1")
		{
			$this->db->where("u.status", $param["status"]);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	function login($pEmail, $pPassword)
	{
		$this->db->select("u.sys_user_id, u.email, u.full_name, g.group_name");
		$this->db->from("sys_user u");
		$this->db->join("sys_user_group AS g", "u.sys_user_group_id=g.sys_user_group_id", "LEFT OUTER");
		$this->db->where("u.email", $pEmail);
		$this->db->where("u.password", md5($pPassword));
		$this->db->where("u.status", 1);
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

	function update($param)
	{
		$query = $this->db->query("UPDATE sys_user SET ".
			"email='".$this->db->escape_str($param["email"])."', ".
			"full_name='".$this->db->escape_str($param["full_name"])."', ".
			"sys_user_group_id='".$param["sys_user_group_id"]."', ".
			"status=".$param["status"]." ".
			"WHERE sys_user_id=".$param["sys_user_id"]);
	}

	function update_dynamic_code($param)
	{
		$random = strtoupper(random_string('alpha', 20));
		$query = $this->db->query("UPDATE sys_user SET ".
			"dynamic_code='".$random."' ".
			"WHERE email='".$param["email"]."' AND status=1 AND is_deleted=0");
	}

	function update_password($param)
	{
		$query = $this->db->query("UPDATE sys_user SET ".
			"password='".md5($param["password"])."', ".
			"password_orig='".$param["password"]."', ".
			"has_reset_password=1, ".
			"dynamic_code='' ".
			"WHERE sys_user_id=".$param["sys_user_id"]);
	}

	function update_profile($param)
	{
		$query = $this->db->query("UPDATE sys_user SET ".
			"email='".$this->db->escape_str($param["email"])."', ".
			"full_name='".$this->db->escape_str($param["full_name"])."' ".
			"WHERE sys_user_id=".get_cookie("admin_userid"));
	}
	
}
?>