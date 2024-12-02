<?php
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	//require_once("./is_session_active.php");
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

	// Charge les codes services   
	$sql2="select * from services where prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by name";
	$i=0;
	// echo $sql2;
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		// Attention ici on prends le code service comme clef et non pas l'id vue que la recherche se fait par le contractor et que le code service est injecté dans les fichiers d'échanges
		$tbl_service[$row2['code_service']] = $row2['code_service'] . ":" . $row2['name'];
	}

	// Rècupère les printshops 
	$sqlP="select * from printshop order by name";
	$retourP=mysqli_query($con,$sqlP); 
	while($rowP=mysqli_fetch_array($retourP))
	{	
			$tbl_printshop[$rowP['id']] = $rowP['name'];
					
	}
	$sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $_SESSION['prefix_contractor'] . "_orders' UNION SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'users_adresses';";
	$retour=mysqli_query($con,$sql); 
	while($row=mysqli_fetch_array($retour))
	{
		
		$TBL_fields[$i]=$row['COLUMN_NAME'];
		$i++;
	}
	// print_r($TBL_fields);
	
	// Vérifier si la donnée "selected_service" a été reçue
    if (isset($_POST['dateFrom'])&&isset($_POST['dateTo'])) 
    {
        // Récupérer la valeur "selected_service" depuis la requête POST
        $dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];	
        
    }
    else {
        echo 'Error Date value . <br/>';
    }
	$date=date("YmdHis");
	
	$filename="../exports/" . $_SESSION['prefix_contractor'] ."/" . $_SESSION['prefix_contractor'] . "_" . $date . ".csv";
	$fileDownload="../exports/" . $_SESSION['prefix_contractor'] ."/" . $_SESSION['prefix_contractor'] . "_" . $date . ".csv";
	// Création du filename export
	$fp=fopen($filename,"w");
	//$dateSelected = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
	$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders WHERE DATE(date_integration) >= '".$dateFrom."' AND DATE(date_integration) <= '".$dateTo."' order by num_of asc,type_label desc, id desc";
	//$sql = "SELECT * FROM " . $_SESSION['prefix_contractor'] . "_orders WHERE DATE(date_integration) >= '$dateSelected' ORDER BY num_of ASC, type_label DESC, id DESC";

	$retour=mysqli_query($con,$sql);
	// Totalisation par Type de label
	//echo $sql;
	$firstLine=true;
if ($fp) 
{
    
	while($row=mysqli_fetch_array($retour))
	{
		$ligne="";
		$lineHead="";
		foreach($TBL_fields as $key=>$value)
		{
			switch($value)
			{
				case "num_of":
					$lineHead.="NUM OF;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;	
				case "reference":
					$lineHead.="REFERENCE;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "type_label":
					$lineHead.="TYPE LABEL;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				
				case "coloris" :
					$lineHead.="COLOR;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "size":
					$lineHead.="SIZE;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "product_name":									
						$lineHead.="PRODUCT NAME;";	

						if($row["$value"])
					    {
                            $chaine=str_replace(";","",$row["$value"]); // Elimine les ;
                            $chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
                            $chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
                        }										
                        else{
                            $chaine=" ";
                        }						
						$chaine.=";";
						$ligne.=$chaine;
						break;
				case "genre":									
					$lineHead.="GENRE;";	
                    if($row["$value"])
					{
						$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}										
					else{
						$chaine=" ";
					}	
					$chaine.=";";
					$ligne.=$chaine;
					break;
									
				case "code_supplier":
					$lineHead.="CODE SUPPLIER;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					//Afficher le company name
					$sqlS="select * from  users_adresses  where `contractor`='" . $_SESSION['prefix_contractor_id'] . "' and  code_supplier='" . $row['code_supplier']. "' limit 1";
					$retourS=mysqli_query($con,$sqlS);
					$rowS=mysqli_fetch_object($retourS);
				$lineHead.="SUPPLIER;";
					if($rowS){
						$chaine=str_replace(";","",$rowS->company_name); // Elimine les ;
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}
					else{
						$chaine=" ";
					}
					
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "id_printshop":
					$lineHead.="PRINTSHOP;";
					
					$chaine=str_replace(";","",$tbl_printshop[$row['id_printshop']]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				
				case "made_in":
					$lineHead.="MADE IN;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				
				case "qty_init":
					$lineHead.="INITIAL QTY;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "qty_to_produce":
					$lineHead.="QTY TO PRODUCE;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					// Exception MMG
					if($_SESSION['prefix_contractor']=="mmg")
					{
						$batsNumber = 1;
						if($row['type_label']=="CARE_LABEL")
						{
						
						$row['size']=str_replace("/",".",$row['size']);
						//
						$fullNameBAT=$row['num_of'] . "\_" . $row['reference'] . "\_" . $row['coloris'] . "\_" . $row['code_ean'] . "\_" . $row['size'] . "\_CARE LABEL\_" ;
						
						// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
						$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
						// Recherche la dernière version validées
						$sqlB="select count(*) as batsNumber from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc";
						
						$retourB=mysqli_query($con,$sqlB);
						$rowB = mysqli_fetch_object($retourB);
						$batsNumber=$rowB->batsNumber;					
						}
						$qty = $row["$value"]*$batsNumber;
						$chaine=str_replace(";","",$qty); // Elimine les ;
					} // Fin MMG
					else{
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}	
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "date_integration":
					$lineHead.="INTEGRATION DATE;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "status":
					$lineHead.="STATUS;";
					$chaine=str_replace(";","",$status[$row["$value"]]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "status_composition":
					$lineHead.="STATUS COMPOSITION;";
					if($row["$value"])
					{
						$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}										
					else{
						$chaine=" ";
					}
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "code_service":
					$lineHead.="CODE SERVICE;";
					if($row["$value"])
					{
						$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}										
					else{
						$chaine=" ";
					}
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "date_production":					
					$lineHead.="PRODUCTION DATE;";
					if($row["$value"])
					{
						$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}										
					else{
						$chaine=" ";
					}				
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "date_quality":
					$lineHead.="QUALITY CONTROL DATE;";
					if($row["$value"])
					{
						$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
						$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
						$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					}										
					else{
						$chaine=" ";
					}
					$chaine.=";";
					$ligne.=$chaine;
					break;
					
				case "date_delivery":
					
					$lineHead.="DELIVERY DATE;";
					if($row["$value"])
					{
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed	
					}
					else{
						$chaine=" ";
					}				
					$chaine.=";";
					$ligne.=$chaine;
					break;
					
				case "tracking":					
					$lineHead.="TRACKING NUMBER;";
					if($row["$value"])
					{
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed	
					}
					else{
						$chaine=" ";
					}
					$chaine.=";";					
					$ligne.=$chaine;
					break;
				case "saison":	
					$lineHead.="SEASON;";	
                    if($row["$value"])
					{
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed	
					}
					else{
						$chaine=" ";
					}
					$chaine.=";";				
					$ligne.=$chaine;
					break;
					
				case "cup":
					$lineHead.="CUP;";
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed
					$chaine.=";";
					$ligne.=$chaine;
					break;
				case "comment_contractor":					
					$lineHead.="COMMENT CONTRACTOR;";
					if($row["$value"])
					{
					$chaine=str_replace(";","",$row["$value"]); // Elimine les ;
					$chaine=str_replace("\r","_",$chaine); // Elimine les retour chariots
					$chaine=str_replace("\r","_",$chaine); // Elimine les linefeed	
					}
					else{
						$chaine=" ";
					}
					$chaine.=";";					
					$ligne.=$chaine;
					break;							
			}
			
		}
		
		if($firstLine==true)
		{
			fwrite($fp,$lineHead . "\r\n");
			$firstLine=false;
		}
		fwrite($fp,$ligne . "\r\n");
		$ligne="";
	}
	fclose($fp);
	// Création du lien de téléchargement
    echo "<a href='$fileDownload' download='$fileDownload' class='export-btn'>Export File</a>";
	
	exit;
	}
	else 
	{
		// Error opening the file
		echo "Failed to open or create the file.";
	}
	
?>