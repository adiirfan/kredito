<?php
class Model_bid extends CI_Model{

	function get_loan($loan_id)
	{
		//This will only be used when the borrower submit the first loan (continue after account activation)
		$this->db->select("*");
		$this->db->from("loan");
		$this->db->order_by("loan_id", "desc");
		$this->db->where('status >=','2');
		$query = $this->db->get('');
		return $query->result_array();
	}
	
	function get_sum_bid($loan_id,$status=null,$user=null)
	{
		//This will only be used when the borrower submit the first loan (continue after account activation)
		$this->db->select("sum(bid_amount)");
		$this->db->from("loan");
		$this->db->join('bid', 'loan.loan_id=bid.loan_id','left');
			$this->db->where('loan.loan_id',$loan_id);
			$this->db->where('bid.bid_status',$status);
			
			if($user != null){
				$this->db->where('bid.user_id',$user);
			}
		
	//	$this->db->order_by("loan_id", "desc");
		$query = $this->db->get('');
		return $query->row_array();
	}
	function percentase_bid($sum_amount_bid)
	{
		//This will only be used when the borrower submit the first loan (continue after account activation)
		$this->db->select("sum(bid_amount)");
		$this->db->from("loan");
		$this->db->join('bid', 'loan.loan_id=bid.loan_id','left');
			$this->db->where('loan.loan_id',$loan_id);
	//	$this->db->order_by("loan_id", "desc");
		$query = $this->db->get('');
		return $query->row_array();
	}
	function show_bid_data($loan_id)
	{
		//This will only be used when the borrower submit the first loan (continue after account activation)
		$this->db->select("*");
		$this->db->from("loan");
		$this->db->join('bid', 'loan.loan_id=bid.loan_id','left');
		$this->db->join('man_power', 'loan.b_company_man_power=man_power.man_power_id','left');
		//$this->db->join('loan_document', 'loan_document.loan_id=loan.loan_id');
			$this->db->where('loan.loan_id',$loan_id);
	//	$this->db->order_by("loan_id", "desc");
		$query = $this->db->get('');
		return $query->row_array();
	}
	function get_bids($id)
	{
		$this->db->select("*");
		$this->db->from("bid");
		$this->db->join('loan', 'loan.loan_id=bid.loan_id','left');
		$this->db->where("bid.user_id", $id);
		$this->db->order_by('bid_id DESC');
		$query = $this->db->get();

		return $query->result_array();
	}
	function get_bids_by_loan($id_loan)
	{
		$this->db->select("*");
		$this->db->from("bid");
		$this->db->join('loan', 'loan.loan_id=bid.loan_id','left');
		$this->db->join('user', 'bid.user_id=user.user_id','left');
		$this->db->where("bid_status", 1);
		$this->db->where("bid.loan_id", $id_loan);
		$this->db->order_by('bid_id DESC');
		$query = $this->db->get();

		return $query->result_array();
	}
	function get_total_bid($user_id=null)
	{
		$this->db->select("sum(bid_amount) as total");
		$this->db->from("bid");
		$this->db->where("user_id", $user_id);
		$this->db->where("bid_status", 1);
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
	function get_list_bids($percentase_bid=null,$status=null)
	{
		$this->db->select("*");
		$this->db->from("loan");
		//$this->db->join('loan', 'loan.loan_id=bid.loan_id','left');
		if($percentase_bid != null){
		$this->db->where("progress_percent >= ", $percentase_bid);
		}
		if($status != null ){
			$this->db->where("status_suggest", $status);
		}else{
			$this->db->where("status_suggest <=", 1);
		}
		$this->db->where("is_deleted", 0);
		$this->db->where("status", 4);
		$this->db->where("document_prepared", 1);
		$this->db->where("contract_signed", 1);
		$this->db->order_by('progress_percent DESC');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	
	function get_total_bid_by_loan($loan_id=null)
	{
		$this->db->select("sum(bid_amount) as total");
		$this->db->from("bid");
		$this->db->where("loan_id", $loan_id);
		$this->db->where("bid_status", '1');
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
	
	function update_total_loan_bid($jumlah,$loan_id,$loan_amount)
	{
		$persentasi=round(($jumlah * 100) / $loan_amount);
		$sisa=$loan_amount-$jumlah;
		$query = $this->db->query("UPDATE loan SET ".
			"total_bid_amount='".$jumlah."',progress_percent='".$persentasi."',available_bid_amount='".$sisa."' ".
			"WHERE loan_id='".$loan_id."'");
	}
	
	
	
	
	function min_bid_fund($fund=null,$bid=null)
	{
		$total=$fund-$bid;
		
   		return $total;
		
	}
	function activation_bid($param)
	{
		$date = date_create();
		
		$query = $this->db->query("UPDATE bid SET ".
			"bid_status='1',activation_date='".date_format($date, 'Y-m-d h:i:s')."' ".
			"WHERE activation_code='".$param."'");
	}
	
	function select_by_activation($code)
	{
		$this->db->select("*");
		$this->db->from("bid");
		$this->db->where("activation_code", $code);
		
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
}