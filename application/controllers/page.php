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
		$page_data = Array();
		$this->confirmLogin();
		$page_data = $this->addUserSessionData($page_data);
		$page_data['content'] = 'dashboard';
		$page_data['content_data'] = array("VARIABLES" => "THIS ARE VARIABLES YOU WANT TO PASS TO THE dashboard VIEW");
		$this->load->view('page', $page_data);
	}
	
	public function goal()
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('goal', '', true);
		$this->load->view('page', $page_data, false);
	}
	
	public function social()
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('social', '', true);
		$this->load->view('page', $page_data, false);
	}
	
	public function setting()
	{
		$page_data = Array();
		$this->confirmLogin();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('setting', '', true);
		$this->load->view('page', $page_data, false);
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

	
}
?>