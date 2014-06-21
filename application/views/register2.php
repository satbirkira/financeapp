<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register-Finish</title>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/style_shu.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
	$(document).ready(function(e) {
        $('.submit-button').button();
    });
	

	
	</script> 
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
                           
				?>
                             
                   <div class="personalinfo">
                        <label for="userName">User Name:</label>
                        <div class="info"><?php echo $username; ?></div>
                   </div>
                   <div class="personalinfo">
                        <label for="firstName">First Name:</label>
                        <div class="info"><?php echo $firstname; ?></div>
                   </div>
                   
                   <div class="personalinfo">
                        <label for="lastName">Last Name:</label>
                        <div class="info"><?php echo $lastname; ?></div>
                   </div>
                  
                   <div class="personalinfo">
                        <label for="profilePic">Profile Pic:</label>
                        <div class="info"><?php echo form_upload($profilePic,set_value('profilePic')); ?></div>
                        <div class="errordesp"><?php echo form_error('profilePic'); ?></div>                         
                   </div>                    
                  
                   <div style="width:80%;margin-left:0px;margin-right:0px;">
                      <input type="submit" name="btnRegister2" value="Done" class="submit-button" />               
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