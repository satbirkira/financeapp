<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Finance Buddy</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css">
</head>
<body>

<div id="reg_container">
	<div id="reg_logo_container">
	</div>
	<div id="reg_form_container">
		<div id="reg_welcome_text">
			<center><span>FinanceBuddy Register</span></center>
		</div>
		<?php
			//login is the controller, signin is the function
			$form = array(
				'class' => 'form',
				'id' => 'signup'
				);
			$firstname = array(
	              'name'        => 'firstname',
	              'id'          => 'firstname',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '11',
	              'size'        => '75'
	            );
			$lastname = array(
	              'name'        => 'lastname',
	              'id'          => 'lastname',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '11',
	              'size'        => '75'
	            );
			$username = array(
	              'name'        => 'username',
	              'id'          => 'username',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '11',
	              'size'        => '75'
	            );
			$email = array(
	              'name'        => 'email',
	              'id'          => 'email',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '11',
	              'size'        => '75'
	            );
			$password = array(
	              'name'        => 'password',
	              'id'          => 'password',
				  'type'		=> 'password',
	              'value'       => '',
	              'maxlength'   => '11',
	              'size'        => '75'
	            );
			$submit = array(
					'name' => 'submit_reg',
	    			'id' => 'submit_sigup',
	    			'value' => 'Register',
	    			'type' => 'submit',
	    			'content' => 'Register'
				);
			
				echo form_open(base_url().'registration/register', $form);
		?>
		<div class="reginput">
			<label for="firstname">First Name:</label>
			<?php echo form_input($firstname); ?>
		</div>
		<div class="reginput">
			<label for="lastname">Last Name:</label>
			<?php echo form_input($lastname); ?>
		</div>
		<div class="reginput">
			<label for="username">Username:</label>
			<?php echo form_input($username); ?>
		</div>
		<div class="reginput">
			<label for="email">Email:</label>
			<?php echo form_input($email); ?>
		</div>
		<div class="reginput">
			<label for="password">Password:</label>
			<?php echo form_input($password); ?>
		</div>
		<div class="errors">
			<?php if (isset($authentication_error)) {
				echo $authentication_error;
			   }
			   echo validation_errors('<p>');
			?>
		</div>
	</div>

	<div class="reg_submit">
		<?php echo form_button($submit); ?>
	</div>
	<?php echo form_close(); ?>
</div>
</body>
</html>