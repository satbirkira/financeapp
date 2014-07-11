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
				and goalStatus = 0 
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
	
	function get_collaborate_goals($uid)
	{
		$data = "";
		$sql = "SELECT *
				FROM goal g,goalmember m
				WHERE m.userId = ?
				  and g.goalID = m.goalId
  				  and g.goalStatus = 0 
				  and g.userID != ?
				ORDER BY g.goalID desc ";
									
		$query = $this->db->query($sql,array($uid,$uid));
		
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

	function remove_goal($gid)
    {
		$data = array(
						'goalStatus' => 1
				);				
		$this->db->where('goalID',$gid);
		$this->db->update('goal',$data);
		$affected = $this->db->affected_rows();
		
		return $affected;

    }
	
	function update_goal($gid,$amount,$status,$monthly)
    {
		$data = array(
						//'monthlyDepot' => $monthly,
						'currentlySaved' => $amount,
						'goalStatus' => $status
				);				
		$this->db->where('goalID',$gid);
		$this->db->update('goal',$data);
		
		$affected = $this->db->affected_rows();
		
		return $affected;
    }
	
	function get_all_public_goals($uid)
	{
		$data = "";
		$sql = "SELECT g.*, u.userName as friendName
				FROM goal g, user u, friendlist fl
				WHERE fl.userId = ?
			      and g.userID = u.userID
				  and u.userID = fl.friendId
				  and g.goalStatus = 0
				  and g.goalType = 0
				  and fl.friendDeleted = 0
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
			 $data[$i]['friendName'] = $row['friendName'];			
			 
			 $i++;
		}
		
		
		return $data;	
	}
	
	function get_goal_members($gid){
		$data = "";
		$sql = "SELECT gm.goalId,gm.userId, u.userName
				FROM goalmember gm, user u
				WHERE gm.goalId = ?
			      and gm.userID = u.userID ";
									
		$query = $this->db->query($sql,$gid);
		
		$i = 0;
		foreach($query->result_array() as $row){
			
			 $data[$i]['goalId'] = $row['goalId'];
     	     $data[$i]['userId'] = $row['userId'];
			 $data[$i]['userName'] = $row['userName'];			 	
			 
			 $i++;
		}
		
		
		return $data;
		
	}
	
	function add_goal_member($gid,$uid){
		//check if the member has already been added
		$sql = "SELECT *
				  FROM goalmember
				  WHERE  goalId = ?
				  and userId =?";	
				  			
		$query = $this->db->query($sql,array($gid,$uid));
		
		if ($query->num_rows()>0) { //the friend has been added already
			$result = 'exist';
				
		}else{
		  $arr = array(
		    'goalId' => $gid,
		    'userId' => $uid
		   );
		  $this->db->insert('goalmember',$arr);
		  $result = 'not exist';
		}
		return $result;		
	}

}
?>
