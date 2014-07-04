<?php 
class FriendManagement extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('friend_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
/*------------------------------------------------*/
	function addFriend()
	{	
		$error = '';
		if(isset($_POST["btnAdd"]))
		{
			// Validate the values.
			$uid = $this->session->userdata('suis_user_id');
			//$uid = '11';
			//$uid = '2';
			$fname = trim($this->input->post('username'));
			$firstname = trim($this->input->post('username'));
			$lastname = trim($this->input->post('lastname'));
			$farr = array();
			$farr['fname'] = $fname;
			$farr['firstname'] = $firstname;
			$farr['lastname'] = $lastname;
			
			$friend = $this->friend_model->check_friend($uid,$farr);
			
			if ($friend != 'exist'){
  			  $arr = array(
								'userId'=> $uid,
								'friendId'=>$friend[0]['userId'],																
								'friendDeleted'=>0									
			  );

			  $result = $this->friend_model->add_friend($arr);
			  
			  if ($result){									
				  redirect('index.php/friendManagement/viewFriend');					
			  }else{
			  
			  }
			  
			}
		}
		
		$data['main_content'] = 'addFriend';
		$this->load->view('addFriend');
	}
	

/*------------------------------------------------*/
	function deleteFriend()
	{
		
	}
	
/*------------------------------------------------*/
	function viewFriends(){
		$goals = array();
		$deposits = array();
		$uid = $this->session->userdata('suis_user_id');
		//$uid = 11;
		$friends = $this->friend_model->get_all_friends($uid);
		$data['friends'] = $friends;	
		$this->load->view('viewFriend',$data);	
	}
	
/*------------------------------------------------*/	

}


?>