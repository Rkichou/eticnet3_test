<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	
		// Récupère l'adresse
		$sql="select * from  users_adresses "; ;
		$sql.= "where id='"  . mysqli_real_escape_string($con,$_POST['id_adresse']) . "' "; 
		// echo $sql;
		$retour=mysqli_query($con,$sql); 
		$row=mysqli_fetch_object($retour);
		$adresse="";
		$adresse.=$row->company_name . "\r\n";
		$adresse.=$row->adresse_1 . "\r\n";
		$adresse.=$row->adresse_2 . "\r\n";
		$adresse.=$row->adresse_3 . "\r\n";
		$adresse.=$row->zip . "\r\n";
		$adresse.=$row->state . "\r\n";
		$adresse.=$row->city . "\r\n";
		$adresse.=$row->country . "\r\n";
		$adresse.=$row->contact . "\r\n";
		$adresse.=$row->telephone . "\r\n";
		$adresse.=$row->email . "\r\n";
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "other_delivery_adress=\"" . mysqli_real_escape_string($con,$adresse) . "\" ";
		$sql.= "where `num_of`='" . mysqli_real_escape_string($con,$_POST['num_of']) . "' "; 
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
?>

