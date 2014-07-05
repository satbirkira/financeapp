<div id="template_topbar">
	<div style="width: 5%; height: 80px; float: left;"></div>
	<div id="template_logo"></div>
	<!--span style="height: 40px; padding: 20px; line-height: 40px;">Welcome, <?=$suis_first_name . " ". $suis_last_name?>!</span-->
	<div style="width: 5%; height: 80px; float: right;"></div>
	<div id="template_menu">
		<span class="template_menu_item"><a href='<?=base_url()?>page/dashboard'>Dashboard</a></span>
		<span class="template_menu_item"><a href='<?=base_url()?>page/dashboard'>Goals</a></span>
		<span class="template_menu_item"><a href='<?=base_url()?>page/finance'>Finance</a></span>
		<span class="template_menu_item"><a href='<?=base_url()?>page/setting'>Settings</a></span>
		<span class="template_menu_item"><a href='<?=base_url()?>login/logout'>Logout</a></span>
	</div>
</div>