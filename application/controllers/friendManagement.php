<?php 
class FriendManagement extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('goal_model');	
		$this->load->model('deposit_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
/*------------------------------------------------*/
	function addFriend()
	{
		
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
		$uid = 11;
		$friends = $this->friend_model->get_all_friends($uid);
		/*if(count($friends)>1){
			for ($i = 0; $i < count($friends); $i++){
				$deposits[$i] = $this->deposit_model->get_deposit_history($goals[$i]['goalId']);
			}
		}*/

		$data['friends'] = $friends;	
		$this->load->view('viewFriend',$data);	
	}
	
/*------------------------------------------------*/	

}


?>