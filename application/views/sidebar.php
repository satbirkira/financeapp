<div id="sidebar">
<?php

	echo "Welcome: ". $this->session->userdata('userFirstName') . " ". $this->session->userdata('userLastName') . "[<a href='../login/logout'>Logout</a>]" ;
	
?>
</div>