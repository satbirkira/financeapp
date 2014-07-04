<?php 
session_start();
class Page extends CI_Controller{
		
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
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

		
		//dynamically create view
		$page_data['content_data']["variable1"] = "A variable you want to use in the dash view";
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
		

		$page_data['content_data']["variable1"] = "A variable you want to use in the goal view";
		$this->load->view('page', $page_data);
	}
	
	public function social()
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'social';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		

		$page_data['content_data']["variable1"] = "A variable you want to use in the social view";
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
		$page_data['content_data']["variable1"] = "A variable you want to use in the setting view";
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
			$theGoalID = $this->input->post('transactionGoal');
			$amountChange = $this->input->post('transactionAmount');
			
			$this->form_validation->set_rules('transactionAmount', 'Transaction Amount', 'trim|required|max_length[10]|numeric');
			
			if ($this->form_validation->run() == true)
			{
				//if we are adding to goal
					$this->user_model->updateUserAccountAddToGoal($this->session->userdata('suis_user_id'), $theGoalID, $amountChange);
				
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

	
}
?>