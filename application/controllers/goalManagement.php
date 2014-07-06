<?php 
class GoalManagement extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('goal_model');	
		$this->load->model('deposit_model');
		$this->load->model('friend_model');	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
/*------------------------------------------------*/	
	
/*------------------------------------------------*/
	function deleteGoal()
	{
		$gid = $_REQUEST['gid'];
		$response = array();
				
		if($this->goal_model->remove_goal($gid)){
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
	
/*------------------------------------------------*/
	function addCollaborator(){
	    $gid = $_REQUEST['gid'];
		$uid = $_REQUEST['uid'];

		$response = array();
		
		if($this->goal_model->add_goal_member($gid,$uid)){ 		    	
			$response = array(
				'ok' => true,
				'msg' => "Update succeed."							
				);
		}else{
			$response = array(
				'ok' => false,
				'msg' => "Update failed."
				);		
		}
		
		echo json_encode($response);
	}
}

?>