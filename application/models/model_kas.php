<?php
class Model_kas extends CI_Model{

	/*
	Status:
		ic: IC
		pa: Proof of Address
	*/
	function add_investment($param)
	{
		$code = strtoupper(random_string('alpha', 6));
		$query = array(
			"kas_code" => $code,
			"nilai" => $param["nilai"],
			
			"type" => 1,  
			"minus_or_plus" => "+",
			"submitted_date" => date('Y-m-d h:i:s'),
			"user_id" => $param["user_id"],
			"created_date" => date('Y-m-d h:i:s'),
			"investment_id" =>  $param["investment_id"],
			"status" => 0
		);
		
		$this->db->insert('kas', $query);
		$data["kas_id"] = $this->db->insert_id();
		return $data;
	}
	
	function add_bid($param)
	{
		$code = strtoupper(random_string('alpha', 6));
		$query = array(
			"kas_code" => $code,
			"nilai" => $param["nilai"],
			"type" => 2,
			"minus_or_plus" => "-",
			"submitted_date" => date('Y-m-d h:i:s'),
			"user_id" => $param["user_id"],
			"created_date" => date('Y-m-d h:i:s'),
			"bid_id" =>  $param["bid_id"],
			"status" => 2
		);
		
		$this->db->insert('kas', $query);
		$data["kas_id"] = $this->db->insert_id();
		return $data;
	}

	function get($user_id,$investor=null)
	{
		
		$this->db->select('kas.submitted_date,kas.nilai,kas.saldo,kas.investment_id,kas.bid_id,kas.minus_or_plus,bid.bid_code,investment.code_investment,kas.bid_id,kas.status,investment.fund');
		$this->db->from('kas');
		$this->db->join("bid", "kas.bid_id=bid.bid_id", "LEFT");
		$this->db->join("investment", "investment.investment_id=kas.investment_id", "LEFT");
			if($user_id != NULL){
			$this->db->where('kas.user_id',$user_id);
			}
			if($investor==null){
			$this->db->where('kas.status',2);
			}else{
					$this->db->where('kas.status <=',1);
			}
			
			$this->db->order_by("kas.submitted_date", "desc");
		 $query = $this->db->get('');
		return $query->result_array();
	}

	function update_kas_bid($param)
	{
		$query = $this->db->query("UPDATE kas SET ".
			"status='".$param["status"]."', ".
		
			"submitted_date='".date('Y-m-d h:i:s')."' ".
			"WHERE user_id='".$param["user_id"]."' AND bid_id='".$param["bid_id"]."' ");
	}
	function update_kas_investment($param)
	{
		
		$query = $this->db->query("UPDATE kas SET ".
			"status='".$param["status"]."', ".
			"submitted_date='".date('Y-m-d h:i:s')."' ".
			"WHERE user_id='".$param["investor_id"]."' AND investment_id='".$param["investment_id"]."' ");
	}
	
	function jumlah_investment($user_id){
	$this->db->select("sum(nilai)");
		$this->db->from("kas");
		
			$this->db->where('kas.type',1);
			$this->db->where('kas.status',2);
			$this->db->where('kas.user_id',$user_id);
	//	$this->db->order_by("loan_id", "desc");
		$query = $this->db->get('');
		return $query->row_array();
	}
	
	function jumlah_bid($user_id){
		$this->db->select("sum(nilai)");
		$this->db->from("kas");
		$this->db->where('kas.type',2);
		$this->db->where('kas.status',2);
		$this->db->where('kas.user_id',$user_id);
		$query = $this->db->get('');
		return $query->row_array();
	}
	
	function jumlah_saldo($investment,$bid){
		
		$saldo=$investment - $bid;
		
		return $saldo;
		
	}
	
	function update_saldo($param)
	{
		$query = $this->db->query("UPDATE kas SET ".
			"saldo='".$this->db->escape_str($param["saldo"])."', ".
		
			"submitted_date='".date('Y-m-d h:i:s')."' ".
			"WHERE user_id='".$param["investor_id"]."' AND investment_id='".$param["investment_id"]."' ");
	}
	
	function update_saldo_bid($param)
	{
		$query = $this->db->query("UPDATE kas SET ".
			"saldo='".$this->db->escape_str($param["saldo"])."', ".
		
			"submitted_date='".date('Y-m-d h:i:s')."' ".
			"WHERE user_id='".$param["user_id"]."' AND bid_id='".$param["bid_id"]."' ");
	}
	
	function cek_idbid_in_kas($idbid)
	{
		$this->db->select("bid_id");
		$this->db->from("kas");	
		$this->db->where("bid_id", $idbid);
		$query = $this->db->get();
		
			if ($query->num_rows() > 0)
			{
				$data=1;
			}else{
				$data=0;
			}
			return $data;
	}
	
	function get_saldo($id_user)
	{
		$this->db->select("saldo");
		$this->db->from("kas");	
		$this->db->where("user_id", $id_user);
		$this->db->where('kas.status',2);
		$this->db->order_by("kas_id", "desc");
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
	

}