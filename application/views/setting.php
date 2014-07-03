<div id="content">


<div id="setting_container">

		
	<div id="setting_form_container">
		
		<?php
		
			//use short conditions to fill what the user already has
			//example of short conditions in php
			//$score > 10 ? ($age > 10 ? 'Average' : 'Exceptional'
			//var_dump($user_settings);
	
			// page/setting is the controller, changeSetting is the function
			$form = array(
				'class' => 'form',
				'id' => 'changeSetting'
				);
			$username = array(
	              'name'        => 'username',
	              'id'          => 'username',
				  'type'		=> 'text',
	              'value'       => $user_settings['userName'],
	              'maxlength'   => '11',
	              'size'        => '75'
	            );
			
			$beSearchable = array(
	              'name'        => 'beSearchable',
	              'id'          => 'beSearchable',
				  'type'		=> 'checkbox',
	              'checked'       => $user_settings['userBeSearchable'],
	              'size'        => '75'
	            );
			$seeGoalsOnDash = array(
	              'name'        => 'seeGoalsOnDash',
	              'id'          => 'seeGoalsOnDash',
				  'type'		=> 'checkbox',
	              'checked'       => $user_settings['userDisplayGoalsOnDash'],
	              'size'        => '75'
	            );
			$submit = array(
					'name' => 'submit_setting',
	    			'id' => 'submit_setting',
	    			'value' => 'Submit',
	    			'type' => 'submit',
	    			'content' => 'Submit'
				);
			$delete_account_submit = array(
					'name' => 'delete_account_submit',
	    			'id' => 'delete_account_submit',
	    			'value' => 'Delete Account',
	    			'type' => 'submit',
	    			'content' => 'Delete Account'
				);
			$update_pass_submit = array(
					'name' => 'update_pass_submit',
	    			'id' => 'update_pass_submit',
	    			'value' => 'Update Password',
	    			'type' => 'submit',
	    			'content' => 'Update Password'
				);
			
				echo form_open(base_url().'changeSetting', $form);
		?>
		
		<div id="setting_title">
			<span>Change A Setting</span>
		</div>
		<div class="settinginput">
			<label for="change_username">Username</label>
			<?php echo form_input($username); ?>
		</div>
		<div class="settinginput">
			<?php echo form_input($beSearchable); ?>
			<label for="beSearchable">Allow People To Find You</label>
		</div>
		<div class="seeGoalsOnDash">
			<?php echo form_input($seeGoalsOnDash); ?>
			<label for="seeGoalsOnDash">Display Goals On Dashboard</label>
		</div>
		
		<div class="setting_submit">
			<?php echo form_button($submit); ?>
		</div>
		
		</br>
		</br>
		<div id="setting_title">
			<span>Change Password Or Remove Account</span>
		</div>
		
		
		<div class="settinginput">
			<label for="beSearchable">Old Password</label>
		</div>
		<div class="settinginput">
			<label for="beSearchable">New Password</label>
		</div>
		
		<div class="update_pass_submit">
			<?php echo form_button($update_pass_submit); ?>
		</div>
		
		<div class="delete_account_submit">
			<?php echo form_button($delete_account_submit); ?>
		</div>
		
		<div class="errors">
			<?php if (isset($general_error)) {
				echo $general_error;
			   }
			   echo validation_errors('<p>');
			?>
		</div>
		<div class="success">
			<?php if (isset($success_msg)) {
				echo $success_msg;
			   }
			?>
		</div>
		
	</div>
	
		



	<?php echo form_close(); ?>
</div>


</div>