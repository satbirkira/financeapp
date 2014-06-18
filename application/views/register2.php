<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register-Finish</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
</head>
<body>
         <!-- Start the container Div -->
         <div id="container"> 
            <!-- Registration Div starts here -->
            <div id="registration">
                        									
                <div class="regititle">
                    Your account information
                </div>	  
                
                 <!-- Form Div starts here -->
                 <?php                
                $profilePic = array(
                              'name'        => 'profilePic',
                              'id'          => 'profilePic',
                              'class'		=> 'form_input'
                            );
                $username = $this->session->userdata('suis_user_name');
				$firstname = $this->session->userdata('suis_first_name');
				$lastname = $this->session->userdata('suis_last_name');
                      
					       echo form_open_multipart('index.php/registration/register2');
                            
							    if (validation_errors()):?>
                                
                                    <div class="errors">
                                        <?php echo validation_errors('<p>');?>
                                    </div>
                                <?php endif;?>
	                             
                                   <div class="personalinfo">
                                        <label for="userName">User Name:</label>
                                        <?php echo $username; ?>
                                   </div>
                				   <div class="personalinfo">
                                        <label for="firstName">First Name:</label>
                                        <?php echo $firstname; ?>
                                   </div>
                                   
                                    <div class="personalinfo">
                                        <label for="lastName">Last Name:</label>
                                        <?php echo $lastname; ?>
                                     </div>
                                     
                                    <div class="personalinfo">
                                        <label for="profilePic">Profile Pic:</label>
                                        <?php echo form_upload($profilePic,set_value('profilePic')); ?>
                                     </div>                   
                                   

                                   

                                    <div class="personalinfo">
                                        <input type="submit" name="btnRegister2" value="Save" class="submit-button" />
                                    </div>
                            <?php
                                echo form_close();
                            ?>
        				</div>
		         <!-- Form Div ends here -->       
                      </div> 
             <!-- Registration Div ends here --> 
         <!-- End of the container Div -->
</body>
</html>