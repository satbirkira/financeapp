<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
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
                               
								   ?>
                                      <div class="personalinfo">                                        
                                        <label for="firstname">First Name:</label>                                        
                                        <?php echo form_input($firstname,set_value('firstname')); ?>                                        <div class="errordesp"><?php echo form_error('firstname'); ?></div>
                                       </div>
                                       <div class="personalinfo">
                                        <label for="lastname">Last Name:</label>                                         
                                         <?php echo form_input($lastname,set_value('lastname')); ?>
                                         <div class="errordesp"><?php echo form_error('lastname'); ?></div>
                                       </div>
                                       <div class="personalinfo">
                                        <label for="screenname">Choose a Username:</label> 
                                        <?php echo form_input($screenname,set_value('screenname')); ?>
  										<div class="errordesp"><?php echo form_error('screenname'); ?></div>
                                       </div>

                                       <div class="personalinfo">
                                            <label for="email">Your Email:</label>
                                            <?php echo form_input($email,set_value('email')); ?>
                                            <div class="errordesp"><?php echo form_error('email'); ?></div>                                       </div>

                                        <div class="personalinfo">
                                            <label for="password">Choose a Password:</label>
                                            <?php echo form_password($password,set_value('password')); ?>
                                            <div class="errordesp"><?php echo form_error('password'); ?></div>                                        </div>

                                        <div class="personalinfo">
                                            <label for="confirmpassword">Confirm the Password:</label>
                                            <?php echo form_password($confirmpassword,set_value('confirmpassword')); ?>
                                            <div class="errordesp"><?php echo form_error('confirmpassword'); ?></div>                                       </div>                                      

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