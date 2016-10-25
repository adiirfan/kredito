<?php
class Model_activity_log extends CI_Model{

	function add($param)
	{
		$query = array(
			"menu_id" => $param["menu_id"],
			"action" => $param["action"],
			"action_id" => $param["action_id"],
			"action_name" => $param["action_name"],
			"user_id" => get_cookie("admin_userid"),
			"date" => date('Y-m-d H:i:s')
		);
		
		$this->db->insert('activity_log', $query);
	}

	function listing($param)
	{
		$this->db->select("a.activity_log_id, a.menu_id, m.menu_name, a.action, a.action_name, a.user_id, uc.full_name AS created_user, a.date");
		$this->db->from("activity_log a");
		$this->db->join("menu AS m", "a.menu_id=m.menu_id", "LEFT OUTER");
		$this->db->join("sys_user AS uc", "a.user_id=uc.sys_user_id", "LEFT OUTER");
		$this->db->order_by("a.date", "desc");
		if ($param["user_id"] != "0")
		{
			$this->db->where("a.user_id", $param["user_id"]);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	
}
?>