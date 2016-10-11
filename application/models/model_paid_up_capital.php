<?php
class Model_paid_up_capital extends CI_Model{

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
		
		$this->db->insert('paid_up_capital', $query);
		$data["paid_up_capital_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("paid_up_capital");
		$this->db->where("from", $param["from"]);
		$this->db->where("to", $param["to"]);
		$this->db->where("paid_up_capital_id !=", $param["paid_up_capital_id"]);
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

	function delete($paid_up_capital_id)
	{
		$query = $this->db->query("UPDATE paid_up_capital SET is_deleted=1 ".
			"WHERE paid_up_capital_id=".$paid_up_capital_id);
	}

	function get($paid_up_capital_id)
	{
		$this->db->select("*");
		$this->db->from("paid_up_capital");
		$this->db->where("paid_up_capital_id", $paid_up_capital_id);
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
		$this->db->select("p.paid_up_capital_id, p.from, p.to, p.status, uc.full_name AS created_user, p.created_date");
		$this->db->from("paid_up_capital p");
		$this->db->join("sys_user AS uc", "p.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("p.is_deleted", 0);
		$this->db->order_by("p.from", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("p.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE paid_up_capital SET ".
			"`from`=".$param["from"].", ".
			"`to`=".$param["to"].", ".
			"status=".$param["status"]." ".
			"WHERE paid_up_capital_id='".$param["paid_up_capital_id"]."'");
	}

	
}
?>