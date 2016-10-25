<?php
class Model_investment_period extends CI_Model{

	function add($param)
	{
		$query = array(
			"investment_id" => $param["investment_id"],
			"period" => $param["period"],
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('investment_period', $query);
		$data["investment_period_id"] = $this->db->insert_id();
		return $data;
	}

	function check($param)
	{
		$this->db->select("*");
		$this->db->from("investment_period");
		$this->db->where("investment_id", $param["investment_id"]);
		$this->db->where("period !=", $param["period"]);
		$query = $this->db->get();
		
		if ($query->num_rows >= 1){
   			return true;
		}
		else
		{
			return false;
		}
	}

	function delete_all($investment_id)
	{
		$query = $this->db->query("UPDATE investment_period SET is_deleted=1 ".
			"WHERE investment_id=".$investment_id);
	}

	function get($investment_id, $period)
	{
		$this->db->select("*");
		$this->db->from("investment_period");
		$this->db->where("investment_id", $investment_id);
		$this->db->where("period", $period);
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
		$this->db->select("p.period");
		$this->db->from("investment_period p");
		$this->db->where("p.investment_id", $param["investment_id"]);
		$this->db->where("p.is_deleted", 0);
		$this->db->order_by("p.period", "asc");
		
		$query = $this->db->get();
		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE investment_period SET ".
			"created_date='".date('Y-m-d H:i:s')."', ".
			"is_deleted=0 ".
			"WHERE investment_id=".$param["investment_id"]." ".
			"AND period=".$param["period"]);
	}

}