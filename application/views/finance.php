<div id="template_content_title">
	Your finance information.
</div>
<div id="template_content_container">
	<div id="finance_form_container">
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

		// page/finance is the controller, changefinance is the function
		$form = array(
			'class' => 'form',
			'id' => 'changefinance'
			);
		$currentlySaved = array(
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
		$submit = array(
				'name' => 'submit_finance',
    			'id' => 'submit_finance',
    			'value' => 'Submit',
    			'type' => 'submit',
    			'content' => 'Submit'
			);

			echo form_open(base_url().'page/changefinance', $form);
	?>
	<div id="finance_title" style="margin: 25px 0px 15px 0px;">
		<span style="font-size: 20px; font-weight: 300;">Account finances</span>
	</div>
	<div id="finance_form_container">
		
		<div class="financeinput left">
			<label for="change_currentlySaved">Currently Saved</label><br>
			<?php echo form_input($currentlySaved); ?>
		</div>
		<div class="financeinput right">
			<label for="change_interestOnSavings">Interest On Savings</label><br>
			<?php echo form_input($interestOnSavings); ?>
		</div>
		<div class="financeinput left">
			<label for="change_monthlyIncome">Monthly Income</label><br>
			<?php echo form_input($monthlyIncome); ?>
		</div>
		<div style="clear:both"></div>
	</div>
	<div id="finance_form_container">
		<div class="updateacc_button">
			<?php echo form_button($submit); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>