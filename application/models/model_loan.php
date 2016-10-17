<?php
class Model_loan extends CI_Model{

	/*
	Status:
		0: Newly Created (draft)
		1: Saved & Submit later
		2: Submitted
		3: Processing
		4: Success
		5: Rejected
		6: Cancelled by user
	*/
	function add($param)
	{
		$code = strtoupper(random_string('alpha', 6));
		$folder_code = strtoupper(random_string('alpha', 20));
		if (get_cookie("user_id") == ""){
			$loan_status=0;
		}else{
			$loan_status=0;
		}
		$query = array(
			"code" => $code,
			"borrower_id" => $param["borrower_id"],
			"b_salutation_id" => $param["b_salutation_id"],
			"b_full_name" => $param["b_full_name"],
			"b_email" => $param["b_email"],
			"b_mobile_phone" => $param["b_mobile_phone"],
			"b_company_name" => $param["b_company_name"],
			"b_company_registration" => $param["b_company_registration"],
			"b_company_paid_up_capital" => $param["b_company_paid_up_capital"],
			"b_company_man_power" => $param["b_company_man_power"],
			"b_company_revenue" => $param["b_company_revenue"],
			"amount" => $param["amount"],
			"period" => $param["period"],
			"loan_purpose_id" => $param["loan_purpose_id"],
			"loan_purpose_other" => $param["loan_purpose_other"],
			"folder_code" => $folder_code,
			"investment_id" => 0,
			"status" => $loan_status,
			"created_date" => date('Y-m-d H:i:s'),
			"is_deleted" => 0
		);
		
		$this->db->insert('loan', $query);
		$data["loan_id"] = $this->db->insert_id();
		$data["code"] = $code;
		$data["folder_code"] = $folder_code;
		return $data;
	}
	function update_info_by_admin($param)
	{
		$query = $this->db->query("UPDATE loan SET ".
			"risk_id=".$param["risk_id"].", ".
			"apr_percent=".$param["apr_percent"].", ".
			"eir_percent=".$param["eir_percent"].", ".
			"document_prepared=".$param["document_prepared"].", ".
			"contract_signed=".$param["contract_signed"]." ".
			"WHERE loan_id=".$param["loan_id"]);

		$this->update_closing_date($param);
	}
	function update_closing_date($param)
	{
		$this->db->select("*");
		$this->db->from("loan");
		$this->db->where("loan_id", $param["loan_id"]);
		$this->db->where("is_deleted", "0");

		$query = $this->db->get();

		if ($query->num_rows == 1){
			$row = $query->row(); 

			if ($row->status == 4 && $row->document_prepared && $row->contract_signed)
			{
				//date('Y-m-d H:i:s')
				$query = $this->db->query("UPDATE loan SET ".
					"closing_date=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 30 DAY) ".
					"WHERE loan_id=".$param["loan_id"]);
				}
		}
	}
	function get_product($loan_id,$product_detail=null)
	{
		//This will only be used when the borrower submit the first loan (continue after account activation)
		$this->db->select("*");
		$this->db->from("loan_product");
		
		if($product_detail!=null){
			$this->db->join("loan_detail", "loan_detail.loan_id=loan_product.loan_id", "LEFT");
		}
		
		$this->db->order_by("loan_product.loan_id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row(); 
   			 
	
	}
function get_by_user_id($borrower_id)
	{
		//This will only be used when the borrower submit the first loan (continue after account activation)
		$this->db->select("*");
		$this->db->from("loan");
		$this->db->where("borrower_id", $borrower_id);
		$this->db->where("is_deleted", 0);
		$this->db->order_by("loan_id", "desc");
		$this->db->limit(1);
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
	function get($loan_id)
	{
		$this->db->select("*");
		$this->db->from("loan_product");
	//	$this->db->join("loan_detail", "loan_detail.loan_id=loan_product.loan_id", "LEFT OUTER");
		$this->db->where("loan_product.loan_id", $loan_id);
		
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
	function get_product_by_code($code,$limit=null)
	{
		$this->db->select("*");
		$this->db->from("loan_product");
		$this->db->join("loan_detail", "loan_detail.loan_id=loan_product.loan_id", "LEFT OUTER");
		$this->db->where("loan_product.loan_code", $code);
		if($limit != null){
		$this->db->limit($limit);
		}
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
	
	function get_loan_product_by_code($code)
	{
		$this->db->select("*");
		$this->db->from("loan_product");
		
		$this->db->where("loan_product.loan_code", $code);
		
		$query = $this->db->get();
		
		return $query->result_array();
   			
		
	}
	
	function get_loan($loan_id)
	{
		$this->db->select("*");
		$this->db->from("loan");
		$this->db->where("loan_id", $loan_id);
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
		$this->db->from("loan");
		$this->db->where("code", $code);
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
function listing_for_investor()
	{
		$this->db->select("u.user_code,l.loan_id, l.code, l.b_salutation_id, l.amount, l.total_bid_amount, l.available_bid_amount, l.progress_percent, 
			l.period, l.loan_purpose_id, p.loan_purpose_name, l.loan_purpose_other, l.risk_id, r.risk_name, l.eir_percent, 
			l.code as borrower_code, l.b_company_paid_up_capital, l.b_company_man_power, l.b_company_revenue, l.b_company_is_new, l.submitted_date, l.b_company_name,l.status_suggest,
			l.closing_date, DATEDIFF( l.closing_date, CURDATE() ) AS time_left ");
		$this->db->from("loan l");
		$this->db->join("loan_purpose AS p", "l.loan_purpose_id=p.loan_purpose_id", "LEFT OUTER");
		$this->db->join("risk AS r", "l.risk_id=r.risk_id", "LEFT OUTER");
		$this->db->join("user AS u", "l.borrower_id=u.user_id", "LEFT OUTER");
		$this->db->where("l.is_deleted", 0);
		$this->db->where("l.status", 4);
		$this->db->where("l.document_prepared", 1);
		$this->db->where("l.contract_signed", 1);
		$this->db->order_by("l.loan_id", "desc");
		//$this->db->order_by("l.amount", "asc");
		$query = $this->db->get();

		return $query->result();
	}
	function get_count($status)
	{
		$this->db->select("COUNT(l.loan_id) AS record_count");
		$this->db->from("loan l");
		$this->db->where("l.is_deleted", 0);
		if ($status != "-1")
		{
			$this->db->where("l.status", $status);
		}
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
		$this->db->select("l.loan_id, l.code, l.b_salutation_id, l.b_full_name, l.b_mobile_phone, l.b_email, l.b_company_name, l.amount, l.period, l.status, ub.full_name AS borrower_name, l.created_date, l.submitted_date, l.investment_id, i.code AS investment_code");
		$this->db->from("loan l");
		$this->db->join("user AS ub", "l.borrower_id=ub.user_id", "LEFT OUTER");
		$this->db->join("investment AS i", "l.investment_id=i.investment_id", "LEFT OUTER");
		$this->db->where("l.is_deleted", 0);
		$this->db->order_by("l.loan_id", "desc");
		if ($param["status"] != "-1")
		{
			$this->db->where("l.status", $param["status"]);
		}
		$query = $this->db->get();

		return $query->result();
	}

	function listing_my()
	{
		$this->db->select("l.loan_id, l.code, l.b_salutation_id, l.b_full_name, l.b_mobile_phone, l.b_email, l.b_company_name, l.amount, l.period, l.status, l.created_date, l.submitted_date");
		$this->db->from("loan l");
		$this->db->where("l.borrower_id", get_cookie("user_id"));
		$this->db->where("l.status <>", 0);
		$this->db->where("l.is_deleted", 0);
		$this->db->order_by("l.loan_id", "desc");
		$query = $this->db->get();

		return $query->result();
	}

	function update($param)
	{
		//(pinjaman/100)*15)/bulan)+(pinjaman/bulan)  +($pinjaman/$param["period"]*12      +($pinjaman/$param["period"]*12)
		$pinjaman=preg_replace("/[^0-9]/", "", $param["amount"]);
		$persenbulan=12/$param["period"];
		$persen1=(15/100)/$persenbulan;
		$persen2=(20/100)/$persenbulan;
		$cicilanpokok=($pinjaman/$param["period"]);
		$bunga_1=(($pinjaman*$persen1)/$param["period"]);
		$bunga_2=(($pinjaman*$persen2)/$param["period"]);
		$total_cicilan_1=$cicilanpokok+$bunga_1;
		$total_cicilan_2=$cicilanpokok+$bunga_2;
		//preg_replace("/[^0-9]/", "", $param["b_company_revenue"]);
		//preg_replace("/[^0-9]/", "", $param["b_company_paid_up_capital"]);
		$query = $this->db->query("UPDATE loan SET ".
			"borrower_id=".$param["borrower_id"].", ".
			"b_salutation_id=".$param["b_salutation_id"].", ".
			"b_full_name='".$this->db->escape_str($param["b_full_name"])."', ".
			"b_email='".$this->db->escape_str($param["b_email"])."', ".
			"b_mobile_phone='".$this->db->escape_str($param["b_mobile_phone"])."', ".
			"b_company_name='".$this->db->escape_str($param["b_company_name"])."', ".
			"b_company_registration='".$this->db->escape_str($param["b_company_registration"])."', ".
			"b_company_address='".$this->db->escape_str($param["b_company_address"])."', ".
			"b_company_postal_code='".$this->db->escape_str($param["b_company_postal_code"])."', ".
			"b_company_paid_up_capital=".preg_replace("/[^0-9]/", "", $param["b_company_revenue"]).", ".
			"b_ktp=".$this->db->escape_str($param["b_ktp"]).", ".
			"b_address='".$this->db->escape_str($param["b_address"])."', ".
			"b_provinsi='".$this->db->escape_str($param["b_provinsi"])."', ".
			"b_city='".$this->db->escape_str($param["b_city"])."', ".
			"b_postal_code='".$this->db->escape_str($param["b_postal_code"])."', ".
			"b_company_location='".$this->db->escape_str($param["b_company_location"])."', ".
			"b_company_man_power=".$param["b_company_man_power"].", ".
			"b_company_revenue=".preg_replace("/[^0-9]/", "", $param["b_company_paid_up_capital"]).", ".
			"amount='".preg_replace("/[^0-9]/", "", $param["amount"])."', ".
			"period='".$param["period"]."', ".
			"b_cicilan_1='".$this->db->escape_str($total_cicilan_1)."', ".
			"b_cicilan_2='".$this->db->escape_str($total_cicilan_2)."', ".
			"status='1', ".
			"loan_purpose_id='".$param["loan_purpose_id"]."', ".
			"loan_purpose_other='".$this->db->escape_str($param["loan_purpose_other"])."' ".
			"WHERE loan_id=".$param["loan_id"]);
	}
	function update_loan_user($param)
	{

		$query = $this->db->query("UPDATE loan SET ".
			"borrower_id=".$param["borrower_id"].", ".
			"b_salutation_id=".$param["b_salutation_id"].", ".
			"b_full_name='".$this->db->escape_str($param["b_full_name"])."', ".
			"b_email='".$this->db->escape_str($param["b_email"])."', ".
			"b_mobile_phone='".$this->db->escape_str($param["b_mobile_phone"])."', ".
			"b_company_name='".$this->db->escape_str($param["b_company_name"])."' ".
			"WHERE loan_id=".$param["loan_id"]);
	}

	function update_investment($param)
	{
		$query = $this->db->query("UPDATE loan SET ".
			"investment_id=".$param["investment_id"]." ".
			"WHERE loan_id=".$param["loan_id"]);
	}

	function update_status($param)
	{
		$query = $this->db->query("UPDATE loan SET ".
			"status=".$param["status"]." ".
			"WHERE loan_id=".$param["loan_id"]);

		if ($param["status"] == 2)
		{
			$query = $this->db->query("UPDATE loan SET ".
				"submitted_date='".date('Y-m-d H:i:s')."' ".
				"WHERE loan_id=".$param["loan_id"]);			
		}
	}

	function update_status_by_admin($param)
	{
		$query = $this->db->query("UPDATE loan SET ".
			"status=".$param["status"]." ".
			"WHERE loan_id=".$param["loan_id"]);
	}

}