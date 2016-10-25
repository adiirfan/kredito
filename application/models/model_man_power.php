<?php
class Model_man_power extends CI_Model{

	function add($param)
	{
		$query = array(
			"from" => $param["from"],
			"to" => $param["to"],
			"status" => ($param["status"]=="1" ? 1 : 0 ),
			"created_by" => get_cookie("admin_userid"),
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('man_power', $query);
		$data["man_power_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("man_power");
		$this->db->where("from", $param["from"]);
		$this->db->where("to", $param["to"]);
		$this->db->where("man_power_id !=", $param["man_power_id"]);
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

	function delete($man_power_id)
	{
		$query = $this->db->query("UPDATE man_power SET is_deleted=1 ".
			"WHERE man_power_id=".$man_power_id);
	}

	function get($man_power_id)
	{
		$this->db->select("*");
		$this->db->from("man_power");
		$this->db->where("man_power_id", $man_power_id);
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
		$this->db->select("m.man_power_id, m.from, m.to, m.status, uc.full_name AS created_user, m.created_date");
		$this->db->from("man_power m");
		$this->db->join("sys_user AS uc", "m.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("m.is_deleted", 0);
		$this->db->order_by("m.from", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("m.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE man_power SET ".
			"`from`=".$param["from"].", ".
			"`to`=".$param["to"].", ".
			"status=".$param["status"]." ".
			"WHERE man_power_id='".$param["man_power_id"]."'");
	}

	
}
?>