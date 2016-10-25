<?php
class Model_credit extends CI_Model{

	function view_product($tenor=NULL,$condition=NULL,$id=NULL,$kategory=NULL,$pinalty=NULL)
	{
		
		$this->db->select('*');
		$this->db->from('company_product');
			$this->db->join('company', 'company.company_id=company_product.company_id','left');
			$this->db->join('product', 'company_product.product_id=product.product_id','left');
			if($tenor != NULL){
			$this->db->where('company_product.company_product_tenor',$tenor);
			}
			if($condition != NULL){
			$this->db->where('company_product.company_product_condition',$condition);
			}
			if($id != NULL){
			$this->db->where('company_product.company_product_id',$id);
			}
			if($kategory != NULL){
			$this->db->where('company_product.product_id',$kategory);
			}
			if($pinalty != NULL){
			//$this->db->where('company_product.periode_pinalty =','0');
			if($pinalty == 1  ){
			$this->db->where('company_product.pinalty_yes_no','1');
			}else if($pinalty == 2){
				//kodisi untuk product yang semuanya (KPR)
				$this->db->where('company_product.pinalty_yes_no >=','2');
			}
			}
		 $query = $this->db->get('');
		return $query->result_array();
	}
	
	function select_product($id=NULL)
	{
		
		$this->db->select('*');
		$this->db->from('company_product');
			$this->db->join('company', 'company.company_id=company_product.company_id','left');
			$this->db->join('product', 'company_product.product_id=product.product_id','left');
			$this->db->where('company_product.company_product_id',$id);
		
		 $query = $this->db->get('');
		return $query->row_array();
	}
	public function max_idloan(){
		$this->db->select('max(loan_id)');
		$this->db->from('loan_product');
		$query = $this->db->get('');
		return $query->row_array();
	}
	
	public function max_min_interest($id){
		$this->db->select('max(interest_rate) as max_interest,min(interest_rate) as min_interest');
		$this->db->from('company_product');
		$this->db->where('company_product.product_id',$id);
		$query = $this->db->get('');
		return $query->row_array();
	}
	
		public function select_id_from_code($tabel,$row,$code,$from){
		$this->db->select($row);
		$this->db->from($tabel);
		$this->db->where('loan_code',$code);
		$query = $this->db->get('');
		return $query->row_array();
		 } 
		 public function select_id_from_code_2($tabel,$row,$code,$from){
		$this->db->select('*');
		$this->db->from($tabel);
		$this->db->join('company_product', 'company_product.company_product_id=loan_product.company_product_id','left');
		$this->db->join('product', 'company_product.product_id=product.product_id','left');
		$this->db->join('company', 'company_product.company_id=company.company_id','left');
		$this->db->where('loan_code',$code);
		$query = $this->db->get('');
		return $query->row_array();
		 } 

		function random_generator($digits) {
				srand((double) microtime() * 10000000);
		//Array of alphabets
				$input = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q",
					"R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		 
				$random_generator = ""; // Initialize the string to store random numbers
				for ($i = 1; $i < $digits + 1; $i++) { // Loop the number of times of required digits
					if (rand(1, 2) == 1) {// to decide the digit should be numeric or alphabet
		// Add one random alphabet
						$rand_index = array_rand($input);
						$random_generator .=$input[$rand_index]; // One char is added
					} else {
		 
		// Add one numeric digit between 1 and 10
						$random_generator .=rand(1, 10); // one number is added
					} // end of if else
				} // end of for loop
		 
				return $random_generator;
			}
		
		function view_sumbmission_loan($user_id)
	{
		
		$this->db->select('*');
		$this->db->from('loan_product');
		$this->db->join('loan_detail', 'loan_product.loan_id=loan_detail.loan_id','left');
		$this->db->join('company_product', 'company_product.company_product_id=loan_product.company_product_id','left');
		$this->db->where('loan_status >=','1');
		$this->db->where('loan_product.user_id >=',$user_id);
		$this->db->order_by('loan_create_at DESC');
		 $query = $this->db->get('');
		return $query->result_array();
	}
	function view_sumbmission_loan_2($user_id,$email,$group_code=null)
	{
		
		$this->db->select('*');
		$this->db->from('loan_product');
		$this->db->join('loan_detail', 'loan_product.loan_id=loan_detail.loan_id','left');
		$this->db->join('company_product', 'company_product.company_product_id=loan_product.company_product_id','left');
		$this->db->where('loan_status >=','1');
		$this->db->where('loan_product.user_id >=',$user_id);
		$this->db->or_where('loan_detail.loan_email',$email);
		$this->db->order_by('loan_create_at DESC');
		 $query = $this->db->get('');
		 
		 if ($query->num_rows < 1){
		$this->db->select('*');
		$this->db->from('loan_product');
		$this->db->join('loan_detail', 'loan_product.loan_code=loan_detail.loan_code','left');
		$this->db->join('company_product', 'company_product.company_product_id=loan_product.company_product_id','left');
		$this->db->where('loan_status >=','1');
		$this->db->where('loan_product.user_id >=',$user_id);
		$this->db->or_where('loan_detail.loan_email',$email);
		$this->db->group_by('loan_product.loan_code');
		$this->db->order_by('loan_create_at DESC');
		 $query = $this->db->get('');
		 
		}
		 
		 
		return $query->result_array();
	}
	function set_value_sumbmission($user_id=NULL)
	{
		
			$this->db->select('*');
			$this->db->from('loan_product');
			$this->db->join('loan_detail', 'loan_product.loan_id=loan_detail.loan_id','left');
			//$this->db->where("loan_detail.loan_detail_id", 'max(loan_detail_id)');
			if($user_id != NULL){
			$this->db->where("loan_product.user_id", $user_id);
			$this->db->order_by('loan_detail_id DESC');
			$this->db->limit(1);
			}
			$query = $this->db->get('');
			if($user_id == NULL) {
				$data['loan_nik']="";
			$data['loan_name']="";
			$data['loan_pod']="";
			$data['loan_bod']="";
			$data['loan_address']="";
			$data['loan_city']="";
			$data['loan_postal_code']="";
			$data['loan_gender']="";
			$data['loan_email']="";
			$data['loan_phone']="";
			} else {
			if ($query->num_rows() > 0)
			{
			 $row = $query->row();
			 $data['loan_nik']=$row->loan_nik;
			$data['loan_name']=$row->loan_name;
			$data['loan_pod']=$row->loan_pod;
			$data['loan_bod']=$row->loan_bod;
			$data['loan_address']=$row->loan_address;
			$data['loan_city']=$row->loan_city;
			$data['loan_postal_code']=$row->loan_postal_code;
			$data['loan_gender']=$row->loan_gender;
			$data['loan_email']=$row->loan_email;
			$data['loan_phone']=$row->loan_phone;
			
			}else {
			 $data['loan_nik']="";
			$data['loan_name']="";
			$data['loan_pod']="";
			$data['loan_bod']="";
			$data['loan_address']="";
			$data['loan_city']="";
			$data['loan_postal_code']="";
			$data['loan_gender']="";
			$data['loan_email']="";
			$data['loan_phone']="";
			}
			}
			return $data;
	}
	

}