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
		$data = "";
		$sql = "SELECT *
				FROM goal
				WHERE goalID = ? ";
									
		$query = $this->db->query($sql,$gid);
		
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
	
	function update_goal($gid,$amount,$status)
    {
		$data = array(
						'currentlySaved' => $amount,
						'goalStatus' => $status
				);				
		$this->db->where('goalID',$gid);
		$this->db->update('goal',$data);
		
		$affected = $this->db->affected_rows();
		
		return $affected;
    }
	
	function get_goals()
    {
		
    }

}
?>
