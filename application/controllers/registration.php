<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Registration extends CI_Controller {

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
		
		$this->load->library('email');			
		$this->email->set_newline("\r\n");
			
			
		if(isset($_POST["submit_reg"]))
		{
						
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]|min_length[3]');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[45]');
			$this->form_validation->set_rules('real_password', 'Password', 'trim|required|max_length[100]|min_length[6]');
			$this->form_validation->set_rules('real_conf_password', 'Confirm Password', 'trim|required|matches[real_password]');
			
						
			$arrUserDetails['userFirstName'] = $this->input->post('firstname');
			$arrUserDetails['userLastName'] = $this->input->post('lastname');
			$arrUserDetails['userName'] = $this->input->post('username');
			$arrUserDetails['userEmail'] = $this->input->post('email');
			$arrUserDetails['userPassword'] = $this->input->post('real_password');
			$arrUserDetails['userCreatedOn'] = date("Ymd");
			
			if ($this->form_validation->run() == true)
			{
				if ($this->user_model->check_email_availablitiy($arrUserDetails['userEmail']) == false)
				{
					$data['registration_error'] = "This email is already registered to a FinanceBuddy account.";
				}
				else if ($this->user_model->check_username_availablitiy($arrUserDetails['userName']) == false)
				{
					$data['registration_error'] = "This username is unavaliable. Please use another.";
				}
				else
				{
					//register and login user(also sets session data)
					$result = $this->user_model->registerUser($arrUserDetails);
					if($result == true)
					{
						//redirect to dash
						redirect('login');
					}
					else
					{
						$data['registration_error'] = "Could not add to database for unknown reason";
					}
				}
			}
		}
		
		//default
		$this->load->view('registration', $data);
		
	}
	
	
	
}


/* End of file login.php */
/* Location: ./application/controllers/login.php */