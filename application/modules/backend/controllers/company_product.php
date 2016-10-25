<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class company_product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	  function __construct()
	 {
		 parent:: __construct();
		 if ($this->session->userdata('username')=="") {
			redirect('auth');
		}
		 $this->load->library('template');	
		
		$this->load->model('model_backend');
		 
	 }
	 
	public function index($product=NULL)
	{ 
	$data['segment'] = $this->uri->segment(2);
	
	$data['product'] =$this->model_backend->view_product();
	$data['company'] =$this->model_backend->view_company();
	$data['company_product'] =$this->model_backend->view_product_company();
	$data['product'] =$this->model_backend->view_product();
	$this->template->display('company_product',$data);
		
	}
	public function car_refinancing()
	{ 
	$data['segment'] = $this->uri->segment(2);
	$data['table']="tableproduct";
	$data['product'] =$this->model_backend->view_product();
	$data['company'] =$this->model_backend->view_company();
	$data['company_product'] =$this->model_backend->view_product_company();
	$data['product'] =$this->model_backend->view_product();
	$this->template->display('company_product',$data);
		
	}
	public function property_refinancing()
	{ 
	$data['segment'] = $this->uri->segment(2);
	$data['table']="tableproperty";
	$data['product'] =$this->model_backend->view_product();
	$data['company'] =$this->model_backend->view_company();
	$data['company_product'] =$this->model_backend->view_product_company();
	$data['product'] =$this->model_backend->view_product();
	$this->template->display('company_product',$data);
		
	}
	public function edit_company_product($id=NULL)
	{ 
	
	$data=$this->model_backend->form_product_company($id);
	echo json_encode($data);
	//$this->template->display('data_product',$data);
		
	}
	public function add_company_product($id=NULL)
	{ 
	$id=$this->input->post('company_product_id',true);
	$pinalty='1';
	if($this->input->post('pinalty') != NULL){
		$pinalty='2';
	}
		$data = array(
				'product_id' => $this->input->post('product'),
                'company_id' => $this->input->post('company'),
				'company_product_name' => $this->input->post('product_name'),
				'down_payment' => $this->input->post('down_payment'),
				'interest_rate' => $this->input->post('interest_rate'),
                'company_product_condition' => $this->input->post('condition'), 
				'company_product_tenor' => $this->input->post('tenor'),
				'plafon_loan' => $this->input->post('plafon_loan'),
				'periode_pinalty' => $this->input->post('pinalty'),
				'pinalty_yes_no' => $pinalty,
				
				
		);
	if($id != NULL){
		
		$where ='company_product_id ='.$this->input->post('company_product_id');
		$this->db->update('company_product', $data, $where );
		
	}else{
		$this->db->insert('company_product', $data);
	}
		echo json_encode(array("status" => TRUE));
		
	}
	public function delete_company_product()
	{
		$tables = array('company_product');
		$this->db->where('company_product_id', $this->input->post('company_product_id'));
		$this->db->delete($tables);
		echo json_encode(array("status" => TRUE));
	}
	public function get_company_product()
	{ 
	$kategory=$this->input->get('kategory');
		$edit="edit";
		$delete="delete";
		$data = array();
		$mydata = array();
		//$list = $this->anggota->get_datatables();
		$data1 =$this->model_backend->view_product_company($kategory);
		$i=1;
		foreach($data1 as $row){
			$condition=null;
			if($row['company_product_condition'] == 1){
				$condition= "Baru";
			}else{
				$condition= "Bekas";
			}
			
			$id=$row['company_product_id'];
			$image=$row['company_image'];
			$mydata = array();
			$mydata[]= $i;
			//$mydata[]=  'tes';
			$mydata[]=  '<img src="'.base_url().'uploads/company/'.$row['company_image'].'" width="50px" height="50px"></img>';
			$mydata[]=$row['company_product_name'];
			if($kategory==1){
			$mydata[]=$row['down_payment'];
			}
			$mydata[]=$row['interest_rate'].' %';
			if($kategory==1){
			$mydata[]=$condition;
			}else if($kategory==2){
				$mydata[]=$row['plafon_loan'].' %';
				$mydata[]=$row['periode_pinalty'].' Tahun';
			}
			$mydata[]="<a href=\"javascript:;\" onclick=\"detail_data('$id','edit')\">
						
						<i class=\"fa fa-fw fa-pencil\" style=\"font-size:20px;color:yellow;\"></i></a>
						
						<a href=\"javascript:;\" onclick=\"detail_data('$id','delete')\">
						<i class=\"fa fa-fw fa-trash\" style=\"font-size:20px;color:red;\"></i>";
			$data[] = $mydata;
			$i++;
		}
		//$output = array(
						//"draw" =>  0,
						//"recordsTotal" => 57,
						//"recordsFiltered" => 57,
					//	"aaData" => $data,
					//	);
	
		//echo json_encode($output);
	
		echo json_encode(array('aaData'=>$data));
	}
	public function get_company_product1()
	{
	
		echo '{
  "aaData": [
    [
      "row 1 col 1 data",
      "row 1 col 2 data",
      "row 1 col 3 data",
      "row 1 col 4 data"
    ],
    [
      "row 2 col 1 data",
      "row 2 col 2 data",
      "row 2 col 3 data",
      "row 2 col 4 data"
    ],
    [
      "row 3 col 1 data",
      "row 3 col 2 data",
      "row 3 col 3 data",
      "row 3 col 4 data"
    ],
    [
      "row 4 col 1 data",
      "row 4 col 2 data",
      "row 4 col 3 data",
      "row 4 col 4 data"
    ]
  ]
}';
	}


}