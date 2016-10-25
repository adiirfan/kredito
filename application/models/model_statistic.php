<?php
class Model_statistic extends CI_Model{

	function get()
	{
		$this->db->select("*");
		$this->db->from("statistic");
		$this->db->where("statistic_id", 1);
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

	function update()
	{
		$query = $this->db->query("UPDATE statistic SET ".
			"total_loan= (SELECT SUM(total_fund) from user WHERE user_group='B' AND is_deleted=0) ");

		$query = $this->db->query("UPDATE statistic SET ".
			"total_investment= (SELECT SUM(total_fund) from user WHERE user_group='I' AND is_deleted=0) ");

		$query = $this->db->query("UPDATE statistic SET ".
			"total_investment_used= (SELECT SUM(fund_used) from investment WHERE status = 4 AND is_deleted=0) ");		
	}

}