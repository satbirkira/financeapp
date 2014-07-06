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
	

/*------------------------------------------------*/
	function deleteFriend()
	{	
		$fid = $_REQUEST['fid'];
		$uid = $this->session->userdata('suis_user_id');
		//$uid = '11';
		$response = array();
				
		if($this->friend_model->remove_friend($uid,$fid)){
			$response = array(
				'ok' => true,
				'msg' => "Delete succeed."
		    );	
		}else{
			$response = array(
				'ok' => false,
				'msg' => "Delete failed."
		    );	
		}
		
		echo json_encode($response);
		
	}
	
/*------------------------------------------------*/
	
	
/*------------------------------------------------*/	
	function searchFriend(){
		$fname = $_REQUEST['fname'];
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$farr = array();
		$response = array();

		$farr['fname'] = $fname;
		$farr['firstname'] = $firstname;
		$farr['lastname'] = $lastname;
		
		$friend = $this->friend_model->search_friend($farr);
		if ($friend != 'no user'){
			$response = array(
				'ok' => true,
				'msg' => "found",
				'friends' =>$friend
		    );	
		}else{
			$response = array(
				'ok' => false,
				'msg' => "can't find the user.",
				'friends' => ''
		    );	
		}
		
		echo json_encode($response);

		
	}
	
	function addOneFriend(){
		$uid = $this->session->userdata('suis_user_id');
		//$uid = '11';
		//$uid = '2';	
		$arr = array(
						'userId'=> $uid,
						'friendId'=>$_REQUEST['fid'],																
						'friendDeleted'=>0									
		);

		$result = $this->friend_model->add_friend($arr);
		
		if ($result){
			$response = array(
				'ok' => true,
				'msg' => "added"
		    );	
		}else{
			$response = array(
				'ok' => false,
				'msg' => "failed"
		    );	
		}
		
		echo json_encode($response);
		
	}
}


?>