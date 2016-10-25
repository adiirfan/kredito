<?php
class Model_backend extends CI_Model{

	//LOGIN
	public function User_Login($username) {
			$this->db->select('users.username,users.password,users.id_user,users.id_level,level.nama_level');
			$this->db->from('users');
			$this->db->join('level', 'users.id_level=level.id_level','left');
			$this->db->where("username", $username);
       
			$query = $this->db->get('');
			return $query->row_array();
    }
	
	function view_product_company($kategory=null)
	{
		
		$this->db->select('*');
		$this->db->from('company_product');
			$this->db->join('company', 'company.company_id=company_product.company_id','left');
			$this->db->join('product', 'company_product.product_id=product.product_id','left');
			if($kategory != NULL){
			$this->db->where('company_product.product_id',$kategory);
			}
		 $query = $this->db->get('');
		return $query->result_array();
	}
	function view_main_product()
	{
		
		$this->db->select('product_main_id,product_main_code,product_main_name');
		$this->db->from('product_main');
		 $query = $this->db->get('');
		return $query->result_array();
	}
	function view_product()
	{
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('product_main', 'product.product_main_id=product_main.product_main_id','left');
		 $query = $this->db->get('');
		return $query->result_array();
	}
	function view_company()
	{
		
		$this->db->select('*');
		$this->db->from('company');
		 $query = $this->db->get('');
		return $query->result_array();
	}
	function view_sumbmission_loan()
	{
		$this->db->select('*');
		$this->db->from('loan_product');
		$this->db->join('loan_detail', 'loan_product.loan_id=loan_detail.loan_id','left');
		$this->db->join('company_product', 'company_product.company_product_id=loan_product.company_product_id','left');
		$this->db->where('is_deleted ','0');
		$this->db->where('loan_status !=','0');
		$this->db->order_by('loan_create_at DESC');
		 $query = $this->db->get('');
		return $query->result_array();
	}
	function select_multiple_loan($loan_id)
	{
		$this->db->select('*');
		$this->db->from('loan_product_multiple');
		$this->db->join('company_product', 'company_product.company_product_id=loan_product_multiple.company_product_id','left');
		$this->db->where('loan_product_multiple.loan_id',$loan_id);
		$query = $this->db->get('');
		return $query->result_array();
	}
	function view_sumbmission_loan_business($id_user=null)
	{
		$this->db->select('*');
		$this->db->from('loan');
		$this->db->where('is_deleted ','0');
		$this->db->where('status >= ','1');
		
		if($id_user==2){
			$this->db->where('cs_approve >= ','1');
		}
		
		$this->db->order_by('submitted_date DESC');
		$query = $this->db->get('');
		return $query->result_array();
	}
	function check_doc_upload($id)
	{
		
		$this->db->select('count(loan_id)');
		$this->db->from('loan_document');
		$this->db->where('loan_document.loan_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	function status_submission($value)
	{
		$status="";
		if($value == 1){
		$status= '<span class="label label-danger">Menunggu Dokumen</span>';
		}else if($value == 2){
		$status= '<span class="label label-warning">Diajukan</span>';
		}else if($value == 3){
		$status= '<span class="label label-info">Dalam proses</span>';
		}else if($value == 4){
		$status= '<span class="label label-success">Telah diverifikasi</span>';
		}else if($value == 5){
		$status= '<span class="label label-success">Ditolak</span>';
		}else if($value == 6){
		$status= '<span class="label label-success">Dibatalkan</span>';
		}else if($value == 7){
		$status= '<span class="label label-success">Proses Pencairan Dana</span>';
		}else if($value == 8){
		$status= '<span class="label label-success">Selesai</span>';
		}else if($value == 10){
		$status= '<span class="label label-success">Telah diverifikasi CS</span>';
		}
		return $status;
	}
	function status_investor($value)
	{
		$status="";
		if($value == 1){
		$status= '<span class="label label-danger">Menunggu Upload Dokumen</span>';
		}else if($value == 2){
		$status= '<span class="label label-danger">Belum Disetujui</span>';
		}
		else if($value == 3){
		$status= '<span class="label label-info">Disetujui</span>';
		}else if($value == 6){
		$status= '<span class="label label-success">Dibatalkan</span>';
		}
		return $status;
	}
	function status_bid($value)
	{
		$status="";
		if($value == 0){
		$status= '<span class="label label-danger">Menunggu Konfirmasi email</span>';
		}else if($value == 1){
		$status= '<span class="label label-info">Berhasil</span>';
		}else if($value == 2){
		$status= '<span class="label label-success">Dibatalkan</span>';
		}
		return $status;
	}
	function status_investment($value)
	{
		$status="";
		if($value == 1){
		$status= '<span class="label label-danger">Menunggu Pembayaran</span>';
		}else if($value == 2){
		$status= '<span class="label label-info">Belum Disetujui</span>';
		}else if($value == 3){
		$status= '<span class="label label-success">Disetujui</span>';
		}
		else if($value == 4){
		$status= '<span class="label label-success">Ditolak</span>';
		}
		return $status;
	}
	public function form_company($idcompany) {
			$this->db->select('*');
			$this->db->from('company');
			$this->db->where("company_id", $idcompany);
			$query = $this->db->get('');
			if ($query->num_rows() > 0)
			{
			 $row = $query->row();
			$data['company_id']=$row->company_id;
			$data['company_code']=$row->company_code;
			$data['company_name']=$row->company_name;
			$data['company_email']=$row->company_email;
			$data['company_phone']=$row->company_phone;
			$data['company_address']=$row->company_address;
			$data['company_image']=$row->company_image;
			}else{
			$data['company_id']="";
			$data['company_code']="";
			$data['company_name']="";
			$data['company_email']="";
			$data['company_phone']="";
			$data['company_address']="";
			$data['company_image']="";
			}
			return $data;
	}
	function form_product_company($id)
	{
		
		$this->db->select('*');
		$this->db->from('company_product');
			$this->db->join('company', 'company.company_id=company_product.company_id','left');
			$this->db->join('product', 'company_product.product_id=product.product_id','left');
			
			$this->db->where('company_product.company_product_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	
	function form_repayment($id)
	{
		$this->db->select("loan_repayment_id,loan_id,schedule, principal, interest, instalment, balance, status");
		$this->db->from("loan_repayment");
		$this->db->where('is_deleted', 0);
		$this->db->where("loan_repayment_id", $id);
		//$this->db->order_by("schedule", "asc");
		$query = $this->db->get();

		return $query->row_array();
	}
	
	function form_submission_loan($id)
	{
		
		$this->db->select('*');
		$this->db->from('loan_product');
			$this->db->join('loan_detail', 'loan_product.loan_id=loan_detail.loan_id','left');
			$this->db->join('company_product', 'company_product.company_product_id=loan_product.company_product_id','left');
			$this->db->join('product', 'company_product.product_id=product.product_id','left');
			$this->db->join('company', 'company_product.company_id=company.company_id','left');
			
			$this->db->where('loan_product.loan_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	
	function form_submission_loan_business($id)
	{
		
		$this->db->select('*');
		$this->db->from('loan');
		$this->db->join('bid', 'loan.loan_id=bid.loan_id','left');
		$this->db->join('man_power', 'loan.b_company_man_power=man_power.man_power_id','left');
		$this->db->where('loan.loan_id',$id);	
		$query = $this->db->get('');
		return $query->row_array();
	}
	function form_submission_loan_business2($id)
	{
		
		$this->db->select('*');
		$this->db->from('loan');
		
		$this->db->where('loan.loan_id',$id);	
		$query = $this->db->get('');
		return $query->row_array();
	}
	function form_payment($id)
	{
		
		$this->db->select('*');
		$this->db->from('loan_repayment');
		
		$this->db->where('loan_repayment.loan_repayment_id',$id);	
		$query = $this->db->get('');
		return $query->row_array();
	}
	function form_category_product($id)
	{
		
		$this->db->select('*');
		$this->db->from('product');
			
			
			$this->db->where('product.product_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	function form_product_main($id)
	{
		
		$this->db->select('*');
		$this->db->from('product_main');
			
			
			$this->db->where('product_main.product_main_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	function form_company_modal($id)
	{
		
		$this->db->select('*');
		$this->db->from('company');
			
			
			$this->db->where('company.company_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	function view_document_loan($id)
	{
		
		$this->db->select('loan_document.file_name,loan.folder_code');
		$this->db->from('loan');
		$this->db->join('loan_document', 'loan_document.loan_id=loan.loan_id','left');
		$this->db->where('loan_document.loan_id',$id);
		$query = $this->db->get('');
		//return $query->row_array();
		return $query->result_array();
	}
	function view_document_investment($id)
	{
		
		$this->db->select('investment_document.file_name,investment.folder_code');
		$this->db->from('investment');
		$this->db->join('investment_document', 'investment_document.investment_id=investment.investment_id','left');
		$this->db->where('investment.investment_id',$id);
		$query = $this->db->get('');
		//return $query->row_array();
		return $query->result_array();
	}
	
	function form_investor($id)
	{
		
		$this->db->select('*');
		$this->db->from('user');
			$this->db->where('user_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	
	function form_investment($id)
	{
		
		$this->db->select('*');
		$this->db->from('investment');
			$this->db->where('investment_id',$id);
			
		 $query = $this->db->get('');
		return $query->row_array();
	}
	
	function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}
		/*
	var $table = 'company_product';
	var $column = array('company_image','company_product_name','down_payment','interest_rate','company_product_condition','company_product_id');
	var $order = array('company_product_id' => 'asc');


	private function _get_datatables_query()
	{
		
		$this->db->from('company_product');
			$this->db->join('company', 'company.company_id=company_product.company_id','left');
			$this->db->join('product', 'company_product.product_id=product.product_id','left');

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	*/

}