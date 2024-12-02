<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "status=\"" . 4 . "\" where id='"  . $_POST['id'] . "' "; // Passe en waiting for production
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
?>

