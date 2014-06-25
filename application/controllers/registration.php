<?php 

class Registration extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
    }
/*------------------------------------------------*/	
	function register()
	{	
		// If registration button is clicked.
		if(isset($_POST["btnRegister"]))
		{
			$this->load->library('email');			
			$this->email->set_newline("\r\n");
			// Validate the user form capture.
			$this->form_validation->set_rules('screenname', 'Screen Name', 'trim|required|max_length[45]|min_length[3]');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[45]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[15]|min_length[6]');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|matches[password]');
			
			$username =  $this->input->post('screenname');
			$firstname =  $this->input->post('firstname');
			$lastname =  $this->input->post('lastname');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$confirmpassword = $this->input->post('confirmpassword');						
																
			$todayDate = date("Ymd");							
										
			$registration = array(
									'userName'=> $username,																	
									'userFirstName'=> $firstname,											
									'userLastName'=> $lastname,
									'userEmail'=> $email,
									'userPassword'=>$this->user_model->hash_password($password),		
									'userCreatedOn'=>$todayDate
			);

			
			if ($this->form_validation->run() == true)
			{
				$result = $this->user_model->create_new_user($registration);
				if($result)
				{
					redirect('/registration/register2');
				}
				else
				{
					//it will continue and load the view again, but with errors displaying
				}
			}
		}
		
		//if there was no post, or it failed to validate and hence
		//no redirection occurs and this displays again with errors
		$data['main_content'] = 'register1';
		$this->load->view('register1',$data);
		
	}
/*------------------------------------------------*/
	function register2()
	{
		// If registration button is clicked.
		if(isset($_POST["btnRegister2"]))
		{
			$profilePic = "";			
			$config['upload_path'] = $_SERVER["DOCUMENT_ROOT"].'/financeapp/uploads/profile/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);
			$field_name = 'profilePic';
			// Upload the file
			$this->upload->do_upload($field_name);
			$uploadedImages= $this->upload->data();
			$profilePic = $uploadedImages['file_name'];
			$uid = $this->session->userdata('suis_user_id');							
			$userDetails = array('userProfileImage'=> $profilePic);

			
			if ($this->form_validation->run() == true)
			{
				$result = $this->user_model->update_user_details($userDetails,$uid);
				if($result)
				{
					//should redirect to the dashboard
					redirect('index.php/page/dashboard');
				}
				else
				{
					//it will continue and load the view again, but with errors displaying
				}
			}
		
		}			
		$data['main_content'] = 'register2';		
		//$this->load->view('includes/template',$data);
		$this->load->view('register2',$data);
	}
	
	
/*------------------------------------------------*/
	function check_username(){	
		$username = $_REQUEST['username'];
		//$username = "11";
		$username = trim($username);
		$username = preg_replace("/[\s]+/", "", $username);					
	
		$response = array();
		
		if($username == ''){
			$response = array(
				'ok' => false,
				'msg' => "Please specify a username."
				);
		}else if(!preg_match('/^[A-Za-z0-9]+$/',$username)){
			$response = array(
				'ok' => false,
				'msg' => "The username can only contain alphanumerics."
				);
			
		}else if($this->user_model->check_username_availablitiy($username)){ 
			$response = array(
				'ok' => false,
				'msg' => "The username is not available."
				);
		}else{
			$response = array(
				'ok' => true,
				'msg' => "The username is available."
				);
			
		}
		
		echo json_encode($response);
		
	}
/*------------------------------------------------*/
	function check_email(){	
		
		$email = trim($_REQUEST['email']);
		$email = preg_replace("/[\s]+/", "", $email);					
	
		$response = array();
		
		if($email == ''){
			$response = array(
				'ok' => false,
				'msg' => "Please specify an email address."
				);
		}else if($this->user_model->check_email_availablitiy($email)){ 
			$response = array(
				'ok' => false,
				'msg' => "The email has been registered."
				);
		}else{
			$response = array(
				'ok' => true,
				'msg' => "The email hasn't been registered."
				);
			
		}
		
		echo json_encode($response);
	}


/*------------------------------------------------*/
}

?>