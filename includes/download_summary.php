<?php 
		require_once("../config.inc.php");
		require_once("../languages.inc.php");
		// Controle si une session est active
		// Si non active on stop le script
		require_once("./is_session_active.php");
		$font = 'arial';
		$prefix_contractor=$_SESSION['prefix_contractor'];
		//Rècupère l'id contractor pour la selection des adresses façonniers
		$sql2="select * from `contractors` where `prefix`='" . $prefix_contractor. "' limit 1";
		$retour2=mysqli_query($con,$sql2); 
		$row2=mysqli_fetch_object($retour2);
		
		$conctractor=$row2->name;
		// Rècupère l'UTILISATEUR 
		$sqlD="select * FROM users where id='" . $_GET['user_id'] . "'";
		//echo $sqlD;
		$retourD=mysqli_query($con,$sqlD); 
		$rowD=mysqli_fetch_object($retourD);
		$devise= $rowD->devise;
		$date = new DateTime();

		// Nom du fichier PDF
		$filename="documents/"  . $prefix_contractor . "/packing_list/globalsumup_".  $_GET['user_id'] . "_" . date('YmdHis') . ".pdf";
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
		
			$chaineLogo.="<td style='width:62mm;height:15mm;text-align:center'><h2 style='Font-weight:400'>ACKNOWLEDGEMENT OF RECEIPT</h2></td>";
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
		
		
		$chaine2="<table style='position: relative;width:100%;border: solid 1px #000; border-radius: 5px; top:5mm;'>";
			$chaine2.="<tr style='font-size:14px;text-align:center;font-weight:bold'>";
					$chaine2.="<td style='height:8mm;width:30mm;border-bottom:1px solid #000;border-right:1px solid #000;'>P.O </td>";
					$chaine2.="<td style='height:8mm;width:30mm;border-bottom:1px solid #000;border-right:1px solid #000;'>ARTICLE CODE</td>";
					$chaine2.="<td style='height:8mm;width:40mm;border-bottom:1px solid #000;border-right:1px solid #000;'>LABEL</td>";
					$chaine2.="<td style='height:8mm;width:40mm;border-bottom:1px solid #000;border-right:1px solid #000;'>MANUFACTURER</td>";				
					$chaine2.="<td style='height:8mm;width:10mm;border-bottom:1px solid #000;border-right:1px solid #000;'>QTY</td>";
					$chaine2.="<td style='height:8mm;width:12mm;border-bottom:1px solid #000;border-right:1px solid #000;'>UNIT PRICE</td>";
					$chaine2.="<td style='height:8mm;width:12mm;border-bottom:1px solid #000;'>TOTAL</td>";		
		$chaine2.="</tr>";			
		$chaine.=$chaine2;

		$sqlCart="select * from `cart` where  `id_user`='" . $_GET['user_id'] . "' and date_validation >= '".date_format($date,"Y-m-d 00:00:00")."'  and date_validation <= '".date_format($date,"Y-m-d 23:59:59")."'and status = 1";
		//$chaine.=$sqlCart;
		$retourCart=mysqli_query($con,$sqlCart);
		$j=0;
		while($rowCart=mysqli_fetch_array($retourCart))
		{						
			
			//TABLEAU PRODUCT ORDER
			$sqlS="select * from `users_adresses` where  `code_supplier`='" . $rowCart['code_supplier'] . "'";	
			$retourS=mysqli_query($con,$sqlS);
			
			$rowS=mysqli_fetch_object($retourS);
	
			
			$tot=0;
			
			$sql="select * from `articles` where  `ref_produit_fini`='" . $rowCart['reference_article'] . "'";	
			$retour=mysqli_query($con,$sql);
			
			$row=mysqli_fetch_object($retour);
			$j++;
			$bottom+=10;
				//$last=0;
				/*if ($bottom >= 250) { // Vérifie si la longeur de la chaine dépasse la limite de la page
					$last=1;
					$bottom=25;
					$chaine.="</table>";
																	
					$bottom+=10;
					$chaine.=$chaine2;
					//$bottom+=20;
				}*/
			switch ($devise){
				case "{1}": 
					$unit_price=$row->price_eur;
					$dev=mb_convert_encoding("&euro;", "UTF-8", mb_detect_encoding("&euro;"));
					break;
				case "{2}":
					$unit_price=$row->price_usd;
					$dev="$";
					break;
				case "{3}":
					$unit_price=$row->price_cny;
					$dev=mb_convert_encoding("&yen;", "UTF-8", mb_detect_encoding("&yen;"));
					break;
			}
			$prix=$rowCart['qty'];
			if($row->unite_facturation==="3"){
				$prix=$rowCart['qty']/1000;
			}
				
			elseif ($row->unite_facturation==="2"){
				$prix=$rowCart['qty'];
			}
			//Total
			$total= $unit_price * $prix;
			$chaine.="<tr style='background-color:#FFFFFF;color:#000;font-size:11px;text-align:center;'>";
			$i=mysqli_num_rows($retourCart);
			$libelle=$row->libelle;
				if(($i==1)||($j==$i)||($bottom>=240))
				{
					
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;'>" . $rowCart['num_commande'] . "</td>";
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;'>" . $rowCart['reference_article'] . "</td>";
					$chaine.="<td style='height:8mm;width:40mm;border-right:1px solid #000;'>" . $libelle . "</td>";
					$chaine.="<td style='height:8mm;width:40mm;border-right:1px solid #000;'>" . $rowS->company_name . "</td>";
					$chaine.="<td style='height:8mm;width:10mm;border-right:1px solid #000;'>" . $rowCart['qty'] . "</td>";
					$chaine.="<td style='height:8mm;width:12mm;border-right:1px solid #000;'>" . $unit_price . "</td>";

					$chaine.="<td style='height:8mm;width:12mm;'>"  . $total ." ". $dev ."</td>";
					
				}
				else
				{
					
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $rowCart['num_commande']. "</td>";
					$chaine.="<td style='height:8mm;width:30mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $rowCart['reference_article'] . "</td>";
					$chaine.="<td style='height:8mm;width:40mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $libelle . "</td>";
					$chaine.="<td style='height:8mm;width:40mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $rowS->company_name . "</td>";
					$chaine.="<td style='height:8mm;width:10mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $rowCart['qty']. "</td>";
					$chaine.="<td style='height:8mm;width:12mm;border-right:1px solid #000;border-bottom:1px solid #000;'>" . $unit_price . "</td>";
	
					$chaine.="<td style='height:8mm;width:12mm;border-bottom:1px solid #000;'>".$total." ".$dev." </td>";					
				}
				//$bottom+=10;
			$chaine.="</tr>";
		
			if ($bottom >= 240) { // Vérifie si la longeur de la chaine dépasse la limite de la page
				$last=1;
				
				$chaine.="<br/>";	
				$chaine.= "</page>";
				$chaine.= "<page pageset=old>";
				$bottom=30;
			}
			
		}
		//$chaine2.="</table>";
		$chaine.="</table>";	
			
		
		$chaine.= "</page>";
		//echo $chaine;
		 
	// require_once('../html2pdf/html2pdf.class.php');
	require_once dirname(__FILE__).'/../vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;
			//echo $chaine;
    $html2pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8', array(5, 5, 5, 5));
	$html2pdf->setDefaultFont($font);
    $html2pdf->WriteHTML($chaine);
    $html2pdf->Output($filename);
	
		