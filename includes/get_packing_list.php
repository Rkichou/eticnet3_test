<?php 
		session_start();
		require_once("../config.inc.php");
		require_once("../languages.inc.php");
		// Controle si une session est active
		// Si non active on stop le script
		require_once("./is_session_active.php");
		
		
		$prefix_contractor=$_SESSION['prefix_contractor'];
		//Rècupère l'id contractor pour la selection des adresses façonniers
		$sql2="select * from `contractors` where `prefix`='" . $_SESSION['prefix_contractor']. "' limit 1";
		$retour2=mysqli_query($con,$sql2); 
		$row2=mysqli_fetch_object($retour2);
		$idConctractor=$row2->id;
		$conctractor=$row2->name;
		// Rècupère les services en fonction du contractor
		$sql2="select * from services where prefix_contractor='" . $prefix_contractor. "' order by name";
		$retour2=mysqli_query($con,$sql2); 
		while($row2=mysqli_fetch_array($retour2))
		{
			$tbl_service[$row2['code_service']] = $row2['name'];
			
		}

		////////////////////////////////////////////////////////////////////
		if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
		{
			$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and `reference`='" . $_GET['reference'] . "' and status>=4 and status<=7 order by type_label";
		}
		else{
			$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and status>=4  and status<=7 order by type_label"; 

		}
		$retour=mysqli_query($con,$sql);
		$row=mysqli_fetch_object($retour);
		// Nom du fichier PDF
		
		$num_of=str_replace('_','-',$row->num_of);
		if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
		{
			$filename = dirname(__DIR__) . "../documents/"  . $prefix_contractor . "/packing_list/packlst_".  $row->tracking. "_" . $num_of . "_" . $row->reference  .  "_" . date('Y-m-d').".pdf";
		}
		else{
			$filename = dirname(__DIR__) . "../documents/"  . $prefix_contractor . "/packing_list/packlst_".  $row->tracking . "_" . $num_of .  "_" . date('Y-m-d') . ".pdf";
		}
		// 		
		$marge = "5mm";				
		$chaine="<page backtop=30mm backbottom=15mm backleft=5mm backright=5mm>";
		$chaineLogo=$chaineDate="";$chaine2="";$chaineFooter="";
		$bottom=0;
		$chaineFooter.="<page_footer> ";
          //FOOTER	
			$chaineFooter.="<table style='width:100%;'>";
			$chaineFooter.="<tr><td style='text-align:left;width:50%;'><img src='../images/myeticnet.png' style='height:18px'></td>";

			$chaineFooter.="<td style='text-align:right;width:50%;'><span style='Font-weight:400'>[[page_cu]]/[[page_nb]]</span></td>";

			$chaineFooter.="</tr></table>";
			$chaineFooter.="</page_footer>";
			$chaine.=$chaineFooter;
		
			//LOGOS
			$chaine.="<page_header> ";
			$chaineLogo.="<table style='position: relative;width:95%;left:5mm;height:15mm;'>";
			$chaineLogo.="<tr><td style='width:62mm;height:15mm;text-align:left'><img src='../images/etic_europe.png' style='height:30px'></td>";
		
			$chaineLogo.="<td style='width:62mm;height:15mm;text-align:center'><h2 style='Font-weight:400'>Packing list</h2></td>";
			$chaineLogo.="<td style='width:62mm;height:15mm;text-align:right'><img src='../images/logos_clients/" . $prefix_contractor . ".png' style='height:30px'></td>";
		$chaineLogo.="</tr></table>";
		$bottom+=10;
		$chaine.=$chaineLogo;	
			//DATE + OF
		$chaineDate.="<table style='position: relative;width:95%;left:5mm;height:10mm;'>";
			$chaineDate.="<tr><td style='width:50%;height:10mm;'>";
				$chaineDate.="<span style='font-size:20px;'>Date : " . date('d/m/Y')  ."</span >"; 
			$chaineDate.="</td>";
			$chaineDate.="<td style='width:50%;height:10mm;'>";
				$chaineDate.="<span style='font-size:20px;'>Contractor : " . strtoupper($conctractor) .  "</span >  ";
			$chaineDate.="</td></tr>";
		$chaineDate.="</table>";
		$chaine.=$chaineDate;
		//$chaine.="<br/><br/>";
		$chaine.="</page_header>";
		$bottom+=15;
		
		$chaine.="<table style='position: relative;width:100%; border-collapse: collapse;'>";	
			$chaine.="<tr style='font-size:15px;left:5mm;'>";
			$chaine.="<td style='height:8mm;width:50%;'><b>Supplier </b></td>  ";
			
			$chaine.="<td style='height:8mm;width:50%;'><b>Delivery adress</b></td>";
			$chaine.="</tr>";
		$chaine.="</table>";
			
			
			$bottom+=15;
		
			$chaine.="<table style='width:100%;position:relative;font-size:12px;'>";

			// Adresse livraison faconnier
			// Sauf si le façonnier a choisi une autre adresse de livraison
			if($row->other_delivery_adress)
			{
				$tbl_adresse=explode("\r\n" ,$row->other_delivery_adress);
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Supplier: " . $tbl_adresse[0] . "</td>";
					$chaine.="<td style='width:50%;'>Adress: " . $tbl_adresse[1] . "</td>";
					$chaine.="</tr>";
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Contact: " . $tbl_adresse[8] . "</td>";					
					$chaine.="<td style='width:50%;'>Adress 2: " . $tbl_adresse[2]. "</td>";
					$chaine.="</tr>";
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Email: " . $tbl_adresse[10] . "</td>";					
					$chaine.="<td style='width:50%;'>Zip: " . $tbl_adresse[4] . " </td>";
					$chaine.="</tr>";
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Phone: " . $tbl_adresse[9] . "</td>";
					
					$chaine.="<td style='width:50%;'>City: " . $tbl_adresse[6] . "</td>";
					$chaine.="</tr>";
					$chaine.="<tr><td style='height:3mm;width:50%;'></td>";
					$chaine.="<td style='width:50%;'>Country: " . $tbl_adresse[7] . "</td>";
					$chaine.="</tr>";						
			}
			else
			{

			$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row->code_supplier . "' limit 1";
			$retourS=mysqli_query($con,$sqlS);
			$rowS=mysqli_fetch_object($retourS);

			$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Supplier: " . $rowS->company_name . "</td>";
					$chaine.="<td style='width:50%;'>Adress: " . $rowS->adresse_1 . "</td>";
					$chaine.="</tr>";
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Contact: " . $rowS->contact . "</td>";					
					$chaine.="<td style='width:50%;'>Adress 2: " . $rowS->adresse_2. "</td>";
					$chaine.="</tr>";
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Email: " . $rowS->email . "</td>";					
					$chaine.="<td>Zip: " . $rowS->zip . " </td>";
					$chaine.="</tr>";
					$chaine.="<tr>";
					$chaine.="<td style='height:3mm;width:50%;'>Phone: " . $rowS->telephone . "</td>";
					
					$chaine.="<td>City: " . $rowS->city . "</td>";
					$chaine.="</tr>";
					$chaine.="<tr><td style='height:3mm;width:50%;'></td>";
					$chaine.="<td>Country: " . $rowS->country . "</td>";
					$chaine.="</tr>";	
			}
			$chaine.="</table>";
			$bottom+=15;
			$chaine.="<br/>";
			
			$chaine.="<table style='position: relative;width:100%;border: solid 1px #000; border-radius: 5px; top:5mm;'>";	
			$chaine.="<tr>";
			
			if($prefix_contractor=="dior")
			{
				$chaine.="<td style='width:34%;height:10mm;text-align:center;font-size:15px;'>";
				$chaine.="P.O : <b>" . $row->num_of . "</b>";
				$chaine.="</td>";
				$chaine.="<td style='width:33%;text-align:center;height:10mm;font-size:15px;'>";
				$chaine.="Article Code : <b>" . $row->reference . "</b>";
				$chaine.="</td>";
				$chaine.="<td style='width:33%;text-align:center;height:10mm;font-size:15px;'>";
				$service= $tbl_service[$row->code_service];
				$chaine.="Service : <b>" .$service . "</b>";
				$chaine.="</td>";
			}
			else{
				$chaine.="<td style='width:50%;height:10mm;text-align:center;font-size:15px;'>";
				$chaine.="P.O : <b>" . $row->num_of . "</b>";
				$chaine.="</td>";
				$chaine.="<td style='width:50%;text-align:center;height:10mm;font-size:15px;'>";
				$chaine.="Article Code : <b>" . $row->reference . "</b>";
				$chaine.="</td>";
			}
			$bottom+=5;
			
			$bottom+=10;
			$chaine.="</tr></table>";
			
			//TABLEAU PRODUCT ORDER
			$chaine2.="<table style='position: relative;width:100%;border: solid 1px #000; border-radius: 5px; top:7mm;text-align:center;'>";
			$chaine2.="<tr style='font-size:11px;text-align:center;'>";
				$chaine2.="<td style='height:8mm;width:12mm;border-bottom:1px solid #000;border-right:1px solid #000;'>ID </td>";
				$chaine2.="<td style='height:8mm;width:36mm;border-bottom:1px solid #000;border-right:1px solid #000;'>LABEL</td>";
				$chaine2.="<td style='height:8mm;width:30mm;border-bottom:1px solid #000;border-right:1px solid #000;'>ARTICLE CODE</td>";
				$chaine2.="<td style='height:8mm;width:30mm;border-bottom:1px solid #000;border-right:1px solid #000;'>COLOR</td>";
				$chaine2.="<td style='height:8mm;width:10mm;border-bottom:1px solid #000;border-right:1px solid #000;'>SIZE</td>";
				$chaine2.="<td style='height:8mm;width:25mm;border-bottom:1px solid #000;border-right:1px solid #000;'>EAN 13</td>";
				$chaine2.="<td style='height:8mm;width:10mm;border-bottom:1px solid #000;border-right:1px solid #000;'>QTY</td>";
				if($_SESSION['prefix_contractor']=="dior")
				{
					$chaine2.="<td style='height:8mm;width:20mm;border-bottom:1px solid #000;text-align:center;'>LABEL COLOR </td>";
				}
				else{
					$chaine2.="<td style='height:8mm;width:20mm;border-bottom:1px solid #000;text-align:center;'>CONTROL </td>";
				}
					
			$chaine2.="</tr>";
			$chaine.=$chaine2;
			$bottom+=10;
				
			$i=0;
			$tot=0;
			if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
			{
			$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and `reference`='" . $_GET['reference'] . "' and status>=4  and status<=7 order by type_label"; 
			}
			else{
				$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and status>=4  and status<=7 order by type_label"; 

			}
			// On récupère que les status validés suppliers et on élimine ceux faits par le supplier
			$retour=mysqli_query($con,$sql);
			$j=0;
			while($row=mysqli_fetch_array($retour))
			{
				if($row['type_label']=="CARE_LABEL")
				{
					$row['type_label']="CARE LABEL";
				}
				$j++;
				$bottom+=10;
				//$last=0;
				if ($bottom >= 250) { // Vérifie si la longeur de la chaine dépasse la limite de la page
					$last=1;
					$bottom=25;
					$chaine.="</table>";
																	
					$bottom+=10;
					$chaine.=$chaine2;
					//$bottom+=20;
				}
				$chaine.="<tr style='background-color:#FFFFFF;color:#000;font-size:11px;text-align:center;'>";
				$i=mysqli_num_rows($retour);
				if(($i==1)||($j==$i)||($bottom>=240))
				{
					$chaine.="<td style='height:8mm;width:12mm;border-right:1px solid #000;'>" . $row['id'] . "</td>";
					$chaine.="<td style='height:8mm;width:36mm;border-right:1px solid #000;'>" . $row['type_label'] . "</td>";
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;'>" . $row['reference'] . "</td>";
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;'>" . $row['coloris'] . "</td>";
					$chaine.="<td style='height:8mm;width:10mm;border-right:1px solid #000;'>" . $row['size'] . "</td>";
					$chaine.="<td style='height:8mm;width:25mm;border-right:1px solid #000;'>" . $row['code_ean'] . "</td>";
					$chaine.="<td style='height:8mm;width:10mm;border-right:1px solid #000;'>"  . $row['qty_to_produce'] . "</td>";
					if($_SESSION['prefix_contractor']=="dior")
					{
					$chaine.="<td style='height:8mm;width:20mm;'>"  . $row['couleur_etiquette'] . "</td>";
					}
					else{
						$chaine.="<td style='height:8mm;width:20mm;'></td>";
					}
				}
				else
				{
					$chaine.="<td style='height:8mm;width:12mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $row['id'] . "</td>";
					$chaine.="<td style='height:8mm;width:36mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $row['type_label'] . "</td>";
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $row['reference'] . "</td>";
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $row['coloris'] . "</td>";
					$chaine.="<td style='height:8mm;width:10mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $row['size'] . "</td>";
					$chaine.="<td style='height:8mm;width:25mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $row['code_ean'] . "</td>";
					$chaine.="<td style='height:8mm;width:10mm;border-right:1px solid #000;border-bottom:1px solid #000;'>"  . $row['qty_to_produce'] . "</td>";
					if($_SESSION['prefix_contractor']=="dior")
					{
					$chaine.="<td style='height:8mm;width:20mm;border-bottom:1px solid #000;'>"  . $row['couleur_etiquette'] . "</td>";
					}
					else{
						$chaine.="<td style='height:width:20mm;8mm;border-bottom:1px solid #000;'></td>";
					}
				}
				//$bottom+=10;
				$chaine.="</tr>";
				
				$tot+=($row['qty_to_produce']*1);
			}
				// $chaine.="<tr style='background-color:#FFFFFF;color:#000'>";
				// $chaine.="<td colspan=12 align=right><b> $pap : $tot </b></td>";
				// $chaine.="</tr>";
				// $pap=$row['lab_name'];
			//$bottom+=10;			
			$chaine.="</table>";
			
			
			if ($bottom >= 240) { // Vérifie si la longeur de la chaine dépasse la limite de la page
				$last=1;
				
				$chaine.="<br/>";	
				$chaine.= "</page>";
				$chaine.= "<page pageset=old>";
				$bottom=30;	

			}
			
			//$chaine.=$bottom;
			$chaine.="<div style='position: relative; top:5mm;width:50%;height:30mm;align:right;right:0mm;border: solid 1px #000; border-radius: 5px;'>";
			$chaine.="<p style='text-align: center;font-size:12px;'> VISA control</p >"; 
			$chaine.="</div>";
			
		
		$chaine.= "</page>";
		//echo $chaine;
		 
	// require_once('../html2pdf/html2pdf.class.php');
	require_once dirname(__FILE__).'/../vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;
			//echo $chaine;
    // Create the PDF
    try {
        $html2pdf = new Html2Pdf('P', 'A4', 'fr', false, 'UTF-8', array(5, 5, 5, 5));
        $html2pdf->writeHTML($chaine);
        $html2pdf->output($filename); // 'F' to save to file
		$html2pdf->output($filename,'F');
    } catch (Html2PdfException $e) {
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }
	
		