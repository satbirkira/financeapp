
<script>

	function submitLogin()
	{
		//first encrypt password
		document.getElementById("real_password").value = CryptoJS.MD5(document.getElementById("password").value);
		document.getElementById("real_new_password").value = CryptoJS.MD5(document.getElementById("new_password").value);
		
		document.getElementById("password").value = "";
		document.getElementById("new_password").value = "";
		//submit
		document.getElementById("update_pass_submit").submit();
	}

</script>

<div id="template_content_title">
	Your account settings.
</div>
<div id="template_content_container">
	<div id="setting_form_container">
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

	<?php

		// page/setting is the controller, changeSetting is the function
		$form = array(
			'class' => 'form',
			'id' => 'changeSetting'
			);
		$username = array(
              'name'        => 'username',
              'id'          => 'username',
			  'type'		=> 'text',
              'value'       => set_value('username',$user_settings['userName']),
              'maxlength'   => '45',
              'size'        => '75'
            );
		$firstname = array(
              'name'        => 'firstname',
              'id'          => 'firstname',
			  'type'		=> 'text',
              'value'       => set_value('firstname',$user_settings['userFirstName']),
              'maxlength'   => '45',
              'size'        => '75'
            );
		$lastname = array(
              'name'        => 'lastname',
              'id'          => 'lastname',
			  'type'		=> 'text',
              'value'       => set_value('lastname',$user_settings['userLastName']),
              'maxlength'   => '45',
              'size'        => '75'
            );
		$email = array(
              'name'        => 'email',
              'id'          => 'email',
			  'type'		=> 'text',
              'value'       => set_value('email',$user_settings['userEmail']),
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
              'name'        => 'new_password',
              'id'          => 'new_password',
			  'type'		=> 'password',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '75'
            );	
		/*$currentlySaved = array(
              'name'        => 'currentlySaved',
              'id'          => 'currentlySaved',
			  'type'		=> 'text',
              'value'       => set_value('currentlySaved',$user_settings['userCurrentlySaved']),
              'maxlength'   => '10',
              'size'        => '75'
            );	
		$interestOnSavings = array(
              'name'        => 'interestOnSavings',
              'id'          => 'interestOnSavings',
			  'type'		=> 'text',
              'value'       => set_value('interestOnSavings',$user_settings['userInterestOnSavings']),
              'maxlength'   => '10',
              'size'        => '75'
            );	
		$monthlyIncome = array(
              'name'        => 'monthlyIncome',
              'id'          => 'monthlyIncome',
			  'type'		=> 'text',
              'value'       => set_value('monthlyIncome',$user_settings['userMonthlyIncome']),
              'maxlength'   => '10',
              'size'        => '75'
            );	
		*/
		$beSearchable = array(
              'name'        => 'beSearchable',
              'id'          => 'beSearchable',
			  'type'		=> 'checkbox',
              'size'        => '75'
            );
		if((bool)$user_settings['userBeSearchable'] == true)
		{
			$beSearchable['checked'] = "1";
		}
		$seeGoalsOnDash = array(
              'name'        => 'seeGoalsOnDash',
              'id'          => 'seeGoalsOnDash',
			  'type'		=> 'checkbox',
              'size'        => '75'
            );
		if((bool)$user_settings['userDisplayGoalsOnDash'] == true)
		{
			$seeGoalsOnDash['checked'] = "1";
		}
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
    			'content' => 'Update Password',
				'onClick' => 'submitLogin()'
			);
		
			echo form_open_multipart(base_url().'page/changeSetting', $form);
	?>
	<div id="setting_title" style="margin: 25px 0px 15px 0px;">
		<span style="font-size: 20px; font-weight: 300;">Account Settings</span>
	</div>
	<div id="setting_form_container">
		<div class="settinginput left">
			<label for="change_firstname">First Name</label><br>
			<?php echo form_input($firstname); ?>
		</div>
		<div class="settinginput right">
			<label for="change_lastname">Last Name</label><br>
			<?php echo form_input($lastname); ?>
		</div>
		<div class="settinginput left">
			<label for="change_username">Username</label><br>
			<?php echo form_input($username); ?>
		</div>
		<div class="settinginput right">
			<label for="change_email">Email</label><br>
			<?php echo form_input($email); ?>
		</div>
		<!--
		<div class="settinginput left">
			<label for="change_currentlySaved">Currently Saved</label><br>
			<?php echo form_input($currentlySaved); ?>
		</div>
		<div class="settinginput right">
			<label for="change_interestOnSavings">Interest On Savings</label><br>
			<?php echo form_input($interestOnSavings); ?>
		</div>
		<div class="settinginput left">
			<label for="change_monthlyIncome">Monthly Income</label><br>
			<?php echo form_input($monthlyIncome); ?>
		</div>
		-->
		<div class="settinginput left">
			<div class="setting_check left">
				<label for="beSearchable">Allow People To Find You</label>
				<?php echo form_input($beSearchable); ?>
			</div>
			<div class="setting_check right">
				<label for="seeGoalsOnDash">Display Goals On Dashboard</label>
				<?php echo form_input($seeGoalsOnDash); ?>
			</div>
		</div>
		
		<div>
			<img src="../../uploads/profile/<?php echo $user_settings['userProfileImage']; ?>" width="100px" height="100px"  />
		</div>
		
		<div>
			<input type="file" name="profilePicture" size="20" />
		</div>
		
		
		<div style="clear:both"></div>
	</div>
	<div id="setting_form_container">
		<div id="setting_buttons">
			<div class="updateacc_button" style="margin-right: 15px">
				<?php echo form_button($submit); ?><br>
			</div>
			<div class="updateacc_button red">
				<?php echo form_button($delete_account_submit); ?><br>
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div id="setting_title" style="margin: 25px 0px 15px 0px;">
		<span style="font-size: 20px; font-weight: 300;">Change Password</span>
	</div>
	<div id="setting_form_container">
		<div class="settinginput left">
			<label for="old_pass">Old Password</label><br>
			<?php echo form_input($old_password); ?>
			<input type="hidden" id="real_password" name="real_password" value= "" />
		</div>
		<div style="clear: both"></div>
		<div class="settinginput left">
			<label for="new_pass">New Password</label><br>
			<?php echo form_input($new_password); ?>
			<input type="hidden" id="real_new_password" name="real_new_password" value= "" />
		</div>
	</div>
	<div id="setting_form_container">
		<div class="updateacc_button">
			<?php echo form_button($update_pass_submit); ?>
		</div>
		<div style="clear:both"></div>
	</div>

	
	
	<?php echo form_close(); ?>
	<div style="clear:both"></div>
</div>