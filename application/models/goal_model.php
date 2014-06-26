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
	
	function get_all_goals($uid)
	{
		$data = "";
		$sql = "SELECT *
				FROM goal
				WHERE userID = ?
				ORDER BY goalID desc ";
									
		$query = $this->db->query($sql,$uid);
		
		$i = 0;
		foreach($query->result_array() as $row){
			
			 $data[$i]['goalId'] = $row['goalID'];
     	     $data[$i]['goalName'] = $row['goalName'];
			 $data[$i]['startDate'] = $row['startDate'];
			 $data[$i]['targetDate'] = $row['targetDate'];
			 $data[$i]['totalCost'] = $row['totalCost'];
			 $data[$i]['monthlyDepot'] = $row['monthlyDepot'];
			 $data[$i]['interestRate'] = $row['interestRate'];
			 $data[$i]['currentlySaved'] = $row['currentlySaved'];			
 			 $data[$i]['goalStatus'] = $row['goalStatus'];			
			 
			 $i++;
		}
		
		
		return $data;	
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
