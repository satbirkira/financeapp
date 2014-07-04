<?php
class User_model extends CI_Model {
	
/* User table as refrence
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `userPassword` varchar(100) NOT NULL, 
  `userCreatedOn` DATE NOT NULL,
  `userEmail` varchar(45) DEFAULT NULL,
  `userFirstName` varchar(45) DEFAULT NULL,
  `userLastName` varchar(45) DEFAULT NULL,
  `userCurrentlySaved` int(10) NOT NULL DEFAULT '0',
  `userInterestOnSavings` int(11) NOT NULL DEFAULT '0',
  `userMonthlyIncome` int(10) NOT NULL DEFAULT '0',
  `userAccountUpdated` BOOLEAN DEFAULT FALSE,
  `userProfileImage` varchar(45) DEFAULT NULL,
  `userBeSearchable` varchar(45) DEFAULT TRUE,
  `userDisplayGoalsOnDash` varchar(45) DEFAULT TRUE,
  `userDeleted` BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (`userID`)
*/


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function hash_password($password)
	{
		return md5($password);
		//$salt = md5 (time ());
		//$hash = hash ('sha256', $salt . $password);
		//return $salt . $hash;
	}
	
    
	/* Login Functions */
	
	function attempt_login($userName, $password)
	{
		//this call returns false or a row with the users data
		//returned array contains: userId, userPassword, userName, userEmail, userLastName, userFirstName
		$rows = $this->check_login($userName ,$password);
		if($rows == false)
		{
			return false;
		}
		else
		{
			//this loop will only run once, just extracts the row
			foreach($rows as $row)
			{
				$userId = $row->userId;
				$arrUser['userName'] = $row->userName;
				$arrUser['userPassword'] = $row->userPassword;
				$arrUser['userEmail'] =  $row->userEmail;
				$arrUser['userLastName'] = $row->userLastName;
				$arrUser['userFirstName'] = $row->userFirstName;
				$this->set_session_info($userId, $arrUser);
				return true;
			}
		}
	}
	
	
	function check_login($userName ,$password)
	{
		$this->db->select('userId, userPassword, userName, userEmail, userLastName, userFirstName');
		$this->db->from('user');
		$this->db->where('userName', $userName);
		$this->db->where('userPassword', $password);
		$this->db->where('userDeleted != true');
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function set_session_info($userId, $arrUser)
	{
		$this->session->set_userdata('suis_user_id',$userId);
		$this->session->set_userdata('suis_user_pass',$arrUser['userPassword']);
		$this->session->set_userdata('suis_user_name',$arrUser['userName']);
		$this->session->set_userdata('suis_user_email',$arrUser['userEmail']);
		$this->session->set_userdata('suis_last_name',$arrUser['userLastName']);
		$this->session->set_userdata('suis_first_name',$arrUser['userFirstName']);
	}
	
	function logout()
	{
		$this->session->sess_destroy();
	}
	
	
	/* Registration Functions */
	
	function registerUser($arrUserDetails)
	{
		//hash the password
		$arrUserDetails['userPassword'] = $this->hash_password( $arrUserDetails['userPassword'] );
		$result = $this->db->insert('user', $arrUserDetails);
		$userId = $this->db->insert_id();
		//$this->set_session_info($userId, $arrUserDetails); uncomment since we don't login right away
		return $result;
	}
	
	function check_email_availablitiy($email)
	{
		$this->db->select('userId');
		$this->db->from('user');
		$this->db->where('userEmail',$email);
		$query = $this->db->get();
		//if there already exists this email
		if ($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}

	}
	
	function check_username_availablitiy($username)
	{
		$this->db->select('userId');
		$this->db->from('user');
		$this->db->where('userName',$username);
		$query = $this->db->get();
		//if there already exists this username
		if ($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}

	}
	
	/* Get User info */
	
	function get_user_details($uid)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('userId',$uid);
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
	
	/* Updating User Info */
	
	function updateUserAccount($uid, $arrUserAccDetails)
    {
		$this->db->from('user');
		$this->db->where('userId',$uid);
		return $this->db->update('user',$arrUserAccDetails);
    }
	
	function userAccountUpdated($uid)
    {
		$this->db->select('userID');
		$this->db->from('user');
		$this->db->where('userID',$uid);
		$this->db->where('userAccountUpdated', true);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
    }
	
	
	
	/* Get Settings */
	
	function getUserSettingsArray($uid)
    {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('userID',$uid);
		$query = $this->db->get();
		$rows = $query->result();
		
			//this loop will only run once, just extracts the row
			foreach($rows as $row)
			{
				$settings_array['userName'] = $row->userName;
				$settings_array['userPassword'] = $row->userPassword;
				$settings_array['userEmail'] =  $row->userEmail;
				$settings_array['userLastName'] = $row->userLastName;
				$settings_array['userFirstName'] = $row->userFirstName;
				
				$settings_array['userCurrentlySaved'] = $row->userCurrentlySaved;
				$settings_array['userInterestOnSavings'] = $row->userInterestOnSavings;
				
				$settings_array['userMonthlyIncome'] = $row->userMonthlyIncome;
				$settings_array['userAccountUpdated'] = $row->userAccountUpdated;
				$settings_array['userBeSearchable'] = $row->userBeSearchable;
				$settings_array['userDisplayGoalsOnDash'] = $row->userDisplayGoalsOnDash;
				return $settings_array;
			}
    }
	
	
	/*  Get goal   */
	function getUserGoalArray($uid)
    {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->from('goal');
		$this->db->where('user.userID',$uid);
		$this->db->where('user.userID = goal.userID');
		$query = $this->db->get();
		return $query->result_array();
		
		
		/*//this loop will only run once, just extracts the row
		foreach($rows as $row)
		{
			$goals_array['userID'] = $row->userID;
			$goals_array['goalID'] = $row->goalID;
			$goals_array['goalName'] =  $row->goalName;
			$goals_array['startDate'] = $row->startDate;
			$goals_array['targetDate'] = $row->targetDate;
			
			$goals_array['totalCost'] = $row->totalCost;
			$goals_array['monthlyDepot'] = $row->monthlyDepot;
			
			$goals_array['interestRate'] = $row->interestRate;
			$goals_array['currentlySaved'] = $row->currentlySaved;
			$goals_array['goalStatus'] = $row->goalStatus;
			return $goals_array;
		}*/
    }

}
?>
