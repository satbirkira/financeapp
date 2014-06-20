<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
</head>
<body>

<div id="container">
	<div id="login">
	<?php
		//login is the controller, signin is the function
		$form = array(
			'class' => 'form',
			'id' => 'signin'
			);
		$username = array(
              'name'        => 'username',
              'id'          => 'username',
			  'type'		=> 'text',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '25'
            );
		$password = array(
              'name'        => 'password',
              'id'          => 'password',
			  'type'		=> 'password',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '25'
            );
		$submit = array(
				'name' => 'submit',
    			'id' => 'submit_sigin',
    			'value' => 'Submit',
    			'type' => 'submit',
    			'content' => 'Submit'
			);
		
		echo form_open('login/signin', $form);
		
		if (validation_errors()):
			?>
			<div class="errors">
				<?php echo validation_errors('<p>');?>
			</div>
			<?php endif;?>
			<div class="signupinput">
				<label for="firstname">Username:</label>
				<?php echo form_input($username); ?>
			</div>
			<div class="signupinput">
				<label for="password">Password:</label>
				<?php echo form_input($password); ?>
			</div>
			<div class="signupinput">
				<?php echo form_button($submit); ?>
			</div>
			<?php echo form_close(); ?>
		<a href="index.php/registration/register">Sign Up</a>
		<a href="#">Forget Password</a>
	</div>
</div>
<div>

</div>
</body>
</html>