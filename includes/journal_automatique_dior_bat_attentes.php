<?php
	session_start();
	require_once("../config.inc.php");
	// Charge le script d'envoi d'email 
	require_once('./send_email_no_control.php');
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//
	$service[1]="01"; // Accessoire
	$service[2]="02"; // Femme
	$service[3]="03"; // Homme
	$mailService[1]="s.auger@eticeurope.com|b.auger@eticeurope.com|q.auger@eticeurope.com|d.gouveia@eticeurope.com|p.cunha@eticeurope.com";
	$mailService[2]="s.auger@eticeurope.com|b.auger@eticeurope.com|q.auger@eticeurope.com|d.gouveia@eticeurope.com|p.cunha@eticeurope.com";
	$mailService[3]="s.auger@eticeurope.com|b.auger@eticeurope.com|q.auger@eticeurope.com|d.gouveia@eticeurope.com|p.cunha@eticeurope.com";
	// Rècupère les qte des of par type label on rècupère tous les O.F. sans exceptions
	$TBL_sujet[1]="TACC - " . date("dmY") . " - Eticnet report";
	$TBL_sujet[2]="PAPF - " . date("dmY") . " - Eticnet report";
	$TBL_sujet[3]="PAPH - " . date("dmY") . " - Eticnet report";
	
	$sql='select * from `dior_orders`';
	$retour=mysqli_query($con,$sql); 
	while($row=mysqli_fetch_array($retour))
	{
		$TBL_qte[$row['num_of']][$row['reference']][$row['type_label']]+=$row['qty_init'];
	}
	// print_r($TBL_qte);
	// die(); 
	//////////////////////////////////////////////////////////////////////////////
			
			$journal.="</table>";
		$journal.="<h2>STATUT 20 WITHOUT BAT</h2>";
		$journal.="<table>";
		$journal.="<tr style='background-color:#606060;color:#fefefe'>";
		$journal.="<td>COMMESSA</td><td>REFERENCE</td><td>COLORIS</td><td>TAILLE</td>";
		$journal.="<tr>";
		$sql="select * from  `dior_orders` where `status` ='4' and `prefix_bat`='CL' and `qty_init`>0 and `status_composition`='20' order by `id` desc ;";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			// Regarde si j'ai une compo validé
				// Reconstitution du nom de BAT
					$initDirectory="dior";
					$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
					// Exception DIOR
					if($row['size']=="U" and $row['prefix_bat']=='CL')
					{
						$row['size']="TU";
					}
					$fullNameBAT=$row['code_service'] . "_" . $row['prefix_bat'] . "_" . $row['reference'] . "_" . $row['size'] . "_" ;
				// Recherche la dernière version validées
					$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='dior' order by horodatage desc limit 1";
					$retourB=mysqli_query($con,$sqlB);
					$fullLinkImage="";
					// echo $sqlB;
					while($rowB=mysqli_fetch_array($retourB))
					{
						$fullLinkImage=$rowB['bat_name'];
					}
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					// Recherche spécifique Dior Taille U depuis un fichier extracfinal à la place du fichier Excel fournit en début de saison
					// Recherche uniquement si on n'a pas trouvé précédemment avec TU
					if(trim($fullLinkImage)=="")
					{
						$i++;
						if($i%2==0)
						{
							$journal.="<tr>";
						}
						else
						{
							$journal.="<tr style='background-color:#cccccc'>";
						}
						$journal.="<td>" . $row['num_of'] . "</td>";
						$journal.="<td>" . $row['reference'] . "</td>";
						$journal.="<td>" . $row['coloris'] . "</td>";
						$journal.="<td>" . $row['size'] . "</td>";
						// $journal.="<td>" . $row['qty_init'] . "</td>";
						$journal.="</tr>";
					}
		}
		$journal.="</table>";
		echo "<hr/>";
		echo $journal;
		
		$sujet="BAT EN ATTENTE DIOR";
		$retourMail=send_mail("q.auger@eticeurope.com",$sujet,$journal);
		$retourMail=send_mail("n.lopes@eticeurope.com",$sujet,$journal);
		$retourMail=send_mail("d.gouveia@eticeurope.com",$sujet,$journal);
		$retourMail=send_mail("p.cunha@eticeurope.com",$sujet,$journal);
		
		
				
			
			
?>

