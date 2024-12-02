<?php
class manage_table 
{
	// Attention AUCUN FIELD ne doit être OBLIGATOIRE pour le bon fonctionnement de cette class
	// Le champ id est obligatoire dans toutes les structures
	// Toutes les valeurs null doivent êtres autorisées
	/////////////////////////////////////////////////////////////////////////////////////////////////
	// Variables publics
	public $masterTable = ''; 	// La table en cours d'édition 
	public $TBL_Fields;			// Tableau des champs de la table
	public $conMSQLI;			// Conexion mysqli
	public $TBL_LIST;			// Tableau des tables listes (exemple liste des contractor, liste des devise
	public $returnTable	= '';	// Table master pour l'édition des sous-tables (exemple adresses multiples)
	public $returnID = 0;		// ID enregistrement de retour de la master pour l'édition des sous-tables
	public $linkID = '';			// Indique le champs de la sous_table qui contient l'id de la table master	
	////////////////////////////////////////////////////////////////////////////////////
	public function __construct()
	{
		//
	}
	// Ouverture de la connection
	public function open_mysqli()
	{
		$this->conMSQLI = new Connection(); // pass connection params if you want to overwrite default connection params
		if($_SESSION['prefix_contractor']=="dior" && $_SESSION['role']!=1 && $_SESSION['id']!=287)
		{
			// echo $_SESSION['prefix_contractor'];
			die("Vous n'avez pas accès à cette fonction.");
		}
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////
	// Définition de la table de retour en cas d'édition d'une sous tables
	public function set_return_table($param1,$param2,$param3) 
	{
		$this->returnTable=$param1;
		$this->returnID=$param2;
		$this->linkID=$param3;
	}
	// Définition de la table en cours
	public function set_master_table($param1) 
	{
		$this->masterTable=$param1;
	}
	// 
	public function get_master_table() 
	{
		return $this->masterTable;
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////
	// Affichage des enregistrements
	private function get_fields($table) // Liste des champs de la table	
	{
		$i=0;
		$sql="SHOW COLUMNS FROM `" . $table . "`;";
		$retour=$this->conMSQLI->conn->query($sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$i++;
			$TBL_tmp[$i]=$row['Field'];
		}
		return $TBL_tmp;
	}
	private function get_attributs($table) // Liste des attributs de la table. Utilisé pour créer des listes de choix, masquage/affichage...	
	{
		$i=0;
		$sql="select * from `attributs_tables` where table_name='" . $table . "';";
		$retour=$this->conMSQLI->conn->query($sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$i++;
			$TBL_tmp[$row['field_name']]=$row['attributs'];
			// Analyse les attributs pour pré-charger les valeurs de listes
			$TBL_Attributs=explode(" ",$row['attributs']); // Les attributs sont séparés par des espaces
			if($TBL_Attributs[0]=="LIST" || $TBL_Attributs[0]=="MULTI" || $TBL_Attributs[0]=="MULTI_PREFIX")
			{
				// Attribut 1 = nom de la table cible
				// Attribut 2 = champs de la table cible à afficher dans la liste déroulante
				// Parcours les valeurs de la table et les stocks dans le tableau général des listes
				if($_SESSION['role']==1) // Admin
				{
					$sql2="select * from `" . $TBL_Attributs[1] . "` order by " . $TBL_Attributs[2] . ";"; 
				}
				else
				{
					// Uniquement pour les tables contenant un champs contractors
					// Et la table role qui n'affiche que le choix de manufacturer
					
					switch($TBL_Attributs[1])
					{
						case 'roles':
							if($_SESSION['prefix_contractor']=="mmg")
							{
								// Affiche le rôle printshop mmg
								$sql2="select * from `" . $TBL_Attributs[1] . "` where (id=2 or id=3 or id=7 or  id=8) order by " . $TBL_Attributs[2] . ";"; 
								break;
							}
							else
							{
								//
								$sql2="select * from `" . $TBL_Attributs[1] . "` where (id=2 or id=3 or id=7 ) order by " . $TBL_Attributs[2] . ";"; 
								break;
							}
					
						case 'services':
							$sql2="select * from `" . $TBL_Attributs[1] . "` where ((`prefix_contractor` = '" . $_SESSION['prefix_contractor'] . "')) order by " . $TBL_Attributs[2] . ";"; 
							break;
						case 'contractors':
							$sql2="select * from `" . $TBL_Attributs[1] . "` where ((`id` = '" . $_SESSION['prefix_contractor_id'] . "')) order by " . $TBL_Attributs[2] . ";"; 
							break;
						case 'users':
							$sql2="select * from `" . $TBL_Attributs[1] . "` where ((`contractors` like '{" . $_SESSION['prefix_contractor_id'] . "}%')) order by " . $TBL_Attributs[2] . ";"; 
							break;
						default:
							$sql2="select * from `" . $TBL_Attributs[1] . "` order by " . $TBL_Attributs[2] . ";";
							break;
					}
					// die($sql);
				}
				$retour2=$this->conMSQLI->conn->query($sql2); 
				// Si on est sur un multi_prefix, on affiche le prefix_contractor
				if($TBL_Attributs[0]=="MULTI_PREFIX")
				{
					while($row2=mysqli_fetch_array($retour2))
					{
						$this->TBL_LIST[$TBL_Attributs[1]][$row2['id']]=$row2[$TBL_Attributs[2]] . "(" . $row2['prefix_contractor'] .")";
					}
				}
				else
				{	
					// Sinon on affiche tout
					$retour2=$this->conMSQLI->conn->query($sql2); 
					while($row2=mysqli_fetch_array($retour2))
					{
						$this->TBL_LIST[$TBL_Attributs[1]][$row2['id']]=$row2[$TBL_Attributs[2]];
					}
				}
			}
		}
		return $TBL_tmp;
		// return $sql2;
	}
	// 
	private function get_params($table) // Parametres d'affichages
	{
		// Collecte les paramètres et les critères d'affichage de la table
		// Les paramètres sont enregistrés dans les variables de sessions
		// Qui sont stockès dans la table sessions pour les rappeler à chaque connexion.
		$nomParametre="display_line_" . $table;
		if(!isset($_SESSION[$nomParametre]))
		{
			$maxRecord=10;
		}
		else
		{
			$maxRecord=$_SESSION[$nomParametre];
		}
		return $maxRecord;
	}
	//
	private function get_search_criteria($table) // critères de recherche
	{
		// Collecte les paramètres et les critères d'affichage de la table
		// Les paramètres sont enregistrés dans les variables de sessions
		// Qui sont stockès dans la table sessions pour les rappeler à chaque connexion.
		$nomParametre="search_criteria_" . $table;
		if(!isset($_SESSION[$nomParametre]))
		{
			$searchCriteria="";
		}
		else
		{
			$searchCriteria=$_SESSION[$nomParametre];
		}
		return $searchCriteria;
	}
	//
	private function get_sort_table($table) // critères de recherche
	{
		// Collecte les paramètres et les critères d'affichage de la table
		// Les paramètres sont enregistrés dans les variables de sessions
		// Qui sont stockès dans la table sessions pour les rappeler à chaque connexion.
		$nomParametre="sort_table_" . $table;
		if(!isset($_SESSION[$nomParametre]))
		{
			$sortTable=" ORDER BY id DESC";
		}
		else
		{
			$sortTable=" ORDER BY " . $_SESSION[$nomParametre] . " ";
		}
		// echo $sortTable;
		return $sortTable;
	}
	//
	private function get_clause_where($table) 
	{
		// Contruit une requète sql de recherche
		// Récupère les valeurs de liste
		$TBL_Attributs=$this->get_attributs($table);
		// Récupère la saisie de l'utilsateur
		$searchCriteria=trim($this->get_search_criteria($table));
		if($searchCriteria=="")
		{
			// Aucune recherche on affiche tout
			if($_SESSION['role']==1) // Admin
			{
				$sql=""; 
			}
			else
			{
				// Uniquement pour les tables contenant un champs contractors
				switch($table)
				{
					case 'users':
						$sql="where `contractors` like '{" . $_SESSION['prefix_contractor_id'] . "}%' "; 
						break;
					default:
						$sql="";
						break;
				
				}
				// die($sql);
			}
			
		}
		else
		{
			// Initialise la requete SQL avec une valeur toujours vraie
			
			// Aucune recherche on affiche tout
			if($_SESSION['role']==1) // Admin
			{
				$sql=" where 1=1";
			}
			else
			{
				// Uniquement pour les tables contenant un champs contractors
				switch($table)
				{
					case 'users':
						$sql="where `contractors` like '{" . $_SESSION['prefix_contractor_id'] . "}%' "; 
						break;
					default:
						$sql=" where 1=1 ";
						break;
				
				}
				// die($sql);
			}
			$firstCondition=true;
			// On construit une requète qui exploite tout les champs de la base
			//
			// Extraction des mots recherchés (séparateurs espace)
			$TBL_words=explode(" ",$searchCriteria);
			// Récupération des champs de la table
			$TBL_Fields=$this->get_fields($this->masterTable);
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
				// Recherche dans les clefs étrangères
				foreach($TBL_Attributs as $keyA=>$valueA)
				{
					 $TBL_tmp=explode(" ",$valueA);
					 if($TBL_tmp[0]=="LIST")
					 {
														// Attention : le champ id doit toujours s'appeler... id !
						$sql.=" or (`$value` in (select `id` from `" .  $TBL_tmp[1] . "` where `" . $TBL_tmp[2] ."` like \"%" . $valueW . "%\")) ";
					 }
					 if($TBL_tmp[0]=="MULTI")
					 {
														// Attention : le champ id doit toujours s'appeler... id !
						$sql.=" or (`$value` in (select `id` from `" .  $TBL_tmp[1] . "` where `" . $TBL_tmp[2] ."` like \"%" . $valueW . "%\")) ";
					 }
					 if($TBL_tmp[0]=="MULTI_PREFIX")
					 {
														// Attention : le champ id doit toujours s'appeler... id !
						$sql.=" or (`$value` in (select `id` from `" .  $TBL_tmp[1] . "` where `" . $TBL_tmp[2] ."` like \"%" . $valueW . "%\")) ";
					 }
				}
			}
			// Fin de la requète
			$sql.=") ";
			}
			// echo $sql;
			// die();
		return $sql;
	}
	// Nombre total d'enregistrements
	private function get_total_records($table)
	{
		$nbRecords=0;
		// compte le nombre d'enregistrements 
		$sql="select count(*) FROM `" . $table . "`;";
		$retour=$this->conMSQLI->conn->query($sql);
		if($retour)
		{
			$row = $retour->fetch_row();
			$nbRecords=$row[0];
		}
		return $nbRecords;
	
	}
	// Nombre d'enregistrement retournés
	private function get_select_records($table)
	{
		$nbRecords=0;
		// Création de la clause where de la requete sql
		$whereSQL=$this->get_clause_where($table);
		// compte le nombre d'enregistrements 
		$sql="select count(*) FROM `" . $table . "` $whereSQL ;";
		$retour=$this->conMSQLI->conn->query($sql); 
		if($retour)
		{
			$row = $retour->fetch_row();
			$nbRecords=$row[0];
		}
		return $nbRecords;
	}
	// Calcul de la pagination
	private function get_pagination($table)
	{
		$nbSheets=0;
		// Collecte les paramètres et les critères d'affichage de la table
		$maxRecord=$this->get_params($table);
		// Création de la clause where de la requete sql
		$whereSQL=$this->get_clause_where($table);
		// compte le nombre d'enregistrements 
		$sql="select count(*) FROM `" . $table . "` $whereSQL ;";
		// echo "<br/>" . $sql;
		// die();
		$retour=$this->conMSQLI->conn->query($sql); 
		if($retour)
		{
			$row = $retour->fetch_row();
			$nbSheets=intval($row[0]/$maxRecord);
			if($nbSheets!=$row[0]/$maxRecord) // Vérifie si on a un reste de division
			{
				$nbSheets++;	// 1 page en plus 
			}
		}
		return $nbSheets;
	}
	// Feuille en cours de visualisation
	private function get_actual_sheet($table)
	{
		$nomParametre="actual_sheet_" . $table;
		if(!isset($_SESSION[$nomParametre]))
		{
			$actualSheet=1;
		}
		else
		{
			$actualSheet=$_SESSION[$nomParametre];
		}
		return $actualSheet;
	}
	//
	// 
	public function get_header_edition($id) // Affichage des critères de tri et de recherche
	{
		// Charge les traductions
		global $TBL_MESSAGE;
	
		// Collecte les paramètres et les critères d'affichage de la table
		$maxRecord=$this->get_params($this->masterTable);
		$searchCriteria=$this->get_search_criteria($this->masterTable);
		$nbSheets=$this->get_pagination($this->masterTable);
		$actualSheet=$this->get_actual_sheet($this->masterTable);
		$totalRecord=$this->get_total_records($this->masterTable);
		$selectRecord=$this->get_select_records($this->masterTable);
		//
		$select10="";
		$select20="";
		$select50="";
		$select100="";
		$select200="";
		switch($maxRecord)
		{
			case 10:
				$select10=" selected='selected' ";
				break;
			case 20:
				$select20=" selected='selected' ";
				break;
			case 50:
				$select50=" selected='selected' ";
				break;
			case 100:
				$select100=" selected='selected' ";
				break;
			case 200:
				$select200=" selected='selected' ";
				break;
		}
		// Retour en HTML
		$HTML="";
		$HTML.="<table class='as_agence-table'>";
		// Affiche le header de la table
		$HTML.="<tr class='as_agence-table-bigHeader'>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= $TBL_MESSAGE[20];
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= "<b>" . $this->masterTable . "</b>" ;
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= $TBL_MESSAGE[21];
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= "<b>" . $selectRecord . " / " . $totalRecord . "</b>" ;
		$HTML.= "</td>";
		$HTML.= "<td colspan=3 class='as_agence-table-bigHeader-td-transparent'>";
		// Bouton de retour vers la table originelle
		
			$HTML.= "<label  class='as_agence-icon-header' style='color:red' onclick='exit_record(1,$id)'>X</label>" ;
		$HTML.=  "</td>";
	
		$HTML.= "</tr>";
		//
		$HTML.="</table>";
		return $HTML ;
	}
	// 
	public function get_header() // Affichage des critères de tri et de recherche
	{
		// Charge les traductions
		global $TBL_MESSAGE;
	
		// Collecte les paramètres et les critères d'affichage de la table
		$maxRecord=$this->get_params($this->masterTable);
		$searchCriteria=$this->get_search_criteria($this->masterTable);
		$nbSheets=$this->get_pagination($this->masterTable);
		$actualSheet=$this->get_actual_sheet($this->masterTable);
		$totalRecord=$this->get_total_records($this->masterTable);
		$selectRecord=$this->get_select_records($this->masterTable);
		//
		$select10="";
		$select20="";
		$select50="";
		$select100="";
		$select200="";
		switch($maxRecord)
		{
			case 10:
				$select10=" selected='selected' ";
				break;
			case 20:
				$select20=" selected='selected' ";
				break;
			case 50:
				$select50=" selected='selected' ";
				break;
			case 100:
				$select100=" selected='selected' ";
				break;
			case 200:
				$select200=" selected='selected' ";
				break;
		}
		// Retour en HTML
		$HTML="";
		$HTML.="<table class='as_agence-table'>";
		// Affiche le header de la table
		$HTML.="<tr class='as_agence-table-bigHeader'>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= $TBL_MESSAGE[20];
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= "<b>" . $this->masterTable . "</b>" ;
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= $TBL_MESSAGE[21];
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-bigHeader-td'>";
		$HTML.= "<b>" . $selectRecord . " / " . $totalRecord . "</b>" ;
		$HTML.= "</td>";
		$HTML.= "<td colspan=3 class='as_agence-table-bigHeader-td-transparent'>";
		// Rappel du mode d'affichage
		$nomParametre="display_mode_" . $this->masterTable ;
		if(!isset($_SESSION[$nomParametre]))
		{
			$_SESSION[$nomParametre]="MIDDLE";
		}
		if($_SESSION[$nomParametre]=="MIDDLE")
		{
			$HTML.= "<img id='display_mode' name='" .  $this->masterTable . "_display_mode". "' class='as_agence-icon-header' onclick='left_to_full_screen(this);' src='images/icon_right_arrow.png'>" ;
		}
		else
		{
			$HTML.= "<img id='display_mode' name='" .  $this->masterTable . "_display_mode". "' class='as_agence-icon-header' onclick='left_to_full_screen(this);' src='images/icon_left_arrow.png'>" ;
		}
		$HTML.=  "</td>";
	
		$HTML.= "</tr>";
		//
		$HTML.= "<tr>";
		$HTML.= "<td class='as_agence-table-header-td'>";
		$HTML.= $TBL_MESSAGE[19];
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-header-td'>";
		$HTML.= "<select name='" .  $this->masterTable . "_display_rows". "' onchange=\"set_display_line(this);\">";
		$HTML.= "<option $select10 value='10'>10</option>";
		$HTML.= "<option $select20 value='20'>20</option>";
		$HTML.= "<option $select50 value='50'>50</option>";
		$HTML.= "<option $select100 value='100'>100</option>";
		$HTML.= "<option $select200 value='200'>200</option>";
		$HTML.= "</select>";
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-header-td'>";
		$HTML.= $TBL_MESSAGE[17];
		$HTML.= "</td>";
		$HTML.= "<td  class='as_agence-table-header-td'>";
		$HTML.= "<input style='width:100%' name='" .  $this->masterTable . "_search_criteria". "' value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_keyup(event,this);\" onblur=\"set_search_criteria(this);\">";
		$HTML.= "</td>";
		$HTML.= "<td class='as_agence-table-header-td'>";
		$HTML.= $TBL_MESSAGE[18];
		$HTML.= "</td>";	
		$HTML.= "<td class='as_agence-table-header-td'>";
		$HTML.= "<select name='" .  $this->masterTable . "_display_sheet". "' onchange=\"set_display_sheet(this);\">";
		for($p=1;$p<=$nbSheets;$p++)
		{
			if($actualSheet==$p)
			{
				$HTML.= "<option selected='selected' value='$p'>$p</option>";
			}
			else
			{
				$HTML.= "<option value='$p'>$p</option>";
			}
		}
		$HTML.= "</select>";
		$HTML.= " / $nbSheets</td>";
		// Bouton ajout d'un nouvel enregistrement
		$HTML.= "<td class='as_agence-table-header-td as_agence-right'>";
		// Bouton Ajout enregistrement
																								// L'id 0 provoque la création d'un nouvel enregistrement
		$HTML.= "<input type='button' onclick=\"edit_record('" . $this->masterTable . "','" . "0" . "');\" class='AS_agence-bouton-action AS_agence-fond-bleu' value=\"" . $TBL_MESSAGE[26] . "\">";
		$HTML.= "</td>";	
		
		//
		$HTML.="</tr>";
		$HTML.="</table>";
		return $HTML ;
	}
	//
	public function get_records() // Retourne les enregistrements de la table
	{
		// Charge les traductions
		global $TBL_MESSAGE;
	
		// Collecte les paramètres et les critères d'affichage de la table
		$maxRecord=$this->get_params($this->masterTable); // Nbre max enregistrements visibles
		$actualSheet=$this->get_actual_sheet($this->masterTable); // Page en cours d'affichage
		$nbSheets=$this->get_pagination($this->masterTable); // Nombres totales de pages
		// Calcul l'offset (départ affichage mysql)
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
		
		// Création de la clause where de la requete sql
		$whereSQL=$this->get_clause_where($this->masterTable);
		// Critère de tri
		$nomParametre="sort_table_" . $this->masterTable;
		if(!isset($_SESSION[$nomParametre]))
		{
			$_SESSION[$nomParametre]="ID DESC";
		}
		$TBL_sortField=explode(" ",$_SESSION[$nomParametre]);
		$orderBY=$this->get_sort_table($this->masterTable);
		// Compteur de lignes pour afficher une alternance de couleurs
		$cptLine=0;
		// Retour en HTML
		$HTML='';
		// Liste des champs de la table
		$TBL_Fields=$this->get_fields($this->masterTable);
		$TBL_Attributs=$this->get_attributs($this->masterTable);
		// $HTML=print_r($TBL_sortField);
		$HTML.='';//$whereSQL;
		$HTML.="<table class='as_agence-table'>";
		// Affiche le header de la table
		$HTML.="<tr class='as_agence-table-header'>";
		$HTML.='<td></td>';// Colonne Action Edition
		
		foreach($TBL_Fields as $key=>$value)
		{
			if(strtoupper($TBL_sortField[0])==strtoupper($value))
			{
				// Affiche le champs de tri
				if($TBL_sortField[1]=="DESC")
				{
					$HTML.= "<td onclick=\"set_sort_table(this,'ASC')\"; id='" . $this->masterTable  . "_sort_field' class='as_agence-table-header-td as_agence-pointer as_agence-sort-field-desc'>" . strtoupper($value) . "</td>";
				}
				else
				{
					$HTML.= "<td onclick=\"set_sort_table(this,'DESC')\"; id='" . $this->masterTable  . "_sort_field' class='as_agence-table-header-td as_agence-pointer as_agence-sort-field-asc'>" . strtoupper($value) . "</td>";
				}	
				
			}
			else
			{
				$HTML.= "<td onclick=\"set_sort_table(this,'ASC')\"; id='" . $this->masterTable  . "_sort_field' class='as_agence-table-header-td as_agence-pointer'>" . strtoupper($value) . "</td>";
			}
		}
		// Affiche les actions possibles
		$HTML.= "<td class='as_agence-table-header-td'>" . "ACTIONS" . "</td>";	
		//
		$HTML.="</tr>";
		// Affichages des données		
		$sql="select * FROM `" . $this->masterTable . "` $whereSQL $orderBY limit " . $offset . "," . $maxRecord . ";";
		// $HTML.=$sql;
		$retour=$this->conMSQLI->conn->query($sql); 
		while($row=mysqli_fetch_array($retour))
		{ 
			$cptLine++;
			if($cptLine%2 ==0)
			{
				$HTML.="<tr class='as_agence-table-datas as_agence-table-pair'>";
			}
			else
			{
				$HTML.="<tr class='as_agence-table-datas as_agence-table-impair'>";
			}
					// $HTML.= "<td class='as_agence-table-datas-td'>" . $cptLine . "</td>";
			// Collecte les droits sur la table
			$isEdit=true;
			$isDelete=true;
			$HTML.= "<td class='as_agence-table-datas-td'>";
				$HTML.= "<label class='fa-solid fa-pen' style='cursor:pointer;font-size:0.7vw' onclick=\"edit_record('" . $this->masterTable . "','" . $row['id'] . "');\"></label>";
			$HTML.= "</td>";
			
			foreach($TBL_Fields as $key=>$value)
			{
				// Vérifie les attributs du champs
				if(isset($TBL_Attributs[$value]))
				{
					// Analyse les Attributs
					$TBL_tmp=explode(" ",trim($TBL_Attributs[$value]));
					switch($TBL_tmp[0])
					{
						
						case "TABLES":
						{
							// Les champs de type TABLES font appel à une table modifiable dynamiquement
							// 1er champ est la table
							// 2 ème et 3ème champs sont la relation de la table esclave et de la table maitre
							// les suivants sont les champs à afficher dans la liste de la table maitre
							$HTML.= "<td class='as_agence-table-datas-td'>";
								$sqlT="select * FROM `" . trim($TBL_tmp[1]) . "` where " . trim($TBL_tmp[2]) . "='" . trim($row[$TBL_tmp[3]]) . "';";
								$retourT=$this->conMSQLI->conn->query($sqlT); 
								// $HTML.="<label class='as_agence-box-datas'>";
									$HTML.="<table class='as_agence-table-records'>";
									$HTML.="<tr style='background-color:#999999;color:#efefef'>";
										for($t=4;$t<count($TBL_tmp);$t++)
										{
											$HTML.= "<td style='padding:5px'>" . $TBL_tmp[$t] . "</td>";
										}
										$HTML.="</tr>";
									while($rowT=mysqli_fetch_array($retourT))
									{
										$HTML.="<tr style='border:1px solid #555555'>";
										for($t=4;$t<count($TBL_tmp);$t++)
										{
											// Recherche le type de champs dans la tables des attributs
											$field_attribut_child="";	// Initialise le field_attribut à rien
											$sqlA="select * FROM `attributs_tables` where table_name='" . trim($TBL_tmp[1]) . "' and field_name='" . trim($TBL_tmp[$t]) . "' limit 1;";
											$retourA=$this->conMSQLI->conn->query($sqlA); 
											while($rowA=mysqli_fetch_array($retourA))
											{
												// Ici on a un seul enregistrement, mais avec mysqli le fetch_object n'est pas fiable, si la requète retournée est vide
												//
												$field_attribut_child=trim($rowA['attributs']);
											}
											// On explode les paramètres séparés par des espaces
											// Le 1er paramètre est le type de champs
											$TBL_Attributs_Child=explode(" ",$field_attribut_child);
											switch($TBL_Attributs_Child[0])
											{
												case "LIST" :
													// Récupère les valeurs ATTENTION AU RESPECT DE LA STRUCTURE DES TABLES
													// Les règles de nommage des tables ne doivent pas contenir d'espace dans les nom ainsi que les champs
													$sqlTAC="select * from `" . $TBL_Attributs_Child[1] . "` where id='" . $rowT[$TBL_tmp[$t]] . "' limit 1";
													$retourTAC=$this->conMSQLI->conn->query($sqlTAC); 
													while($rowTAC=mysqli_fetch_array($retourTAC))
													{
														$HTML.= "<td style='border:1px solid #555555;padding:5px'>" . $rowTAC[$TBL_Attributs_Child[2]] . "</td>";
													}
													break;
												default:
													$HTML.= "<td style='border:1px solid #555555;padding:5px'>" .  $rowT[$TBL_tmp[$t]] . "</td>";
													break;
											}
											
										}
										$HTML.="</tr>";
									}
									$HTML.="</table>";
								// $HTML.="</label>"; 
							$HTML.= "</td>";
							break;
						}
						case "LIST":
						{
							// Les champs de type LIST affiche une liste de choix non multiples
							$HTML.= "<td class='as_agence-table-datas-td'><i>" . $this->TBL_LIST[$TBL_tmp[1]][$row[$value]] . "</i></td>";
							break;
						}
						case "MULTI":
						{
							// Les champs de type MULTI sont toujours de type texte
							// On énumére les valeurs et on vérifie si elles sont renseignées
							$HTML.= "<td class='as_agence-table-datas-td'>";
							foreach($this->TBL_LIST[$TBL_tmp[1]] as $keyMULTI=>$valueMULTI)
							{
								// Recherche dans le champs texte si la valeur existe
								// Sous une forme {id}
								$keySearch="{" . trim($keyMULTI) . "}";
								$pos = strpos($row[$value], $keySearch);
								if ($pos === false) 
								{
									$HTML.="<label class='as_agence-box-unselect'>$valueMULTI</label>";
								}
								else
								{
									// Il existe on le présente sous une forme de boîte
									$HTML.="<label class='as_agence-box-select'>$valueMULTI</label>";
								}
							}
							$HTML.= "</td>";
							break;
						}
						case "MULTI_PREFIX":
						{
							// Les champs de type MULTI_PREFIX sont toujours de type texte
							// On énumére les valeurs et on vérifie si elles sont renseignées
							$HTML.= "<td class='as_agence-table-datas-td'>";
							foreach($this->TBL_LIST[$TBL_tmp[1]] as $keyMULTI=>$valueMULTI)
							{
								// Recherche dans le champs texte si la valeur existe
								// Sous une forme {id}
								$keySearch="{" . trim($keyMULTI) . "}";
								$pos = strpos($row[$value], $keySearch);
								if ($pos === false) 
								{
									$HTML.="<label class='as_agence-box-unselect'>$valueMULTI</label>";
								}
								else
								{
									// Il existe on le présente sous une forme de boîte
									$HTML.="<label class='as_agence-box-select'>$valueMULTI</label>";
								}
							}
							$HTML.= "</td>";
							break;
						}
						case "PASSWORD":
						{
							$HTML.= "<td class='as_agence-table-datas-td'>" . "**************" . "</td>";
							break;
						}
						default:
						{
							$HTML.= "<td class='as_agence-table-datas-td'><i>" . $row[$value] . "</i></td>";
							break;
						}
					}
				}
				else
				{
					// Affichage standard
					$HTML.= "<td class='as_agence-table-datas-td'>" . $row[$value] . "</td>";
				}
			}
			// Affiche les actions possibles
			$HTML.= "<td class='as_agence-table-datas-td'>";
			if($isEdit)
			{
				// Bouton Edition
				$HTML.= "<input type='button' onclick=\"edit_record('" . $this->masterTable . "','" . $row['id'] . "');\" class='as_agence-bouton-action as_agence-fond-vert' value=\"" . $TBL_MESSAGE[22] . "\">";
			}
			if($isEdit)
			{
				// Bouton suppression 			
				// ATTENTION LE BOUTON DELETE NE DETRUIT PAS, IL PASSE UN FLAG DELETED A 1 ! 
				// Il faut en tenir compte dans toutes les requètes d'interrogation des tables	
				$HTML.= "<input type='button' class='as_agence-bouton-action as_agence-fond-rouge' value=\"" . $TBL_MESSAGE[23] . "\">";
			}			
			$HTML.="</td>";
			$HTML.="</tr>";	
		}
		$HTML.="</table>";
		return $HTML ;
	}
	//////////////////////////////////////////
	public function edit_record($id) // Modification enregistrement de la table
	{
		// Charge les traductions
		global $TBL_MESSAGE;
	
		// Collecte les paramètres et les critères d'affichage de la table
		$maxRecord=$this->get_params($this->masterTable); // Nbre max enregistrements visibles
		// Si id=0 on créé un nouvel enregistrement
			// Attention aucun field ne doit être obligatoire pour le bon fonctionnement de cette class
			if($id==0)
			{
				$sql="insert into " . $this->masterTable . " (id) values (Null);";
				$retour=$this->conMSQLI->conn->query($sql); 
				// On rècupère l'ID du nouvel enregistrement
				$id=$this->conMSQLI->conn->insert_id;
			}
		// Création de la clause where de la requete sql
		$whereSQL=" where id='" . $id . "'";
		// Compteur de lignes pour afficher une alternance de couleurs
		$cptLine=0;
		// Retour en HTML
		$HTML="";
		$HTML.="<form id='record_form' action='includes/set_record_values.php' method='POST'>";
		// Attention ici ce sont des noms de champs réservés
			$HTML.="<input type='hidden' name='_table_name_' value=\"" . $this->masterTable . "\">";
			$HTML.="<input type='hidden' name='_record_id_' value=\"" . $id . "\">";
		// Champs en cas d'édition de sous-table permet un retour vers l'enregistrement maitre
			if($this->returnID >0)
			{
				$HTML.="<input type='hidden' name='_return_table_' value=\"" . $this->returnTable . "\">";
				$HTML.="<input type='hidden' name='_return_id_' value=\"" . $this->returnID . "\">";
			}
		//
		// Liste des champs de la table
		$TBL_Fields=$this->get_fields($this->masterTable);
		$TBL_Attributs=$this->get_attributs($this->masterTable);
		// $HTML=print_r($TBL_sortField);
		// $HTML.=$whereSQL;
		$HTML.="<table class='as_agence-table'>";
		// Affichages des données	
		$sql="select * FROM `" . $this->masterTable . "` $whereSQL ;";
		// $HTML.=$sql;	
		$retour=$this->conMSQLI->conn->query($sql); 
		while($row=mysqli_fetch_array($retour))
		{
			foreach($TBL_Fields as $key=>$value)
			{
				$cptLine++;
			
				if($cptLine%2 ==0)
				{
					$HTML.="<tr class='as_agence-table-datas as_agence-table-pair'>";
				}
				else
				{
					$HTML.="<tr class='as_agence-table-datas as_agence-table-impair'>";
				}
				$HTML.= "<td  class='as_agence-table-header-td as_agence-pointer'>" . strtoupper($value) . "</td>";
				// Vérfie si on est le champ linkID d'une sous-Table
				if(strtoupper($value)==strtoupper($this->linkID))
				{
					$row[$value]=$this->returnID;
				}
				// Vérifie les attributs du champs
				if(isset($TBL_Attributs[$value]))
				{
					// Analyse les Attributs
					$TBL_tmp=explode(" ",$TBL_Attributs[$value]);
					switch($TBL_tmp[0])
					{
						case "TABLES":
						{
							// Les champs de type TABLES font appel à une table modifiable dynamiquement
							// 1er champ est la table
							// 2 ème et 3ème champs sont la relation de la table esclave et de la table maitre
							// les suivants sont les champs à afficher dans la liste de la table maître
							$HTML.= "<td class='as_agence-table-datas-td'>";
							$HTML.= "<input type='button' onclick=\"save_record(2);edit_sub_record('" . $TBL_tmp[1] . "','" . "0" . "','" . $this->masterTable . "','" . $row['id'] .  "','" . $TBL_tmp[2] . "');\" class='AS_agence-bouton-action AS_agence-fond-bleu' value=\"" . $TBL_MESSAGE[26] . "\">";
							$HTML.= "<br/>";				
								
								$sqlT="select * FROM `" . $TBL_tmp[1] . "` where " . $TBL_tmp[2] . "='" . $row[$TBL_tmp[3]] . "';";
								$retourT=$this->conMSQLI->conn->query($sqlT); 
								// $HTML.="<label class='as_agence-box-datas'>";
									$HTML.="<table class='as_agence-table-records'>";
									$HTML.="<tr style='background-color:#999999;color:#efefef'>";
										for($t=4;$t<count($TBL_tmp);$t++)
										{
											$HTML.= "<td style='padding:5px'>" . $TBL_tmp[$t] . "</td>";
										}
										$HTML.="</tr>";
									while($rowT=mysqli_fetch_array($retourT))
									{
										$HTML.="<tr style='border:1px solid #555555'>";
										for($t=4;$t<count($TBL_tmp);$t++)
										{
											$HTML.= "<td style='border:1px solid #555555;padding:5px'>" . $rowT[$TBL_tmp[$t]] . "</td>";
										}
										$isEdit=true;
										$isDelete=true;
										if($isEdit)
										{
											$HTML.= "<td style='border:1px solid #555555;padding:5px'>";
											// Bouton Edition						save_record(2) indique une sauvegarde de l'enregistrement maitre avant l'édition de la sous-table
											$HTML.= "<input type='button' onclick=\"save_record(2);edit_sub_record('" . $TBL_tmp[1] . "','" . $rowT['id'] . "','" . $this->masterTable . "','" . $row['id'] .  "','" . $TBL_tmp[2] .  "');\" class='AS_agence-bouton-action AS_agence-fond-vert' value=\"" . $TBL_MESSAGE[22] . "\">";
											$HTML.="</td>";
										}
										$HTML.="</tr>";
									}
									$HTML.="</table>";
								// $HTML.="</label>"; 
							$HTML.= "</td>";
							
								
							break;
						}
						case "LIST":
						{
							$HTML.="<td class='as_agence-table-datas-td '>";
							$HTML.="<select class='as_agence-input' style='width:100%' name=\"" . $value . "\" value=\"" . "" . "\">";
							foreach($this->TBL_LIST[$TBL_tmp[1]]as $keyList=>$valueList)
							{
								if($row[$value]==$keyList)
								{
									$HTML.= "<option selected='selected' value=\"" . $keyList . "\">" . $valueList . "</option>";
								}
								else
								{
									$HTML.= "<option value=\"" . $keyList . "\">" . $valueList . "</option>";
								}
							}
							$HTML.="</select>";
							// $HTML.= "<td class='as_agence-table-datas-td'><i>" . $this->TBL_LIST[$TBL_tmp[1]][$row[$value]] . "</i></td>";
							break;
						}
						case "MULTI":
						{
							// Le champs multi est toujours de type texte
							// On énumére les valeurs et on vérifie si elles sont présentes 
							$HTML.= "<td class='as_agence-table-datas-td'>";
							foreach($this->TBL_LIST[$TBL_tmp[1]] as $keyMULTI=>$valueMULTI)
							{
								// Recherche dans le champs texte si la valeur existe
								// Sous une forme {id}
								$keySearch="{" . trim($keyMULTI) . "}";
								$contentString=trim($row[$value]);
								$pos = strpos($contentString, $keySearch);
								// $HTML.= "<br/><b>" . $contentString . "</b> __ <i>" . $keySearch . "</i>:" . $pos . "<br/>";
								if ($pos === false) 
								{
									// Il n'existe pas on le présente sous une forme de boîte en gris
									// Active ou desactive les valeurs de choix multiples
									$HTML.="<label onclick='activate_unactivate_multi_box(\"$keySearch\",\"$value\",this);' class='as_agence-box-unselect as_agence-pointer'>$valueMULTI</label>";
								}
								else
								{
									// Il existe on le présente sous une forme de boîte active en vert
									// Active ou desactive les valeurs de choix multiples
									$HTML.="<label onclick='activate_unactivate_multi_box(\"$keySearch\",\"$value\",this);' class='as_agence-box-select as_agence-pointer'>$valueMULTI</label>";		
								}
								
							}
							$HTML.= "<input type='hidden' class='AS_agence-input' style='width:100%' id=\"" . $value . "\" name=\"" . $value . "\" value=\"" . $row[$value] . "\">";
							$HTML.= "</td>";
							break;
						}
						case "MULTI_PREFIX":
						{
							// Le champs multi est toujours de type texte
							// On énumére les valeurs et on vérifie si elles sont présentes 
							$HTML.= "<td class='as_agence-table-datas-td'>";
							foreach($this->TBL_LIST[$TBL_tmp[1]] as $keyMULTI=>$valueMULTI)
							{
								// Recherche dans le champs texte si la valeur existe
								// Sous une forme {id}
								$keySearch="{" . trim($keyMULTI) . "}";
								$contentString=trim($row[$value]);
								$pos = strpos($contentString, $keySearch);
								// $HTML.= "<br/><b>" . $contentString . "</b> __ <i>" . $keySearch . "</i>:" . $pos . "<br/>";
								if ($pos === false) 
								{
									// Il n'existe pas on le présente sous une forme de boîte en gris
									// Active ou desactive les valeurs de choix multiples
									$HTML.="<label onclick='activate_unactivate_multi_box(\"$keySearch\",\"$value\",this);' class='as_agence-box-unselect as_agence-pointer'>$valueMULTI</label>";
								}
								else
								{
									// Il existe on le présente sous une forme de boîte active en vert
									// Active ou desactive les valeurs de choix multiples
									$HTML.="<label onclick='activate_unactivate_multi_box(\"$keySearch\",\"$value\",this);' class='as_agence-box-select as_agence-pointer'>$valueMULTI</label>";		
								}
								
							}
							$HTML.= "<input type='hidden' class='AS_agence-input' style='width:100%' id=\"" . $value . "\" name=\"" . $value . "\" value=\"" . $row[$value] . "\">";
							$HTML.= "</td>";
							break;
						}

						case "PASSWORD":
						{
							// Aucune valeur pour les mots de passe
							$HTML.= "<td class='as_agence-table-datas-td'><input placeholder=\"" . $TBL_MESSAGE[25] . "\" class='as_agence-input' style='width:100%' name=\"" . $value . "\" value=\"" . "" . "\"></td>";
							break;
						}
						default:
						{
							$HTML.= "<td class='as_agence-table-datas-td'><input class='as_agence-input' style='width:100%' name=\"" . $value . "\" value=\"" . $row[$value] . "\"></td>";
							break;
						}
					}
				}
				else
				{
					// Affichage standard
					$HTML.= "<td class='as_agence-table-datas-td'><input class='as_agence-input' style='width:100%' name=\"" . $value . "\" value=\"" . $row[$value] . "\"></td>";
				}
				$HTML.="</tr>";
			}
		}
		$HTML.="<tr class='as_agence-table-datas '>";
		$HTML.= "<td colspan=2 class='as_agence-table-datas-td as_agence-center'>";
		$HTML.="<input type='button' onclick='save_record();' class='as_agence-bouton-validation as_agence-fond-bleu' value=\"" . $TBL_MESSAGE[24]. "\">";
		$HTML.="</td>";
		$HTML.="</tr>";
		$HTML.="</table>";
		$HTML.="</form>";
		return $HTML ;
	}
} 
?>