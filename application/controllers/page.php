<?php 
session_start();
class Page extends CI_Controller{
		
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
		$this->load->helper(array('form', 'url'));
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
	
	public function setting()
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['content'] = 'settings';
		$page_data['content_data'] = array();
		$page_data['content_data'] = $this->addUserSessionData($page_data['content_data']);
		

		$page_data['content_data']["variable1"] = "A variable you want to use in the setting view";
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
	
		Setting Functions
	
	*/
	
	
	
	
	
	
	/*
	
		Social Functions
	
	*/

	
}
?>