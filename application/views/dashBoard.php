<div id="template_content_title">
	Your dashboard.
</div>
<div id="template_content_container">
	<div id="dash_metrics">
		<div class="dash_big_display blue">
			<div class="amount">
				<span class="currency_sym">$</span><span class="dash_value">2000</span>
			</div>
			<div class="description">Budget</div>
		</div>

		<div class="dash_big_display blue">
			<div class="amount">
				<span class="currency_sym">$</span><span class="dash_value">200</span>
			</div>
			<div class="description">Expenditure</div>
		</div>

		<div class="dash_big_display red">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value">21</span>
			</div>
			<div class="description">Outstanding Goals</div>
		</div>

		<div class="dash_big_display green">
			<div class="amount">
				<span class="currency_sym">#</span><span class="dash_value">3</span>
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
	<div id="setting_title" style="margin: 30px 0px 15px 0px;">
		<span style="font-size: 30px; font-weight: 300;">My goals</span>
	</div>
	<div id="dash_metrics">
	<?php 
	var_export($goals_array); 
	foreach ($goals_array as $row)
	{
		
		echo "<div class='dash_prog_display'>";
			echo "<div class='goal_title' style='float:left;'>$row[goalName]</div>";
			echo "<div class='goal_percent' style='float:right;text-align: right;'>". ((int)$row['amountChangedHistoryLogs']+(int)$row['currentlySaved'])/(int)$row['totalCost']."%</div>";
			echo "<div class='goal_bar_outer'>";
			echo "<div class='goal_bar_inner' style='width: 50%'></div>";
			echo "</div>";

		echo "</div>";
	}
		
	
	
	?>
		<div class="dash_prog_display">
			<div class="goal_title" style="float:left;">Goal #1 Title</div>
			<div class="goal_percent" style="float:right;text-align: right;">50%</div>
			<div class="goal_bar_outer">
				<div class="goal_bar_inner" style="width: 50%"></div>
			</div>
		</div>
		<div class="dash_prog_display">
			<div class="goal_title" style="float:left;">Goal #2 Title</div>
			<div class="goal_percent" style="float:right;text-align: right;">30%</div>
			<div class="goal_bar_outer">
				<div class="goal_bar_inner" style="width: 30%"></div>
			</div>
		</div>
		<div class="dash_prog_display">
			<div class="goal_title" style="float:left;">Goal #3 Title</div>
			<div class="goal_percent" style="float:right;text-align: right;">63%</div>
			<div class="goal_bar_outer">
				<div class="goal_bar_inner" style="width: 63%"></div>
			</div>
		</div>
		<div style="clear: both"></div>
	</div>
<?endif?>
	<div style="clear: both"></div>
</div>