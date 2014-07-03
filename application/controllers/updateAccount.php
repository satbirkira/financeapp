<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class UpdateAccount extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
	
	public function index()
	{
		$data = Array();	
		$this->confirmLogin();
		
		//if already updated skip this page
		if($this->user_model->userAccountUpdated($this->session->userdata('suis_user_id')) == true)
		{
			redirect('page/demo_inprog');
		}
		
		if(isset($_POST["submit_updateacc"]))
		{		
			$this->form_validation->set_rules('currentlySaved', 'Currently Saved', 'trim|required|max_length[10]|numeric|greater_than[-1]');
			$this->form_validation->set_rules('interestOnSavings', 'Interest on Savings', 'trim|required|max_length[10]|numeric|greater_than[-1]|less_than[101]');
			$this->form_validation->set_rules('monthlyIncome', 'Monthly Income', 'trim|required|max_length[10]|numeric|greater_than[-1]');
			
			$user_id = $this->session->userdata('suis_user_id');
			$arrUserAccDetails['userAccountUpdated'] = true;	
			$arrUserAccDetails['userCurrentlySaved'] = $this->input->post('currentlySaved');
			$arrUserAccDetails['userInterestOnSavings'] = $this->input->post('interestOnSavings');
			$arrUserAccDetails['userMonthlyIncome'] = $this->input->post('monthlyIncome');
			
			if ($this->form_validation->run() == true)
			{
				//update user account info
				$result = $this->user_model->updateUserAccount($user_id, $arrUserAccDetails);
				if($result == true)
				{
					//redirect to dash
					redirect('page/demo_inprog');
				}
				
			}
		}
		elseif (isset($_POST["submit_skip_updateacc"]))
		{
			redirect('page/dashboard');
		}
		
		//default
		$this->load->view('updateAccount', $data);
		
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
	
	
	
}
