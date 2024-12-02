	<?php
	session_start();
	 // error_reporting(1);
 // error_reporting('On');

	require_once("../config.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	// print_r($_POST);
	// die();
	///////////////////////////////////////////////////////////////////////////
	// $sql2="select * from roles order by libelle";
	// $retour2=mysqli_query($con,$sql2); 
	// while($row2=mysqli_fetch_array($retour2))
	// {
		// $tbl_role[$row2['id']] = $row2['libelle'];
	// }
	//

	// echo $_SERVER["DOCUMENT_ROOT"] . "<br/>";;
	for($nbBAT=1;$nbBAT<=$_POST['nbBAT'];$nbBAT++)
	{
		// 			Déplace le BAT vers le répertoire de validation
		//Reconstitue le nom du fichier					substr enlève ../ !
		$sourceFile     =$_SERVER["DOCUMENT_ROOT"] . "/" . substr($_POST['directoryS'],3) . $_POST['batBaseNameWoNum'] . $nbBAT . $_POST['batFileExtension'];
		$destinationFile=$_SERVER["DOCUMENT_ROOT"] . "/". substr($_POST['directoryD'],3) . $_POST['batBaseNameWoNum'] .  $nbBAT. $_POST['batFileExtension']  ;
																															// Ajoute un horodatage aux documents validés ou refusés
		if(rename($sourceFile,$destinationFile))
		{
			echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "OK" .  "<br/>";
		}
		else
		{
			echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "KO" .  "<br/>";
		}
		// die();
		// Création de l'enregistrement de dévalidation pour horodater l'événement
			$sql="insert into suivi_bats (id,user_id,prefix_contractor,bat_name,comment,state,horodatage) value (";
			$sql.= "Null,";
			$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,$destinationFile) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,$_POST['commentaire']) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,$_POST['state']) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,date('Y-m-d H:i:s')) . "\") "; // Heure serveur
			$retour=mysqli_query($con,$sql);
		// Update enregistrement de validation en passant le statut 1 à 3
			$sql="update suivi_bats set state='3' where bat_name=\"" .  mysqli_real_escape_string($con,$sourceFile) . "\" and state=1 limit 1";
			$retour=mysqli_query($con,$sql);
		// Enregistre l'événement dans le journal
			$sql="insert into journal_actions (id,user_id,prefix_contractor,num_of,bat_name,action,horodatage) value(";
			$sql.= "Null,";
			$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "\", ";
			$sql.= "\"" . "NONE" . "\","; 
			$sql.= "\"" . mysqli_real_escape_string($con,$destinationFile) . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,"DEVALIDATION") . "\", ";
			$sql.= "\"" . mysqli_real_escape_string($con,date('Y-m-d H:i:s')) . "\") "; // Heure serveur
			$retour=mysqli_query($con,$sql);

	}
	
?>

