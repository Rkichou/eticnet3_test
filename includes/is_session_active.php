<?php
	
	session_start();
	
	// Si la session est inactive on tue le script
	if(!isset($_SESSION['id']) || !isset($_SESSION['id']))
	{
		echo "No session active!";
		// Wait for 2 seconds before redirecting
    	echo '<meta http-equiv="refresh" content="3;url=login.php">';
    	exit();
	}

