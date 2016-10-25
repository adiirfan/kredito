<?php
class Model_backend extends CI_Model{

	function view_product_company()
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
		
		$this->db->select('product_id,product_code,product_id,product_main_id,product_name');
		$this->db->from('product');
		 $query = $this->db->get('');
		return $query->result_array();
	}
	

}