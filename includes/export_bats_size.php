<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
		///////////////////////////////////////////////////////////////////////
		// Parcours les fichiers en attente
		// print_r($_SESSION);
		// print_r($_SESSION);
		// die();
	
	echo "<div class='as_agence-div-header-table'>";

		echo "<div class='as_agence-div-content-table'>"; 
				/////////////////// Lecture des BATs en attente de validation ////////////////////////////
				/// Rècupère la directoy de dépot des BATs
				$initDirectory=$_SESSION['prefix_contractor'];
				// Directory des BATs en Attente
				$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
				// Directory des BATs refusés
					// Rècupère la liste des BATs validés
					$files = scandir($batsDirectoryV, SCANDIR_SORT_DESCENDING);
				// Ouverture fichier Export
				$filename="../exports/" . $_SESSION['prefix_contractor'] ."/" . $_SESSION['prefix_contractor'] . "_" . $date . ".csv";
				$fileDownload="../exports/" . $_SESSION['prefix_contractor'] ."/" . $_SESSION['prefix_contractor'] . "_" . $date . ".csv";
				// Création du filename export
				$fp=fopen($filename,"w");
				$ligne="BAT_NAME;OF;TYPE_LABEL;DIMENSION_MM";
				fwrite($fp,$ligne . "\r\n");
				$ligne="";
				foreach($files as $key => $value)
				{
					if($value!="index.php")
					{
						// Rècupère les dimensions du BATs
						$fileName=$batsDirectoryV . $value;
						list($width, $height) = getimagesize($fileName);
						// echo $width . "<br/>" . $height ;
						$height=$height/12;
						// Retire la date de validation du BAT
						$tblBAT=explode("_",$value);
						// echo $value . ":" . ":" . $tblBAT[0] . ":" . $tblBAT[1] . ":" .  $height . "<br/>"; 
						$ligne=$value . ";"  . $tblBAT[0] . ";" . $tblBAT[1] . ";" .  $height ;
						fwrite($fp,$ligne . "\r\n");
						$ligne="";
			
					}
				}
			fclose($fp);
			// Création du lien de téléchargement
			echo "<a href='$fileDownload' download='$fileDownload' class='button'>EXPORT FILE</a>";	
		echo "</div>";
	echo "</div>";


?>

