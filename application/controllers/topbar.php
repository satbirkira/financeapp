<?php 
session_start();
class Topbar extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
		$this->load->helper(array('form', 'url'));
	}	
	
	public function index()
	{
		$data['userId'] = $this->session->userdata('suis_user_id');
		$data['userName'] = $this->session->userdata('suis_user_name');
		$data['userEmail'] = $this->session->userdata('suis_user_email');
		$data['userLastName'] = $this->session->userdata('suis_last_name');
		$data['userFirstName'] = $this->session->userdata('suis_first_name');
		$this->load->view('topbar', $data);
	}

	
}
?>