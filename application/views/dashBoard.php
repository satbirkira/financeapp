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
		foreach ($goals_array as $row)
		{
			$percent_complete = min(100, (((int)$row['amountChangedHistoryLogs']+(int)$row['currentlySaved'])/(int)$row['totalCost'])*100);
			if($percent_complete == 100)
			{
				$goals_completed += 1;
			}
			else
			{
				$goals_outstanding += 1;
				$sendThisMonthOnGoals += $row['monthlyDepot'];
			}
			
			
		}
			
		?>	
		<div class="dash_big_display blue">
			<div class="amount">
				<span class="currency_sym">$</span><span class="dash_value"><?php echo $thisMonthsIncome;  ?></span>
			</div>
			<div class="description">This Month's Income</div>
		</div>

		<div class="dash_big_display blue">
			<div class="amount">
				<span class="currency_sym">$</span><span class="dash_value"><?php echo $sendThisMonthOnGoals;  ?></span>
			</div>
			<div class="description">Save To Goals This Month</div>
		</div>

		<div class="dash_big_display red">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value"><?php echo $goals_outstanding;  ?></span>
			</div>
			<div class="description">Outstanding Goals</div>
		</div>

		<div class="dash_big_display green">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value"><?php echo $goals_completed;  ?></span>
			</div>
			<div class="description">Goals Completed</div>
		</div>

		<div class="dash_big_display yellow last">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value">3</span>
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
		foreach ($goals_array as $row)
		{
			$percent_complete = min(100, (((int)$row['amountChangedHistoryLogs']+(int)$row['currentlySaved'])/(int)$row['totalCost'])*100);
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