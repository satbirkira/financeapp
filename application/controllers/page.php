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
	
	public function dashboard()
	{
		$page_data = Array();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('dashboard', '', true);
		$this->load->view('page', $page_data, false);
	}
	
	public function goal()
	{
		$page_data = Array();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('goal', '', true);
		$this->load->view('page', $page_data, false);
	}
	
	public function social()
	{
		$page_data = Array();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('social', '', true);
		$this->load->view('page', $page_data, false);
	}
	
	public function setting()
	{
		$page_data = Array();
		$page_data['sidebar'] = $this->load->view('sidebar', '', true);
		$page_data['topbar'] = $this->load->view('topbar', '', true);
		$page_data['content'] = $this->load->view('setting', '', true);
		$this->load->view('page', $page_data, false);
	}

	
}
?>