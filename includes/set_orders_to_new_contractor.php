<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
		$statut=1; // Repasse un cancel en new
		
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "status=\"" . $statut . "\" where num_of='"  . $_POST['num_of'] . "' and `status`=0"; 
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
?>

