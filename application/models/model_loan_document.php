<?php
class Model_loan_document extends CI_Model{

	/*
	Status:
		aa: Audited Accounts
		ma: M&A
		la: Letter of Award
	*/
	function add($param)
	{
		$query = array(
			"loan_id" => $param["loan_id"],
			"document_type" => $param["document_type"],
			"file_name" => $param["file_name"],
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('loan_document', $query);
		$data["loan_document_id"] = $this->db->insert_id();
		return $data;
	}



}