<?php
class Model_investment_document extends CI_Model{

	/*
	Status:
		ic: IC
		pa: Proof of Address
	*/
	function add($param)
	{
		$query = array(
			"investment_id" => $param["investment_id"],
			"document_type" => $param["document_type"],
			"file_name" => $param["file_name"],
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('investment_document', $query);
		$data["investment_document_id"] = $this->db->insert_id();
		return $data;
	}



}