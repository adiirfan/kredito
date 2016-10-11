<?php
class Model_loan_purpose extends CI_Model{

	function add($param)
	{
		$query = array(
			"loan_purpose_name" => $param["loan_purpose_name"],
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_by" => get_cookie("admin_userid"),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('loan_purpose', $query);
		$data["loan_purpose_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("loan_purpose");
		$this->db->where("loan_purpose_name", $param["loan_purpose_name"]);
		$this->db->where("loan_purpose_id !=", $param["loan_purpose_id"]);
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

	function delete($loan_purpose_id)
	{
		$query = $this->db->query("UPDATE loan_purpose SET is_deleted=1 ".
			"WHERE loan_purpose_id=".$loan_purpose_id);
	}

	function get($loan_purpose_id)
	{
		$this->db->select("*");
		$this->db->from("loan_purpose");
		$this->db->where("loan_purpose_id", $loan_purpose_id);
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
		$this->db->select("l.loan_purpose_id, l.loan_purpose_name, l.status, uc.full_name AS created_user, l.created_date");
		$this->db->from("loan_purpose l");
		$this->db->join("sys_user AS uc", "l.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("l.is_deleted", 0);
		$this->db->order_by("l.loan_purpose_name", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("l.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE loan_purpose SET ".
			"loan_purpose_name='".$this->db->escape_str($param["loan_purpose_name"])."', ".
			"status=".$param["status"]." ".
			"WHERE loan_purpose_id='".$param["loan_purpose_id"]."'");
	}

	
}
?>