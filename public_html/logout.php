<?php
require ('controller.php');
startSession();
	if(isset($_SESSION['custID'])){
		 session_destroy();
	echo "Successfully logged out.";
	}
	else{
		echo "LogOut Failed...";
	}
?>
