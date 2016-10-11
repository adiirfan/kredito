<?php
class Model_menu extends CI_Model{

	function listing($param)
	{
		$this->db->select("*");
		$this->db->from("menu");
		$this->db->order_by("menu_name", "asc");
		if ($param["parent_id"] != "-1")
		{
			$this->db->where("parent_id", $param["parent_id"]);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	
}
?>