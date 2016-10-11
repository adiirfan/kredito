<?php
class model_loan_repayment extends CI_Model{

	function add($param)
	{
		$CI =& get_instance();
		$CI->load->model('model_loan');
		$loan = $CI->model_loan->get($param["loan_id"]);
		
		if($this->check_months($param["loan_id"]) < $loan->period)
		{
			$query = array(
				"loan_repayment_id" => null,
				"loan_id" => $param["loan_id"],
				"schedule" => $param["schedule"],
				"principal" => $param["principal"],
				"interest" => $param["interest"],
				"instalment" => $param["instalment"],
				"balance" => $param["balance"],
				"status" => $param["status"],
				"created_by" => $param["created_by"],
				"created_date" => date('Y-m-d H:i:s'),
				"is_deleted" => 0
			);
			$this->db->insert('loan_repayment', $query);
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete($id)
	{
		$query = [
			"is_deleted" => 1
		];

		$this->db->where('loan_repayment_id', $id);
		$this->db->update('loan_repayment', $query);
	}

	function listing($param)
	{
		$this->db->select("r.loan_repayment_id, r.loan_id, r.schedule, r.principal, r.interest, r.instalment, r.balance, r.status, uc.full_name AS created_by, r.created_date");
		$this->db->from("loan_repayment r");
	//	$this->db->join("loan AS l", "l.loan_id=r.loan_id", "LEFT");
		$this->db->join("sys_user AS uc", "r.created_by=uc.sys_user_id", "LEFT OUTER");
		$this->db->where("r.loan_id", $param["loan_id"]);
		$this->db->where('r.is_deleted', 0);
		$this->db->order_by("r.schedule", "asc");
		
		$query = $this->db->get();

		return $query->result();
	}

	function get($id)
	{
		$this->db->select("*");
		$this->db->from("loan_repayment");
		$this->db->where("loan_repayment_id", $id);
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
	
	function get_list_by_loan($id)
	{
		$this->db->select("*");
		$this->db->from("loan_repayment");
		$this->db->join("loan", "loan_repayment.loan_id=loan.loan_id", "LEFT OUTER");
		$this->db->where("loan_repayment.loan_id", $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function check_months($id)
	{
		$this->db->select("*");
		$this->db->from("loan_repayment");
		$this->db->where("loan_id", $id);
		$this->db->where("is_deleted", 0);
		$num_results = $this->db->count_all_results();
		
		return $num_results;
	}

	function update($param)
	{
		$query = [
			"schedule" => $param["schedule"],
			"principal" => $param["principal"],
			"interest" => $param["interest"],
			"instalment" => $param["instalment"],
			"balance" => $param["balance"],
			"status" => $param["status"]
		];

		$this->db->where('loan_repayment_id', $param["loan_repayment_id"]);
		$this->db->update('loan_repayment', $query);
	}

	function repayment_for_investor($param)
	{
		$this->db->select("l.amount,r.schedule,r.principal, r.interest, r.instalment, r.balance, r.status");
		
		$this->db->from("loan_repayment r");
		$this->db->join("loan AS l", "l.loan_id=r.loan_id", "LEFT");
		$this->db->where('r.is_deleted', 0);
		$this->db->where("r.loan_id", $param["loan_id"]);
		$this->db->order_by("r.schedule", "asc");
		$queries = $this->db->get();

		return $queries->result();
	}
}
?>