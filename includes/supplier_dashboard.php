<?php
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	include '../includes/verification_bats_valides.php';
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
	//
		// Préchargement BAT MMG
	if($_SESSION['prefix_contractor']=="mmg")
	{
												
		$sqlB="select * from suivi_bats where (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by id desc";
																																												// Retourne le plus récent en 1er
		$retourB=mysqli_query($con,$sqlB);
		$cpt_BAT_MMG=0;
		while($rowB=mysqli_fetch_array($retourB))
		{
			$cpt_BAT_MMG++;
			$TBL_BAT_MMG[$cpt_BAT_MMG]=$rowB['bat_name'];
		}
		// print_r($TBL_BAT_MMG);
		// echo $cpt_BAT_MMG;
		// die("Maintenance en cours...");
	}

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
		//echo $_SESSION[$nomParametre];
		// die();
		if(!isset($_SESSION[$nomParametre]))
		{
			$searchCriteria="";
		}
		else
		{
			$searchCriteria=$_SESSION[$nomParametre];
		}
		// Enlève " et '
		$searchCriteria=str_replace("\"","",$searchCriteria);
		$searchCriteria=str_replace("'","",$searchCriteria);
		// state_criteria_chk_state_1_status
		echo "<b>SUPPLIER DASHBOARD</b> " . $TBL_MESSAGE[17];
		echo "&nbsp;";
		echo  "<input class='as_agence-input2' name='dashboard_customer_search_criteria". "' value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_dashboard_supplier_keyup(event,this);\" onblur=\"set_search_criteria_dashboard_supplier(this);\">";
		echo "<br/><br/>";
		echo "STATE&nbsp;";
		// Vérifie les statuts productions et alimente la clause whereStateProduction
		$whereStateProduction=" and (`status` in (";
		for($i=0 ;$i<=8;$i++)
		{
			$nomParametre="state_criteria_chk_state_" . $i . "_status";
			$checked="";
			if(isset($_SESSION[$nomParametre]) && strtoupper($_SESSION[$nomParametre])=="TRUE")
			{
				$checked=" checked=checked";
				$whereStateProduction.=$i . ",";
				$isVisible[$i]=1;
			}
			else
			{
				$checked="";
				$isVisible[$i]=0;
			}
			echo "<input $checked type='checkbox' id='chk_state_$i' value='" . 1 . "' onclick=\"set_status_state_dashboard_supplier(this);\">" . $status[$i] . " ";
		}
		echo "</select>";
		// Retire la dernière virgule et ajoute la parenthèse de fermeture 
		$whereStateProduction=substr($whereStateProduction,0,-1). "))";
		// echo "<br/>" . $whereStateProduction;
		if( trim($whereStateProduction)=="and (`status` in ))")
		{
			// On force l'affichage de tous
			$whereStateProduction=" and (`status` in (";
			for($i=0 ;$i<=8;$i++)
			{
				$whereStateProduction.=$i . ",";
				$isVisible[$i]=1;
			}
			// Retire la dernière virgule et ajoute la parenthèse de fermeture 
			$whereStateProduction=substr($whereStateProduction,0,-1). "))";

		
		}
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
	// En mode supplier on se sert des codes circuits des adresses
		$searchCriteriaSupplier="`code_supplier` in (";
		$sql="select * FROM users_adresses where id_user='" . $_SESSION['supplier_id'] . "'";
		$retour=mysqli_query($con,$sql);
		$i=0;
		while($row=mysqli_fetch_array($retour))
		{
			$i++;
			$TBL_code_supplier[$i]=$row['code_supplier'];
			$searchCriteriaSupplier.="\"" . $row['code_supplier'] . "\",";
			// Conserve les adresses pour en faire une Selection
			$TBL_adresse_id[$i]=$row['id'];
			$TBL_adresse_name[$i]=$row['adresse_name'];
			$TBL_company_name[$i]=$row['company_name'];
			$TBL_adresse_1[$i]=$row['adresse_1'];
			$TBL_adresse_2[$i]=$row['adresse_2'];
			$TBL_adresse_3[$i]=$row['adresse_3'];
			$TBL_adresse_zip[$i]=$row['zip'];
			$TBL_adresse_state[$i]=$row['state'];
			$TBL_adresse_city[$i]=$row['city'];
			$TBL_adresse_country[$i]=$row['country'];
			$TBL_adresse_contact[$i]=$row['contact'];
			$TBL_adresse_telephone[$i]=$row['telephone'];
			$TBL_adresse_mail[$i]=$row['email'];
		}
		// Conserve le nombre d'adresse max conservées
		$max_adresses=$i;
		// Retire la dernière virgule de la clause in
		$searchCriteriaSupplier=substr($searchCriteriaSupplier,0,-1) . ")";
		// echo $sql;
		// print_r($TBL_code_supplier);
		// echo "<hr/>$i</hr>";
		// die();
		//
	// Construit la requète de Recherche
		$i=0;
		$sql="SHOW COLUMNS FROM " . $_SESSION['prefix_contractor'] . "_orders;";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$i++;
			$TBL_tmp[$i]=$row['Field'];
		}
			$sql=" where ((($searchCriteriaSupplier) $whereStateProduction )";
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
			$sql.=")) ";
		$recherche=$sql;
	////////////////////////////////////////////
	// compteur pour différencier les lignes
	$num_ligne=0;
	echo "<div class='as_agence-div-content-table'>";
			$num_ligne++;
			if($num_ligne % 2==0)
			{
				$classLigne="class='as_agence-table-datas as_agence-table-pair'";
			}
			else
			{
				$classLigne="class='as_agence-table-datas as_agence-table-impair'";
			}
			// print_r($_SESSION);
			// Recherche des O.F. en cours --- On tient compte de la Session qui indique sur quelle table on travaille
			// Affichage des tris
				$orderTriDefault="ASC";
				$nomParametre="order_display_customer_dashboard" ;
				if(isset($_SESSION[$nomParametre]))
				{
					$tbl_tri=explode(":",$_SESSION[$nomParametre]);
					$ordre_tri="order by " . $tbl_tri[0] . " " . $tbl_tri[1];
					if($tbl_tri[1]=="ASC")
					{
						$orderTriDefault="DESC";
					}
					else
					{
						$orderTriDefault="ASC";
					}
				}
				else
				{
					$ordre_tri="order by num_of desc ,date_integration desc";
				}
			// Calcul la pagination
			$maxRecord=10; // Affiche 10 max par pages pour éviter une saturation du serveur quand tout le monde se connecte
			if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan"){
				$sql="select count(*) from " . $_SESSION['prefix_contractor'] . "_orders $recherche group by num_of, reference  $ordre_tri";
			}
			else{
				$sql="select count(*) from " . $_SESSION['prefix_contractor'] . "_orders $recherche group by num_of  $ordre_tri";
			}
			
			$retour=mysqli_query($con,$sql);
			// Group retourne un tableau il faut l'additionner
			$nbRows = mysqli_num_rows($retour);
			$nbSheets=intval($nbRows/$maxRecord);
			$nbRecords=0;
			while($row=mysqli_fetch_array($retour))
			{
				$nbRecords++;
			}
			if($nbSheets!=$nbRows/$maxRecord) // Vérifie si on a un reste de division
			{
				$nbSheets++;	// 1 page en plus 
			}
			//
			$table="ORDERS";
			$nomParametre="actual_sheet_" . $table;	// Récupère la pagination actuel
			if(!isset($_SESSION[$nomParametre]))
			{
				$actualSheet=1;
			}
			else
			{
				$actualSheet=$_SESSION[$nomParametre];
			}
			// Vérifie si la feuille actuelle n'est pas supérieur au nombre de feuilles max suite à une nouvelle recherche
			if ($actualSheet>$nbSheets)
			{
				$actualSheet=1;
			}
			if($actualSheet==1)
			{
				$offset=0;
			}
			else
			{
				$offset=$actualSheet*$maxRecord;
				$offset=$offset-$maxRecord; 
			}
			// Affichage de l'option de sélection de la page en cours
			echo $TBL_MESSAGE[21] . " <b>$nbRecords</b> ";
			echo $TBL_MESSAGE[18] . " ";
			echo  "<select name='" .  "ORDERS" . "_display_sheet". "' onchange=\"set_display_sheet_supplier(this);\">";
			for($p=1;$p<=$nbSheets;$p++)
			{
				if($actualSheet==$p)
				{
					echo "<option selected='selected' value='$p'>$p</option>";
				}
				else
				{
					echo "<option value='$p'>$p</option>";
				}
			}
			echo "</select>";
			echo " /<b> $nbSheets</b> ";
		
			if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
			{
			$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders $recherche  group by num_of,reference  $ordre_tri limit " . $offset . "," . $maxRecord . ";";
			}
			else{
				$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders $recherche group by num_of  $ordre_tri limit " . $offset . "," . $maxRecord . ";";
			}
			$retour=mysqli_query($con,$sql);
			// echo $sql;
			// die();
			echo "<table style='min-width:100%'>";
			echo "<tr style='background-color:#202020;color:#fefefe'>";
				echo "<td></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('num_of','$orderTriDefault');\"><b>O.F.(Commessa)</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('reference','$orderTriDefault');\"><b>REFERENCE.</b></td>";
				
				echo "<td onclick=\"set_order_display_dashboard_supplier('code_service','$orderTriDefault');\"><b>SERVICE</b></td>";
				if($_SESSION['prefix_contractor']=="dior")
				{
					echo "<td onclick=\"set_order_display_dashboard_supplier('status_composition','$orderTriDefault');\"><b>STAT. COMPOSITION</b></td>";
				}
				echo "<td onclick=\"set_order_display_dashboard_supplier('code_supplier','$orderTriDefault');\"><b>CODE MANUFACTURER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('code_supplier','$orderTriDefault');\"><b>MANUFACTURER </b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('made_in','$orderTriDefault');\"><b>MADE IN</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('date_integration','$orderTriDefault');\"><b>DATE ORDER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('status','$orderTriDefault');\"><b>STATE</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('comment_contractor','$orderTriDefault');\"><b>COMMENT SUPPLIER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('code_supplier','$orderTriDefault');\"><b>DELIVERY ADRESS </b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('tracking','$orderTriDefault');\"><b>TRACKING NUMBER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard_supplier('date_delivery','$orderTriDefault');\"><b>DELIVERY DATE</b></td>";
				echo "<td colspan=2><b>ACTIONS</b></td>";
			echo "</tr>";
			while($row=mysqli_fetch_array($retour))
			{
				// if($isVisible[$row['status']] && $isVisibleService[$row['code_service']]) // Obsolète 16/01/2024
				{
					// Test si on est sur la première visu de l'O.F.
					$num_ligne++;
					if($num_ligne % 2==0)
					{
						$classLigne="class='as_agence-table-datas as_agence-table-pair'";
					}
					else
					{
						$classLigne="class='as_agence-table-datas as_agence-table-impair'";
					}
					echo "<tr $classLigne>";
						echo "<td><img id='ligne_table_$num_ligne' src='/images/details_open.png' onclick=\"deplie_ligne_customer_dashboard('" . $num_ligne . "');\"></td>";
						echo "<td>";
							echo $row['num_of'];
						echo "</td>";
						echo "<td>";
							echo $row['reference'];
						echo "</td>";
						
						echo "<td>";
						if($row['code_service']){
							echo $tbl_service[$row['code_service']];
						}
							
						echo "</td>";
						if($_SESSION['prefix_contractor']=="dior")
						{
						echo "<td>";
							echo $row['status_composition'];
						echo "</td>";
						}
						echo "<td>";
							echo $row['code_supplier'];
						echo "</td>";
						echo "<td>";
							$sqlS="select * from  users_adresses  where `contractor`='" . $_SESSION['prefix_contractor_id'] . "' and  code_supplier='" . $row['code_supplier']. "' limit 1";
							$retourS=mysqli_query($con,$sqlS);
							while($rowS=mysqli_fetch_array($retourS))
							{
								echo $rowS['company_name'] . " (" . $rowS['contact'] . ")";
							}
						echo "</td>";
						
						echo "<td>";
							echo $row['made_in'];
						echo "</td>";
						echo "<td>";
							echo $row['date_integration'];
						echo "</td>";
						echo "<td>";
							if($row['status']!=0)
							{
								if($row['status']==4){
									$batValid=verify_bats($row['num_of'],$row['reference'],$_SESSION['prefix_contractor'],$con);
									if($batValid==true)	{
										echo "Waiting for production";
									}
									else{
										echo "Waiting for BAT validation";
									}
								}
								else{
									echo $status[$row['status']];
								}
							}
							else
							{
								echo "<label style='color:navy'>";
									echo $status[$row['status']];
								echo "</label>";
							}
						echo "</td>";
						echo "<td>";
							echo "<label class='fa-solid fa-pen' style='cursor:pointer;font-size:0.7vw' onclick=\"set_comment_supplier(this,'" . $row['num_of']. "','" . $row['reference'] . "');\">". $row['comment_supplier'] . "</label>";
						echo "</td>";
						
						// Selection d'une autre adresse de livraison
						echo "<td>";
							$sqlS="select * from  users_adresses  where code_supplier='" . $row['code_supplier']. "' limit 1";
							$retourS=mysqli_query($con,$sqlS);
							while($rowS=mysqli_fetch_array($retourS))
							{
								echo "<label class='fa-solid fa-pen' style='cursor:pointer;font-size:0.7vw' onclick=\"set_new_address_supplier('" . $row['num_of']. "');\">&nbsp;</label>";
								if($row['other_delivery_adress'] ==="")
								{
									echo "<b>". $rowS['adresse_name'] . "</b><br/>" ;
									echo $rowS['company_name'] . "\r\n"  ;
									echo $rowS['adresse_1'] . "\r\n"  ;
									echo $rowS['adresse_2'] . "\r\n"  ;
									echo $rowS['adresse_3'] . "\r\n"  ;
									echo $rowS['zip'] . "\r\n"  ;
									echo $rowS['state'] . "\r\n"  ;
									echo $rowS['city'] . "\r\n"  ;
									echo $rowS['country'] . "\r\n"  ;
									echo $rowS['contact'] . "\r\n"  ;
									echo $rowS['telephone'] . "\r\n"  ;
									echo $rowS['email'] . "\r\n"  ;
								}
								else
								{
									echo $row['other_delivery_adress']; // Affiche l'adresse sélectionnée pour cet O.F.
								}
							}
						echo "</td>";
						echo "<td>";
							echo $row['tracking'];
						echo "</td>";
						echo "<td>";
						if($row['date_delivery']){
							echo substr($row['date_delivery'],0,10);
						}
						echo "</td>";
						
						
						echo "<td>";
							if($row['urgent_mode']==0 )
							{
								// echo "<input type='button' value='urgent' onclick=\"set_orders_urgent_supplier('" . $row['num_of'] . "');\">";
							}
							else
							{
								echo "<label style='color:red'>URGENT</label>";
							}
						echo "</td>";
						echo "<td>";
							// Masque pour DIOR
							switch($_SESSION['prefix_contractor'])
							{
								case "dior":
									// Rien
									break;
								
								default:
									echo "<input type='button' value='duplique' onclick=\"duplique_order_supplier('" . $row['num_of'] . "','" . $row['reference'] . "');\">";
									break;
								
							}	
						echo "</td>";
						echo "<td>";
							
								//echo "<input type='button' id='extract' value='Extract BATs' class='extract' onclick=\"extract_bats_supplier('" . $row['num_of'] . "');\">";
								//echo "<div id='extraction'></div>";	
						echo "</td>";
					echo "</tr>";
					echo "<tr id='colonne_table_$num_ligne' style='display:none'>";
						echo "<td></td>";
						echo "<td  colspan=14><br/>";
							echo "<table style='min-width:100%;border:0px solid #606060'>";
							echo "<tr style='background-color:#606060;color:#fefefe'>";
								echo "<td><b># Internal	</b></td>";
								if($_SESSION['prefix_contractor']!="lan"){
									echo "<td><b>O.F.(Commessa)</b></td>";
									echo "<td><b>REFERENCE.</b></td>";
								}
								echo "<td><b>COLORIS</b></td>";
								echo "<td><b>SIZE</b></td>";
								echo "<td><b>TYPE LABEL</b></td>";
								echo "<td><b>CODE EAN</b></td>";
								echo "<td><b>QTY INITIAL</b></td>";
								echo "<td><b>QTY TO PRODUCE</b></td>";
								echo "<td><b>IMAGE</b></td>";
								echo "<td><b>STATUS</b></td>";
								echo "<td colspan=6><b>ACTIONS</b></td>";
								
							echo "</tr>";

								$num_ligne2=0; 
								$sql2="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='" . $row['num_of']. "' order by type_label desc, id desc";
								if($_SESSION['prefix_contractor']=="mmg")
								{									
									
									$sql2 = "select * FROM mmg_orders WHERE num_of= '".$row['num_of']."' and reference= '".$row['reference']."' GROUP BY 
									CONCAT(num_of, '_', reference,'_',type_label,'_',size,'_',coloris) order by type_label asc, id desc;";													
								}
								if($_SESSION['prefix_contractor']=="lan")
								{									
									
									$sql2 = "select * FROM lan_orders WHERE num_of= '".$row['num_of']."' and reference= '".$row['reference']."'
									order by type_label asc, id desc;";													
								}
								$retour2=mysqli_query($con,$sql2);
								// Totalisation par Type de label
								$totQtyInit=0;
								$totQtyToProduce=0;
								$prdEnCours="";
								// Permet de n'afficher les actions qu'une fois par type de produits
								$afficheAction=0;
								while($row2=mysqli_fetch_array($retour2))
								{
									// Initialisation 1ère ligne
									if($prdEnCours=="")
									{
										$prdEnCours=$row2['type_label'];
										$totQtyInit=0;
										$totQtyToProduce=0;
										$afficheAction=0;
										//
									}
									// Rupture de Totalisation
									if($prdEnCours!=$row2['type_label'])
									{
										echo "<tr style='background-color: #eee;'>";
										if($_SESSION['prefix_contractor']=="lan")
										{
											echo "<td colspan=5></td>";
										}
										else{
											echo "<td colspan=7></td>";
										}
										echo "<td style='text-align:center'><b>$totQtyInit</b></td>";
										echo "<td style='text-align:center'><b>$totQtyToProduce</b></td>";
										echo "<td></td>";
										echo "<td></td>";
										echo "</tr>";
										//
										$totQtyInit=0;
										$totQtyToProduce=0;
										//
										$prdEnCours=$row2['type_label'];
										//
										$afficheAction=0;
									}
									// Totalisation
									$totQtyInit+=$row2['qty_init'];
									$totQtyToProduce+=$row2['qty_to_produce'];
									// Affichage
									$num_ligne2++;
									if($num_ligne2 % 2==0)
									{
										$classLigne2="class='as_agence-table-datas '";
									}
									else
									{
										$classLigne2="class='as_agence-table-datas '";
									}
									echo "<tr $classLigne2>";
										echo "<td>";
											echo $row2['id'];
										echo "</td>";
										if($_SESSION['prefix_contractor']!="lan"){
											echo "<td>";
												echo $row2['num_of'];
											echo "</td>";
											echo "<td>";
												echo $row2['reference'];
											echo "</td>";
										}
										
										echo "<td>";
											echo $row2['coloris'];
										echo "</td>";
										echo "<td>";
											echo $row2['size'];
										echo "</td>";
										echo "<td>";
											echo $row2['type_label'];
										echo "</td>";
										echo "<td>";
											echo $row2['code_ean'];
										echo "</td>";
										echo "<td style='text-align:center'>";
											// if($row2['status']<4 && (substr($row2['num_of'],0,4)=="DUP_"))
											if($row2['status']<5 && $_SESSION['prefix_contractor']!='dior')
											{
												echo "<label class='fa-solid fa-pen' style='cursor:pointer;font-size:0.7vw' onclick=\"set_new_qty(this,'" . $row2['id']. "');\"> ". $row2['qty_init'] . "</label>";
											}
											else
											{
												echo $row2['qty_init'];
											}
										echo "</td>";
										echo "<td style='text-align:center'>";
												echo $row2['qty_to_produce'];
										echo "</td>";
										$fullLinkImage="";$fullNameBAT="";
										// Reconstitution du nom de BAT
											$initDirectory=$_SESSION['prefix_contractor'];
											$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
											$batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
											// Exception DIOR
											if($_SESSION['prefix_contractor']=="dior")
											{
												if($row2['size']=="U" and $row2['prefix_bat']=='CL')
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
											}
											//// Exception MMG
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
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
												
												// Modification du 18.04.2024
												// Samuel Auger		
													// $sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
													// $retourB=mysqli_query($con,$sqlB);
													
													// $fullLinkImage="";
													// while($rowB=mysqli_fetch_array($retourB))
													// {
														// $fullLinkImage=$rowB['bat_name'];
													// }
													// Modification du 18.04.2024
												for($b=1;$b<=$cpt_BAT_MMG;$b++)
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
											//// Exception Lemaire
											if($_SESSION['prefix_contractor']=="lem")
											{	
												// Eliminer le _1 ou _2 en cas de commande introduite plusieurs fois
												$num_of=explode('_', $row2['num_of'], 2);
												// $fullNameBAT=$row2['num_of'] . "_" . $row2['type_label'] . "_" ;
												$fullNameBAT=$num_of[0] . "_" . $row2['type_ordre']  ;
													
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
											// Recherche la dernière version validée
												$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
												$retourB=mysqli_query($con,$sqlB);

												while($rowB=mysqli_fetch_array($retourB))
												{
													$fullLinkImage=$rowB['bat_name'];
												}
											} // Fin Lemaire
											// Exception Loewe
											if($_SESSION['prefix_contractor']=="loe")
											{							
												$fullNameFolder= substr($row2['saison'],0,4)  . "-" . $row2['reference'] . "__" ;//Date proelia ensuite											
												$fullLinkImage = "" . $fullNameFolder . "/";
												
											} // Fin Loewe
											// Exception Chloe
											if($_SESSION['prefix_contractor']=="chloe")
											{
												
												if($row2['type_label']=="CARE_LABEL")
												{
													$row2['type_label']="CARE LABEL";
												}
												//
												$row2['size']=str_replace("/",".",$row2['size']);
												// echo $row2['type_label'];
												// echo substr($row2['type_label'],0,8);
												if(substr($row2['type_label'],0,8)=="BAR_CODE")
												{
													// C'est du sticker
													$fullNameBAT=$row2['reference'] . "_S_" ;
												}
												else
												{
													// C'est du care_label ..... A la place de S on a 20...début du 21ème siècle (2024...2025....)
													$fullNameBAT=$row2['reference'] . "_20" ;
												}
												// echo "..."  . $fullNameBAT . "<br/>";
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
											// Recherche la dernière version validées
												$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
												$retourB=mysqli_query($con,$sqlB);

												while($rowB=mysqli_fetch_array($retourB))
												{
													$fullLinkImage=$rowB['bat_name'];
												}
											} // Fin CHLOE
											// Exception ALAIA
											if($_SESSION['prefix_contractor']=="ala")
											{
												if($row2['type_label']=="CARE LABEL")
												{
													// 
													$fullNameBAT=$row2['num_of'] . "_" ;	
													// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
													$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
													
												// Recherche la dernière version validées
													$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
													$retourB=mysqli_query($con,$sqlB);

													while($rowB=mysqli_fetch_array($retourB))
													{
														$fullLinkImage=$rowB['bat_name'];
													}
												}
												else{
													// C'est du sticker
													$fullLinkImage="";
												}
											} // Fin ALAIA
											// Exception lanvin
											if($_SESSION['prefix_contractor']=="lan")
											{
												if($row2['type_label']=="CARE LABEL")
												{
													// 
													$fullNameBAT=$row2['reference'] . "_" ;	
													// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
													$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
													// Recherche la dernière version validées
													$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
													$retourB=mysqli_query($con,$sqlB);
													//echo $sqlB;
													
													while($rowB=mysqli_fetch_array($retourB))
													{
														$fullLinkImage=$rowB['bat_name'];
													}
												}
												else{
													// C'est du sticker
													$fullLinkImage="";
												}
											} // Fin LANVIN
											// Exception PATOU
											if($_SESSION['prefix_contractor']=="patou")
											{
												$prefix="";
												if($row2['type_label']=="CARE LABEL"){
													$prefix="1_";
												}
												if($row2['type_label']=="QRCODE COTTON LABEL"){
													$prefix="2_";
												}
												if($row2['type_label']=="STICKER CARELABEL BLISTER"){
													$prefix="3_";
												}
												if($row2['type_label']=="STICKER QR CARELABEL BLISTER"){
													$prefix="4_";
												}
												if($row2['type_label']=="PICTURE HANGTAG"){
													$prefix="5_";
												}
												if($row2['type_label']=="QR HANGTAG"){
													$prefix="6_";
												}
												if($row2['type_label']=="QR SAC HANGTAG"){
													$prefix="7_";
												}
												// 
												$fullNameBAT=$row2['reference'] . "_" . $prefix ;	
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
											// Recherche la dernière version validées
												$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
												$retourB=mysqli_query($con,$sqlB);
												
												while($rowB=mysqli_fetch_array($retourB))
												{
													$fullLinkImage=$rowB['bat_name'];
												}
											} // Fin PATOU
											//On est sur un BAT validé
											if(trim($fullLinkImage)>"")
											{
												$tbl_name_image=explode("/",$fullLinkImage);
												echo "<td>";
												// echo $fullLinkImage;
												if(isset($tbl_name_image))
												{
													for ($n=1;$n<20;$n++)
													{
														$fileImageValidate=str_replace("_1.","_$n.",$tbl_name_image[count($tbl_name_image)-1]);
														if(file_exists($batsDirectoryV . $fileImageValidate))
														{
															
															echo "&nbsp;<a href='" . $batsDirectoryV . $fileImageValidate . "'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#009900;cursor:pointer'></label>" . "</a>";
															echo "&nbsp;<a href='includes/bmp_to_pdf.php?fileName=" . $batsDirectoryV . $fileImageValidate . "'  target='_blank'>" . "<label class='fa-solid fa-file-pdf' style='color:#990000;cursor:pointer'></label>" . "</a>";
															echo "&nbsp;<a href='" . $batsDirectoryV . $fileImageValidate . "'  download>" . "<label class='fa-solid fa-download	' style='color:#009999;cursor:pointer'></label>" . "</a>";
														}
														else
														{
															// echo "ERROR FILE NOT EXIST";
														}
													}
												} 
												echo "</td>";
											}
											else
											{ 
												
												unset($tbl_name_image);
												// Affiche le BAT en attente de validation
												// Reconstitue le nom du bat
												echo "<td>";
													// echo $batsDirectoryW . $fullNameBAT . "1.png";
													// $fullNameBAT=$row2['num_of'] . "_" . $row2['reference'] . "_" . $row2['coloris'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" . $row2['type_label'] . "_1" ;
													for ($n=1;$n<20;$n++)
													{
														if(file_exists($batsDirectoryW . $fullNameBAT . "$n.png"))
														{
															echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . "$n.png'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
														}
														if(file_exists($batsDirectoryW . $fullNameBAT . "$n.bmp"))
														{
															echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . "$n.bmp'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
														}
													}
													
												echo "</td>";
											}
											// 
											echo "<td>";
												if($row2['status']==4){
												
													if($batValid==true)	{
														echo "Waiting for production";
													}
													else{
														echo "Waiting for BAT validation";
													}
												}
												else{
													echo $status[$row2['status']];
												}
											echo "</td>";
											// Validation à la ligne
											if($_SESSION['prefix_contractor']=='dior')
											{
												$afficheAction=1;	// Bloque l'affichage des boutons actions pour les suppliers DIOR
											}
											if($afficheAction==0 && $batValid==true)
											{
												$afficheAction=1;	// Bloque l'affichage des boutons actions
												if($row2['status']>0 && $row2['status']<=3 )
												{
													echo "<td>";
														// Permet de valider touts les produits identiques d'un OF
														echo "<input type='button' value='To Be Produced By Etic Europe' onclick=\"set_orders_validate_by_supplier_by_product('" . $row2['id'] . "','" . $prdEnCours . "');\">";
													echo "<td>";
													echo "<td>";
														// Permet de valider en mode produit par le supplier touts les produits identiques d'un OF
														echo "<input type='button' value='To Be Produced By Supplier'  onclick=\"set_orders_print_by_supplier_by_product('" . $row2['id'] . "','" . $prdEnCours . "');;\">";
													echo "<td>";
												}
												echo "<td>";
													if($row2['status']>0 && $row2['status']<3)
													{
														// Permet de cancel touts les produits identiques d'un OF
														echo "<input type='button' value='Cancel' onclick=\"set_orders_cancel_by_supplier_by_product('" . $row2['id'] . "','" . $prdEnCours . "');\">";
													}
												echo "</td>";
											}
							
										echo "</td>"; 
									echo "</tr>";
								} // Fin while 2
								// Rupture de Totalisation
								echo "<tr style='background-color:#eee'>";
									if($_SESSION['prefix_contractor']=="lan")
									{
										echo "<td colspan=5></td>";
									}
									else{
										echo "<td colspan=7></td>";
									}
								echo "<td style='text-align:center'><b>$totQtyInit</b></td><td style='text-align:center'><b>$totQtyToProduce</b></td>";
								echo "<td></td>";
										echo "<td></td>";
								echo "</tr>";
							echo "</table>";
						echo "<br/></td>";
					echo "</tr>";
				} // IsVisble
			} // While $row 
			echo "</table>";
	echo "</div>";
	echo "<div style='display:none;position:fixed;left:10%;top:10%;background-color:#FFFFFF;color:#292929;border:2px solid #202020;text-align:center' id='set_adresse_for_order'>";
			echo "<br/><input type='button' value='close' onclick='close_set_new_address_supplier();'><hr/>";
			for($i=1;$i<=$max_adresses;$i++)
			{
				echo "<b>" . $TBL_adresse_name[$i] . "</b>";
				echo "<br/>" . $TBL_company_name[$i];
				echo "<br/>" . $TBL_adresse_1[$i];
				echo "<br/>" . $TBL_adresse_2[$i];
				echo "<br/>" . $TBL_adresse_3[$i];
				echo "<br/>" . $TBL_adresse_zip[$i];
				echo "<br/>" . $TBL_adresse_state[$i];
				echo "<br/>" . $TBL_adresse_city[$i];
				echo "<br/>" . $TBL_adresse_country[$i];
				echo "<br/>" . $TBL_adresse_contact[$i];
				echo "<br/>" . $TBL_adresse_telephone[$i];
				echo "<br/>" . $TBL_adresse_mail[$i];
				echo "<br/><input type='button' value='Select this adress' onclick=\"select_delivery_adress('" . $TBL_adresse_id[$i] . "');\">";
				echo "<hr/>";
			}
			// On place le numéro d'O.F. dans ce input pour l'affecter en dynamique
			echo "<input id='num_of_adresse' type='hidden'>";
			echo "<input type='button' value='close' onclick='close_set_new_address_supplier();'>";
			echo "<br/>";
	echo "</div>";
	// Réaffiche la ligne déplié
	if($_SESSION['current_line_of']>0)
	{
		echo "<input type='hidden' id='last_line_open' value='" . $_SESSION['current_line_of'] . "'>" ;
	}
	else
	{
		echo "<input type='hidden' id='last_line_open' value='" . 0 . "'>" ;
	}
?>
