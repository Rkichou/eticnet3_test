<?php

	require_once("../config.inc.php");
	require_once("is_session_active.php");

	if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
	{
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "comment_contractor='" . mysqli_real_escape_string($con,$_POST['comment']) . "'," ;
		$sql.= "horodatage_contractor_comment='" . date('Y-m-d H:i:s') . "' " ;
 		$sql.= "where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "';"; 
		$retour=mysqli_query($con,$sql); 
		if (!$retour) {
			echo "<p style='color:red;'>SQL Error " . mysqli_error($con) . "</p>";
		}
	}
	else{

		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "comment_contractor='" . mysqli_real_escape_string($con,$_POST['comment']) . "'," ;
		$sql.= "horodatage_contractor_comment='" . date('Y-m-d H:i:s') . "' " ;
  		$sql.= "where num_of='"  . $_POST['num_of'] . "'; "; 
	//echo $sql;
		$retour=mysqli_query($con,$sql); 
		if (!$retour) {
			echo "<p style='color:red;'>SQL Error " . mysqli_error($con) . "</p>";
		}
	}
?>

