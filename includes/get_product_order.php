<?php 
		session_start();
		require_once("../config.inc.php");
		require_once("../languages.inc.php");
		// Controle si une session est active
		// Si non active on stop le script
		require_once("./is_session_active.php");
		
		$prefix_contractor=$_SESSION['prefix_contractor'];
		// Rècupère l'id contractor pour la selection des adresses façonniers
		$sql2="select * from `contractors` where `prefix`='" . $_SESSION['prefix_contractor']. "' limit 1";
		$retour2=mysqli_query($con,$sql2); 
		$row2=mysqli_fetch_object($retour2);
		$idConctractor=$row2->id;

		////////////////////////////////////////////////////////////////////
		if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
			{
			$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and `reference`='" . $_GET['reference'] . "' and status>=4  and status<=7"; 
			}
			else{
				$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and status>=4 and status<=7";
		
			}
		$retour=mysqli_query($con,$sql);
		$row=mysqli_fetch_object($retour);
		// Nom du fichier PDF
		$filename="documents/"  . $prefix_contractor . "/packing_list/packlst_".  $_GET['num_of'] . "_" . date('YmdHis') . ".pdf";
		//
		
		$marge = "10mm";
		
		//A generaliser Quentin ( 29/03/2024)
		if($prefix_contractor == "loe"){
			$chaine="<page backtop=5mm>";
			
			//LOGOS
			$chaine.="<div>";
			$chaine.="<div style='position: absolute;width:10mm;height:2mm;left:".$marge.";top:10mm'><img src='../images/eticeurope2024.png'></div>";
			$chaine.="<div style='position: absolute;width:100%;height:10mm;right:0;top:20mm;text-align:center;font-size:10mm;'>PRODUCTION ORDER</div>";
			$chaine.="<div style='position: absolute;width:10mm;height:5mm;right:".$marge.";top:12mm'><img src='../images/logos_clients/" . $prefix_contractor . ".png'></div>";
			$chaine.="</div>";
			
			//DATE + OF
			$chaine.="<div style='position: absolute;width:100%;height:100mm;left:".$marge.";top:30mm'>";
			$chaine.="<h4>Date : " . date('d/m/Y')  . "</h4>";
			$chaine.="Num O.F. (Commessa) : <b>" . $row->num_of . "</b>   ";
			$chaine.="Code Article : <b>" . $row->reference . "</b>";
			$chaine.="</div>";
			$chaine.="<table style='position: absolute;width:100%;height:100mm;right:".$marge.";top:30mm' align='right'>";
		
			// Adresse livraison faconnier
			// Sauf si le façonnier a choisi une autre adresse de livraison
			if(trim($row->other_delivery_adress)>"")
			{
				$tbl_adresse=explode("\r\n" ,$row->other_delivery_adress);
				$chaine.="<tr><td>" . $tbl_adresse[0] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[8] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[1] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[2]. "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[3] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[4] . " " . $tbl_adresse[5] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[6] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[7] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[9] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[10] . "</td></tr>";
					
			}
			else
			{
				$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row->code_supplier . "' limit 1";
				$retourS=mysqli_query($con,$sqlS);
				while($rowS=mysqli_fetch_array($retourS))
				{
					$chaine.="<tr><td>" . $rowS['company_name'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['contact'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['adresse_1'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['adresse_2'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['zip'] . " "  . $rowS['city'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['country'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['telephone'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['email'] . "</td></tr>";
					
				}
			}
			$chaine.="</table>";
			$chaine.="<br/><br/>";
			
			//TABLEAU PRODUCT ORDER
			$chaine.="<table style='position:absolute;width:100%;top:80mm;border: solid 1px #5544DD; border-collapse: collapse' align='center'>";
			$chaine.="<tr style='background-color:#202020;color:#FFFFFF;font-size:11px;text-align:center;'>";
				$chaine.="<td style='width:10mm;'>" . "ID " . "</td>";
				$chaine.="<td style='width:30mm;' >" . "TYPE " . "</td>";
				$chaine.="<td>" . "CODE ARTICLE" . "</td>";
				$chaine.="<td>" . "COLORIS" . "</td>";
				$chaine.="<td>" . "TAILLE" . "</td>";
				$chaine.="<td>" . "EAN 13" . "</td>";
				$chaine.="<td>" . "QTY" . "</td>";
				$chaine.="<td>" . "COULEUR<br/>ETIQUETTE" . "</td>";
				
				$chaine.="<td>" . "VISA<br/>IMPRESSION" . "</td>";
				$chaine.="<td>" . "VISA<br/>CONTROLE" . "</td>";
				$chaine.="<td>" . "VISA<br/>EXPEDITION" . "</td>";
			$chaine.="</tr>";
					
			$i=0;
			$tot=0;
			if($_SESSION['prefix_contractor']=="mmg")
			{
			$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and `reference`='" . $_GET['reference'] . "' and status>=4  and status<=7 order by type_label"; 
			}
			else{
				$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and status>=4  and status<=7 order by type_label"; 

			}
			$retour=mysqli_query($con,$sql);
		
			while($row=mysqli_fetch_array($retour))
			{
				$i++;
				if($i%2==0)
				{
					$chaine.="<tr style='background-color:#ffffff;color:#202020;border:1px solid #202020;font-size:11px;text-align:center;'>";
				}
				else
				{
					$chaine.="<tr style='background-color:#FFFFFF;color:#202020;border:1px solid #202020;font-size:11px;text-align:center;'>";
				}
				$chaine.="<td style='border:1px solid #202020'>" . $row['id'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['type_label'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['reference'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['coloris'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['size'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['code_ean'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>"  . $row['qty_to_produce'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>"  . $row['couleur_etiquette'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . "<br/><br/>" . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . "" . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . "" . "</td>";
				$chaine.="</tr>";
				$tot+=($row['qty_to_produce']*1);
			}
				// $chaine.="<tr style='background-color:#FFFFFF;color:#202020'>";
				// $chaine.="<td colspan=12 align=right><b> $pap : $tot </b></td>";
				// $chaine.="</tr>";
				// $pap=$row['lab_name'];
							
			$chaine.="</table>";
		}
		else{
			$chaine="<page backtop=50mm>";
			$chaine.="<page_header>";
			$chaine.="<img src='../images/eticeurope.png' style='height:20px;>";
			if($prefix_contractor =="dior")
			{
				$chaine.="<div style='position: absolute;width:10mm;height:5mm;left:150mm;top:5mm'><img src='../images/logos_clients/" . $prefix_contractor . ".png' style='height:60px'></div>";
			}
			$chaine.="<h4>PRODUCTION ORDER ETIC-EUROPE" . date('d/m/Y')  . "</h4>";
			if($prefix_contractor=='lem'){
				if($row->code_supplier=='5243' || $row->code_supplier=='1045'){
					
					$chaine.="<div style='height:3mm;font-size:15px;color:red'><b>Send Commercial Invoice</b></div>  ";					
				}
			}
			$chaine.="Num O.F. (Commessa) : <b>" . $row->num_of . "</b>   ";
			$chaine.="Code Article : <b>" . $row->reference . "</b><br/>";
			// récupération du Service
			$sqlS="select * from services where prefix_contractor='" . $prefix_contractor . "' and code_service='" . $row->code_service . "'";
			$retourS=mysqli_query($con,$sqlS);
			$rowS=mysqli_fetch_object($retourS);
			if($rowS){
				$chaine.="Code Service : <b>" . $row->code_service . " : " . $rowS->name . "</b> ";
			}
			//$chaine.="Code Service : <b>" . $row->code_service . " : " . $rowS->name . "</b> ";
			$chaine.="Customer : <b>" . strtoupper($prefix_contractor) .  "</b>";
			
			$chaine.="</page_header>";
			$chaine.="<table  style='position: relative;width: 80%;border: solid 1px #5544DD; border-collapse: collapse; top:5mm'>";
		
			// Adresse livraison faconnier
			// Sauf si le façonnier a choisi une autre adresse de livraison
			if($row->other_delivery_adress)
			{
				$tbl_adresse=explode("\r\n" ,$row->other_delivery_adress);
				$chaine.="<tr><td>" . $tbl_adresse[0] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[8] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[1] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[2]. "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[3] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[4] . " " . $tbl_adresse[5] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[6] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[7] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[9] . "</td></tr>";
					$chaine.="<tr><td>" . $tbl_adresse[10] . "</td></tr>";
					
			}
			else
			{
				$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row->code_supplier . "' limit 1";
				$retourS=mysqli_query($con,$sqlS);
				while($rowS=mysqli_fetch_array($retourS))
				{
					$chaine.="<tr><td>" . $rowS['company_name'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['contact'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['adresse_1'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['adresse_2'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['zip'] . " "  . $rowS['city'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['country'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['telephone'] . "</td></tr>";
					$chaine.="<tr><td>" . $rowS['email'] . "</td></tr>";
					
				}
			}
			$chaine.="</table>";
			$chaine.="<br/><br/>";
			$chaine.="<table  style='min-width:96%;width: 96%;border: solid 1px #5544DD; border-collapse: collapse' align='center'>";
			
			$chaine.="<tr style='background-color:#202020;color:#FFFFFF;font-size:11px'>";
				$chaine.="<td align=center>" . "ID " . "</td>";
				$chaine.="<td align=center >" . "TYPE " . "</td>";
				$chaine.="<td align=center >" . "CODE ARTICLE" . "</td>";
				$chaine.="<td align=center >" . "COLORIS" . "</td>";
				$chaine.="<td align=center >" . "TAILLE" . "</td>";
				$chaine.="<td align=center >" . "EAN 13" . "</td>";
				$chaine.="<td align=center>" . "QTY" . "</td>";
				$chaine.="<td align=center>" . "COULEUR<br/>ETIQUETTE" . "</td>";
				
				$chaine.="<td align=center>" . "VISA<br/>IMPRESSION" . "</td>";
				$chaine.="<td align=center>" . "VISA<br/>CONTROLE" . "</td>";
				$chaine.="<td align=center>" . "VISA<br/>EXPEDITION" . "</td>";
			$chaine.="</tr>";
					
			$i=0;
			$tot=0;
			if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
			{
			$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and `reference`='" . $_GET['reference'] . "' and status>=4  and status<=7 order by type_label"; 
			}
			else{
				$sql="select * from `" . $prefix_contractor . "_orders` where  `num_of`='" . $_GET['num_of'] . "' and status>=4  and status<=7 order by type_label"; 

			}
			$retour=mysqli_query($con,$sql);
		
			while($row=mysqli_fetch_array($retour))
			{
				$i++;
				if($i%2==0)
				{
					$chaine.="<tr style='background-color:#ffffff;color:#202020;border:1px solid #202020;font-size:11px'>";
				}
				else
				{
					$chaine.="<tr style='background-color:#FFFFFF;color:#202020;border:1px solid #202020;font-size:11px'>";
				}
				$chaine.="<td style='border:1px solid #202020'>" . $row['id'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['type_label'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['reference'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['coloris'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['size'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . $row['code_ean'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>"  . $row['qty_to_produce'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>"  . $row['couleur_etiquette'] . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . "<br/><br/>" . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . "" . "</td>";
				$chaine.="<td style='border:1px solid #202020'>" . "" . "</td>";
				$chaine.="</tr>";
				$tot+=($row['qty_to_produce']*1);
			}
				// $chaine.="<tr style='background-color:#FFFFFF;color:#202020'>";
				// $chaine.="<td colspan=12 align=right><b> $pap : $tot </b></td>";
				// $chaine.="</tr>";
				// $pap=$row['lab_name'];
							
		$chaine.="</table>";
		
		}
		$chaine.= "</page>";
		//echo $chaine;
		 
	// require_once('../html2pdf/html2pdf.class.php');
	require_once dirname(__FILE__).'/../vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($chaine);
    $html2pdf->Output($filename);
	
		