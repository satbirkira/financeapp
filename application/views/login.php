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

<script>

	function submitLogin()
	{
		//first encrypt password
		document.getElementById("real_password").value = CryptoJS.MD5(document.getElementById("password").value);
		document.getElementById("password").value = "";
		//submit
		document.getElementById("signin").submit();
	}

</script>

<div id="login_container">
	<div id="login_logo_container">
	</div>
	<div id="login_form_container">
		<div id="login_welcome_text">
			<center><span>Welcome to FinanceBuddy!</span></center>
		</div>
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
	              'value'       => set_value('username', ''),
	              'maxlength'   => '45',
	              'size'        => '75'
	            );
			$password = array(
	              'name'        => 'password',
	              'id'          => 'password',
				  'type'		=> 'password',
	              'value'       => '',
	              'maxlength'   => '100',
	              'size'        => '75'
	            );
			$submit = array(
					'name' => 'submit_login',
	    			'id' => 'submit_sigin',
	    			'value' => 'Submit',
	    			'type' => 'submit',
	    			'content' => 'Submit',
					'onClick' => 'submitLogin()'
				);
			
				echo form_open(base_url().'login/login', $form);
		?>
		<div class="signupinput">
			<label for="firstname">Username:</label>
			<?php echo form_input($username); ?>
		</div>
		<div class="signupinput">
			<label for="password">Password:</label>
			<?php echo form_input($password); ?>
			<input type="hidden" id="real_password" name="real_password" value= "" />
		</div>
		<div class="errors">
			<?php if (isset($authentication_error)) {
				echo $authentication_error;
			   }
			   echo validation_errors('<p>');
			?>
		</div>
	</div>

	<div class="login_submit">
		<?php echo form_button($submit); ?>
	</div>
	<?php echo form_close(); ?>
	<div id="login_links_container">
		<a id="login_links" style="float:left" href="<?=base_url()?>registration">Sign Up</a>
		<!--a id="login_links" style="float:right" href="#">Forget Password</a-->
	</div>
</div>
</body>
</html>