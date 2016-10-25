<?php
class Model_investment extends CI_Model{

	/*
	Status:
		0: Newly Created (draft)
		1: Saved & Submit later
		2: Newly Submitted
		3: Processing
		4: Success
		5: Rejected
		6: Cancelled by user
	*/

	function add($param)
	{
		$code = strtoupper(random_string('alpha', 6));
		$folder_code = strtoupper(random_string('alpha', 20));
		$query = array(
			"code" => $code,
			"investor_id" => $param["investor_id"],
			"i_salutation_id" => $param["i_salutation_id"],
			"i_full_name" => $param["i_full_name"],
			"i_email" => $param["i_email"],
			"i_mobile_phone" => $param["i_mobile_phone"],
			"i_address" => $param["i_address"],
			"i_investor_type" => $param["i_investor_type"],
			"i_company_name" => $param["i_company_name"],
			"i_company_registration" => $param["i_company_registration"],
			"fund" => $param["fund"],
			"bank_trf" => $param["bank_trf"],
			"name_account_bank" => $param["name_account_bank"],
			"tgl_trf" => $param["tgl_trf"],
			"notes" => $param["note"],
			"fund_used" => $param["fund_used"],
			"pref_paid_up_capital_id" => $param["pref_paid_up_capital_id"],
			"pref_paid_up_capital_from" => $param["pref_paid_up_capital_from"],
			"pref_paid_up_capital_to" => $param["pref_paid_up_capital_to"],
			"pref_man_power_id" => $param["pref_man_power_id"],
			"pref_man_power_from" => $param["pref_man_power_from"],
			"pref_man_power_to" => $param["pref_man_power_to"],
			"pref_revenue_id" => $param["pref_revenue_id"],
			"pref_revenue_from" => $param["pref_revenue_from"],
			"pref_revenue_to" => $param["pref_revenue_to"],
			"folder_code_2" => $folder_code,
			"status" => 0,
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('investment', $query);
		$data["investment_id"] = $this->db->insert_id();
		$data["code"] = $code;
		$data["folder_code"] = $folder_code;
		return $data;
	}
	function add2($param)
	{
		$code = strtoupper(random_string('alpha', 6));
		$folder_code = strtoupper(random_string('alpha', 20));
		$query = array(
			"code_investment" => $code,
			"investor_id" => $param["investor_id"],
			"i_salutation_id" => $param["i_salutation_id"],
			"i_full_name" => $param["i_full_name"],
			"i_email" => $param["i_email"],
			"i_mobile_phone" => $param["i_mobile_phone"],
			"i_address" => $param["i_address"],
			"i_investor_type" => $param["i_investor_type"],
			"i_company_name" => $param["i_company_name"],
			"i_company_registration" => $param["i_company_registration"],
			"fund" => $param["fund"],
			//"bank_trf" => $param["bank_trf"],
			//"name_account_bank" => $param["name_account_bank"],
			//"tgl_trf" => $param["tgl_trf"],
		//	"notes" => $param["note"],
			"fund_used" => $param["fund_used"],
			"pref_paid_up_capital_id" => $param["pref_paid_up_capital_id"],
			"pref_paid_up_capital_from" => $param["pref_paid_up_capital_from"],
			"pref_paid_up_capital_to" => $param["pref_paid_up_capital_to"],
			"pref_man_power_id" => $param["pref_man_power_id"],
			"pref_man_power_from" => $param["pref_man_power_from"],
			"pref_man_power_to" => $param["pref_man_power_to"],
			"pref_revenue_id" => $param["pref_revenue_id"],
			"pref_revenue_from" => $param["pref_revenue_from"],
			"pref_revenue_to" => $param["pref_revenue_to"],
			"folder_code_2" => $folder_code,
			//"bukti_trf" => $param["bukti_trf"],
			"status" => 1,
			"created_date" => date('Y-m-d H:i:s'),
			"submitted_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('investment', $query);
		$data["investment_id"] = $this->db->insert_id();
		$data['nilai']=$param["fund"];
		$data["code"] = $code;
		$data["folder_code"] = $folder_code;
		return $data;
	}
	function get($investment_id)
	{
		$this->db->select("*");
		$this->db->from("investment");
		$this->db->where("investment_id", $investment_id);
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
	
	function listing2($param)
	{
		$this->db->select("i.status,i.code_investment,i.i_full_name,i.i_mobile_phone,i.fund,i.created_date,i.investment_id,i.i_email,u.folder_code,i.bukti_trf");
		$this->db->from("investment i");
		$this->db->join('user as u', 'u.user_id=i.investor_id','left');
		
		if ($param["status"] != "-1")
		{
			$this->db->where("i.status >=", $param["status"]);
		}
		$this->db->order_by('investment_id DESC');
		$query = $this->db->get();
		
			

		return $query->result();
	}

	function get_total_fund($investor_id)
	{
		$this->db->select("sum(fund) as total");
		$this->db->from("investment");
		$this->db->where("investor_id", $investor_id);
		$this->db->where("status", 3);
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
	
	function get_by_code($code)
	{
		$this->db->select("*");
		$this->db->from("investment");
		$this->db->where("code_investment", $code);
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

	function get_count($status)
	{
		$this->db->select("COUNT(i.investment_id) AS record_count");
		$this->db->from("investment i");
		$this->db->where("i.is_deleted", 0);
		if ($status != "-1")
		{
			$this->db->where("i.status", $status);
		}
		/*
		if ($param["user_id"] != 0)
		{
			$this->db->where("i.investor_id", $param["user_id"]);
		}
		*/
		$query = $this->db->get();

		$record_count = 0;
		if ($query->num_rows == 1){
			$row = $query->row(); 
			if ($row->record_count == null)
				$record_count = 0;
			else
				$record_count = $row->record_count;
		}
		return $record_count;
	}

	function listing($param)
	{
		$this->db->select("i.investment_id, i.code, i.i_salutation_id, i.i_full_name, i.i_mobile_phone, i.i_email, i.i_company_name, i.fund, i.fund_used, i.status, ui.full_name AS investor_name, i.created_date, i.submitted_date");
		$this->db->from("investment i");
		$this->db->join("user AS ui", "i.investor_id=ui.user_id", "LEFT OUTER");
		/*
		$this->db->where("i.status <>", 0);
		$this->db->where("i.status <>", 1);
		*/
		$this->db->where("i.is_deleted", 0);
		$this->db->order_by("i.investor_id", "desc");
		if ($param["status"] != "-1")
		{
			$this->db->where("i.status", $param["status"]);
		}
		/*
		if ($param["user_id"] != 0)
		{
			$this->db->where("i.investor_id", $param["user_id"]);
		}
		*/
		$query = $this->db->get();

		return $query->result();
	}

	function listing_available()
	{
		$this->db->select("i.investment_id, i.code, i.i_salutation_id, i.i_full_name, i.i_investor_type, i.i_company_name, i.fund");
		$this->db->from("investment i");
		$this->db->where("i.status", 4);
		$this->db->where("i.is_deleted", 0);
		$this->db->where("i.fund - i.fund_used > 0");
		$this->db->order_by("i.investor_id", "desc");
		
		$query = $this->db->get();

		return $query->result();
	}

	function listing_fully_match($param)
	{
		$query = $this->db->query("SELECT i.investment_id, i.code, i.i_full_name, i.i_mobile_phone, i.i_email, i.i_company_name, i.fund, i.fund_used, GROUP_CONCAT(p.period SEPARATOR ', ') as period_str, i.pref_paid_up_capital_from, i.pref_paid_up_capital_to, i.pref_man_power_from, i.pref_man_power_to, i.pref_revenue_from, i.pref_revenue_to ".
			" FROM investment i ".
			" LEFT OUTER JOIN investment_period p ON i.investment_id = p.investment_id ".
			" WHERE i.status = 4".
			" AND i.is_deleted = 0".
			" AND p.is_deleted = 0".
			" AND i.fund - i.fund_used >= ".$param["amount"].
			" AND i.pref_paid_up_capital_from <= ".$param["b_company_paid_up_capital"]." AND i.pref_paid_up_capital_to >= ".$param["b_company_paid_up_capital"].
			" AND i.pref_man_power_from <= ".$param["b_company_man_power"]." AND i.pref_man_power_to >= ".$param["b_company_man_power"].
			" AND i.pref_revenue_from <= ".$param["b_company_revenue"]." AND i.pref_revenue_to >= ".$param["b_company_revenue"].
			" AND i.investment_id IN (SELECT investment_id FROM investment_period WHERE is_deleted = 0 AND period = ".$param["period"].")".
			" GROUP BY i.investment_id");

		return $query->result();
	}

	function listing_partially_match($param)
	{
		$query = $this->db->query("SELECT i.investment_id, i.code, i.i_full_name, i.i_mobile_phone, i.i_email, i.i_company_name, i.fund, i.fund_used, GROUP_CONCAT(p.period SEPARATOR ', ') as period_str, i.pref_paid_up_capital_from, i.pref_paid_up_capital_to, i.pref_man_power_from, i.pref_man_power_to, i.pref_revenue_from, i.pref_revenue_to ".
			" FROM investment i ".
			" LEFT OUTER JOIN investment_period p ON i.investment_id = p.investment_id ".
			" WHERE i.status = 4".
			" AND i.is_deleted = 0".
			" AND p.is_deleted = 0".
			" AND i.fund - i.fund_used >= ".$param["amount"].
			" AND ((i.pref_paid_up_capital_from <= ".$param["b_company_paid_up_capital"]." AND i.pref_paid_up_capital_to >= ".$param["b_company_paid_up_capital"].")".
			" OR (i.pref_man_power_from <= ".$param["b_company_man_power"]." AND i.pref_man_power_to >= ".$param["b_company_man_power"].")".
			" OR (i.pref_revenue_from <= ".$param["b_company_revenue"]." AND i.pref_revenue_to >= ".$param["b_company_revenue"].")".
			" OR i.investment_id IN (SELECT investment_id FROM investment_period WHERE is_deleted = 0 AND period = ".$param["period"]."))".
			" AND i.investment_id NOT IN (".$param["exclude_id_str"].")".
			" GROUP BY i.investment_id");

		return $query->result();
	}

	function listing_my()
	{
		$this->db->select("i.investment_id, i.code, i.i_salutation_id, i.i_full_name, i.i_mobile_phone, i.i_email, i.i_company_name, i.fund, i.status, i.created_date, i.submitted_date");
		$this->db->from("investment i");
		$this->db->where("i.investor_id", get_cookie("user_id"));
		$this->db->where("i.status <>", 0);
		$this->db->where("i.is_deleted", 0);
		$this->db->order_by("i.investor_id", "desc");
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		$query = $this->db->query("UPDATE investment SET ".
			"investor_id=".$param["investor_id"].", ".
			"i_salutation_id=".$param["i_salutation_id"].", ".
			"i_full_name='".$this->db->escape_str($param["i_full_name"])."', ".
			"i_email='".$this->db->escape_str($param["i_email"])."', ".
			"i_mobile_phone='".$this->db->escape_str($param["i_mobile_phone"])."', ".
			"i_address='".$this->db->escape_str($param["i_address"])."', ".
			"i_investor_type='".$this->db->escape_str($param["i_investor_type"])."', ".
			"i_company_name='".$this->db->escape_str($param["i_company_name"])."', ".
			"i_company_registration='".$this->db->escape_str($param["i_company_registration"])."', ".
			"pref_paid_up_capital_id=".$param["pref_paid_up_capital_id"].", ".
			"pref_paid_up_capital_from=".$param["pref_paid_up_capital_from"].", ".
			"pref_paid_up_capital_to=".$param["pref_paid_up_capital_to"].", ".
			"pref_man_power_id=".$param["pref_man_power_id"].", ".
			"pref_man_power_from=".$param["pref_man_power_from"].", ".
			"pref_man_power_to=".$param["pref_man_power_to"].", ".
			"pref_revenue_id=".$param["pref_revenue_id"].", ".
			"pref_revenue_from=".$param["pref_revenue_from"].", ".
			"pref_revenue_to=".$param["pref_revenue_to"].", ".
			"fund=".$param["fund"]." ".
			"WHERE investment_id=".$param["investment_id"]);
	}

	function update_fund_used($param)
	{
		$this->db->select("SUM(amount) AS total_amount");
		$this->db->from("loan");
		$this->db->where("investment_id", $param["investment_id"]);
		$this->db->where("(status <> 5 OR status <> 6)");
		$this->db->where("is_deleted", "0");

		$query = $this->db->get();
		$total_amount = 0;
		if ($query->num_rows == 1){
			$row = $query->row(); 
			if ($row->total_amount == null)
				$total_amount = 0;
			else
				$total_amount = $row->total_amount;
		}
		
		$this->db->query("UPDATE investment SET ".
			"fund_used=".$total_amount." ".
			"WHERE investment_id=".$param["investment_id"]);
				
	}

	function update_status($param)
	{
		$query = $this->db->query("UPDATE investment SET ".
			"status=".$param["status"]." ".
			"WHERE investment_id=".$param["investment_id"]);

		if ($param["status"] == 2)
		{
			$query = $this->db->query("UPDATE investment SET ".
				"submitted_date='".date('Y-m-d H:i:s')."' ".
				"WHERE investment_id=".$param["investment_id"]);			
		}
	}

	
		
	
		
	function update_status_by_admin($param)
	{
		$query = $this->db->query("UPDATE investment SET ".
			"status=".$param["status"]." ".
			"WHERE investment_id=".$param["investment_id"]);
	}

}