<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	//
	if($_SESSION['prefix_contractor']!="mmg")
	{
		die("Vous n'avez pas accès à cette fonction. / You can't access to this function");
	}
	//
	// Préchargement BAT MMG
	if($_SESSION['prefix_contractor']=="mmg")
	{
												
		$sqlB="select * from suivi_bats where  (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by id desc";
																																												// Retourne le plus récent en 1er
		$retourB=mysqli_query($con,$sqlB);
		$cpt_BAT_MMG=0;
		while($rowB=mysqli_fetch_array($retourB))
		{
			$cpt_BAT_MMG++;
			$TBL_BAT_MMG[$cpt_BAT_MMG]=$rowB['bat_name'];
		}
		// print_r($TBL_BAT_MMG);
		// die();
		// echo $cpt_BAT_MMG;
		// die("Maintenance en cours...");
	}
	
	// Assigne les valeurs de status
	$status[0]='Canceled';
	$status[1]='New';
	$status[2]='Wait for Contractor validation';
	$status[3]='Wait for Manufacturer validation';
	$status[4]='Waiting for production';
	$status[5]='In production';
	$status[6]='In quality control'; 
	$status[7]='Delivery';
	$status[8]='Product By Supplier';
	// $status[9]='Waiting for BAT';
	// Charge les codes services
	// Rècupère les services en fonction du contractor
	$sql2="select * from services where prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by name";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		// Attention ici on prends le code service comme clef et non pas l'id vue que la recherche se fait par le contractor et que le code service est injecté dans les fichiers d'échanges
		$tbl_service[$row2['code_service']] = $row2['code_service'] . ":" . $row2['name'];
	}
	// Barre de recherche
	echo "<div class='as_agence-div-header-table-dashboard'>";
		$nomParametre="search_criteria_dashboard";
		if(!isset($_SESSION[$nomParametre]))
		{
			$searchCriteria="";
		}
		else
		{
			$searchCriteria=$_SESSION[$nomParametre];
		}
		//
		// $nomParametre="search_criteria_status";
		// if(!isset($_SESSION[$nomParametre]))
		// {
			// $searchCriteriaState="1=1";
		// }
		// else
		// {
			// if($_SESSION[$nomParametre]==-1)
			// {
				// $searchCriteriaState="1=1";	
			// }
			// else
			// {
				// $searchCriteriaState="status='" . $_SESSION[$nomParametre] ."'";
			// }
		// }
		// state_criteria_chk_state_1_status
		// echo "CUSTOMER DASHBOARD " . $TBL_MESSAGE[17];
		// echo "&nbsp;";
		// echo  "<input class='as_agence-input2' name='dashboard_customer_search_criteria". "' value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_dashboard_keyup(event,this);\" onblur=\"set_search_criteria_dashboard(this);\">";
		// echo "<br/><br/>";
		// echo "STATE&nbsp;";
		// echo "<select name='criteria_status' onblur=\"set_status_criteria_dashboard(this);\">";
		// echo "<option value='-1'>" . "ALL" . "</option>";
		// Vérifie  les statuts productions
		// Vérifie les statuts productions et alimente la clause whereStateProduction
		// $whereStateProduction=" (`status` in (";
		
		// for($i=0 ;$i<=9;$i++)
		// {
			// $nomParametre="state_criteria_chk_state_" . $i . "_status";
			// $checked="";
			// if(isset($_SESSION[$nomParametre]) && strtoupper($_SESSION[$nomParametre])=="TRUE")
			// {
				// $checked=" checked=checked";
				// $whereStateProduction.=$i . ","; 
				// $isVisible[$i]=1;
			// }
			// else
			// {
				// $checked="";
				// $isVisible[$i]=0;
			// }
			// echo "<input $checked type='checkbox' id='chk_state_$i' value='" . 1 . "' onclick=\"set_status_state_dashboard(this);\">" . $status[$i] . " ";
		// }
		// echo "</select>";
		// Retire la dernière virgule et ajoute la parenthèse de fermeture 
		// $whereStateProduction=substr($whereStateProduction,0,-1). "))";
		// echo "<br/>" . $whereStateProduction;
		// if( trim($whereStateProduction)=="(`status` in ))")
		// {
			// die("<h1>0 Record selected</h1>");
		// }
	echo "</div>";
	// Vérifie la visibilité des services (en rapport avec la colonne service)
	// echo $_SESSION['user_service'];
	$tbl_services=explode("|",$_SESSION['user_service']);
	foreach($tbl_services as $key=>$value)
	{
		if(trim($value)>"")
		{
			$tbl_services_2=explode(":",$value);
			$isVisibleService[$tbl_services_2[0]]=true;
		}
	}	
	// print_r($isVisibleService);
	// Construit la requète de Recherche
		$i=0;
		$sql="SHOW COLUMNS FROM " . $_SESSION['prefix_contractor'] . "_orders;";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$i++;
			$TBL_tmp[$i]=$row['Field'];
		}
			$sql=" where ($whereStateProduction ";
			$firstCondition=true;
			// On construit une requète qui exploite tout les champs de la base
			// Extraction des mots recherchés (séparateurs espace)
			$TBL_words=explode(" ",$searchCriteria);
			// Récupération des champs de la table
			$TBL_Fields=$TBL_tmp;
			// print_r($TBL_words);
			foreach($TBL_words as $keyW=>$valueW)
			{
				foreach($TBL_Fields as $key=>$value)
				{
					if($firstCondition==true)
					{
						// Pour la première condition on met un AND
						$sql.=  " and ((`$value` like \"%" . $valueW . "%\") ";
						$firstCondition=false;
					}
					else
					{
						$sql.=  " or (`$value` like \"%" . $valueW . "%\") ";
					}
				}
			}
			// Fin de la requète
			$sql.=") )";
			// echo $sql;
		$recherche=$sql;
	////////////////////////////////////////////
	// compteur pour différencier les lignes
	$num_ligne=0;
	echo "<div class='as_agence-div-content-table'>";
			
			// print_r($_SESSION);
			// Recherche des O.F. en cours --- On tient compte de la Session qui indique sur quelle table on travaile
			// Affichage des tris
			$ordre_tri="order by num_of desc ,date_integration desc";
			echo "<form action='../includes/download_datas_for_bats_modelises.php' method='POST'>";
			echo "<table style='min-width:100%;border:0px solid #606060'>";
			echo "<tr style='background-color:#606060;color:#fefefe'>";
			echo "<td><b># Internal	</b></td>";
								
								echo "<td><b>O.F.(Commessa)</b></td>";
								echo "<td><b>REFERENCE.</b></td>";
								echo "<td><b>COLORIS</b></td>";
								echo "<td><b>CODE EAN</b></td>";
								echo "<td><b>SIZE</b></td>";
								echo "<td><b>TYPE LABEL</b></td>";
								echo "<td><b>STATUT COMPOSITION</b></td>";
								if($_SESSION['prefix_contractor']!="dior")
								{
									echo "<td><b>FILE NAME</b></td>";
								}
								echo "<td><b>DATE INTEGRATION</b></td>";
								if($_SESSION['prefix_contractor']!="dior")
								{
									echo "<td><b>SELECTED</b></td>";
								}
																
							
			echo "</tr>";
								$of_en_cours="";
								$num_ligne=0;
								$sql2="select * from " . $_SESSION['prefix_contractor'] . "_orders  where status>0 and status<7 and LENGTH(num_of)<10  group by num_of,code_ean,type_label order by date_integration desc";
								$retour2=mysqli_query($con,$sql2);
								while($row2=mysqli_fetch_array($retour2))
								{
									if($of_en_cours!=$row2['num_of'])
									{
										$num_ligne++;
										$of_en_cours=$row2['num_of'];
									}
									if($num_ligne % 2==0)
									{
										$classLigne2="class='as_agence-table-datas as_agence-table-pair'";
									}
									else
									{
										$classLigne2="class='as_agence-table-datas as_agence-table-impair'";
									}
										
										// Reconstitution du nom de BAT
											$initDirectory=$_SESSION['prefix_contractor'];
											$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
											$batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
											$batsDirectoryR = "../bats/" . $initDirectory ."/refused/";
											// Exception DIOR
											if($_SESSION['prefix_contractor']=="dior")
											{
												if($row2['size']=="U" and $row2['prefix_bat']=='CL')//
												{
													$row2['size']="TU";
												}
												if($row2['prefix_bat']=='STK')
												{
													$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" ;
												}
												else
												{
													$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
												}
												
											// Recherche la dernière version validées
												$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
												$retourB=mysqli_query($con,$sqlB);
												echo $sqlB;
												$fullLinkImage="";
												while($rowB=mysqli_fetch_array($retourB))
												{
													$fullLinkImage=$rowB['bat_name'];
												}
												/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												// Recherche spécifique Dior Taille U depuis un fichier extracfinal à la place du fichier Excel fournit en début de saison
												// Recherche uniquement si on n'a pas trouvé précédemment avec TU
												if(trim($fullLinkImage)=="")
												{
													
													if($row2['size']=="TU" and $row2['prefix_bat']=='CL')//
													{
														$row2['size']="U";
													}
													if($row2['prefix_bat']=='STK')
													{
														$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" ;
													}
													else
													{
														$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
													}
													// Recherche la dernière version validées
													$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
													$retourB=mysqli_query($con,$sqlB);
													$fullLinkImage="";
													while($rowB=mysqli_fetch_array($retourB))
													{
														$fullLinkImage=$rowB['bat_name'];
													}
												}
											} // Fin Exception DIOR
											// Exception MMG
											if($_SESSION['prefix_contractor']=="mmg")
											{
												
												if($row2['type_label']=="CARE_LABEL")
												{
													$row2['type_label']="CARE LABEL";
												}
												//
												$row2['size']=str_replace("/",".",$row2['size']);
												//
												$fullNameBAT=$row2['num_of'] . "_" . $row2['reference'] . "_" . $row2['coloris'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" . $row2['type_label'] . "_" ;
												// echo "<i>" . $fullNameBAT . "</i>";
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
												// echo "<u>" . $fullNameBAT . "</u><br/>";	
												
											// Recherche la dernière version validées
												// $sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
												// $retourB=mysqli_query($con,$sqlB);
												
												// $fullLinkImage="";
												// while($rowB=mysqli_fetch_array($retourB))
												// {
													// $fullLinkImage=$rowB['bat_name'];
												// }
												// Modification du 18.04.2024
												$fullLinkImage="";
												for($b=0;$b<=$cpt_BAT_MMG;$b++)
												{
													
													if(strpos($TBL_BAT_MMG[$b],$fullNameBAT)===false)
													{
														// Rien
													}
													else
													{
														// BAT trouvé
														$fullLinkImage=$TBL_BAT_MMG[$b];
														break;			
													}
													
												}
											} // Fin MMG
											//
											$trouve=false;
											//On est sur un BAT validé
											if(trim($fullLinkImage)>"")
											{
												$trouve=true;
											}
											else
											{
												// On recherche si existe en attente de validé
													for ($n=1;$n<20;$n++)
													{
														if(file_exists($batsDirectoryW . $fullNameBAT . "$n.png"))
														{
															// echo "ici";
															$trouve=true;
															break;
															
															// echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . "$n.png'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
														}
														if(file_exists($batsDirectoryW . $fullNameBAT . "$n.bmp"))
														{
															// echo "ica";
															$trouve=true;
															break;
															// echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . "$n.bmp'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
														}
													}
											}
										
											if($trouve==false)
											{ 
												unset($tbl_name_image);
												// Affiche le BAT en attente de validation
												echo "<tr $classLigne2>";
													$n=1;
													// echo "<td>" . $batsDirectoryW . $fullNameBAT . "$n.bmp" . "</td>";
													echo "<td>" . $row2['id'] . "</td>";
													echo "<td>" . $row2['num_of'] . "</td>";
													echo "<td>" . $row2['reference'] . "</td>";
													echo "<td>" . $row2['coloris'] . "</td>";
													echo "<td>" . $row2['code_ean'] . "</td>";
													echo "<td>" . $row2['size'] . "</td>";
													echo "<td>" . $row2['type_label'] . "</td>";
													echo "<td>" . $row2['status_composition'] . "</td>";
													if($_SESSION['prefix_contractor']!="dior")
													{
														echo "<td>" . $row2['file_name'] . "</td>";
													}
													echo "<td>" . $row2['date_integration'] . "</td>";
													$cptCheck++;
													if($_SESSION['prefix_contractor']!="dior")
													{
														echo "<td>" . "<input type='checkbox' name='chk_box_" . $cptCheck . "' value='" . $row2['id'] . "|" . $_SESSION['prefix_contractor'] . "|" . $row2['file_name'] . "|" . $row2['num_of'] . "|" . $row2['code_ean'] . "' " . "</td>";
													}
												echo "</tr>";
												// $cpt++;
												// if($cpt==20)
												// {
													// die();
												// }
											}
								} // Row 2
							echo "</table>";
							if($_SESSION['prefix_contractor']!="dior")
							{
								echo "<input type='submit'>";
							}
					echo "</form>";
							echo "<hr/>" . $num_ligne;
			echo "</div>";

?>

