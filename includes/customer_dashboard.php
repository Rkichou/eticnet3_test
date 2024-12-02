<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	//
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
		// echo $cpt_BAT_MMG;
		// die("Maintenance en cours...");
	}
	// Préchargement des BAT LOEWE 24/07/2024 -- SAMUEL AUGER 
	if($_SESSION['prefix_contractor']=="loe")
	{
		// On doit récupérer les derniers  BATS validés et en attente avec un classement par Date
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
		
		// ATTENTION ICI IL VA FALLOIR METTRE UNE GESTION DES ATTENTES / VALIDES QUI PEUVENT EXISTER EN MEME TEMPS
		
			// Rècupère la liste des BATs en attente
			$files = scandir($batsDirectoryW, SCANDIR_SORT_DESCENDING);
			// Tri par Date
			foreach($files as $key=>$value)
			{
				$tmpKey=explode("_",$value);
				// Mettre un tri par date ! 24/07/2024
				$clef=$tmpKey[0]."_" . $tmpKey[1];
				//echo $clef . " ";
				if(isset($TBL_BAT_LOE[$clef]))
				{
					$tmpKey2=explode("_",$TBL_BAT_LOE[$clef]);
					$tmpkey3= $tmpKey[2] ."-". $tmpKey[3];
					$tmpkey4= $tmpKey2[2] ."-". $tmpKey2[3];
					$TBL_tmpNum1=explode("-",$tmpkey3);
					$TBL_tmpNum2=explode("-",$tmpkey4);
					
					$num1=$TBL_tmpNum1[0].$TBL_tmpNum1[1].$TBL_tmpNum1[2].$TBL_tmpNum1[3].$TBL_tmpNum1[4].$TBL_tmpNum1[5];
					$num2=$TBL_tmpNum2[0].$TBL_tmpNum2[1].$TBL_tmpNum2[2].$TBL_tmpNum2[3].$TBL_tmpNum2[4].$TBL_tmpNum2[5];
					// echo "<i>" . $num1 . "</i> : " . $num2 . "<br/>";
					// On remplace si la clef est plus récente
					if($num1>$num2)
					{
						// echo "ok";
						$TBL_BAT_LOE[$clef]=$value ."|";
					}
				}
				else
				{
					$TBL_BAT_LOE[$clef]=$value ."|";
				}
			}
			// print_r($TBL_BAT_LOE);
			unset($files);
			// Récupère la liste des BATs validés
			$files = scandir($batsDirectoryV, SCANDIR_SORT_DESCENDING);
			// Tri par Date
			foreach($files as $key=>$value)
			{
				$tmpKey=explode("_",$value);
				// Mettre un tri par date ! 24/07/2024
				$clef=$tmpKey[0]."_" . $tmpKey[1];
				
				if(isset($TBL_BAT_LOE[$clef]))
				{
					$tmpKey2=explode("_",$TBL_BAT_LOE[$clef]);
					$tmpkey3= $tmpKey[2] ."-". $tmpKey[3];
					$tmpkey4= $tmpKey2[2] ."-". $tmpKey2[3];
					$TBL_tmpNum1=explode("-",$tmpkey3);
					$TBL_tmpNum2=explode("-",$tmpkey4);
					$num1=$TBL_tmpNum1[0].$TBL_tmpNum1[1].$TBL_tmpNum1[2].$TBL_tmpNum1[3].$TBL_tmpNum1[4].$TBL_tmpNum1[5];
					$num2=$TBL_tmpNum2[0].$TBL_tmpNum2[1].$TBL_tmpNum2[2].$TBL_tmpNum2[3].$TBL_tmpNum2[4].$TBL_tmpNum2[5];
					// echo "<i>" . $num1 . "</i> : " . $num2 . "<br/>";
					// On remplace si la clef est plus récente
					if($num1>$num2)
					{
						// echo "ok";
						$TBL_BAT_LOE[$clef]=$value ."|";
					}
				}
				else
				{
					$TBL_BAT_LOE[$clef]=$value ."|";
				}
			}
			// print_r($TBL_BAT_LOE);
	}

	// $status[9]='Waiting for BAT';
	// Charge les codes services
	// Rècupère les services en fonction du contractor
	$sql2="select * from services where prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by name";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		if($_SESSION['prefix_contractor']!="dior") 
		{
			// Attention ici on prends le code service comme clef et non pas l'id vue que la recherche se fait par le contractor et que le code service est injecté dans les fichiers d'échanges
			$tbl_service[$row2['code_service']] = $row2['name'];
		}
		else 
		{
				// Attention ici on prends le code service comme clef et non pas l'id vue que la recherche se fait par le contractor et que le code service est injecté dans les fichiers d'échanges
				$tbl_service[$row2['code_service']] = $row2['code_service'] . ":" . $row2['name'];
		}
		
	}
	// print_r($tbl_service);
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
		// Enlève " et '
		$searchCriteria=str_replace("\"","",$searchCriteria);
		$searchCriteria=str_replace("'","",$searchCriteria);
		
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
		//echo "CUSTOMER DASHBOARD " . $TBL_MESSAGE[17];
		echo "<h5>CUSTOMER DASHBOARD</h5>";
		//echo "&nbsp;";
		echo "<br/>";
		echo  "<input class='as_agence-input2' name='dashboard_customer_search_criteria". "' placeholder= \"" . $TBL_MESSAGE[17]. "\" value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_dashboard_keyup(event,this);\" onblur=\"set_search_criteria_dashboard(this);\">";
		echo "<br/><br/>";
		echo "STATE&nbsp;:&nbsp;";
		// echo "<select name='criteria_status' onblur=\"set_status_criteria_dashboard(this);\">";
		// echo "<option value='-1'>" . "ALL" . "</option>";
		// Vérifie  les statuts productions
		// Vérifie les statuts productions et alimente la clause whereStateProduction
		$whereStateProduction=" (`status` in (";
		
		for($i=0 ;$i<=8;$i++)
		{
			$nomParametre="state_criteria_chk_state_" . $i . "_status";
			$checked="";
			if(isset($_SESSION[$nomParametre]) && strtoupper($_SESSION[$nomParametre])=="TRUE")
			{
				$checked=" checked=checked";
				$whereStateProduction.=$i . ",";
				$isVisibles[$i]=1;
			}
			else
			{
				$checked="";
				$isVisibles[$i]=0;
			}
			echo "<input $checked type='checkbox' id='chk_state_$i' value='" . 1 . "' onclick=\"set_status_state_dashboard(this);\">" . $status[$i] . " ";
		}
		echo "</select>";
		// Retire la dernière virgule et ajoute la parenthèse de fermeture 
		$whereStateProduction=substr($whereStateProduction,0,-1). "))";
		// echo "<br/>" . $whereStateProduction;
		if( trim($whereStateProduction)=="(`status` in ))")
		{
			die("<h1>0 Record selected</h1>");
		}
	echo "</div>";
	// Vérifie la visibilité des services (en rapport avec la colonne service)
	// echo $_SESSION['user_service'];
	$tbl_services=explode("|",$_SESSION['user_service']);
	// Construction de la requète SERVICE
	$sqlService="";
	foreach($tbl_services as $key=>$value)
	{
		if(trim($value)>"")
		{
			$tbl_services_2=explode(":",$value);
			$isVisibleService[$tbl_services_2[0]]=true;
			$sqlService.="'" . $tbl_services_2[0] . "',";
		}
	}	
	// Si on a des services alors on ajoute la requète service
	if($sqlService>"")
	{
		$sqlService ="(`code_service` in (" . $sqlService . "'') or code_service is null) and ";
	}
	// print_r($isVisibleService);
	// echo $sqlService;
	// die();
	// Construit la requète de Recherche
		$i=0;
		$sql="SHOW COLUMNS FROM " . $_SESSION['prefix_contractor'] . "_orders;";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$i++;
			$TBL_tmp[$i]=$row['Field'];
		}
			$sql=" where $sqlService ($whereStateProduction ";
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
			// Recherche des O.F. en cours --- On tient compte de la Session qui indique sur quelle table on travaile
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
			// echo $sql;
			// die();
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
			echo  "<select name='" .  "ORDERS" . "_display_sheet". "' onchange=\"set_display_sheet_customer(this);\">";
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
			//
			if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
			{
			$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders $recherche group by num_of,reference  $ordre_tri limit " . $offset . "," . $maxRecord . ";";
			}
			else{
				$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders $recherche group by num_of  $ordre_tri limit " . $offset . "," . $maxRecord . ";";
			}
			$retour=mysqli_query($con,$sql);
			// echo $sql;
			echo "<table style='min-width:100%'>";
			echo "<tr style='background-color:#202020;color:#fefefe'>";
				echo "<td></td>";
				echo "<td onclick=\"set_order_display_dashboard('num_of','$orderTriDefault');\"><b>O.F.(Commessa)</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('reference','$orderTriDefault');\"><b>REFERENCE.</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('Saison','$orderTriDefault');\"><b>SAISON</b></td>";
				if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc")
				{
					echo "<td onclick=\"set_order_display_dashboard('type_ordre','$orderTriDefault');\"><b>TYPE ORDRE</b></td>";
				}
				echo "<td onclick=\"set_order_display_dashboard('code_service','$orderTriDefault');\"><b>SERVICE</b></td>";
				if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc")
				{
					echo "<td onclick=\"set_order_display_dashboard('status_composition','$orderTriDefault');\"><b>STAT. COMPOSITION</b></td>";
					
				}
				echo "<td onclick=\"set_order_display_dashboard('code_supplier','$orderTriDefault');\"><b>CODE MANUFACTURER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('code_supplier','$orderTriDefault');\"><b>MANUFACTURER</b></td>";
				if($_SESSION['prefix_contractor']=="lem")
				{
					echo "<td onclick=\"set_order_display_dashboard('product_name','$orderTriDefault');\"><b>PRODUCT NAME</b></td>";					
					echo "<td onclick=\"set_order_display_dashboard('genre','$orderTriDefault');\"><b>GENDER</b></td>";
				}
				echo "<td onclick=\"set_order_display_dashboard('made_in','$orderTriDefault');\"><b>MADE IN</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('date_integration','$orderTriDefault');\"><b>DATE ORDER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('status','$orderTriDefault');\"><b>STATE</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('comment_contractor','$orderTriDefault');\"><b>COMMENT CONTRACTOR</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('comment_contractor','$orderTriDefault');\"><b>VALIDATION CONTRACTOR</b></td>";
				
				echo "<td onclick=\"set_order_display_dashboard('tracking','$orderTriDefault');\"><b>TRACKING NUMBER</b></td>";
				echo "<td onclick=\"set_order_display_dashboard('date_delivery','$orderTriDefault');\"><b>DELIVERY DATE</b></td>";
				echo "<td colspan=4><b>ACTIONS</b></td>";
							
			echo "</tr>";
			while($row=mysqli_fetch_array($retour))
			{
				// if($isVisible[$row['status']] && $isVisibleService[$row['code_service']])
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
						echo "<td >";
							echo $row['num_of'];
						echo "</td>";
						echo "<td>";
							echo $row['reference'];
						echo "</td>";
						echo "<td>";
							echo $row['saison'];
						echo "</td>";
						if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc"){
							echo "<td>";
								echo $row['type_ordre'];
							echo "</td>";
						}
						echo "<td>";
						if($row['code_service']){
							echo $tbl_service[$row['code_service']];
						}
						echo "</td>";
						if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc")
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
								// if($row['other_delivery_adress']){								
									if(trim($row['other_delivery_adress'])=="")
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
								// }
							}
						echo "</td>";						
						if($_SESSION['prefix_contractor']=="lem")
						{
							echo "<td>";
								echo $row['product_name'];
							echo "</td>";
							echo "<td>";
								echo $row['genre'];
							echo "</td>";
						}						
						echo "<td>";
							echo $row['made_in'];
						echo "</td>";
						echo "<td>";
							$date = new DateTime($row['date_integration']);
							echo date_format($date,"d-m-Y");
						echo "</td>";
						echo "<td>";
							if($row['status']!=0)
							{
								echo $status[$row['status']];
							}
							else
							{
								echo "<label style='color:navy'>";
									echo $status[$row['status']];
								echo "</label>";
							}
						echo "</td>";
						echo "<td>";
							echo "<label class='fa-solid fa-pen' style='cursor:pointer;font-size:0.7vw' onclick=\"set_comment_contractor(this,'" . $row['num_of']. "','" . $row['reference'] . "');\"> ". $row['comment_contractor'] . "</label>";
						echo "</td>";
						echo "<td>";
							echo $row['horodatage_customer_validate'];
						echo "</td>";
						
						echo "<td>";
						if ($row['tracking']!=null)
						{
							if(substr($row['tracking'],0,3)=="DHL")
							{
								echo "<a href='https://www.dhl.com/fr-fr/home/tracking/tracking-express.html?submit=1&tracking-id=" . substr($row['tracking'],4)  . "' target='_blank'>" . $row['tracking'] . "</a>";
							}
							else
							{
								echo $row['tracking'];								
							}
						}
						else 
							echo " ";
						echo "</td>";
						echo "<td>";
							if ($row['date_delivery']!=null){
								echo substr($row['date_delivery'],0,10);
							}
							else{
								echo " ";	
							}
						echo "</td>";
						echo "<td>";
							if($_SESSION['prefix_contractor']=="chloe")
							{
									echo "<input type='button' value='?' onclick=\"display_infos_file('" . $row['file_name'] . "','" . $_SESSION['prefix_contractor'] . "');\">&nbsp;";
							}
							if($row['status']>0 && $row['status']<5)
							{
								// Exception mmg
								if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
								{
									echo "<input type='button' value='cancel / destroy' onclick=\"set_orders_cancel_mmg('" . $row['num_of'] . "','" . $row['reference'] . "');\">";
								}
								else
								{
									echo "<input type='button' value='cancel' onclick=\"set_orders_cancel('" . $row['num_of'] . "');\">";
								}
							}							
						echo "</td>";
						echo "<td>";
							if($_SESSION['prefix_contractor']=="dior" )
							{
								// echo $_SESSION['id'];
								if($row['status']>0 && $row['status']<=3 && $row['status_composition']==20)
								{
									echo "<input type='button' value='validate order' onclick=\"set_orders_validate_contractor('" . $row['num_of'] . "');\">";
								}
								if($row['status']==0 && $_SESSION['id']==287)
								{
									echo "<td><input type='button' value='Change to New' onclick=\"set_orders_new_contractor('" . $row['num_of'] . "');\"></td>";
								}
							} 
							//
							else if($_SESSION['prefix_contractor']=="mmg"|| $_SESSION['prefix_contractor']=="lan")
							{
								if($row['status']>0 && $row['status']<=3 )
								{
									echo "<input type='button' value='validate order' onclick=\"set_orders_validate_contractor_mmg('" . $row['num_of'] . "','" . $row['reference'] . "');\">";
								}
							}
							else
							{
								if($row['status']>0 && $row['status']<=3 )
								{
									echo "<input type='button' value='validate order' onclick=\"set_orders_validate_contractor('" . $row['num_of'] . "');\">";
								}
							}
							
							
						echo "</td>";
			
						echo "<td>";
							if($row['urgent_mode']==0 )
							{
								echo "<input type='button' value='urgent' onclick=\"set_orders_urgent('" . $row['num_of'] . "','" . $row['reference'] . "');\">";
							}
							else
							{
								echo "<label style='color:red'>URGENT</label>";
							}
						echo "</td>";
						echo "<td>";							
								echo "<input type='button' value='duplique' onclick=\"duplique_order('" . $row['num_of'] . "','" . $row['reference'] . "');\">";
							
						echo "</td>";
					echo "</tr>";
					echo "<tr id='colonne_table_$num_ligne' style='display:none'>";
						echo "<td></td>";
						echo "<td  colspan=12><br/>";
							echo "<table style='min-width:100%;border:0px solid #606060'>";
							echo "<tr style='background-color:#606060;color:#fefefe'>";
								echo "<td><b># Internal	</b></td>";
								
								if($_SESSION['prefix_contractor']!="lem" && $_SESSION['prefix_contractor']!="lan")
								{
									echo "<td><b>O.F.(Commessa)</b></td>";
									echo "<td><b>REFERENCE</b></td>";
								}
								echo "<td><b>COLORIS</b></td>";
								echo "<td><b>SIZE</b></td>";
								if($_SESSION['prefix_contractor']=="dior"){ 
									echo "<td><b>STAT. COMPO</b></td>";
								}
								
								echo "<td><b>TYPE LABEL</b></td>";
								if($_SESSION['prefix_contractor']=="loe" || $_SESSION['prefix_contractor']=="patou")
								{
									echo "<td><b>PRODUCT NAME</b></td>";					
								}
								echo "<td><b>CODE EAN</b></td>";
								echo "<td><b>QTY INITIAL</b></td>";
								echo "<td><b>QTY TO PRODUCE</b></td>";	
								echo "<td><b>STATUT</b></td>";
								if($_SESSION['prefix_contractor']!="dior")
								{
									echo "<td style='width:200px'><b>VALIDATION BAT</b></td>";
								}
								else
								{
									echo "<td style='width:200px'><b>BAT</b></td>";
								}
							
							echo "</tr>";
								$total=0; $total2=0;
								$total_to_produce = 0; $total_to_produce2=0;
								$labelEnCours="";
								$num_ligne2=0;
								$sql2="select * from " . $_SESSION['prefix_contractor'] . "_orders  where num_of='" . $row['num_of']. "' order by type_label asc, id desc";
								if($_SESSION['prefix_contractor']=="lem")
								{									
										// Requête pour les lignes avec CARE LABEL
										$sql2 = "select *, SUM(qty_init) as qty_init_total, SUM(qty_to_produce) as qty_to_produce_total
										FROM lem_orders WHERE num_of= '".$row['num_of']."' GROUP BY 
										CASE 
											WHEN type_ordre = 'COMPO' THEN CONCAT(num_of, '_', reference)
											WHEN type_ordre = 'Sticker' THEN CONCAT(num_of,'_', reference, '_', coloris, '_', size)
										END";													
								}
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
								while($row2=mysqli_fetch_array($retour2))
								{
	
									// Totalisation
									if($labelEnCours=="")
									{
										$labelEnCours=$row2['type_label'];
										if($_SESSION['prefix_contractor'] =="lem")
										{
											$total2+=$row2['qty_init_total'];
											$total_to_produce2+=$row2['qty_to_produce_total'];
										}
										
									}
									if($labelEnCours!=$row2['type_label'])
									{	
										
										echo "<tr style='background-color:#202020;color:#ffffff'>";
										if(($_SESSION['prefix_contractor']=="mmg")||($_SESSION['prefix_contractor']=="ala"))
										{
											echo "<td colspan=7></td>";
										}
										else if($_SESSION['prefix_contractor']=="lem" || $_SESSION['prefix_contractor']=="lan")
										{
											echo "<td colspan=5></td>";
										}
										else
										{
											echo "<td colspan=8></td>";
										}
										if($_SESSION['prefix_contractor'] =="lem")
										{
											echo "<td>" . $total2 . "</td>";
										}
										else
										{
											echo "<td>" . $total . "</td>";
											// Remise à zéro du total en cours
											$total=0;
										}
										if($_SESSION['prefix_contractor']=="lem")
										{
										echo "<td>". $total_to_produce2 ."</td>";
										}
										else
										{
											echo "<td>" . $total_to_produce . "</td>";
											// Remise à zéro du total en cours
											$total_to_produce=0;
										}
										echo "<td></td>";
										echo "<td></td>";
										echo "</tr>";
										
										
										$labelEnCours=$row2['type_label'];
										
									}
									// Totalisation standard
									if($_SESSION['prefix_contractor'] !="lem")
									{	
											$total+=$row2['qty_init'];
											$total_to_produce+=$row2['qty_to_produce'];	
									}

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
										if($_SESSION['prefix_contractor']!="lem" && $_SESSION['prefix_contractor']!="lan")
										{
											echo "<td>";
												echo $row2['num_of'];
											echo "</td>";
											echo "<td>";
												echo $row2['reference'];
											echo "</td>";
										}
										echo "<td>";
										if($_SESSION['prefix_contractor']=="lem")
										{
											if ($row2['type_ordre'] == "COMPO")
											{
												echo "-";
											}
											else 
											{
												echo $row2['coloris'];
											}
										}
										else{
											echo $row2['coloris'];
										}
											
										echo "</td>";
										echo "<td>";
										if($_SESSION['prefix_contractor']=="lem")
										{
											if ($row2['type_ordre'] === "COMPO")
											{
												echo "-";
											}
											else 
											{
												echo $row2['size'];
											}
										}
										else{
											echo $row2['size'];
										}
										echo "</td>";
										
										if($_SESSION['prefix_contractor']=="dior")
										{
											echo "<td>";
												echo $row2['status_composition'];
											echo "</td>";
										}
	
										echo "<td>";
											echo $row2['type_label'];
										echo "</td>";
										if(($_SESSION['prefix_contractor']=="loe")||($_SESSION['prefix_contractor']=="patou"))
										{
											echo "<td>". $row2['product_name']."</td>";					
										}
										echo "<td>";
										if($_SESSION['prefix_contractor']=="lem")
										{
											if ($row2['type_ordre'] === "COMPO")
											{
												echo "-";
											}
											else 
											{
											echo $row2['code_ean'];
											}
										}
										else 
											{
											echo $row2['code_ean'];
											}
										echo "</td>";
										echo "<td>";
										if($_SESSION['prefix_contractor']=="lem")
										{
											if($row2['status']==1 & substr($row2['num_of'],0,4)=="DUP_")
											{
												echo "<label class='fa-solid fa-pen' style='cursor:pointer' onclick=\"set_new_qty(this,'" . $row2['id']. "');\"> ". $row2['qty_init_total'] . "</label>";
											}
											else
											{
												
												echo $row2['qty_init_total'];
											}
										}
										else
										{
											if($row2['status']<5 & substr($row2['num_of'],0,4)=="DUP_")
											{
												echo "<label class='fa-solid fa-pen' style='cursor:pointer' onclick=\"set_new_qty(this,'" . $row2['id']. "');\"> ". $row2['qty_init'] . "</label>";
											}
											else
											{
												echo $row2['qty_init'];
											}
										}
											
										echo "</td>";
										echo "<td>";
										if($_SESSION['prefix_contractor']=="lem")
										{													
											echo $row2['qty_to_produce_total'];													
										}
										else{
											echo $row2['qty_to_produce'];	
										}
										echo "</td>";
										echo "<td>";
											echo $status[$row2['status']];
										echo "</td>";
										$fullLinkImage="";
										// Reconstitution du nom de BAT
											$initDirectory=$_SESSION['prefix_contractor'];
											$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
											$batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
											$batsDirectoryR = "../bats/" . $initDirectory ."/refused/";
											// Exception DIOR
											if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc")
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
												// echo "<td>";
													// echo $sqlB;
												// echo "</td>";
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
												
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
													
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
											// Exception Lemaire
											if($_SESSION['prefix_contractor']=="lem")
											{	

												// Eliminer le _1 ou _2 en cas de commande introduite plusieurs fois
												$num_of=explode('_', $row2['num_of'], 2);
												// $fullNameBAT=$row2['num_of'] . "_" . $row2['type_label'] . "_" ;
												$fullNameBAT=$num_of[0] . "_" . $row2['type_ordre']  ;
												// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
												$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
												// Recherche la dernière version validées
												$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
												// echo $sqlB;
												$retourB=mysqli_query($con,$sqlB);												
												
												while($rowB=mysqli_fetch_array($retourB))
												{
													$fullLinkImage=$rowB['bat_name'];
												}
											} // Fin Lemaire
											// Exception Loewe
											if($_SESSION['prefix_contractor']=="loe")
											{	
												// !!!!!!!!!!!! ATTENTION ON PEUT AVOIR PLUSIEURS TYPE ETIQUETTES !!!!!!!!!!!!!!!!!!!
												// $fullNameFolder = substr($row2['saison'],0,4)  . "-" . $row2['reference'] . "_" ;//Date proelia ensuite
												$fullNameImage = substr($row2['saison'],0,4)  . "-" . $row2['reference'] . "_" . $row2['prefix_bat'] ;												
												if(isset($TBL_BAT_LOE[$fullNameImage]))
												{
													$TBL_IMG_LOE=explode("|",$TBL_BAT_LOE[$fullNameImage]);
													// print_r($TBL_IMG_LOE); 
													// echo $fullNameImage . ":" ;
													// echo $TBL_BAT_LOE[$fullNameImage];
													// print_r($TBL_BAT_LOE);
													$fullNameBAT  = $TBL_IMG_LOE[0];
													// Recherche la dernière version validée
													$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
													// echo $sqlB;
													// $fullLinkImage="";
													$retourB=mysqli_query($con,$sqlB);												
													while($rowB=mysqli_fetch_array($retourB))
													{
														$fullLinkImage=$rowB['bat_name'];
													}
													// echo "<b>" . $fullLinkImage . "</b>";
												}
												else
												{
													$fullNameBAT = "";
												}
											} // Fin Loewe
											
											//
											// Exception CHLOE
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
											} // Fin ALAIA
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
												// echo "<td><i>$fullLinkImage</i>";
												echo "<td>";
												if($_SESSION['prefix_contractor']=="dior" || $_SESSION['prefix_contractor']=="diorhc")
												{
													$tbl2_name_image=explode("_",$tbl_name_image[count($tbl_name_image)-1]);
													$dateBAT=substr($tbl2_name_image[count($tbl2_name_image)-2],6,2) . "/" . substr($tbl2_name_image[count($tbl2_name_image)-2],4,2) . "/" . substr($tbl2_name_image[count($tbl2_name_image)-2],0,4) ;
													echo $dateBAT . " " ;
													// echo $tbl2_name_image[count($tbl2_name_image)-2] ;
												}
												// echo $fullLinkImage;
												if(isset($tbl_name_image))
												{
													// for ($n=2;$n<20;$n++)
													//echo "tbl_name_image is set <br/>";
													for ($n=1;$n<20;$n++)
													{
														if($_SESSION['prefix_contractor']=="loe_old")
														{
															$fileImageValidate = $fullLinkImage . "" . $n . ".png";
															//echo $fileImageValidate;
														}
														else
														{
															$fileImageValidate=str_replace("_1.","_$n.",$tbl_name_image[count($tbl_name_image)-1]);
															//echo "for n = ". $n . "fileImage = " . $fileImageValidate . "<br/>";
															// '$fileImageValidate=str_replace("_2.","_$n.",$tbl_name_image[count($tbl_name_image)-1]);
															// $fileImageValidate=str_replace("_3.","_$n.",$tbl_name_image[count($tbl_name_image)-1]);
															
														}
													
														if(file_exists($batsDirectoryV . $fileImageValidate))
														{
															if($_SESSION['prefix_contractor']=="chloe" || $_SESSION['prefix_contractor']=="loe")
															{
																echo "&nbsp;<a href='../includes/visu_bat.php?source=" . $batsDirectoryV . $fileImageValidate . "'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#009900'></label>" . "</a>";
															}
															else
															{
																echo "&nbsp;<a href='" . $batsDirectoryV . $fileImageValidate . "'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#009900'></label>" . "</a>";
															}
														}
														else
														{
															//echo "ERROR FILE " . $batsDirectoryV . $fileImageValidate . " NOT EXIST<br/>";
														}
													}
												} 
												echo "</td>";
											}
											else // Bat en attente de validation
											{ 
												
												unset($tbl_name_image);
												// Affiche le BAT en attente de validation
												// Reconstitue le nom du bat
												echo "<td>";
													// echo $batsDirectoryW . $fullNameBAT . "1.png";
													// $fullNameBAT=$row2['num_of'] . "_" . $row2['reference'] . "_" . $row2['coloris'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" . $row2['type_label'] . "_1" ;
													for ($n=1;$n<20;$n++)
													{
														switch($_SESSION['prefix_contractor'])
														{
															// Exception lanvin
															case("lan"):
															{
																if($row2['type_label']=="CARE LABEL")
																{
																	$fullNameBAT=$row2['reference'] . "_" ;													

																	for ($j=1;$j<20;$j++)
																	{
																		if(file_exists($batsDirectoryW . $fullNameBAT . $j ."_"."$n.png"))
																		{
																			echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . $j ."_"."$n.png'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
																		}
																		if(file_exists($batsDirectoryW . $fullNameBAT . $j ."_"."$n.bmp"))
																		{
																			echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . $j ."_"."$n.bmp'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
																		}
																	}
																}
																break;

															} // Fin LANVIN
															// Exception Loewe
															case("loe"):
															{
																// echo "<td><i>$fullNameBAT</i>";
																$fullNameBAT2=substr($fullNameBAT,0,strlen($fullNameBAT)-5);
																if(file_exists($batsDirectoryW . $fullNameBAT2 . "$n.bmp"))
																{
																	echo "&nbsp;<a href='../includes/visu_bat.php?source=" . $batsDirectoryW . $fullNameBAT2 . "$n.bmp'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000099'></label>" . "</a>";

																}
																break;
															}
															default:
															{
																
																if(file_exists($batsDirectoryW . $fullNameBAT . "$n.png"))
																{
																	echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . "$n.png'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
																}
																if(file_exists($batsDirectoryW . $fullNameBAT . "$n.bmp"))
																{
																	echo "&nbsp;<a href='" . $batsDirectoryW . $fullNameBAT . "$n.bmp'  target='_blank'>" . "<label class='fa-solid fa-eye' style='color:#000080;cursor:pointer'></label>" . "</a>";
																}
																break;
															}
														}
													}
	
												echo "</td>";
											}
										if($_SESSION['prefix_contractor'] =="lem")
										{	
											if ($row2['type_ordre'] != "COMPO")
											{											
												$total+=$row2['qty_init_total'];
												$total_to_produce+=$row2['qty_to_produce_total'];	
											}
										}					
									
								} // Fin $row2
								echo "<tr style='background-color:#202020;color:#ffffff'>";
								
										if(($_SESSION['prefix_contractor']=="mmg")||($_SESSION['prefix_contractor']=="ala"))
										{
											echo "<td colspan=7></td>";
										}
										else if($_SESSION['prefix_contractor']=="lem" || $_SESSION['prefix_contractor']=="lan")
										{
											echo "<td colspan=5></td>";
										}
										else
										{
											echo "<td colspan=8></td>";
										}								
								echo "<td>" . $total . "</td>";	
								echo "<td>". $total_to_produce ."</td>";
								
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

