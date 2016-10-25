<?php
class Model_sys_user_group extends CI_Model{

	function add($param)
	{
		$query = array(
			"group_name" => $param["group_name"],
			"loan_request_notification" => ($param["loan_request_notification"]=="1" ? 1 : 0 ),
			"investment_notification" => ($param["investment_notification"]=="1" ? 1 : 0 ),
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_by" => get_cookie("admin_userid"),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('sys_user_group', $query);
		$data["sys_user_group_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("sys_user_group");
		$this->db->where("group_name", $param["group_name"]);
		$this->db->where("sys_user_group_id !=", $param["sys_user_group_id"]);
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

	function delete($sys_user_group_id)
	{
		$query = $this->db->query("UPDATE sys_user_group SET is_deleted=1 ".
			"WHERE sys_user_group_id=".$sys_user_group_id);
	}

	function get($sys_user_group_id)
	{
		$this->db->select("*");
		$this->db->from("sys_user_group");
		$this->db->where("sys_user_group_id", $sys_user_group_id);
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
		$this->db->select("g.sys_user_group_id, g.group_name,g.loan_request_notification, g.investment_notification, g.status, uc.full_name AS created_user, g.created_date");
		$this->db->from("sys_user_group g");
		$this->db->join("sys_user AS uc", "g.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("g.is_deleted", 0);
		$this->db->order_by("g.group_name", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("g.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE sys_user_group SET ".
			"group_name='".$this->db->escape_str($param["group_name"])."', ".
			"loan_request_notification=".$param["loan_request_notification"].", ".
			"investment_notification=".$param["investment_notification"].", ".
			"status=".$param["status"]." ".
			"WHERE sys_user_group_id='".$param["sys_user_group_id"]."'");
	}

	
}
?>