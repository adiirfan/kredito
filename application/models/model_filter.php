<?php
class Model_filter extends CI_Model{

	function add($param)
	{
		$this->db->select("*");
		$this->db->from("filter");
		$this->db->where("menu_id", $param["menu_id"]);
		$this->db->where("user_id", get_cookie("admin_userid"));
		$query = $this->db->get();
		
		if ($query->num_rows >= 1){
   			$query = $this->db->query("UPDATE filter SET ".
				"value1='".$this->db->escape_str($param["value1"])."', ".
				"value2='".$this->db->escape_str($param["value2"])."', ".
				"value3='".$this->db->escape_str($param["value3"])."', ".
				"value4='".$this->db->escape_str($param["value4"])."', ".
				"value5='".$this->db->escape_str($param["value5"])."', ".
				"value6='".$this->db->escape_str($param["value6"])."', ".
				"value7='".$this->db->escape_str($param["value7"])."', ".
				"value8='".$this->db->escape_str($param["value8"])."', ".
				"value9='".$this->db->escape_str($param["value9"])."', ".
				"value10='".$this->db->escape_str($param["value10"])."' ".
				"WHERE menu_id=".$param["menu_id"]." ".
				"AND user_id=".get_cookie("admin_userid"));
		}
		else
		{
			$query = array(
				"menu_id" => $param["menu_id"],
				"user_id" => get_cookie("admin_userid"),
				"value1" => $param["value1"],
				"value2" => $param["value2"],
				"value3" => $param["value3"],
				"value4" => $param["value4"],
				"value5" => $param["value5"],
				"value6" => $param["value6"],
				"value7" => $param["value7"],
				"value8" => $param["value8"],
				"value9" => $param["value9"],
				"value10" => $param["value10"]
			);
			
			$this->db->insert('filter', $query);
		}
	}

	function get($menu_id)
	{
		$this->db->select("*");
		$this->db->from("filter");
		$this->db->where("menu_id", $menu_id);
		$this->db->where("user_id", get_cookie("admin_userid"));
		
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
?>