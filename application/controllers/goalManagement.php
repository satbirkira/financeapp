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
		$gid = $_GET['gid'];
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
		$this->output->set_content_type('application/json')
                 ->set_output(json_encode($response));
		//echo json_encode($response);
	}
	
/*------------------------------------------------*/
	
/*------------------------------------------------*/
	
/*------------------------------------------------*/
	function addCollaborator(){
	    $gid = $_GET['gid'];
		$uid = $_GET['uid'];

		$response = array();
		$result = $this->goal_model->add_goal_member($gid,$uid);
		
		if($result){ 
		   if($result == 'exist'){		    	
			$response = array(
				'ok' => true,
				'msg' => "Update succeed.",
				'exist' => 	true						
				);
		   }else if($result == 'not exist'){
			   $response = array(
			  	'ok' => true,
				'msg' => "Update succeed.",
				'exist' =>false							
				);
		   }
		}else{
			$response = array(
				'ok' => false,
				'msg' => "Update failed.",
				'exist' =>false	
				);	
		}
		
		$this->output->set_content_type('application/json')
                 ->set_output(json_encode($response));
		//echo json_encode($response);
	}
}

?>