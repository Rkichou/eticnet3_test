<?php

	ini_set('display_errors', 1);
	
	error_reporting(E_ALL);
	
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	
	
	
	/////////////////////////////////////////////////////////:
	$indice_dup="DUP_";
	// Vérifie l'indice DUP_ existe déjà
	if($_SESSION['prefix_contractor']=="mmg"||$_SESSION['prefix_contractor']=="lan")
	{
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='DUP_"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "'";
	}
	else
	{
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='DUP_"  . $_POST['num_of'] . "'";
	}
	$retour=mysqli_query($con,$sql); 
	if(mysqli_num_rows($retour)>0)
	{
		$indice_dup="DUP_DUP_";
	}
	//
	// Vérifie l'indice DUP_DUP_ existe déjà
	if($_SESSION['prefix_contractor']=="mmg"||$_SESSION['prefix_contractor']=="lan")
	{
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='DUP_DUP_"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "'";
	}
	else
	{
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='DUP_DUP_"  . $_POST['num_of'] . "'";
	}
	$retour=mysqli_query($con,$sql); 
	if(mysqli_num_rows($retour)>0)
	{
		$indice_dup="DUP_DUP_DUP_";
	}
	///////////////////////////////////////////////
	// lecture des O.F. et duplication de la ligne
	if($_SESSION['prefix_contractor']=="mmg"||$_SESSION['prefix_contractor']=="lan")
	{
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='"  . $_POST['num_of'] . "' and `reference`='" . $_POST['reference'] . "'";
	}
	else
	{
		$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='"  . $_POST['num_of'] . "'";
	}
	
	////////// 3 duplicatas maxi ////////////
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$sql2="insert into  " . $_SESSION['prefix_contractor'] . "_orders  ";
			$sql2.="(id,num_of,code_supplier,validation_supplier,id_printshop,type_label,prefix_bat,reference_support,reference,coloris,size,cup,made_in,code_ean,";
			$sql2.="qty_init,qty_to_produce,status,reference_bat,saison,date_integration,customer_datas,file_name,code_service,type_ordre,status_composition, product_name,genre) values (";
			
			$sql2.="0,";
			$sql2.="'$indice_dup" . $row['num_of']. "',";
			$sql2.="'" . $row['code_supplier']. "',";
			$sql2.="'" . $row['validation_supplier']. "',";
			$sql2.="'" . $row['id_printshop']. "',";
			$sql2.="'" . $row['type_label']. "',";
			$sql2.="'" . $row['prefix_bat']. "',";
			$sql2.="'" . $row['reference_support']. "',";
			$sql2.="'" . $row['reference']. "',";
			$sql2.="'" . addslashes($row['coloris']). "',";
			$sql2.="'" . $row['size']. "',";
			$sql2.="'" . $row['cup']. "',";
			$sql2.="'" . $row['made_in']. "',";
			$sql2.="'" . $row['code_ean']. "',";
			$statut=1;
			switch($_SESSION['prefix_contractor'])
			{
				// Spécifique dior -- Duplicata à Zéro --
				case "dior":
					$sql2.="'" . 0 . "',";
					$sql2.="'" . 0 . "',";
					break;
				// Spécifique Lemaire -- Quantite à Zéro --
				case "lem":
					$sql2.="'" . 0 . "',";
					$sql2.="'" . 0 . "',";
					//$statut=4;
					break;	
				default:
					$sql2.="'" . $row['qty_init']. "',";
					$sql2.="'" . $row['qty_to_produce']. "',";
					break;
			}
			if($_SESSION['prefix_contractor']=="lan"){
				$statut=4;
			}
			
			$sql2.="'" . $statut . "',"; // Force la statut à new
			$sql2.="'" . $row['reference_bat']. "',";
			$sql2.="'" . $row['saison']. "',";
			$sql2.="'" . date('Y-m-d H:i:s'). "',";
			$sql2.="'" . addslashes($row['customer_datas']). "',";
			$sql2.="'" . $row['file_name']. "',";
			$sql2.="'" . $row['code_service']. "',";
			$sql2.="'" . $row['type_ordre']. "',";
			$sql2.="'" . $row['status_composition']. "',";
			$sql2.="'" . $row['product_name']. "',";
			$sql2.="'" . $row['genre']. "'";
			$sql2.=");";	
			echo $sql2;
			$retour2=mysqli_query($con,$sql2);
		
		}
?>

