<?php
class Model_investment_status extends CI_Model{

	function add($param)
	{
		$query = array(
			"investment_id" => $param["investment_id"],
			"status" => $param["status"],
			"remarks" => $param["remarks"],
			"created_by" => $param["user_id"],
			"created_date" => date('Y-m-d H:i:s')
		);
		
		$this->db->insert('investment_status', $query);
		$data["investment_status_id"] = $this->db->insert_id();
		return $data;
	}

	function listing($param)
	{
		$this->db->select("s.investment_status_id, s.status, s.remarks, uc.full_name AS created_user, s.created_date");
		$this->db->from("investment_status s");
		$this->db->join("sys_user AS uc", "s.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("s.investment_id", $param["investment_id"]);
		$this->db->order_by("s.created_date", "desc");
		
		$query = $this->db->get();

		return $query->result();
	}

}