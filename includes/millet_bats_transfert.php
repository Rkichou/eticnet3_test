<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
		///////////////////////////////////////////////////////////////////////
	
		if($_SESSION['prefix_contractor']!='mmg')
		{
			die("Session invalide !");
		}
		/// Rècupère la directoy de dépot des BATs
		$initDirectory=$_SESSION['prefix_contractor'];
		// Directory des BATs en Attente
		$batsDirectoryW = "../bats/" . $initDirectory ."/waiting_for_move_in_waiting_mode/";
		// Directory des BATs en attente de validation
		$batsDirectoryV = "../bats/" . $initDirectory ."/waiting/";
		// Rècupère la liste des BATs en attente
		$files = scandir($batsDirectoryW, SCANDIR_SORT_DESCENDING);
		// Parcours les fichiers en attente
		foreach($files as $key => $value)
		{
			// Le numéro de l'étiquette est toujours le dernier chiffre
			// les noms de fichier sont séparés par des underscore "_"
			// echo $value . "<br/>";
			$tbl_name=explode("_",$value);
			if($value!="index.php")
			{
					//	Analyse si on est sur l'étiquette n° 1
					$tbl_bat=explode(".",$value); // Sépare le nom de fichier en 2 pour enlever l'extension   ATTENTION JAMAIS DE "." dans le nom du BAT
					// print_r($tbl_bat);
					// Reconstitue le filename du BAT sans l'extension
					$batFileName="";
					// Rècupère l'extention du BAT
					$batFileExtension="." . $tbl_bat[count($tbl_bat)-1];
					
					// Exception du . dans la taille
					if(count($tbl_bat)==2)
					{
						$batFileName=$tbl_bat[0];
					}
					if(count($tbl_bat)==3)
					{
						$batFileName=$tbl_bat[0] . "." . $tbl_bat[1]  ;
					}
					echo $batFileName;
					// Vérifie que l'on soit sur le BAT N°1
					$tbl_numeroBAT=explode("_",$batFileName);
					$numeroBAT=$tbl_numeroBAT[count($tbl_numeroBAT)-1];
					// Reconstitue le filename du BAT sans le numéro d'étiquette 
					$batBaseNameWoNum="";
					for($n=0;$n<count($tbl_numeroBAT)-1;$n++)
					{
						// echo  "<i>N° : " . $tbl_numeroBAT[$n] . "</i>";
						$batBaseNameWoNum.=$tbl_numeroBAT[$n] . "_";
					}
							echo "<hr/>" . $batBaseNameWoNum . "<br/>";	// Nom du BAT sans l'extention
							for($b=1;$b<=20;$b++)
							{
								// Reconstitue le nom complet du BAT
								$batRealName=$batBaseNameWoNum . $b . $batFileExtension;
								// echo $batRealName; 
								// Vérifie si le fichier existe
								$batRealDirectory=$batsDirectoryW;
								//
								 // echo $batRealDirectory . $batRealName . "<br/>";
								if (file_exists($batRealDirectory . $batRealName))
								{
									// On vérifie si il est déjà validé 
											// Recherche la dernière version validée
											$sqlB="select * from suivi_bats where bat_name like '%" . $batBaseNameWoNum . "%' and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
											$retourB=mysqli_query($con,$sqlB);
											$fullLinkImage="";
											while($rowB=mysqli_fetch_array($retourB))
											{
												$fullLinkImage=$rowB['bat_name'];
											}
											/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
											// Recherche spécifique Dior Taille U depuis un fichier extracfinal à la place du fichier Excel fournit en début de saison
											// Recherche uniquement si on n'a pas trouvé précédemment avec TU
											echo "...." . $sqlB . "<br/>";
											//
											if(trim($fullLinkImage)>"")
											{
												// Rècupère uniquement le nom de l'image
												$tbl_name_image=explode("/",$fullLinkImage);
												echo "<b>Déjà validé</b> <i>" . $tbl_name_image[count($tbl_name_image)-1] . " impossible de passer en attente.</i>";
											}
											else
											{
												echo "<b>Introuvable</b> <i> passe en mode attente de validation.";
												// die();
												$sourceFile     =$_SERVER["DOCUMENT_ROOT"] . "/" .substr($batRealDirectory,3) . $batRealName;
												$destinationFile=$_SERVER["DOCUMENT_ROOT"] . "/" .substr($batsDirectoryV,3)  . $batRealName ;
																															// Ajoute un horodatage aux documents validés ou refusés
												if(rename($sourceFile,$destinationFile))
												{
													echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "OK" .  "<br/>";
												}
												else
												{
													echo "<br/>" . $sourceFile . " move to " . $destinationFile . " result : " . "KO" .  "<br/>";
												}
												echo "<br/>";
												// die();
											}
								}
								else
								{
									break; // On sort de la boucle... Les numéros doivent se suivre
								}
							}
						echo "</div>";
			}
		}
			die();
	echo "</div>";


?>

