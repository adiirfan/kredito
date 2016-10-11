<?php
class Model_loan_status extends CI_Model{

	function add($param)
	{
		$query = array(
			"loan_id" => $param["loan_id"],
			"status" => $param["status"],
			"remarks" => $param["remarks"],
			"created_by" => $param["user_id"],
			"created_date" => date('Y-m-d H:i:s')
		);
		
		$this->db->insert('loan_status', $query);
		$data["loan_status_id"] = $this->db->insert_id();
		return $data;
	}

	function listing($param)
	{
		$this->db->select("s.loan_status_id, s.status, s.remarks, uc.username AS created_user, s.created_date");
		$this->db->from("loan_status s");
		$this->db->join("users AS uc", "s.created_by=uc.id_user", "LEFT OUTER");
		$this->db->where("s.loan_id", $param["loan_id"]);
		$this->db->order_by("s.created_date", "desc");
		
		$query = $this->db->get();

		return $query->result();
	}

}