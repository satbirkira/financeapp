<div id="template_content_title">
	Your dashboard.
</div>
<div id="template_content_container">
	<div id="dash_metrics">
		<?php
		$goals_completed = 0;
		$goals_outstanding = 0;
		$sendThisMonthOnGoals = 0;
		$thisMonthsIncome = $user_settings['userMonthlyIncome'];
		$amountTotalSavedThisMonth = 0;
		
		$numberOfCollaboratorsForYourGoals = 0;
		$numberOfGoalsYourCollbingOn = 0;
		
		foreach ($goals_array as $row)
		{
			//old way where currentlySaved was actually what you initially had saved
			//$percent_complete = min(100, (((int)$row['amountChangedHistoryLogs']+(int)$row['currentlySaved'])/(int)$row['totalCost'])*100);
			
			$amountTotalSavedThisMonth += $row['amountChangedHistoryLogsThisMonth'];
			
			$percent_complete = min(100, (((int)$row['currentlySaved'])/(int)$row['totalCost'])*100);
			if($percent_complete == 100)
			{
				$goals_completed += 1;
			}
			else
			{
				$goals_outstanding += 1;
				$sendThisMonthOnGoals += $row['monthlyDepot'];
			}
			
			if($row['numberOfCollaboratorsForYourGoals'] > 0)
			{
				$numberOfCollaboratorsForYourGoals += 1;
			}
			
			if($row['numberOfGoalsYourCollbingOn'] > 0)
			{
				$numberOfGoalsYourCollbingOn += 1;
			}
			
			
		}
			
		?>	
		<div class="dash_big_display blue">
			<div class="amount">
				<span class="currency_sym">$</span><span class="dash_value"><?php echo $amountTotalSavedThisMonth;  ?></span>
			</div>
			<div class="description">Saved Away This Month</div>
		</div>

		<div class="dash_big_display blue">
			<div class="amount">
				<span class="currency_sym">$</span><span class="dash_value"><?php echo $sendThisMonthOnGoals;  ?></span>
			</div>
			<div class="description">Need To Save This Month</div>
		</div>

		<div class="dash_big_display red">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value"><?php echo $goals_outstanding;  ?></span>
			</div>
			<div class="description">Your Outstanding Goals</div>
		</div>

		<div class="dash_big_display green">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value"><?php echo $goals_completed;  ?></span>
			</div>
			<div class="description">Your Goals Completed</div>
		</div>

		<div class="dash_big_display yellow last">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value"><?php echo (int)($numberOfCollaboratorsForYourGoals+$numberOfGoalsYourCollbingOn) ?></span>
			</div>
			<div class="description">Collaborative Goals</div>
		</div>
		<div style="clear: both"></div>
	</div>

<?if(true):?>
	
	<?php 
	
	if($user_settings['userDisplayGoalsOnDash'] == true)
	{
		echo "<div id='setting_title' style='margin: 30px 0px 15px 0px;'>";
		echo "	<span style='font-size: 30px; font-weight: 300;'>My goals</span>";
		echo "</div>";
		echo "<div id='dash_metrics'>";
		if(empty($goals_array))
		{
			echo "Use the goals page to get started";
		}
		foreach ($goals_array as $row)
		{
			//old way where currentlySaved was actually what you initially had saved
			//$percent_complete = min(100, (((int)$row['amountChangedHistoryLogs']+(int)$row['currentlySaved'])/(int)$row['totalCost'])*100);
			$percent_complete = min(100, (((int)$row['currentlySaved'])/(int)$row['totalCost'])*100);
			echo "<div class='dash_prog_display'>";
				echo "<div class='goal_title' style='float:left;'>$row[goalName]</div>";
				echo "<div class='goal_percent' style='float:right;text-align: right;'>$percent_complete%</div>";
				echo "<div class='goal_bar_outer'>";
				echo "<div class='goal_bar_inner' style='width: $percent_complete%'></div>";
				echo "</div>";

			echo "</div>";
		}
	}
	?>
		<div style="clear: both"></div>
	</div>
<?endif?>
	<div style="clear: both"></div>
</div>