<?php
class Model_revenue extends CI_Model{

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
		
		$this->db->insert('revenue', $query);
		$data["revenue_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("revenue");
		$this->db->where("from", $param["from"]);
		$this->db->where("to", $param["to"]);
		$this->db->where("revenue_id !=", $param["revenue_id"]);
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

	function delete($revenue_id)
	{
		$query = $this->db->query("UPDATE revenue SET is_deleted=1 ".
			"WHERE revenue_id=".$revenue_id);
	}

	function get($revenue_id)
	{
		$this->db->select("*");
		$this->db->from("revenue");
		$this->db->where("revenue_id", $revenue_id);
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
		$this->db->select("r.revenue_id, r.from, r.to, r.status, uc.full_name AS created_user, r.created_date");
		$this->db->from("revenue r");
		$this->db->join("sys_user AS uc", "r.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("r.is_deleted", 0);
		$this->db->order_by("r.from", "asc");
		if ($param["status"] != "-1")
		{
			$this->db->where("r.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE revenue SET ".
			"`from`=".$param["from"].", ".
			"`to`=".$param["to"].", ".
			"status=".$param["status"]." ".
			"WHERE revenue_id='".$param["revenue_id"]."'");
	}

	
}
?>