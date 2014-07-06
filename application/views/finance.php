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
			
		$transactionGoal = 'transactionGoal';
		if(empty($goals_array))
		{
			$transactionGoal_options = Array();
		}
		else
		{
			foreach ($goals_array as $goal)
			{
				$transactionGoal_options[$goal['goalID']] = $goal['goalName'];
			}
		}
		$transactionAmount = array(
              'name'        => 'transactionAmount',
              'id'          => 'transactionAmount',
			  'type'		=> 'text',
              'maxlength'   => '10',
              'size'        => '20'
            );	
		$submit_finance = array(
				'name' => 'submit_finance',
    			'id' => 'submit_finance',
    			'value' => 'Submit',
    			'type' => 'submit',
    			'content' => 'Submit'
			);
		$submit_add_finance = array(
				'name' => 'submit_add_finance',
    			'id' => 'submit_add_finance',
    			'value' => 'Submit',
    			'type' => 'submit',
    			'content' => 'Add'
			);
		
			echo form_open(base_url().'page/changefinance', $form);
	?>
	<div id="finance_title" style="margin: 25px 0px 15px 0px;">
		<span style="font-size: 20px; font-weight: 300;">Account finances</span>
	</div>
	<div id="finance_form_container">
		Note: These values are only for your refrence. Finance Buddy does not automatic put money into goals.
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
		</div>
		<div id="finance_form_container">
			<div class="updateacc_button">
				<?php echo form_button($submit_finance); ?>
			</div>
		</div>
		<!--
		Add money to a goal:
		<div class="financeinput left">
			<label for="change_transactiongoal">Transaction Goal</label><br>
			<?php echo form_dropdown($transactionGoal,  $transactionGoal_options); ?>
		</div>
		<div class="financeinput left">
			<label for="change_transactionAmount">Amount To Put Into Goal</label><br>
			<?php echo form_input($transactionAmount); ?>
		</div>
		<div id="finance_form_container">
			<div class="updateacc_button">
				<?php echo form_button($submit_add_finance); ?>
			</div>
		</div>
		
		<div style="clear:both"></div>
		-->
	</div>

	<?php echo form_close(); ?>
	<!--

		<table>
		<tr>
			<td> 
				Goal Name
			</td>
			<td> 
				Date of Transaction
			</td>
			<td> 
				Changed Amount
			</td>
		</tr>
		<?php

		foreach ($transactions_array as $row)
		{
			echo "<tr>";
				echo "<td>";
					echo $row['goalName'];
				echo "</td>";
				echo "<td>";
					$trans_date = date("F d", STRTOTIME($row['eventDate']));
					$trans_year = date("Y", STRTOTIME($row['eventDate']));
					echo $trans_date. ", " .$trans_year;
				echo "</td>";
				echo "<td>";
					if((int)$row['amountChanged'] > 0)
					{
						echo "+".$row['amountChanged'];
					}
					else
					{
						echo $row['amountChanged'];
					}
				echo "</td>";
			echo "</tr>";
		}
		
		?>
		</table>
	
	-->
	
</div>