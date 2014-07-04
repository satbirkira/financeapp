<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
	
	public function index()
	{
		$this->login();
	}
	
	public function logout()
	{
		$this->user_model->logout();
		redirect('login');
	}
	
	public function login()
	{
		$data = Array();
		//if already logged in, make sure user is still allowed and redirect
		$usernameInSession = $this->session->userdata('suis_user_name');
		if(!empty($usernameInSession))
		{
			$alreadyHashedPass = $this->session->userdata('suis_user_pass');
			if($this->user_model->attempt_login($usernameInSession, $alreadyHashedPass))
			{
				if($this->user_model->userAccountUpdated($this->session->userdata('suis_user_id')) == false)
				{
					redirect('updateAccount');
				}
				//else redirect dash
				else
				{
					//redirect to dash
					redirect('/page/dashboard');
				}
			}
		}
		else if(isset($_POST["submit_login"]))
		{
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[15]|min_length[6]');
			
			$username =  $this->input->post('username');
			$password =  $this->input->post('password');
			
			if ($this->form_validation->run() == true)
			{
				if($this->user_model->attempt_login($username, $this->user_model->hash_password($password)))
				{
					//if user has not updated account, redirect to that page
					if($this->user_model->userAccountUpdated($this->session->userdata('suis_user_id')) == false)
					{
						redirect('updateAccount');
					}
					//else redirect dash
					else
					{
						//redirect to dash
						redirect('/page/dashboard');
					}
				}
				else
				{
					$data['authentication_error'] = "Incorrect Username or Password";
				}
			}
		}
		
		//default
		$this->load->view('login', $data);
	}
	
	
	
}


/* End of file login.php */
/* Location: ./application/controllers/login.php */