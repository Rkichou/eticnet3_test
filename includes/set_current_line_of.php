<?php
	session_start();
	$_SESSION['current_line_of']=$_POST['num_ligne'];
	echo $_SESSION['current_line_of'];