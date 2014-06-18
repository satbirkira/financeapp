<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
                <!-- Registration Div starts here -->
                <div id="registration">
                
                	<div class="regititle">
                    Register with your email address
                	</div>	
                     <!-- Form Div starts here -->
                     <?php
					 $firstname = array(
                                  'name'        => 'firstname',
                                  'id'          => 'firstname',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
					$lastname = array(
                                  'name'        => 'lastname',
                                  'id'          => 'lastname',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
                    $screenname = array(
                                  'name'        => 'screenname',
                                  'id'          => 'screenname',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
                    $email = array(
                                  'name'        => 'email',
                                  'id'          => 'email',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '100'
                                );
                    $password = array(
                                  'name'        => 'password',
                                  'id'          => 'password1',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '30'
                                );
                    $confirmpassword = array(
                                  'name'        => 'confirmpassword',
                                  'id'          => 'confirmpassword',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '30'
                                );
                 
                                
								echo form_open('index.php/registration/register');
                                if (validation_errors()):
								   ?>
                                        <div class="errors">
                                            <?php echo validation_errors('<p>');?>
                                        </div>
                         <?php endif;?>
                                      <div class="personalinfo">
                                        <label for="firstname">First Name:</label>
                                            <?php echo form_input($firstname,set_value('firstname')); ?>
                                       </div>
                                       <div class="personalinfo">
                                        <label for="lastname">Last Name:</label>
                                            <?php echo form_input($lastname,set_value('lastname')); ?>
                                       </div>
                                       <div class="personalinfo">
                                        <label for="screenname">Choose a Username:</label>
                                            <?php echo form_input($screenname,set_value('screenname')); ?>
                                       </div>

                                       <div class="personalinfo">
                                            <label for="email">Your Email:</label>
                                            <?php echo form_input($email,set_value('email')); ?>
                                       </div>

                                        <div class="personalinfo">
                                            <label for="password">Choose a Password:</label>
                                            <?php echo form_password($password,set_value('password')); ?>
                                        </div>

                                        <div class="personalinfo">
                                            <label for="confirmpassword">Confirm the Password:</label>
                                            <?php echo form_password($confirmpassword,set_value('confirmpassword')); ?>
                                       </div>                                      

                                        <div class="personalinfo">
                                            <input type="submit" name="btnRegister" value="Register" class="submit-button" />
                                        </div>

                                   
                                <?php
                                    echo form_close();
                                ?>
                   
                         <!-- Form Div ends here -->  
                     </div> 
                     <!-- Registration Div ends here -->     
                    </div>
             <!-- End of the container Div -->
</body>
</html>