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
		$nomParametre="search_criteria_bat";
		if(!isset($_SESSION[$nomParametre]))
		{
			$searchCriteria="";
		}
		else
		{
			$searchCriteria=$_SESSION[$nomParametre];
		}
		echo $TBL_MESSAGE[17];
		// print_r($_SESSION);
		if(strtoupper($_SESSION['login'])=='DIANA_PAULA')
		{
			$searchCriteria="STK_";
		}
		echo "&nbsp;";
		echo  "<input style='width:40%;height:32px' name='bat_customer_search_criteria". "' value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_bat_keyup(event,this);\" onblur=\"set_search_criteria_bat(this);\">";
		echo "<br/><br/>";
	echo "</div>";
	echo "<div class='as_agence-div-content-table'>"; 
		/////////////////// Lecture des BATs en attente de validation ////////////////////////////
		/// Rècupère la directoy de dépot des BATs
		$initDirectory=$_SESSION['prefix_contractor'];
		// Directory des BATs en Attente
		$batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
		// Directory des BATs validés
		$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
		// Directory des BATs refusés
		$batsDirectoryR = "../bats/" . $initDirectory ."/refused/";
		// Directory des BATs dévalidés
		$batsDirectoryI = "../bats/" . $initDirectory ."/devalides/";
		
		// echo $batsDirectoryW ;
		if($_POST['mode']==1)
		{
			// Rècupère la liste des BATs en attente
			$files = scandir($batsDirectoryW, SCANDIR_SORT_DESCENDING);
		}
		//
		if($_POST['mode']==2)
		{
			// Rècupère la liste des BATs validés
			$files = scandir($batsDirectoryV, SCANDIR_SORT_DESCENDING);
		}
		//
		if($_POST['mode']==3)
		{
			// Rècupère la liste des BATs refusés
			$files = scandir($batsDirectoryR, SCANDIR_SORT_DESCENDING); 
		}
		//
		if($_POST['mode']==4)
		{
			// Rècupère la liste des BATs invalidés
			$files = scandir($batsDirectoryI, SCANDIR_SORT_DESCENDING); 
		}
		// dessine des onglets
		echo "<div class='as_agence-div-onglet'>";
				if($_POST['mode']==1)
				{
					echo "<div class='as_agence-index-onglet-actif' onclick='customer_bats(1)'>";
				}
				else
				{
					echo "<div class='as_agence-index-onglet-inactif' onclick='customer_bats(1)'>";
				}
					echo $TBL_MESSAGE[41];
				echo "</div>";
				if($_POST['mode']==2)
				{
					echo "<div class='as_agence-index-onglet-actif' onclick='customer_bats(2)'>";
				}
				else
				{
					echo "<div class='as_agence-index-onglet-inactif' onclick='customer_bats(2)'>";
				}
				echo $TBL_MESSAGE[42];
				echo "</div>";
				if($_POST['mode']==3)
				{
					echo "<div class='as_agence-index-onglet-actif' onclick='customer_bats(3)'>";
				}
				else
				{
					echo "<div class='as_agence-index-onglet-inactif' onclick='customer_bats(3)'>";
				}
					echo $TBL_MESSAGE[43];
				echo "</div>";
				if($_POST['mode']==4)
				{
					echo "<div class='as_agence-index-onglet-actif' onclick='customer_bats(4)'>";
				}
				else
				{
					echo "<div class='as_agence-index-onglet-inactif' onclick='customer_bats(4)'>";
				}
					echo $TBL_MESSAGE[60];
				echo "</div>";
		echo "</div>";
		// echo "<h3>" . $TBL_MESSAGE[41] . "</h3>";
		
		foreach($files as $key => $value)
		{
			$isVisible=true;
			
			// Visu par prefix_contractor
			// echo substr($_SESSION['user_service'],0,2) . " / " . substr($value,0,2);
			if($_SESSION['prefix_contractor']=="dior")
			{
				if(substr($_SESSION['user_service'],0,2)==substr($value,0,2))
				{
					$isVisible=true;
				}
				else
				{
					$isVisible=false;
				}
			}
			// Spécifique Lemaire
			if($_SESSION['prefix_contractor']=="lem")
			{
				// print_r($_SESSION);
					$codeService=explode(":",$_SESSION['user_service']);
					$tblOF=explode("_" , $value);
					$sqlOF="select * from " . $_SESSION['prefix_contractor'] . "_orders where num_of='" . $tblOF[0]. "' limit 1";
					$retourOF=mysqli_query($con,$sqlOF);
					$rowOF=mysqli_fetch_object($retourOF);
					// echo $codeService[0] . ":" . "<b>" . $rowOF->code_service . "</b><br/>";
					if($codeService[0]==$rowOF->code_service)
					{
						// echo "ok";
						$isVisible=true;
					}
					else
					{
						$isVisible=false;
					}
	
			}
			// echo $_SESSION['login'];
			// Spécifique Diana Paula
			if(strtoupper($_SESSION['login'])=='DIANA_PAULA')
			{
				$isVisible=true;
			
			}
			if(strtoupper($_SESSION['login'])=='BENJAMIN_LEMAIRE')
			{
				$isVisible=true;
			
			}
			if(trim($searchCriteria)>"" && $isVisible==true)
			{
				$isVisible=false;
				if(strpos($value,$searchCriteria)!==false)
				{
					$isVisible=true;
				}
			}
			// print_r($_SESSION);
			if($isVisible)
			{
				$cpt_comment++;
				// On fait une présentation en box avec un regroupe par numéro d'étiquettes
				// Le numéro de l'étiquette est toujours le dernier chiffre
				// les noms de fichier sont séparés par des underscore "_"
				// $tbl_name=explode("_",$value);
				if($value!="index.php")
				{
					//								Analyse si on est sur l'étiquette n° 1
					$tbl_bat=explode(".",$value); // Sépare le nom de fichier en 2 pour enlever l'extension   ATTENTION JAMAIS DE "." dans le nom du BAT
																											// . EXCEPTION DANS LA TAILLE
					// Reconstitue le filename du BAT sans l'extension
					$batFileName="";
					// On vérifie si on a un "." dans la taille (exemple 5.8 pour millet mountain group)
					if(count($tbl_bat)==2)
					{
						for($n=0;$n<count($tbl_bat)-1;$n++)
						{
							$batFileName.=$tbl_bat[$n];
						}
					}
					else
					{
						for($n=0;$n<count($tbl_bat)-1;$n++)
						{
							if($n==4)
							{
								$batFileName.=$tbl_bat[$n];
							}
							else
							{
								$batFileName.=$tbl_bat[$n] . "."; // Remet le . dans la taille
							}
						}
					}
					
					// Rècupère l'extention du BAT
					$batFileExtension="." . $tbl_bat[count($tbl_bat)-1];
					// Vérifie que l'on soit sur le BAT N°1
					$tbl_numeroBAT=explode("_",$batFileName);
					$numeroBAT=$tbl_numeroBAT[count($tbl_numeroBAT)-1];
					// Reconstitue le filename du BAT sans le numéro d'étiquette
					$batBaseNameWoNum="";
					for($n=0;$n<count($tbl_numeroBAT)-1;$n++)
					{
						$batBaseNameWoNum.=$tbl_numeroBAT[$n] . "_";
					}
					// Affiche les BAT de 1 à 20
					if($numeroBAT==1) // Vérifie que l'on soit sur le BAT N° 1 (les autres sont traités dans la boucle
					{
						// On fait la boucle de 1 à 20 BAT
						// Initialise le compteur de BATs rééls
						$nbBAT=0;
						if($_POST['mode']==1)
						{
							echo "<div class='as_agence-box-bat as_agence-waiting'>";
						}
						if($_POST['mode']==2)
						{
							echo "<div class='as_agence-box-bat as_agence-validate'>";
						}
						if($_POST['mode']==3)
						{
							echo "<div class='as_agence-box-bat as_agence-refused'>";
						}
						if($_POST['mode']==4)
						{
							echo "<div class='as_agence-box-bat as_agence-refused'>";
						}
						// Spécifique LEMAIRE
							if($_SESSION['prefix_contractor']=="lem")
							{
								// echo "<hr/>";
								$tblOF=explode("_" , $batBaseNameWoNum);
								$sqlOF="select * from " . $_SESSION['prefix_contractor'] . "_orders where num_of='" . $tblOF[0]. "' limit 1";
								$retourOF=mysqli_query($con,$sqlOF);
								$rowOF=mysqli_fetch_object($retourOF);
								echo "<b>" . $rowOF->reference . "</b>";
								echo "<br>" . $rowOF->product_name ;
								echo "<br>" . $rowOF->code_service ;
								echo "<hr/>";
							}
					
							// print_r($tbl_bat);
							echo "" . $batBaseNameWoNum . "<hr/>";	// Nom du BAT sans l'extention
							for($b=1;$b<=20;$b++)
							{
								// Reconstitue le nom complet du BAT
								$batRealName=$batBaseNameWoNum . $b . $batFileExtension;
								// echo $batRealName; 
								// Vérifie si le fichier existe
								if($_POST['mode']==1)
								{
									$batRealDirectory=$batsDirectoryW;
								}
								//
								if($_POST['mode']==2)
								{
									$batRealDirectory=$batsDirectoryV;
								}
								//
								if($_POST['mode']==3)
								{
									$batRealDirectory=$batsDirectoryR;
								}
								//
								if($_POST['mode']==4)
								{
									$batRealDirectory=$batsDirectoryI;
								} 
								//
								// echo "<i>" . $batRealDirectory . $batRealName . "</i>";
								if (file_exists($batRealDirectory . $batRealName))
								{
									echo "<a href='../includes/visu_bat.php?source=" . urlencode($batRealDirectory . $batRealName)  . "' class='as_agence-bat-link' target='_blank'>" . $TBL_MESSAGE[38] .  "&nbsp;#<b>$b</b></a><br/><br/>";
									$nbBAT++;
								}
								else 
								{ 
									break; // On sort de la boucle... Les numéros doivent se suivre
								}
							}
							if($_POST['mode']==1)
							{
								
								echo "<hr/>";
								echo $TBL_MESSAGE[35];
								echo "<br/>";
								echo "<textarea id='comment_$cpt_comment' style='width:80%;height:10%'></textarea>";
								echo "<hr/>";
								echo "<input type='button' value='" . $TBL_MESSAGE[36] . "' class='as_agence_bouton_vert'  onclick=\"this.style.display='none';confirm_move_bat_to_state('" . $batsDirectoryW . "','" . $batsDirectoryV  ."','" . $batBaseNameWoNum . "','" ;
								echo $batFileExtension . "'," . $nbBAT .",1,'comment_$cpt_comment','" .  $TBL_MESSAGE[39] . "');\">";
																		// 1 = validé
								echo "&nbsp;";
								echo "<input type='button' value='" . $TBL_MESSAGE[37] . "' class='as_agence_bouton_rouge' onclick=\"confirm_move_bat_to_state('" . $batsDirectoryW . "','" . $batsDirectoryR  ."','" . $batBaseNameWoNum . "','" ;
								echo $batFileExtension . "'," . $nbBAT .",2,'comment_$cpt_comment','" .  $TBL_MESSAGE[40] . "');\">";
								
								if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc"|| $_SESSION['prefix_contractor']=="chloe")
								{
									echo "<hr/>";
									echo "&nbsp;";
									echo "<input type='button' value='Style Validation' class='as_agence_bouton_vert' onclick=\"confirm_move_bat_style_to_state('" . $batsDirectoryW . "','" . $batsDirectoryV  ."','" . $batBaseNameWoNum . "','" ;
									echo $batFileExtension . "'," . $nbBAT .",1,'comment_$cpt_comment','" .  $TBL_MESSAGE[39] . "');\">";
								
									echo "<hr/>";
									echo "&nbsp;";
									echo "<input type='button' value='Style Refus' class='as_agence_bouton_vert' onclick=\"confirm_move_bat_style_to_state('" . $batsDirectoryW . "','" . $batsDirectoryR  ."','" . $batBaseNameWoNum . "','" ;
									echo $batFileExtension . "'," . $nbBAT .",2,'comment_$cpt_comment','" .  $TBL_MESSAGE[40] . "');\">";
		
								
								}
							}// Validation de toutes les tailles
							
							
							//
							if($_POST['mode']==2)
							{
								
								echo "<hr/>";
								echo $TBL_MESSAGE[56];
								echo "<br/>";
								echo "<textarea id='comment_$cpt_comment' style='width:80%;height:10%'></textarea>";
								echo "<hr/>";
								
								echo "<input type='button' value='" . $TBL_MESSAGE[57] . "' class='as_agence_bouton_rouge' onclick=\"confirm_move_bat_to_state('" . $batsDirectoryV . "','" . $batsDirectoryI  ."','" . $batBaseNameWoNum . "','" ;
								echo $batFileExtension . "'," . $nbBAT .",3,'comment_$cpt_comment','" .  $TBL_MESSAGE[58] . "');\">"; // Dévalidation
							}	
							// Affiche les raisons du refus
							if($_POST['mode']==3)
							{
								
								
								$sql="select * from suivi_bats where bat_name like '%/" . $batBaseNameWoNum . "%' limit 1";
								$retour=mysqli_query($con,$sql);
								while($row=mysqli_fetch_array($retour))
								{
									echo nl2br($row['comment']);
								}
								echo "<hr/>";
							}
								
						echo "</div>";
					}
				}
			}
		}
	echo "</div>";


?>

