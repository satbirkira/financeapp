<?php 
class GoalManagement extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('goal_model');	
		$this->load->model('deposit_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
/*------------------------------------------------*/	
	function addGoal()
	{	
		// If registration button is clicked.
		if(isset($_POST["btnAdd"]))
		{
			// Validate the values.
			$this->form_validation->set_rules('goalTitle', 'What is your saving goal?', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('total', 'Goal Total', 'trim|required|max_length[15]|numeric');
			$this->form_validation->set_rules('startDate', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('targetDate', 'Target Date', 'trim|required');
			$this->form_validation->set_rules('monthlyDepot', 'Estimated Monthly Deposit', 'trim|required|max_length[15]|numeric');
			$this->form_validation->set_rules('interestRate', 'Annual Interest Rate', 'trim|numeric');
			
			$uid = $this->session->userdata('suis_user_id');
			//$uid = '11';
			$goal = array(
									'goalName'=> $this->input->post('goalTitle'),	
									'userId'=> $uid,																
									'totalCost'=> $this->input->post('total'),											
									'startDate'=> $this->input->post('startDate'),
									'targetDate'=>$this->input->post('targetDate'),
									'monthlyDepot'=>$this->input->post('monthlyDepot'),		
									'interestRate'=>$this->input->post('interestRate'),
									'currentlySaved'=>0,
									'goalStatus'=>0
									
			);

			$result = $this->goal_model->create_new_goal($goal);
			if ($this->form_validation->run() == true && $result)
				{									
					redirect('index.php/goalManagement/viewGoal');
					
				}
		}
		
		$data['main_content'] = 'addGoal';
		
		$this->load->view('addGoal');
		
		//$this->load->view('includes/template',$data);
		
	}
/*------------------------------------------------*/
	function deleteGoal()
	{
		$this->load->view('deleteGoal');
	}
	
/*------------------------------------------------*/
	function viewGoal(){
		$goals = array();
		$deposits = array();
		$uid = $this->session->userdata('suis_user_id');
		//$uid = 11;
		$goals = $this->goal_model->get_all_goals($uid);
		for ($i = 0; $i < count($goals); $i++){
			$deposits[$i] = $this->deposit_model->get_deposit_history($goals[$i]['goalId']);
		}

		$data['goals'] = $goals;	
		$data['deposits'] = $deposits;	
		$this->load->view('viewGoal',$data);	
	}
}

?>