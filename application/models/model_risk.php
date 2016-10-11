<?php
class Model_risk extends CI_Model{

	function add($param)
	{
		$query = array(
			"risk_name" => $param["risk_name"],
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_by" => get_cookie("admin_userid"),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('risk', $query);
		$data["risk_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("risk");
		$this->db->where("risk_name", $param["risk_name"]);
		$this->db->where("risk_id !=", $param["risk_id"]);
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

	function delete($risk_id)
	{
		$query = $this->db->query("UPDATE risk SET is_deleted=1 ".
			"WHERE risk_id=".$risk_id);
	}

	function get($risk_id)
	{
		$this->db->select("*");
		$this->db->from("risk");
		$this->db->where("risk_id", $risk_id);
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
		$this->db->select("r.risk_id, r.risk_name, r.status, uc.full_name AS created_user, r.created_date");
		$this->db->from("risk r");
		$this->db->join("sys_user AS uc", "r.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("r.is_deleted", 0);
		$this->db->order_by("r.risk_name", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("r.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE risk SET ".
			"risk_name='".$this->db->escape_str($param["risk_name"])."', ".
			"status=".$param["status"]." ".
			"WHERE risk_id='".$param["risk_id"]."'");
	}

	
}
?>