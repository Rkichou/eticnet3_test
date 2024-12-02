<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
	{
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "urgent_mode=\"" . 1 . "\" where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "' ";
		$retour=mysqli_query($con,$sql);
	}
	else{
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "urgent_mode=\"" . 1 . "\" where num_of='"  . $_POST['num_of'] . "' ";
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
	}
?>

