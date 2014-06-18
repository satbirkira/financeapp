<?php 
class Registration extends CI_Controller{
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->load->helper('url');
    }
	
	function register()
	{
		// If registration button is clicked.
		if(ISSET($_POST["btnRegister"]))
		{
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			// Validate the user form capture.
			$this->form_validation->set_rules('screenname', 'Screen Name', 'trim|required');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required');
						
			$name =  $this->input->post('screenname');
			$firstname =  $this->input->post('firstname');
			$lastname =  $this->input->post('lastname');
			$company = $this->input->post('email');
			$position = $this->input->post('password');
			$email = $this->input->post('confirmpassword');								
																
			$todayDate = date("Ymd");							
										
			$registration = array(
										'userName'=> $this->input->post('screenname'),										'userFirstName'=> $this->input->post('firstname'),										'userLastName'=> $this->input->post('lastname'),
										'userEmail'=>$this->input->post('email'),
										'userPassword'=>$this->user_model->hash_password($this->input->post('password')),
										
										'userCreatedOn'=>$todayDate
			);

			$result = $this->user_model->create_new_user($registration);
			if ($result)
				{
					// Email Code
					//echo 'lalal';
					redirect('index.php/registration/register2');
					
				}
		}
		
		$data['main_content'] = 'register1';
		$data['arrsecurityQ'] = 'lala';
		//$data['arrsecurityQ'] = $this->securityquestion_model->get_securityQuestions();
		$arrSecurity = array();
		$arrSecurity["0"] = "Select Security Question";
		/*foreach ($data['arrsecurityQ'] as $row)
		{
			$arrSecurity["".$row->securityQuestionId.""] = "".$row->securityQuestion."";
			
		}
		$data['arrsecurityQuestions'] = $arrSecurity; */
		$this->load->view('register1',$data);
		
		//$this->load->view('includes/template',$data);
		
	}

	function register2()
	{
		// If registration button is clicked.
		if(ISSET($_POST["btnRegister2"]))
		{
			$profilePic = "";
			$config['upload_path'] = $_SERVER["DOCUMENT_ROOT"].'/website/uploads/profile/';
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
			$dob = $this->input->post('selYear')."-".$this->input->post('selMonth')."-".$this->input->post('selDay');
			$uid = $this->session->userdata('suis_user_id');							
			$userDetails = array('userProfileImage'=> $profilePic
										//'userGender'=>$this->input->post('gender'),
										//'userCurrentCountryId'=>$this->input->post('selCountry'),
										//'userCitizenship'=>$this->input->post('selCitizenship'),
										//'userDateOfBirth'=>$dob,
										//'userBiography'=>$this->input->post('biography'),
										//'userInterests'=>$this->input->post('interests')
										
			);

			$result = $this->user_model->update_user_details($userDetails,$uid);
			if ($result)
				{
					
					
					
				}
		}
		
		
		//$data['arrCountries'] = $this->country_model->get_Countries();
		
		$data['main_content'] = 'register2';
		//$this->load->view('includes/template',$data);
		$this->load->view('register2',$data);
	}
}
?>