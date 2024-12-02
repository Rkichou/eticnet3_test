<?php
	ini_set('memory_limit', '256M'); // Increase to 256MB, or another value

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	session_start();
	
	//LA013
	$dir = "/home/eticnet/www/chloe_transfert/";
	
	
	require_once("../config.inc.php");
	require_once("../vendor/autoload.php"); 

	use PhpOffice\PhpSpreadsheet\Spreadsheet;	
	use PhpOffice\PhpSpreadsheet\IOFactory;
	
	
	// Open a directory, and read its contents
	$i=0;
	if (is_dir($dir))
	{
		
		if ($dh = opendir($dir))
		{
			while (($file = readdir($dh)) !== false)
			{
				echo "Detected file :" . $file . "<br>";
				if($file!="." && $file!=".." && $file!="index.php" )
				{
					$tblFile[$i]=$file;
					$i++;
				}
			}		
			closedir($dh);
		}
	}
	// Définition nom des étiquettes
	$ETQ[0]="BAR_CODE_LABEL_50X50_STICKER";
	$ETQ[1]="BAR_CODE_LABEL_40X40_STICKER";
	$ETQ[2]="BAR_CODE_LABEL_40X80_STICKER";
	$ETQ[3]="CARE_LABEL_35X87_SATIN";
	$ETQ[4]="CARE_LABEL_35X47_SATIN";
	$ETQ[5]="COMPOSITION_LABEL_50X50_STICKER";
	$ETQ[6]="COMPOSITION_LABEL_40X40_STICKER";
	$ETQ[7]="CARE_LABEL_27X20_SATIN";
	$ETQ[8]="EMBROIDERED_LABEL_42X15_PLIEE";
	$ETQ[9]="DIGITAL_ID";
	
	$ETQ_REF[0]="BCLSTK_50X50";
	$ETQ_REF[1]="BCLSTK_40X40";
	$ETQ_REF[2]="BCLSTK__40X80";
	$ETQ_REF[3]="CLS_35X87";
	$ETQ_REF[4]="CLS_35X47";
	$ETQ_REF[5]="CLSTK_50X50";
	$ETQ_REF[6]="CLSTK_40X40";
	$ETQ_REF[7]="CLS_27X20";
	$ETQ_REF[8]="ELP_42X15";
	$ETQ_REF[9]="DGTL_ID";

	$ETQ_TYPE[0]="BCLSTK_50X50";
	$ETQ_TYPE[1]="BCLSTK_40X40";
	$ETQ_TYPE[2]="BCLSTK__40X80";
	$ETQ_TYPE[3]="CLS_35X87";
	$ETQ_TYPE[4]="CLS_35X47";
	$ETQ_TYPE[5]="CLSTK_50X50";
	$ETQ_TYPE[6]="CLSTK_40X40";
	$ETQ_TYPE[7]="CLS_27X20";
	$ETQ_TYPE[8]="ELP_42X15";
	$ETQ_TYPE[9]="DGTL_ID";


	// Définition des règles étiquettes
	$MC['CH0101001']['all']['all']="RTW Chloé||2|||1||||||";
	$MC['CH0102001']['all']['all']="Fashion Acc Ot Chloé|||1|1||||1|||";
	$MC['CH0102001']['HA']['all']="Fashion Acc Textile Chloé|Hats||2|||1||||1|";
	$MC['CH0102001']['MG']['all']="Fashion Acc Textile Chloé|Gloves||2|||1||||1|";
	$MC['CH0102001']['CU']['all']="Fashion Acc Textile Chloé|Stockings||2|||1||||1|";
	$MC['CH0102001']['BL']['all']="Fashion Acc Textile Chloé|Blanket||2|||1||||1|";
	$MC['CH0102002']['all']['all']="Bags Chloé||2|||||1||||";
	$MC['CH0102002']['all']['X']="Bags Chloé Textile||2|||||||1||";
	$MC['CH0102003']['all']['all']="SLG  Chloé|||1|1||||1|||";
	$MC['CH0102003']['all']['X']="SLG  Chloé Textile|||1|1|||||1||";
	$MC['CH0102004']['all']['all']="Belts Chloé|||1|1||||1|||";
	$MC['CH0102004']['all']['X']="Belts Chloé|||1|1|||||1||";
	$MC['CH0102005']['all']['all']="Scarves Chloé|||2|||1||||1|";
	$MC['CH0102006']['all']['all']="Keyrings Chloé|||1|1||||1|||";
	$MC['CH0103001']['all']['all']="Fashion Jew Chloé|||1|1||||1|||";
	$MC['CH0107001']['all']['all']="Shoes Chloé||||1|||||||1";
	$MC['CH0301001']['all']['all']="Display Mat Chloé (POSM)||1|||||||||";
	$MC['CH0301002']['all']['all']="Printed Mat Chloé (POSM)||1|||||||||";
	$MC['CH0301005']['all']['all']="Sale Accessory Chloé (POSM)||1|||||||||";
	$MC['CH0301006']['all']['all']="Sales Consumable Chloé (POSM)||1|||||1||||";
	$MC['CH0501001']['all']['all']="CASS Chloé (Spare parts)||1|||||||||";
	$MC['CH1300001']['all']['all']="Trims (Spare parts)||1|||||||||";
	$MC['CH0301009']['BD']['all']="Uniforms Chloé|RTW - BODYSUIT|2|||1||||||";
	$MC['CH0301009']['BW']['all']="Uniforms Chloé|RTW - BEACHWEAR|2|||1||||||";
	$MC['CH0301009']['CB']['all']="Uniforms Chloé|RTW - JUMPSUIT|2|||1||||||";
	$MC['CH0301009']['CP']['all']="Uniforms Chloé|RTW - CAPE|2|||1||||||";
	$MC['CH0301009']['EB']['all']="Uniforms Chloé|RTW - OUTFIT|2|||1||||||";
	$MC['CH0301009']['GI']['all']="Uniforms Chloé|RTW - WAISTCOAT|2|||1||||||";
	$MC['CH0301009']['HT']['all']="Uniforms Chloé|RTW - TOP|2|||1||||||";
	$MC['CH0301009']['JU']['all']="Uniforms Chloé|RTW - SKIRT|2|||1||||||";
	$MC['CH0301009']['MA']['all']="Uniforms Chloé|RTW - COAT|2|||1||||||";
	$MC['CH0301009']['MB']['all']="Uniforms Chloé|RTW - SWIMSUIT|2|||1||||||";
	$MC['CH0301009']['MC']['all']="Uniforms Chloé|RTW - CARDIGAN|2|||1||||||";
	$MC['CH0301009']['MP']['all']="Uniforms Chloé|RTW - PULLOVER|2|||1||||||";
	$MC['CH0301009']['PA']['all']="Uniforms Chloé|RTW - TROUSERS|2|||1||||||";
	$MC['CH0301009']['RO']['all']="Uniforms Chloé|RTW - DRESS|2|||1||||||";
	$MC['CH0301009']['SH']['all']="Uniforms Chloé|RTW - SHORT|2|||1||||||";
	$MC['CH0301009']['SL']['all']="Uniforms Chloé|RTW - OVERALL|2|||1||||||";
	$MC['CH0301009']['TS']['all']="Uniforms Chloé|RTW - TEE SHIRT|2|||1||||||";
	$MC['CH0301009']['UW']['all']="Uniforms Chloé|RTW - UNDERWEAR|2|||1||||||";
	$MC['CH0301009']['VE']['all']="Uniforms Chloé|RTW - JACKET|2|||1||||||";
	$MC['CH0301009']['EC']['all']="Uniforms Chloé|Scarves|2||||1|||||";
	$MC['CH0301009']['BE']['all']="Uniforms Chloé|Shoes - BALLERINAS|||1|||||||";
	$MC['CH0301009']['BH']['all']="Uniforms Chloé|Shoes - BOOTS|||1|||||||";
	$MC['CH0301009']['BI']['all']="Uniforms Chloé|Shoes - ANKLE BOOTS|||1|||||||";
	$MC['CH0301009']['BK']['all']="Uniforms Chloé|Shoes - SNEAKERS|||1|||||||";
	$MC['CH0301009']['BO']['all']="Uniforms Chloé|Shoes - SHORT BOOTS|||1|||||||";
	$MC['CH0301009']['CG']['all']="Uniforms Chloé|Shoes - CLOGS|||1|||||||";
	$MC['CH0301009']['CI']['all']="Uniforms Chloé|Shoes - OVER THE KNEE BOOTS|||1|||||||";
	$MC['CH0301009']['ED']['all']="Uniforms Chloé|Shoes - ESPADRILLES|||1|||||||";
	$MC['CH0301009']['ES']['all']="Uniforms Chloé|Shoes - PUMPS|||1|||||||";
	$MC['CH0301009']['FL']['all']="Uniforms Chloé|Shoes - FLATS|||1|||||||";
	$MC['CH0301009']['FS']['all']="Uniforms Chloé|Shoes - FLAT SANDALS|||1|||||||";
	$MC['CH0301009']['ME']['all']="Uniforms Chloé|Shoes - MULES|||1|||||||";
	$MC['CH0301009']['SD']['all']="Uniforms Chloé|Shoes - SANDALS|||1|||||||";
	$MC['CH0301009']['SI']['all']="Uniforms Chloé|Shoes - SLIDES|||1|||||||";
	$MC['CH0301009']['CU']['all']="Uniforms Chloé|Access Textile - STOCKINGS||2|||1|||||";
	$MC['CH0301009']['HA']['all']="Uniforms Chloé|Access Textile - HAT||2|||1||||1|";
	$MC['CH0301009']['HB']['all']="Uniforms Chloé|Access Textile - HEADBAND||2|||1||||1|";
	$MC['CH0301009']['MG']['all']="Uniforms Chloé|Access Textile - GLOVES||2|||1||||1|";
	$MC['CH0301009']['CE']['all']="Uniforms Chloé|BELT||1|1|||||||";
	$MC['CH0301009']['DK']['all']="Uniforms Chloé|Keyrings - DOLL KEY RING||1|1|||||||";
	$MC['CH0301009']['GP']['all']="Uniforms Chloé|Access - PHONE GOODIES||1|1|||||||";
	$MC['CH0301009']['HC']['all']="Uniforms Chloé|Access - HAIR ACCESSORIES||1|1|||||||";
	$MC['CH0301009']['IS']['all']="Uniforms Chloé|Access - IPAD CASE||1|1|||||||";
	$MC['CH0301009']['KH']['all']="Uniforms Chloé|Keyrings - KEY HOLDER||1|1|||||||";
	$MC['CH0301009']['OT']['all']="Uniforms Chloé|Access - OTHER ACCESSORIE||1|1|||||||";
	$MC['CH0301009']['PC']['all']="Uniforms Chloé|Keyrings - KEY RING||1|1|||||||";
	$MC['CH0301009']['PS']['all']="Uniforms Chloé|Access - PHONE CASE||1|1|||||||";
	$MC['CH0301009']['ST']['all']="Uniforms Chloé|Access - STRAP||1|1|||||||";
	$MC['CH0301009']['TB']['all']="Uniforms Chloé|Access - TRINKET BOWL||1|1|||||||";
	$MC['CH0301009']['BL']['all']="Uniforms Chloé|Access Textile - BLANKET||1|1||1|||||";
	$MC['CH0301009']['TW']['all']="Uniforms Chloé|Access - TABLEWARE||1|1||1|||||";
	$MC['CH0301009']['CT']['all']="Uniforms Chloé|Access - CANDLE STICK ||1|1||||1|||";
	$MC['CH0301009']['BA']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['BC']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['BJ']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['BR']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['CM']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['CN']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['CO']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['OJ']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['OR']['all']="Uniforms Chloé|Fashion Jew - Jewerlery ||1|1|||||||";
	$MC['CH0301009']['BN']['all']="Uniforms Chloé|Small LT Goods - BELT BAG||1|1||||1|||";
	$MC['CH0301009']['BN']['X']="Uniforms Chloé|Small LT Goods - BELT BAG||||||||1||";
	$MC['CH0301009']['FP']['all']="Uniforms Chloé|Small LT Goods - FLAT POUCH||1|1||||1|||";
	$MC['CH0301009']['FP']['X']="Uniforms Chloé|Small LT Goods - FLAT POUCH||||||||1||";
	$MC['CH0301009']['HP']['all']="Uniforms Chloé|Small LT Goods - PASS HOLDER||1|1||||1|||";
	$MC['CH0301009']['HP']['X']="Uniforms Chloé|Small LT Goods - PASS HOLDER||||||||1||";
	$MC['CH0301009']['PE']['all']="Uniforms Chloé|Small LT Goods - SHOULDER BAG||1|1||||1|||";
	$MC['CH0301009']['PE']['X']="Uniforms Chloé|Small LT Goods - SHOULDER BAG||||||||1||";
	$MC['CH0301009']['PH']['all']="Uniforms Chloé|Small LT Goods - CLUTCHES & EVENING BAG||1|1||||1|||";
	$MC['CH0301009']['PH']['X']="Uniforms Chloé|Small LT Goods - CLUTCHES & EVENING BAG||||||||1||";
	$MC['CH0301009']['PM']['all']="Uniforms Chloé|Bags - HANDBAG|2|||||1||||";
	$MC['CH0301009']['PM']['X']="Uniforms Chloé|Bags - HANDBAG||||||||1||";
	$MC['CH0301009']['PN']['all']="Uniforms Chloé|Small LT Goods - COIN PURSE||1|1||||1|||";
	$MC['CH0301009']['PN']['X']="Uniforms Chloé|Small LT Goods - COIN PURSE||1|1|||||1||";
	$MC['CH0301009']['PQ']['all']="Uniforms Chloé|Small LT Goods - COMPACT WALLET||1|1||||1|||";
	$MC['CH0301009']['PQ']['X']="Uniforms Chloé|Small LT Goods - COMPACT WALLET||1|1|||||1||";
	$MC['CH0301009']['PR']['all']="Uniforms Chloé|Small LT Goods - LONG WALLET WITH FLAP||1|1||||1|||";
	$MC['CH0301009']['PR']['X']="Uniforms Chloé|Small LT Goods - LONG WALLET WITH FLAP||1|1|||||1||";
	$MC['CH0301009']['PT']['all']="Uniforms Chloé|Small LT Goods - CARD HOLDER||1|1||||1|||";
	$MC['CH0301009']['PT']['X']="Uniforms Chloé|Small LT Goods - CARD HOLDER||1|1|||||1||";
	$MC['CH0301009']['PZ']['all']="Uniforms Chloé|Small LT Goods - LONG ZIPPED WALLET||1|1||||1|||";
	$MC['CH0301009']['PZ']['X']="Uniforms Chloé|Small LT Goods - LONG ZIPPED WALLET||1|1|||||1||";
	$MC['CH0301009']['SM']['all']="Uniforms Chloé|Small LT Goods - MINI BAG||1|1||||1|||";
	$MC['CH0301009']['SM']['X']="Uniforms Chloé|Small LT Goods - MINI BAG||1|1|||||1||";
	$MC['CH0301009']['SO']['all']="Uniforms Chloé|Bags - BACKPACK BAG|2|||||1||||";
	$MC['CH0301009']['SO']['X']="Uniforms Chloé|Bags - BACKPACK BAG|2|||||||1||";
	$MC['CH0301009']['SP']['all']="Uniforms Chloé|Bags - TOTE BAG|2|||||1||||";
	$MC['CH0301009']['SP']['X']="Uniforms Chloé|Bags - TOTE BAG|2|||||||1||";
	$MC['CH0301009']['SV']['all']="Uniforms Chloé|Bags - TRAVEL BAG|2|||||1||||";
	$MC['CH0301009']['SV']['X']="Uniforms Chloé|Bags - TRAVEL BAG|2|||||||1||";
	$MC['CH0301009']['SW']['all']="Uniforms Chloé|Small LT Goods - SQUARE WALLET||1|1||||1|||";
	$MC['CH0301009']['SW']['X']="Uniforms Chloé|Small LT Goods - SQUARE WALLET||1|1|||||1||";

	////////////////////////////////////////////////////////////////////
	$c=0;
	$f=0;
	foreach($tblFile as $key=>$value)
	{
		echo "Version 1.00 Reading : " . $value . "<br/>";
		// Fichier déjà traité ?
		$sql="select * from chloe_orders where file_name='" . $value . "'";
		$retour=mysqli_query($con,$sql); 
		$nbIntegrate=mysqli_num_rows($retour);
		
		//echo $c . " File count on DB : " . $nbIntegrate . "<br/>";
		
		if($nbIntegrate>0)
		{
			echo $c . " File : " . $value . " already integrated.<br/>";
		}
		else
		{
			echo $c . " Start integration file : " . $value . "<br/>";
			$chunkSize = 100 * 1024 * 1024; // 100 MB in bytes
			$fp = null;
			$fp=fopen($dir . $value,"r");
			$d = 0;
			if($fp)
			{
				while (!feof($fp)) 
				{
					$fileDatas = fgets($fp, $chunkSize); // lecture du contenu de la ligne
					$lignes = explode("\r", $fileDatas); //Must be single quote, double quote are for real line return	
					// echo $fileDatas;
					$lig=0;
					foreach ($lignes as $ligne)
					{
						$c++;
						$lig++;
						// if($lig>1)
						{
							// echo "<hr/>". $c . " Original Line " . $c . " is : " . $ligne . " MEMORY : " . memory_get_usage() . "<br/>";
							// $ligne = ltrim($ligne);
							// $ligne = ltrim($ligne, "\r\n");
							// $ligne = ltrim($ligne, "\n");
							$ligne = ltrim($ligne);
							$ligne = trim($ligne, '"'); //remove quotes
							if($ligne == "")
							{
								break;
							}
							
							// Process each line
							// echo "<hr/>". $c . " Edited Line " . $c . " is : " . $ligne . "<br/>";
							
							$tbl=explode("|",$ligne);
							
							// echo $c . " Testing first value : '" . $tbl[0] . "' of file : " . $value ."<br/>";
							// die();
							// echo "<hr/>";
							// print_r($tbl);
							// echo "<hr/>";
								// echo $c . " '" . $tbl[0] . "' is different than : 'LAB_NAME'<br/>";
								
								$data_customer=$ligne;
								$no_data_customer=$value;
								$num_of="";
								$saison="";
								$code_supplier="";
								$reference="";
								$coloris="";
								$size="";
								$cup="";
								$made_in="";
								$code_ean="";
								$qty_init=0;
								$qty_to_product=0;
								$qty_product=0;
								$status="New";
								$adresse_faconnier="";
								$product_name="";

								$data_customer.=$ligne;
								$num_of = trim(trim($tbl[25]));
							
								echo $c . " OF '" . $num_of . "' en cours d'intégration.<br/>";
								//echo "<hr/>";
								$adresse_faconnier.= trim($tbl[4]) . "<br/>";
								$saison=trim($tbl[26]);
								$code_supplier=trim($tbl[6]);
								$reference=trim($tbl[5]);
								$coloris=trim($tbl[7]);
								$size=trim($tbl[28]);					
								$qty_init=(float)trim($tbl[4]);
								$qty_to_produce=((float)($tbl[4])*1.1);
								$made_in="FRANCE";
								$code_ean=trim($tbl[16]);
								$product_name=trim($tbl[18]);
								
								// Recherche si le produit est connu 
								// On recherche en 1er les exceptions
								// 253=IT 20=U 21=V
								$clef="";
								$cas=0;
								$clefCTRL="";
								if(isset($MC[trim($tbl[253])][trim($tbl[20])][trim($tbl[21])]))
								{
									// On recherche la clef exacte
									$clef=$MC[trim($tbl[253])][trim($tbl[20])][trim($tbl[21])];
									$clefCTRL=trim($tbl[253]) . ":" .trim($tbl[20]) .":" . trim($tbl[21]);
									$cas=1;
								}
								if($clef=="")
								{
									// On cherche avec 'all' dans le 1er paramètre 
									if(isset($MC[trim($tbl[253])]['all'][trim($tbl[21])]))
									{
										$clef=$MC[trim($tbl[253])]['all'][trim($tbl[21])];
										$clefCTRL=trim($tbl[253]) . ":" . 'all' . ":" . trim($tbl[21]);
										$cas=2;
									}
								}
								if($clef=="")
								{
									// On cherche avec 'all' dans le 2ème paramètre 
									if(isset($MC[trim($tbl[253])][trim($tbl[20])]['all']))
									{
										$clef=$MC[trim($tbl[253])][trim($tbl[20])]['all'];
										$clefCTRL=trim($tbl[253]) . ":" .trim($tbl[20]) . ":" . 'all';
										$cas=3;
									}
								}
								if($clef=="")
								{
									// On cherche avec 'all' dans les 2 paramètres 
									if(isset($MC[trim($tbl[253])]['all']['all']))
									{
										$clef=$MC[trim($tbl[253])]['all']['all'];
										$clefCTRL=trim($tbl[253]) . ":" . 'all' . ":" . 'all';
										$cas=4;
									}
								}
								if($clef>"")
								{
									echo "<b>Clef : $clefCTRL : $clef : $cas</b><br/>";
									// rècupère le type de modeles étiquettes
									$tbl=explode("|",$clef);
									// print_r($tbl);
									for($etq=2;$etq<=11;$etq++)
									{
										if($tbl[$etq]>0)
										{
											echo "Num " . $etq . "<br/>";
											echo "<br/><u>ETQ : " . $ETQ[$etq-2] . "</u><br/>";
											$sql="INSERT INTO `chloe_orders` (`id`, `date_integration`,`num_of`, `code_supplier`, `reference_support`, `type_label`, `reference`, `coloris`, `size`, `cup`, `made_in`, `code_ean`, `qty_init`, `qty_to_produce`,";
											$sql.=" `status`, `validation_supplier`, `date_validation_supplier`,`reference_bat`, `id_printshop`, `saison`,`file_name`,`product_name`,`customer_datas`) ";
											$sql.="VALUES (NULL,";
											$sql.="'" . date('Y-m-d H:i:s'). "',";
											$sql.="'" . $num_of. "',";
											$sql.="'" . $code_supplier. "',";
											$sql.="'" . $ETQ_REF[$etq-2] . "',";
											$sql.="'" . $ETQ[$etq-2] . "',";
											$sql.="'" . $reference. "',";
											$sql.="'" . $coloris. "',";
											$sql.="'" . $size. "',";
											$sql.="'" . $cup. "',";
											$sql.="'" . $made_in. "',";
											$sql.="'" . $code_ean. "',";
											$sql.="'" . ($qty_init * $tbl[$etq]). "',";
											$sql.="'" . ($qty_to_produce * $tbl[$etq]). "',";
											$sql.="'" . 1 . "',";
											$sql.="'" . 1 . "',";
											$sql.="'" . date('Y-m-d H:i:s'). "',";
											$sql.="'" . $ETQ_TYPE[$etq-2] . "_" . $reference . "_" . $size . "',";
											$sql.="'" . 2 . "',";
											$sql.="'" . $saison . "',";
											$sql.="'" . $value . "',";
											$sql.="'" . $product_name . "',";
											$sql.="'" . $data_customer . "');"; // Fichier trop long on ne le stock pas (filename à la place).
											$retour=mysqli_query($con,$sql);
											echo $sql . "<br/>";
											// die();
										}
										// die();
										// die();
									}
								}		
		
									// Création du supplier
									echo "<hr/>";
									echo "LIGNE INTEGREE<hr/>";
						}
					} // Fin second While
				}// Fin lecture fichier
							
			} // Fin fichier correctement ouvert
		} // Fin test fichier intégré
		// die();
	} // Fin For each