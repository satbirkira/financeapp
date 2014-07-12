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
		$gid = $_GET['gid'];
		$amount = $_GET['amount'];
		$amount = trim($amount);
		$amount = preg_replace("/[\s]+/", "", $amount);					
		$userId = $this->session->userdata('suis_user_id');
	
		$response = array();
		
		$deposit = array(
							'goalID'=> $gid,	
							'eventDate'=> date("Ymd"),
							'amountChanged'=>$amount,
							'userID' => $userId
									
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
			//calculate the estimated monthly deposit

			$start = $detail[0]['startDate'];
			$end = $detail[0]['targetDate'];

			$start = strtotime($start);
			$target = strtotime($end);
			$diff = $target - $start;			
			$one_month=60*60*24*30;			
			$numofmonth = ceil($diff/$one_month);
			
			//satbir: added a change so that desposit does not affect monthlyDeposit database
			$monthly = $detail[0]['monthlyDepot'];
			//$monthly = ($detail[0]['totalCost'] - $amount)/$numofmonth;			
			$monthly = round($monthly,2);
		    $this->goal_model->update_goal($gid,$amount,$status,$monthly);
			
			$response = array(
				'ok' => true,
				'msg' => "Update succeed.",
				'precent' => round($amount/$detail[0]['totalCost'],2)*100,
				'monthly' => $monthly
				);
		}else{
			$response = array(
				'ok' => false,
				'msg' => "Update failed."
				);
			
		}
		
		
		$this->output->set_content_type('application/json')
                 ->set_output(json_encode($response));
		//echo json_encode($response);
		

	}
/*------------------------------------------------*/

}

?>