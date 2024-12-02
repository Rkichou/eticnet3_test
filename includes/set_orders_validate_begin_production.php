<?php
	session_start();
	require_once("../config.inc.php");
	include '../includes/verification_bats_valides.php';

$batValid=verify_bats($_POST['num_of'],$_POST['reference'],$_SESSION['prefix_contractor'],$con);
if($batValid==true)	{
	if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
	{
		// Update de l'enregistrement
		$sql="update " . $_POST['prefix_contractor'] . "_orders set ";
		$sql.= "status=\"" . 5 . "\","; // Passe en waiting for control quality
		$sql.= "date_production=\"" . date('Y-m-d H:i:s') . "\" where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "' and status=4 "; 
		$retour=mysqli_query($con,$sql); 
	}
	else{
		// Update de l'enregistrement
		$sql="update " . $_POST['prefix_contractor'] . "_orders set ";
		$sql.= "status=\"" . 5 . "\","; 
		// Passe en waiting for control quality
		$sql.= "date_production=\"" . date('Y-m-d H:i:s') . "\" where num_of='"  . $_POST['num_of'] . "' and status=4 "; // Passe en waiting for control quality
		
		$retour=mysqli_query($con,$sql); 
	}
	echo "Production confirmed.";
}
else{
	// Pas de BAT validé 
    echo "Production not confirmed. Waiting for BATs validation."	;
}
?>

