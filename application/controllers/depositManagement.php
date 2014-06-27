<?php 
class DepositManagement extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('deposit_model');		
		$this->load->model('goal_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
/*------------------------------------------------*/	
	function addDeposit()
	{	
		$gid = $_REQUEST['gid'];
		$amount = $_REQUEST['amount'];
		$amount = trim($amount);
		$amount = preg_replace("/[\s]+/", "", $amount);					
	
		$response = array();
		
		$deposit = array(
							'goalID'=> $gid,	
							'eventDate'=> date("Ymd"),
							'amountChanged'=>$amount
									
		);		
		
		if($amount == ''){
			$response = array(
				'ok' => false,
				'msg' => "Please specify the amount."
				);
		}else if(!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/',$amount)){
			$response = array(
				'ok' => false,
				'msg' => "The amount can only be numbers."
				);
			
		}else if($this->deposit_model->add_deposit($deposit)){ 
		
		    $detail = $this->goal_model->get_goal_details($gid);
			$amount = $amount *1;
			$amount = $detail[0]['currentlySaved'] + $amount;
			if ($amount == $detail[0]['totalCost']){
				$status = 1; //accomplish the goal
			}else{
				$status = 0;
			}
		    $this->goal_model->update_goal($gid,$amount,$status);
			
			$response = array(
				'ok' => true,
				'msg' => "Update succeed.",
				'precent' => round($amount/$detail[0]['totalCost'],2)*100
				);
		}else{
			$response = array(
				'ok' => false,
				'msg' => "Update failed."
				);
			
		}
		
		echo json_encode($response);
		

	}
/*------------------------------------------------*/

}

?>