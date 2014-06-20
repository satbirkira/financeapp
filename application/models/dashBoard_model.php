<?php
class Dashboard_model extends CI_Model {
	


		$query = $this->db->get();
		return $query->result();
	}
	
	function get_user_screenName($uid)
	{
		$this->db->select('userScreenName');
		$this->db->from('user');
		$this->db->where('userId',$uid);
		$query = $this->db->get();
		return $query->result();
	}

}
?>
