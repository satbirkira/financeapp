<?php
class Goal_Model extends CI_Model {
	
	var $goalTitle = "";
	var $total = "";
	var $startDate = "";
	var $targetDate = "";
	var $monthlyDepot = "";	
	var $interestRate = "";	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function create_new_goal($arrGoal)
    {
		$result = $this->db->insert('goal',$arrGoal);
		//$goalId = $this->db->insert_id();		
		return $result;
    }
		
	function get_goal_details($gid)
	{
		$this->db->select('*');
		$this->db->from('goal');
		$this->db->where('goalId',$uid);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_goal($uid)
	{
		$this->db->select('*');
		$this->db->from('goal');
		$this->db->where('userId',$uid);
		$query = $this->db->get();
		return $query->result();
	}

	function remove_goal()
    {
		
    }
	
	function update_goal()
    {
		
    }
	
	function get_goals()
    {
		
    }

}
?>
