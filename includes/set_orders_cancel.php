<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");

		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "id_customer_cancel=\"" . $_SESSION['id'] . "\",";
		$sql.= "horodatage_customer_cancel=\"" . date('Y-m-d H:i:s') . "\",";
		$sql.= "status=\"" . 0 . "\" where num_of='"  . $_POST['num_of'] . "' and status<5"; // Annulation impossible si ordre en production
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
?>

