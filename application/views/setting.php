<div id="content">


<div id="setting_container">
	<div id="setting_title">
		<span>Change A Setting</span>
	</div>
		
	<div id="setting_form_container">
		
		<?php
			// page/setting is the controller, changeSetting is the function
			$form = array(
				'class' => 'form',
				'id' => 'changeSetting'
				);
			$beSearchable = array(
	              'name'        => 'beSearchable',
	              'id'          => 'beSearchable',
				  'type'		=> 'checkbox',
	              'value'       => '',
	              'size'        => '75'
	            );
			$seeGoalsOnDash = array(
	              'name'        => 'seeGoalsOnDash',
	              'id'          => 'seeGoalsOnDash',
				  'type'		=> 'checkbox',
	              'value'       => '',
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
	    			'content' => 'Delete Accoun'
				);
			
				echo form_open(base_url().'changeSetting', $form);
		?>
		<div class="settinginput">
			<?php echo form_input($beSearchable); ?>
			<label for="beSearchable">Allow People To Find You</label>
		</div>
		<div class="seeGoalsOnDash">
			<?php echo form_input($seeGoalsOnDash); ?>
			<label for="seeGoalsOnDash">Display Goals On Dashboard</label>
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

	<div class="setting_submit">
		<?php echo form_button($submit); ?>
	</div>
	<div class="delete_account_submit">
		<?php echo form_button($delete_account_submit); ?>
	</div>
	<?php echo form_close(); ?>
</div>


</div>