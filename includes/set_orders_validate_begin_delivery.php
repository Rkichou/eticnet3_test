<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
	{
		// Update de l'enregistrement
		$sql="update " . $_POST['prefix_contractor'] . "_orders set ";
		$sql.= "status=\"" . 7 . "\","; // Passe en waiting for control quality
		$sql.= "date_delivery=\"" . date('Y-m-d H:i:s') . "\" where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "' and status=6 "; // Passe en waiting for control quality
		$retour=mysqli_query($con,$sql); 
	}
	else{

		// Update de l'enregistrement
		$sql="update " . $_POST['prefix_contractor'] . "_orders set ";
		$sql.= "status=\"" . 7 . "\","; // Passe en waiting for control quality
		$sql.= "date_delivery=\"" . date('Y-m-d H:i:s') . "\" where num_of='"  . $_POST['num_of'] . "' and status=6 "; // Passe en waiting for control quality
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
	}
?>

