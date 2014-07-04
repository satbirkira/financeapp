<div id="template_content_title">
	Your account preferences.
</div>
<div id="template_content_container">
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
		              'maxlength'   => '45',
		              'size'        => '75'
		            );
				$firstname = array(
		              'name'        => 'firstname',
		              'id'          => 'firstname',
					  'type'		=> 'text',
		              'value'       => $user_settings['userFirstName'],
		              'maxlength'   => '45',
		              'size'        => '75'
		            );
				$lastname = array(
		              'name'        => 'lastname',
		              'id'          => 'lastname',
					  'type'		=> 'text',
		              'value'       => $user_settings['userLastName'],
		              'maxlength'   => '45',
		              'size'        => '75'
		            );
				$email = array(
		              'name'        => 'email',
		              'id'          => 'email',
					  'type'		=> 'text',
		              'value'       => $user_settings['userEmail'],
		              'maxlength'   => '45',
		              'size'        => '75'
		            );
				$old_password = array(
		              'name'        => 'password',
		              'id'          => 'password',
					  'type'		=> 'password',
		              'value'       => '',
		              'maxlength'   => '100',
		              'size'        => '75'
		            );
				$new_password = array(
		              'name'        => 'confirm_password',
		              'id'          => 'confirm_password',
					  'type'		=> 'password',
		              'value'       => '',
		              'maxlength'   => '100',
		              'size'        => '75'
		            );	
				$currentlySaved = array(
		              'name'        => 'currentlySaved',
		              'id'          => 'currentlySaved',
					  'type'		=> 'text',
		              'value'       => $user_settings['userCurrentlySaved'],
		              'maxlength'   => '10',
		              'size'        => '75'
		            );	
				$interestOnSavings = array(
		              'name'        => 'interestOnSavings',
		              'id'          => 'interestOnSavings',
					  'type'		=> 'text',
		              'value'       => $user_settings['userInterestOnSavings'],
		              'maxlength'   => '10',
		              'size'        => '75'
		            );	
				$monthlyIncome = array(
		              'name'        => 'monthlyIncome',
		              'id'          => 'monthlyIncome',
					  'type'		=> 'text',
		              'value'       => $user_settings['userMonthlyIncome'],
		              'maxlength'   => '10',
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
			<div class="settinginput">
				<label for="change_firstname">First Name</label>
				<?php echo form_input($firstname); ?>
			</div>
			<div class="settinginput">
				<label for="change_lastname">Last Name</label>
				<?php echo form_input($lastname); ?>
			</div>
			<div class="settinginput">
				<label for="change_username">Username</label>
				<?php echo form_input($username); ?>
			</div>
			<div class="settinginput">
				<label for="change_email">Email</label>
				<?php echo form_input($email); ?>
			</div>
			
			<div class="settinginput">
				<label for="change_currentlySaved">Currently Saved</label>
				<?php echo form_input($currentlySaved); ?>
			</div>
			<div class="settinginput">
				<label for="change_interestOnSavings">Interest On Savings</label>
				<?php echo form_input($interestOnSavings); ?>
			</div>
			<div class="settinginput">
				<label for="change_monthlyIncome">Monthly Income</label>
				<?php echo form_input($monthlyIncome); ?>
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
			
			<div class="delete_account_submit">
				<?php echo form_button($delete_account_submit); ?>
			</div>
			
			</br>
			</br>
			<div id="setting_title">
				<span>Change Password</span>
			</div>
			
			
			<div class="settinginput">
				<label for="old_pass">Old Password</label>
				<?php echo form_input($old_password); ?>
			</div>
			<div class="settinginput">
				<label for="new_pass">New Password</label>
				<?php echo form_input($new_password); ?>
			</div>
			
			<div class="update_pass_submit">
				<?php echo form_button($update_pass_submit); ?>
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