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
	if($_SESSION['prefix_contractor']=="dior")
	{
		// Reconstitue toutes les tailles possibles de BAT
		$tbl_name=explode("_",$_POST['batBaseNameWoNum']);
		$nameWOSize="";
		for($x=0;$x<= count($tbl_name)-3;$x++)
		{
			$nameWOSize.= $tbl_name[$x] . "_";
		}
		// echo $nameWOSize;
		// die();
		// Reconstitution de toutes les tailles possibles et validations si elles existent
		/// Rècupère la directoy de dépot des BATs
			$initDirectory=$_SESSION['prefix_contractor'];
			$batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
			$date_validation=date('YmdHis');
		
			// Directory des BATs en Attente
			$files = scandir($batsDirectoryW, SCANDIR_SORT_DESCENDING);
			$f=0;
			foreach($files as $key=>$value)
			{
				if(substr($value,0,strlen($nameWOSize))==$nameWOSize)
				{
					$_POST['batBaseNameWoNum']="";
					// echo $value . "\r\n";
					$tbl_name2=explode("_",$value);
					for($x=0;$x<= count($tbl_name)-2;$x++)
					{
						$_POST['batBaseNameWoNum'].= $tbl_name2[$x] . "_";
					}
					// echo $_POST['batBaseNameWoNum'];
					// die();
					///////////////////////////////////////////////////////////////////////////
					// $sql2="select * from roles order by libelle";
					// $retour2=mysqli_query($con,$sql2); 
					// while($row2=mysqli_fetch_array($retour2))
					// {
						// $tbl_role[$row2['id']] = $row2['libelle']; 
					// }
					//
					echo $_SERVER["DOCUMENT_ROOT"] . "<br/>";;
					for($nbBAT=1;$nbBAT<=$_POST['nbBAT'];$nbBAT++)
					{
						// 			Déplace le BAT vers le répertoire de validation
						//Reconstitue le nom du fichier					substr enlève ../ !
						$sourceFile     =$_SERVER["DOCUMENT_ROOT"] . "/" . substr($_POST['directoryS'],3) . $_POST['batBaseNameWoNum'] . $nbBAT . $_POST['batFileExtension'];
						$destinationFile=$_SERVER["DOCUMENT_ROOT"] . "/". substr($_POST['directoryD'],3) . $_POST['batBaseNameWoNum'] . $date_validation . "_" . $nbBAT. $_POST['batFileExtension']  ;
																																			// Ajoute un horodatage aux documents validés ou refusés
						if(rename($sourceFile,$destinationFile))
						{
							echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "OK" .  "<br/>";
						}
						else
						{
							echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "KO" .  "<br/>";
						}
						// Création de l'enregistrement
							$sql="insert into suivi_bats (id,user_id,prefix_contractor,bat_name,comment,state,horodatage) value (";
							$sql.= "Null,";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$destinationFile) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_POST['commentaire']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_POST['state']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,date('Y-m-d H:i:s')) . "\") "; // Heure serveur
							$retour=mysqli_query($con,$sql);
						// Enregistre l'événement dans le journal
							if($_POST['state']==1)
							{
								$action="VALIDATION";
							}
							if($_POST['state']==2)
							{
								$action="REFUS";
							}
							$sql="insert into journal_actions (id,user_id,prefix_contractor,num_of,bat_name,action,horodatage) value(";
							$sql.= "Null,";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "\", ";
							$sql.= "\"" . "NONE" . "\","; 
							$sql.= "\"" . mysqli_real_escape_string($con,$destinationFile) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$action) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,date('Y-m-d H:i:s')) . "\") "; // Heure serveur
							$retour=mysqli_query($con,$sql);

					}
				}
			}
	} // Fin Dior
	if($_SESSION['prefix_contractor']=="chloe")
	{
		// Reconstitue toutes les tailles possibles de BAT
		// $tbl_name=explode("_",$_POST['batBaseNameWoNum']);
		// echo $_POST['batBaseNameWoNum'] . "\r\n";
		$nameWOSize="";
		// for($x=0;$x<= count($tbl_name)-3;$x++)
		// {
			// $nameWOSize.= $tbl_name[$x] . "_";
		// }
		$nameWOSize=substr($_POST['batBaseNameWoNum'],0,strlen($_POST['batBaseNameWoNum'])-6);
		// echo $nameWOSize;
		// die("LA");
		// Reconstitution de toutes les tailles possibles et validations si elles existent
		/// Rècupère la directoy de dépot des BATs
			$initDirectory=$_SESSION['prefix_contractor'];
			$batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
			$date_validation=date('YmdHis');
		
			// Directory des BATs en Attente
			$files = scandir($batsDirectoryW, SCANDIR_SORT_DESCENDING);
			$f=0;
			// print_r($files);
			// die();
			foreach($files as $key=>$value)
			{
				// echo $value . "/" . $nameWOSize;
				if(substr($value,0,strlen($nameWOSize))==$nameWOSize)
				{
					// die("ici");
					$_POST['batBaseNameWoNum']="";
					// echo $value . "\r\n";
					// die("ici 0");
					$tbl_name2=explode("_",$value);
					// for($x=0;$x<= count($tbl_name)-1;$x++)
					// {
						$_POST['batBaseNameWoNum'].= $tbl_name2[0] . "_";
					// }
					// echo $_POST['batBaseNameWoNum'];
					// die("ici 1");
					///////////////////////////////////////////////////////////////////////////
					// $sql2="select * from roles order by libelle";
					// $retour2=mysqli_query($con,$sql2); 
					// while($row2=mysqli_fetch_array($retour2))
					// {
						// $tbl_role[$row2['id']] = $row2['libelle']; 
					// }
					//
					// die("ici 2");
					// echo $_SERVER["DOCUMENT_ROOT"] . "<br/>";;
					// die();
					for($nbBAT=1;$nbBAT<=$_POST['nbBAT'];$nbBAT++)
					{
						// echo $nbBAT;
						// die();
						// 			Déplace le BAT vers le répertoire de validation
						//Reconstitue le nom du fichier					substr enlève ../ !
						$sourceFile     =$_SERVER["DOCUMENT_ROOT"] . "/" . substr($_POST['directoryS'],3) . $_POST['batBaseNameWoNum'] . $nbBAT . $_POST['batFileExtension'];
						$destinationFile=$_SERVER["DOCUMENT_ROOT"] . "/". substr($_POST['directoryD'],3) . $_POST['batBaseNameWoNum'] . $date_validation . "_" . $nbBAT. $_POST['batFileExtension']  ;
						
						// echo $sourceFile;
						// echo "\r\n";
						// echo $destinationFile;
						// die();
						// Ajoute un horodatage aux documents validés ou refusés
							if(rename($sourceFile,$destinationFile))
							{
								echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "OK" .  "<br/>";
							}
							else
							{
								echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "KO" .  "<br/>";
							}
						// Création de l'enregistrement
							$sql="insert into suivi_bats (id,user_id,prefix_contractor,bat_name,comment,state,horodatage) value (";
							$sql.= "Null,";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$destinationFile) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_POST['commentaire']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_POST['state']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,date('Y-m-d H:i:s')) . "\") "; // Heure serveur
							$retour=mysqli_query($con,$sql);
						// Enregistre l'événement dans le journal
							if($_POST['state']==1)
							{
								$action="VALIDATION";
							}
							if($_POST['state']==2)
							{
								$action="REFUS";
							}
							$sql="insert into journal_actions (id,user_id,prefix_contractor,num_of,bat_name,action,horodatage) value(";
							$sql.= "Null,";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['prefix_contractor']) . "\", ";
							$sql.= "\"" . "NONE" . "\","; 
							$sql.= "\"" . mysqli_real_escape_string($con,$destinationFile) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,$action) . "\", ";
							$sql.= "\"" . mysqli_real_escape_string($con,date('Y-m-d H:i:s')) . "\") "; // Heure serveur
							$retour=mysqli_query($con,$sql);

					}
				}
			}
			echo "OK";
	} // Fin Chloe
?>

