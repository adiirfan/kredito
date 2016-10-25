<?php
class Model_investor_document extends CI_Model{

	/*
	Status:
		ic: IC
		pa: Proof of Address
	*/
	function add($param)
	{
		$query = array(
			"user_id" => $param["user_id"],
			"document_type" => $param["document_type"],
			"file_name" => $param["file_name"],
			"created_date" => date('Y-m-d h:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('investor_document', $query);
		$data["investor_document_id"] = $this->db->insert_id();
		return $data;
	}

	function get_document($user_id)
	{
		
		$this->db->select('*');
		$this->db->from('investor_document');
			
			if($user_id != NULL){
			$this->db->where('investor_document.user_id',$user_id);
			}
		 $query = $this->db->get('');
		return $query->result_array();
	}


}