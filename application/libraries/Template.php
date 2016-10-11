<?php 

class Template{
protected $_ci;

	 function __construct()
	 {
		 $this->_ci=&get_instance();
	 }
	function display($template,$data=NULL){
		$data['_header']=$this->_ci->load->view("template/header",$data,true);
		$data['_menu']=$this->_ci->load->view("template/menu",$data,true);
		//$data['_js_edu']=$this->_ci->load->view("template/js_edu",$data,true);
		$data['_aset_atas']=$this->_ci->load->view("template/aset_atas",$data,true);
		$data['_control_sidebar']=$this->_ci->load->view("template/control_sidebar",$data,true);
		$data['_breadscrumb']=$this->_ci->load->view("template/breadscrumb",$data,true);
		$data['_content']=$this->_ci->load->view($template,$data,true);
		$data['_footer']=$this->_ci->load->view("template/footer.php",$data,true);
		$data['_aset_bawah']=$this->_ci->load->view("template/aset_bawah",$data,true);
		$this->_ci->load->view("template.php",$data);
	 }
	 
	function displaylogin(){
	 $this->_ci->load->view("login.php");
	}
}

?>