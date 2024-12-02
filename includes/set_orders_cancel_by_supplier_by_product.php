<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	
		// Récupère le type de produit par l'id
		$sql="select * from  " . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "_orders " ;
		$sql.= "where id='"  . mysqli_real_escape_string($con,$_POST['id']) . "' ";
		$retour=mysqli_query($con,$sql); 
		$row=mysqli_fetch_object($retour);
		$product=$row->type_label;
		$num_of=$row->num_of; 
		$reference=$row->reference;
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "id_supplier_cancel=\"" . $_SESSION['id'] . "\",";
		$sql.= "horodatage_supplier_cancel=\"" . date('Y-m-d H:i:s') . "\",";
		$sql.= "comment_canceled=\"" . mysqli_real_escape_string($con,$_POST['motif']) . "\",";
		if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
		{
			$sql.= "status=\"" . 0 . "\" where `type_label`='"  . mysqli_real_escape_string($con,$product) . "' and `num_of`='" . mysqli_real_escape_string($con,$num_of) . "'  and `reference`='" . mysqli_real_escape_string($con,$reference) . "'"; // Passe en waiting for production
		}
		else{
		$sql.= "status=\"" . 0 . "\" where `type_label`='"  . mysqli_real_escape_string($con,$product) . "' and `num_of`='" . mysqli_real_escape_string($con,$num_of) . "' "; // Passe en waiting for production
		}
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
?>

