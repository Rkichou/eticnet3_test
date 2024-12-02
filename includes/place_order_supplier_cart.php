<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
		$statut=4; // Waiting for production
		// print_r($_POST);
		// print_r($_SESSION);
		// Rècupération des datas articles
		 $sql="select * from articles where id=" . $_POST['id'];
		$retour=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($retour))
		{
			$ref_support=$row['ref_produit_fini'];
			$ref_contractor=$row['ref_contractor'];
			$libelle=$row['libelle'];
		}
		// Récupère l'adresse
		$sql="select * from  users_adresses "; ;
		$sql.= "where id='"  . mysqli_real_escape_string($con,$_POST['adr']) . "' "; 
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
		// ID du printshop
		$printShop=$row->printshop;
		// Supplier code
		$code_supplier=$row->code_supplier;
		
		// Création de  l'enregistrement
		$sql="insert into " . $_SESSION['prefix_contractor'] . "_orders ";
		$sql.="(`id`, `code_service`,`validation_supplier`,`code_ean`, `made_in`,`coloris`,`size`,`cup`, `num_of`, `code_supplier`, `type_label`,  `reference_support`, `reference`,"; 
		$sql.="`qty_init`, `qty_to_produce`,  `status`, `id_printshop` , `other_delivery_adress`,`date_integration`)"; 
		$sql.= " VALUES (NULL,";
		$sql.="'" . "NEGOCE"  . "',";
		$sql.="'" . "1"  . "',";
		$sql.="'" . "NONE"  . "',";
		$sql.="'" . "NONE"  . "',";
		$sql.="'" . "NONE"  . "',";
		$sql.="'" . "NONE"  . "',";
		$sql.="'" . "NONE"  . "',";
		
		$sql.="'" . $_SESSION['id'] . date('YmdHis') . "',";
		$sql.="'" .  $code_supplier . "',";
		$sql.="\"" . mysqli_real_escape_string($con,$libelle ) . "\",";
		$sql.="\"" . mysqli_real_escape_string($con,$ref_contractor)  . "\",";
		$sql.="\"" . mysqli_real_escape_string($con,$ref_support)  . "\",";
		
		$sql.="'" . $_POST['qty']  . "',";
		$sql.="'" . $_POST['qty']  . "',";
		$sql.="'" . $statut  . "',";
		$sql.="'" . $printShop  . "',";
		$sql.="\"" . mysqli_real_escape_string($con,$adresses)  . "\",";
		
		$sql.="'" . date('Y-m-d H:i:s') . "')";
		
		$retour=mysqli_query($con,$sql); 
		// echo $sql;
?>


