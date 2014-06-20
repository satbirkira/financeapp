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

	function hash_password ($password)
	{
		$salt = md5 (time ());
		$hash = hash ('sha256', $salt . $password);
		return $salt . $hash;
	}
    
	function create_new_user($arrUser)
    {
		$result = $this->db->insert('user',$arrUser);
		$userId = $this->db->insert_id();
		$this->session->set_userdata('suis_user_id',$userId);
		$this->session->set_userdata('suis_user_name',$arrUser['userName']);
		$this->session->set_userdata('suis_user_email',$arrUser['userEmail']);
		$this->session->set_userdata('suis_last_name',$arrUser['userLastName']);
		$this->session->set_userdata('suis_first_name',$arrUser['userFirstName']);
		return $result;

    }
	
	 function update_user_details($arrUserDetails,$uid)
    {
		$this->db->where('userId',$uid);
        $this->db->update('user',$arrUserDetails);
    }
	
	function check_login($email,$password)
	{
		$arrUser = array('userEmail' => $email, 'userPassword' => $password);
		$this->db->select('userId,userName');
		$this->db->from('user');
		$this->db->where($arrUser);
		$query = $this->db->get();
		return $query->result();
	}
	
	function check_user_availablitiy($email)
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
