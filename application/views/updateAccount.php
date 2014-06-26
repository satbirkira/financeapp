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

<div id="updateacc_container">
	<div id="updateacc_form_container">
		<div id="updateacc_form_title"></div>
		<?php
			//login is the controller, signin is the function
			$form = array(
				'class' => 'form',
				'id' => 'signup'
				);
			$currentlySaved = array(
	              'name'        => 'currentlySaved',
	              'id'          => 'currentlySaved',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '10',
	              'size'        => '75',
	              'placeholder'	=> 'Currently Saved'
	            );
			$interestOnSavings = array(
	              'name'        => 'interestOnSavings',
	              'id'          => 'interestOnSavings',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '10',
	              'size'        => '75',
	              'placeholder'	=> 'Interest on Savings'
	            );
			$monthlyIncome = array(
	              'name'        => 'monthlyIncome',
	              'id'          => 'monthlyIncome',
				  'type'		=> 'text',
	              'value'       => '',
	              'maxlength'   => '10',
	              'size'        => '75',
	              'placeholder'	=> 'Current Monthly Income'
	            );
			$submit = array(
					'name' => 'submit_updateacc',
	    			'id' => 'submit_updateacc',
	    			'value' => 'Update Account',
	    			'type' => 'submit',
	    			'content' => 'Update Account'
				);
			$skip = array(
					'name' => 'submit_skip_updateacc',
	    			'id' => 'submit_skip_updateacc',
	    			'value' => 'Skip To Dashboard',
	    			'type' => 'submit',
	    			'content' => 'Skip To Dashboard'
				);
			
				echo form_open(base_url().'updateaccount', $form);
		?>
		<div class="updateaccinput">
			<?php echo form_input($currentlySaved); ?>
		</div>
		<div class="updateaccinput">
			<?php echo form_input($interestOnSavings); ?>
		</div>
		<div class="updateaccinput">
			<?php echo form_input($monthlyIncome); ?>
		</div>
		<div class="errors">
			<?php if (isset($authentication_error)) {
				echo $authentication_error;
			   }
			   echo validation_errors('<p>');
			?>
		</div>
		<br>
		<div class="updateacc_submit">
			<?php echo form_button($submit); ?>
		</div>
		<div class="skip_updateacc_submit">
			<?php echo form_button($skip); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</body>
</html>