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
		/*if(isset($_POST["submit_login"]))
		{
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[15]|min_length[6]');
			
			$username =  $this->input->post('username');
			$password =  $this->input->post('password');
			
			if ($this->form_validation->run() == true)
			{
				if($this->user_model->attempt_login($username, $this->user_model->hash_password($password)))
				{
					//redirect to dash
					redirect('/page/dashboard');
				}
				else
				{
					$data['authentication_error'] = "Incorrect Username or Password";
				}
			}
		}
		*/
		//default
		$this->load->view('registration', $data);
		
	}
	
	
	
}


/* End of file login.php */
/* Location: ./application/controllers/login.php */