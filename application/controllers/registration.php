<?php 
class Registration extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
    }
	
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
						
			$name =  $this->input->post('screenname');
			$firstname =  $this->input->post('firstname');
			$lastname =  $this->input->post('lastname');
			$company = $this->input->post('email');
			$position = $this->input->post('password');
			$email = $this->input->post('confirmpassword');								
																
			$todayDate = date("Ymd");							
										
			$registration = array(
									'userName'=> $this->input->post('screenname'),																	
									'userFirstName'=> $this->input->post('firstname'),											
									'userLastName'=> $this->input->post('lastname'),
									'userEmail'=>$this->input->post('email'),
									'userPassword'=>$this->user_model->hash_password($this->input->post('password')),		
									'userCreatedOn'=>$todayDate
			);

			$result = $this->user_model->create_new_user($registration);
			if ($this->form_validation->run() == true && $result)
				{									
					redirect('index.php/registration/register2');
					
				}
		}
		
		$data['main_content'] = 'register1';
		
		$this->load->view('register1',$data);
		
		//$this->load->view('includes/template',$data);
		
	}

	function register2()
	{
		// If registration button is clicked.
		if(isset($_POST["btnRegister2"]))
		{
			$profilePic = "";			
			$config['upload_path'] = $_SERVER["DOCUMENT_ROOT"].'/financeapp/uploads/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
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

			$result = $this->user_model->update_user_details($userDetails,$uid);
			if ($this->form_validation->run() == true && $result)
			{
				//should redirect to the dashboard				
				//currently link to itself because there is no dashboard
				redirect('index.php/registration/register2');
			}
		
		}			
		$data['main_content'] = 'register2';		
		//$this->load->view('includes/template',$data);
		$this->load->view('register2',$data);
	}
}
?>