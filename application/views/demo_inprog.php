<!DOCTYPE html>
<html>
<head><title></title>

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<link href="../../css/style.css" type="text/css" rel="stylesheet"/>
	<link href="../../css/typicalPage.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<style>
	#inprogress {
		width: 300px;
		height: 150px;
		margin: 150px auto 0px;
		background: url('<?=base_url()?>css/assets/Logo.png') no-repeat;
	}
	#inprog_text {
		width: 300px;
		height: 25px;
		font-weight: 400;
		font-size: 20px;
		margin: 0px auto;
		text-align: center;
		background-color: #f4b556;
	}
	#link {
		margin: 10px auto;
		text-align: center;
	}
	#link a {
		text-decoration: none;
	}
</style>
<div id="inprogress"></div>
<div id="inprog_text">
	UNDER CONSTRUCTION...
</div>
<div id="link">
	Welcome, <strong><?=$this->session->userdata('suis_first_name') . " ". $this->session->userdata('suis_last_name')?></strong><br><br>
	<a href='<?=base_url()?>page/dashboard'>"Show me the money!"</a><br><br>
	<a href='<?=base_url()?>login/logout'>SIGN OUT!</a>
</div>
</body>
</html>
