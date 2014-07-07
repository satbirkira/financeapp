<?php 
session_start();
class Page extends CI_Controller{
		
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');
		$this->load->model('goal_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
	}
	
	public function index()
	{
		//nothing, load a specific page like the goal page using /page/goal
	}

	public function demo_inprog() {
		$this->load->view('demo_inprog');
	}
	
	public function dashboard()
	{
		//initial view setup
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'dashboard';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		$page_data['content_data']["user_settings"] = $this->user_model->getUserSettingsArray($this->session->userdata('suis_user_id'));
		$page_data['content_data']["goals_array"] = $this->user_model->getUserGoalArray2($this->session->userdata('suis_user_id'));
		
		//dynamically create view
		$this->load->view('page', $page_data);
	}
	
	public function goal()
	{
		//initial view setup
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'goal';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		$this->load->view('page', $page_data);
	}
	
	public function social()
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'social';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		$this->load->view('page', $page_data);
	}
	
	public function setting($general_error = '', $success_msg = '')
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'setting';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		
		$page_data['content_data']["user_settings"] = $this->user_model->getUserSettingsArray($this->session->userdata('suis_user_id'));
		$page_data['content_data']["general_error"] = $general_error;
		$page_data['content_data']["success_msg"] = $success_msg;
		$this->load->view('page', $page_data);
	}
	
	public function finance($general_error = '', $success_msg = '')
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'finance';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		$page_data['content_data']["goals_array"] = $this->user_model->getUserGoalArray($this->session->userdata('suis_user_id'));;
		$page_data['content_data']["user_settings"] = $this->user_model->getUserSettingsArray($this->session->userdata('suis_user_id'));
		$page_data['content_data']["general_error"] = $general_error;
		$page_data['content_data']["success_msg"] = $success_msg;
		
		//generate transaction table
		$page_data['content_data']["transactions_array"] = $this->user_model->getUserTransactionArray($this->session->userdata('suis_user_id'));
		
		
		$this->load->view('page', $page_data);
	}
	
	public function addUserSessionData($array)
	{
		$array['suis_user_id'] = $this->session->userdata('suis_user_id');
		$array['suis_user_pass'] = $this->session->userdata('suis_user_pass');
		$array['suis_user_name'] = $this->session->userdata('suis_user_name');
		$array['suis_user_email'] = $this->session->userdata('suis_user_email');
		$array['suis_last_name'] = $this->session->userdata('suis_last_name');
		$array['suis_first_name'] = $this->session->userdata('suis_first_name');
		return $array;
	}
	
	public function confirmLogin()
	{
		//user not logged in
		if ((!$this->session->userdata('suis_user_name')) || (!$this->session->userdata('suis_user_pass')))
		{
			redirect('login');
		}
		
		$username = $this->session->userdata('suis_user_name');
		$password = $this->session->userdata('suis_user_pass');
		//user no longer allowed to login
		if ($this->user_model->check_login($username, $password) == false)
		{
			$this->user_model->logout();
			redirect('login');
		}
		
	}
	
	
	/*
	
		Goal Functions
	
	*/
		function addGoal()
	{	
		$this->confirmLogin();

		$this->load->model('goal_model');	
		$this->load->model('deposit_model');
		$this->load->model('friend_model');	
		// If registration button is clicked.
		if(isset($_POST["btnAdd"]))
		{
			// Validate the values.
			$this->form_validation->set_rules('goalTitle', 'What is your saving goal?', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('total', 'Goal Total', 'trim|required|max_length[15]|numeric|greater_than[0]');
			$this->form_validation->set_rules('startDate', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('targetDate', 'Target Date', 'trim|required');
			$this->form_validation->set_rules('monthlyDepot', 'Estimated Monthly Deposit', 'trim|required|max_length[15]|numeric');
			$this->form_validation->set_rules('interestRate', 'Annual Interest Rate', 'trim|numeric');
			$startD = $this->input->post('startDate');
			$targetD = $this->input->post('targetDate');
			$uid = $this->session->userdata('suis_user_id');
			$goal = array(
									'goalName'=> $this->input->post('goalTitle'),	
									'userId'=> $uid,																
									'totalCost'=> $this->input->post('total'),											
									'startDate'=> $startD,
									'targetDate'=>$targetD,
									'monthlyDepot'=>$this->input->post('monthlyDepot'),		
									'currentlySaved'=>0,
									'goalStatus'=>0,
									'goalType'=>$this->input->post('isPublic')
									
			);

			$result = $this->goal_model->create_new_goal($goal);
			if ($this->form_validation->run() == true && $result)
				{									
					//redirect('index.php/page/viewGoal');
					redirect('page/viewGoal');
				}
		}
		
		$page_data = Array();
		$page_data['content'] = 'addGoal';
		$page_data['content_data'] = '';
		
		//dynamically create view
		$this->load->view('page', $page_data);
		

		
	}

/*------------------------------------------------*/
	function viewGoal(){
		$this->confirmLogin();
		$this->load->model('goal_model');	
		$this->load->model('deposit_model');
		$this->load->model('friend_model');	
		
		$goals = array();
		$deposits = array();
		$members = array();
		$cogoals = array();
		$codeposits = array();
		$comembers = array();
		$uid = $this->session->userdata('suis_user_id');
	
		$goals = $this->goal_model->get_all_goals($uid);
		$cogoals = $this->goal_model->get_collaborate_goals($uid);
		$friends = $this->friend_model->get_all_friends($uid);
		if(count($goals)>0 && $goals != ''){
			for ($i = 0; $i < count($goals); $i++){
				$deposits[$i] = $this->deposit_model->get_deposit_history($goals[$i]['goalId']);
				$members[$i] = $this->goal_model->get_goal_members($goals[$i]['goalId']);
			}
		}
		if(count($cogoals)>0 && $cogoals != ''){
			for ($i = 0; $i < count($cogoals); $i++){
				$codeposits[$i] = $this->deposit_model->get_deposit_history($cogoals[$i]['goalId']);
				$comembers[$i] = $this->goal_model->get_goal_members($cogoals[$i]['goalId']);
			}
		}

		$data['goals'] = $goals;	
		$data['deposits'] = $deposits;	
		$data['friends'] = $friends;
		$data['members'] = $members;
		
		$data['cogoals'] = $cogoals;
		$data['codeposits'] = $codeposits;	
		$data['comembers'] = $comembers;
	
		$page_data = Array();
		$page_data['content'] = 'viewGoal';
		$page_data['content_data'] = $data;

		$this->load->view('page', $page_data);

	}
/*------------------------------------------------*/
	function viewFriendsGoal(){ //view the public goals
		$this->confirmLogin();

		$this->load->model('goal_model');	
		$this->load->model('deposit_model');
		$this->load->model('friend_model');	
		
		$goals = array();
		$deposits = array();
		$uid = $this->session->userdata('suis_user_id');
		$goals = $this->goal_model->get_all_public_goals($uid);
		if(count($goals)>1){
			for ($i = 0; $i < count($goals); $i++){
				$deposits[$i] = $this->deposit_model->get_deposit_history($goals[$i]['goalId']);
			}
		}
		
		$data['goals'] = $goals;	
		$data['deposits'] = $deposits;	
		
		$page_data = Array();
		$page_data['content'] = 'viewFriendsGoal';
		$page_data['content_data'] = $data;
		
		//dynamically create view
		$this->load->view('page', $page_data);
		
		
	}
	

	

/*------------------------------------------------*/
		
	
	/*
	
		Finance Functions
	
	*/
	
	public function changeFinance()
	{
		//form validation
		$this->load->library('email');			
		$this->email->set_newline("\r\n");
		
		$general_error = '';
		$success_msg = '';
		
		if(isset($_POST["submit_finance"]))
		{
		
			$this->form_validation->set_rules('currentlySaved', 'Currently Saved', 'trim|required|max_length[10]|numeric|greater_than[-1]');
			$this->form_validation->set_rules('interestOnSavings', 'Interest on Savings', 'trim|required|max_length[10]|numeric|greater_than[-1]|less_than[101]');
			$this->form_validation->set_rules('monthlyIncome', 'Monthly Income', 'trim|required|max_length[10]|numeric|greater_than[-1]');
			
			
			$accountDetails['userCurrentlySaved'] = $this->input->post('currentlySaved');
			$accountDetails['userInterestOnSavings'] = $this->input->post('interestOnSavings');
			$accountDetails['userMonthlyIncome'] = $this->input->post('monthlyIncome');
			
			if ($this->form_validation->run() == true)
			{
			
				$accountDetails['userAccountUpdated'] = true;
				$this->user_model->updateUserAccount($this->session->userdata('suis_user_id'), $accountDetails);
				$success_msg = "Account has been updated.";
				
			}

		}
		else if(isset($_POST["submit_add_finance"]))
		{

			$this->form_validation->set_rules('transactionAmount', 'Transaction Amount', 'trim|required|max_length[10]|numeric');
			
			$transactionArray['goalID'] = $this->input->post('transactionGoal');
			$transactionArray['eventDate'] = date("Ymd");
			$transactionArray['amountChanged'] =  $this->input->post('transactionAmount');
			
			
			if ($this->form_validation->run() == true)
			{
				$result = $this->user_model->updateUserAccountAddToGoal($transactionArray);
				
				if($result)
				{
					$success_msg = "Added transaction.";
				}
				else
				{
					$general_error = "Could not add transaction.";
				}
				
			}
			
		}
		
		$this->finance($general_error, $success_msg);
	}
	
	/*
	
		Setting Functions
	
	*/
	
	
	
	public function changeSetting()
	{
		//form validation
		$this->load->library('email');			
		$this->email->set_newline("\r\n");
		
		$general_error = '';
		$success_msg = '';
		
		if(isset($_POST["submit_setting"]))
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]|min_length[3]');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[45]');
			
			
			$accountDetails['userName'] = $this->input->post('username');
			$accountDetails['userFirstName'] = $this->input->post('firstname');
			$accountDetails['userLastName'] = $this->input->post('lastname');
			$accountDetails['userEmail'] = $this->input->post('email');
			
			
			$accountDetails['userBeSearchable'] = is_string($this->input->post('beSearchable'));
			$accountDetails['userDisplayGoalsOnDash'] = is_string($this->input->post('seeGoalsOnDash'));
			
			
			if ($this->form_validation->run() == true)
			{
				
				$this->user_model->updateUserAccount($this->session->userdata('suis_user_id'), $accountDetails);
				$success_msg = "Account has been updated.";
			}
		}
		else if (isset($_POST["update_pass_submit"]))
		{

			$this->form_validation->set_rules('password', 'Old Password', 'trim|required|max_length[100]|min_length[6]');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|max_length[100]|min_length[6]');
			
			$password = $this->input->post('password');
			$new_password = $this->input->post('new_password');
			
			if ($this->form_validation->run() == true)
			{
			
				if($this->session->userdata('suis_user_pass') == $this->user_model->hash_password($password))
				{
					$accountDetails['userPassword'] = $this->user_model->hash_password($new_password);
					$this->user_model->updateUserAccount($this->session->userdata('suis_user_id'), $accountDetails);
					//user will auto be logged out now
				}
				else
				{
					$general_error = "Password does not match database.";
				}
			}
			
		}
		else if(isset($_POST["delete_account_submit"]))
		{
			$accountDetails['userDeleted'] = true;
			$this->user_model->updateUserAccount($this->session->userdata('suis_user_id'), $accountDetails);
		}
		
		//display view with update notification
		$this->setting($general_error, $success_msg);
	
	}
	
	
	/*
	
		Social Functions
	
	*/
	function addFriend()
	{	
		$this->confirmLogin();

		$page_data['content'] = 'addFriend';
		$page_data['content_data'] = Array();
		//dynamically create view
		$this->load->view('page', $page_data);
	}
	
	function viewFriends(){
		$this->confirmLogin();

		$this->load->model('friend_model');		

		$goals = array();
		$deposits = array();
		$uid = $this->session->userdata('suis_user_id');
		$friends = $this->friend_model->get_all_friends($uid);
		$data['friends'] = $friends;	
		
		$page_data = Array();
		$page_data['content'] = 'viewFriend';
		$page_data['content_data'] = $data;
		
		//dynamically create view
		$this->load->view('page', $page_data);
		
	}
	
}
?>