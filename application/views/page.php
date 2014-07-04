<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Finance Buddy</title>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
	<link type="stylesheet" href="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<link href="../../css/style.css" type="text/css" rel="stylesheet"/>
</head>
<body>

<div id="container">
	<?php $this->load->view('topbar', $content_data); ?>
	<div id="content_container">
		<?php $this->load->view($content, $content_data); ?>
		<!--<?php //$this->load->view('sidebar', $content_data); ?>-->
	</div>

</div>
<div>

</div>
</body>
</html>