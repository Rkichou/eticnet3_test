<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
		 
		// Sécurité si numéro d'O.F. <6
		if(strlen($_POST['num_of'])<6)
		{
			die("Erreur num O.F.");
		}
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders   where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "' and status<5"; // Annulation impossible si ordre en production
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			// Change le statut
			$code_destroy=$row['num_of'] . "_" . $row['reference'] . "_" . $row['coloris']. "_" . $row['code_ean'] . "_";
			if($_SESSION['prefix_contractor']=="lan")
			{
				if($row2['type_label']=="CARE LABEL")
				{
					// 
					$code_destroy=$row2['reference'] . "_" ;
				}
			}
			// echo $code_destroy . "\r\n";
			$sqlD="update suivi_bats set ";
			$sqlD.= "horodatage=\"" . date('Y-m-d H:i:s') . "\",";
			
			$sqlD.= "state=\"" . 3 . "\" where bat_name like '/home/eticnet/www/bats/".$_SESSION['prefix_contractor']."/validate/" . $code_destroy . "%' and state=1 and prefix_contractor='". $_SESSION['prefix_contractor']."'"; 
			$retourD=mysqli_query($con,$sqlD);
			// Bouge le BAT
			$sqlD="select * from suivi_bats  where bat_name like '/home/eticnet/www/bats/".$_SESSION['prefix_contractor']."/validate/" . $code_destroy . "%' and state=3 and prefix_contractor='". $_SESSION['prefix_contractor']."'"; 
			$retourD=mysqli_query($con,$sqlD);
			while( $rowD=mysqli_fetch_array($retourD))
			{
				echo $rowD['bat_name'] . "\r\n";
				// move le BAT dans le repertoire devalides
				$sourceFile=$rowD['bat_name'];
				$destinationFile=str_replace("/validate/","/devalides/",$rowD['bat_name'])  ;
				rename($sourceFile,$destinationFile);
			}
			
		}
		
		
		// Update de l'enregistrement
		$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
		$sql.= "num_of=\"" . $_POST['num_of'] . "_delete"  . "\",";
		$sql.= "id_customer_cancel=\"" . $_SESSION['id'] . "\",";
		$sql.= "horodatage_customer_cancel=\"" . date('Y-m-d H:i:s') . "\",";
		$sql.= "comment_canceled=\"" . mysqli_real_escape_string($con,$_POST['motif']) . "\",";
		$sql.= "status=\"" . 0 . "\" where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] ."' and status<5"; // Annulation impossible si ordre en production
		$retour=mysqli_query($con,$sql); 
		 

?>

