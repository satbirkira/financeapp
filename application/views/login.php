<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
</head>
<body>

<div id="container">
	<?php
		//login is the controller, signin is the function
		//setup arrays
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
              'size'        => '50'
            );
		$password = array(
              'name'        => 'password',
              'id'          => 'password',
			  'type'		=> 'password',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '50'
            );
		$labels = array(
				'class' 	=> 'label',
				'style' 	=> 'color: #000;'
			);
		$submit = array(
				'name' => 'submit',
    			'id' => 'submit_sigin',
    			'value' => 'Submit',
    			'type' => 'submit',
    			'content' => 'Submit'
			);
		echo form_open('login/signin', $form);
		echo form_label('Username: ', 'username', $labels);
		echo form_input($username);
		echo form_label('Password: ', 'password', $labels);
		echo form_input($password);
		echo form_button($submit);
		echo form_close();
	?>
</div>

</body>
</html>