<?php
class Model_salutation extends CI_Model{

	function add($param)
	{
		$query = array(
			"salutation_name" => $param["salutation_name"],
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_by" => get_cookie("admin_userid"),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('salutation', $query);
		$data["salutation_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("salutation");
		$this->db->where("salutation_name", $param["salutation_name"]);
		$this->db->where("salutation_id !=", $param["salutation_id"]);
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

	function delete($salutation_id)
	{
		$query = $this->db->query("UPDATE salutation SET is_deleted=1 ".
			"WHERE salutation_id=".$salutation_id);
	}

	function get($salutation_id)
	{
		$this->db->select("*");
		$this->db->from("salutation");
		$this->db->where("salutation_id", $salutation_id);
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
		$this->db->select("s.salutation_id, s.salutation_name, s.status, uc.full_name AS created_user, s.created_date");
		$this->db->from("salutation s");
		$this->db->join("sys_user AS uc", "s.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("s.is_deleted", 0);
		$this->db->order_by("s.salutation_name", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("s.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE salutation SET ".
			"salutation_name='".$this->db->escape_str($param["salutation_name"])."', ".
			"status=".$param["status"]." ".
			"WHERE salutation_id='".$param["salutation_id"]."'");
	}

	
}
?>