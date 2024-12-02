<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
		$statut=4; // sans validation du manufacturer
		if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
		{
			$statut=3;	// Millet passe par une validation manufacturer
			// Update de l'enregistrement
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "id_customer_validate=\"" . $_SESSION['id'] . "\",";
			$sql.= "horodatage_customer_validate=\"" . date('Y-m-d H:i:s') . "\",";
			$sql.= "status=\"" . $statut . "\" where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "' and status<3 "; // Passe en waiting for production uniquement si statut <3
			$retour=mysqli_query($con,$sql); 
			die();
		}
		else if($_SESSION['prefix_contractor']=="chloe")
		{
			$statut=3;	// chloe passe par une validation manufacturer
			// Update de l'enregistrement
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "id_customer_validate=\"" . $_SESSION['id'] . "\",";
			$sql.= "horodatage_customer_validate=\"" . date('Y-m-d H:i:s') . "\",";
			$sql.= "status=\"" . $statut . "\" where num_of='"  . $_POST['num_of'] . "' and status<3 "; // Passe en waiting for production uniquement si statut <3
			$retour=mysqli_query($con,$sql); 
			die();
		}
		else{

		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "id_customer_validate=\"" . $_SESSION['id'] . "\",";
		$sql.= "horodatage_customer_validate=\"" . date('Y-m-d H:i:s') . "\",";
		$sql.= "status=\"" . $statut . "\" where num_of='"  . $_POST['num_of'] . "' and status<4 "; // Passe en waiting for production uniquement si statut <4
 		$retour=mysqli_query($con,$sql); 
	}
		// echo $sql;
?>

