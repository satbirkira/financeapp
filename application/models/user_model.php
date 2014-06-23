<?php
class User_model extends CI_Model {
	
	var $userScreenName = "";
	var $userFirstName = "";
	var $userLastName = "";
	var $userEmail = "";
	var $userPassword = "";	
	var $userProfileImage = "";	
	var $userCreatedOn = "";

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
    
	function create_new_user($arrUser)
    {
		$result = $this->db->insert('user', $arrUser);
		$userId = $this->db->insert_id();
		$this->set_session_info($userId, $arrUser);
		
		return $result;
    }
	
	function attempt_login($userName, $password)
	{
		//this call returns false or a row with the users data
		//returned array contains: userId, userName, userEmail, userLastName, userFirstName
		$rows = $this->check_login($userName ,$password);
		if($rows == false)
		{
			return false;
		}
		else
		{
			//this loop will only run once, just extracts the row
			foreach($rows as $user_detail)
			{
				$userId = $row->userId;
				$arrUser['userName'] = $row->userName;
				$arrUser['userEmail'] =  $row->userEmail;
				$arrUser['userLastName'] = $row->userLastName;
				$arrUser['userFirstName'] = $row->userFirstName;
				$this->set_session_info($userId, $arrUser);
				return true;
			}
		}
	}
	
	 function update_user_details($arrUserDetails,$uid)
    {
		$this->db->from('user');
		$this->db->where('userId',$uid);
        $this->db->update('user',$arrUserDetails);
    }
	
	function check_login($userName ,$password)
	{
		$this->db->select('userId, userName, userEmail, userLastName, userFirstName');
		$this->db->from('user');
		$this->db->where('userName', $userName);
		$this->db->where('userPassword', $password);
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
		$this->session->set_userdata('suis_user_name',$arrUser['userName']);
		$this->session->set_userdata('suis_user_email',$arrUser['userEmail']);
		$this->session->set_userdata('suis_last_name',$arrUser['userLastName']);
		$this->session->set_userdata('suis_first_name',$arrUser['userFirstName']);
	}
	
	function check_email_availablitiy($email)
	{
		$this->db->select('userId');
		$this->db->from('user');
		$this->db->where('userEmail',$email);
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	function check_username_availablitiy($username)
	{
		$this->db->select('userId');
		$this->db->from('user');
		$this->db->where('userName',$username);
		$query = $this->db->get();
		return $query->num_rows();

	}
	
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

}
?>
