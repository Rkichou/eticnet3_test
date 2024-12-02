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
	$mailService[1]="s.auger@eticeurope.com|b.auger@eticeurope.com|q.auger@eticeurope.com|n.lopes@eticeurope.com|abeau@christiandior.com|aparisot@christiandior.com|ektorza@christiandior.com|sghanem@christiandior.com|chaueter@christiandior.com|";
	$mailService[2]="s.auger@eticeurope.com|b.auger@eticeurope.com|q.auger@eticeurope.com|n.lopes@eticeurope.com|abeau@christiandior.com|aparisot@christiandior.com|czanrei@christiandior.com|ddasilvabarros@christiandior.com|zkaya@christiandior.com|fkarayannis@christiandior.com|fmarchi@christiandior.com|ektorza@christiandior.com|ezamattio@christiandior.com|lshmavon@christiandior.com|";
	$mailService[3]="thle_ext@christiandior.com|s.auger@eticeurope.com|b.auger@eticeurope.com|q.auger@eticeurope.com|n.lopes@eticeurope.com|abeau@christiandior.com|abanzato@christiandior.com|adaria@christiandior.com|ccoudert@christiandior.com|emantoan@christiandior.com|ezamattio@christiandior.com|fmarchi@christiandior.com|gmilioti@christiandior.com|gzoccarato@christiandior.com|pgouget@christiandior.com|sceron@christiandior.com|svandevenne@christiandior.com|";
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
	for($s=1;$s<=3;$s++)
	{
		$journal="<h2>UNIVERS " . $service[$s]. "</h2>";
			
			$journal.="<h2>COMMESSAS AWAITING PRODUCTION OUT OF STATUS 20</h2>";
		$journal.="<table>";
		$journal.="<tr style='background-color:#606060;color:#fefefe'>";
		$journal.="<td>INTEGRATION</td><td>SUPPlIER</td><td>COMMESSA</td><td>REFERENCE</td><td>QTY</td><td>STATUT COMPO</td>";
		$journal.="<tr>";
		$sql="select * from  `dior_orders` where `status` ='4' and `prefix_bat`='CL' and `qty_init`>0 and `status_composition`<>'20'  and code_service='" . $service[$s]. "' group by `num_of` order by `date_integration` asc;";
		$retour=mysqli_query($con,$sql); 
		$i=0;
		$idConctractor=1;
		while($row=mysqli_fetch_array($retour))
		{
			//
			$origin = date_create($row['date_integration']);
			$target = date_create(date('Y-m-d'));
			$interval = date_diff($origin, $target);
			// echo $interval->format('%a');
			$color="";
			if($interval->format('%a')>=7)
			{
					$color=" ;color:red; ";
			}
				$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row['code_supplier'] . "' limit 1";
				$retourS=mysqli_query($con,$sqlS);
				$rowS=mysqli_fetch_object($retourS);
			//
			$i++;
			if($i%2==0)
			{
				$journal.="<tr style='$color'>";
			}
			else
			{
				$journal.="<tr style='background-color:#cccccc $color'>";
			}
			$qty=$TBL_qte[$row['num_of']][$row['reference']][$row['type_label']];
			
			$journal.="<td>" . as_date_us_french($row['date_integration']) . "</td>";
			$journal.="<td>" . $rowS->company_name . "</td>";
			$journal.="<td>" . $row['num_of'] . "</td>";
			$journal.="<td>" . $row['reference'] . "</td>";
			$journal.="<td>" . $qty . "</td>";
			$journal.="<td>" . $row['status_composition'] . "</td>";
			$journal.="</tr>";
		}
		$journal.="</table>";
		
		// Analyse des O.F. en attente de production
		$journal.="<h2>COMMESSAS AWAITING PRODUCTION</h2>";
		$journal.="<table>";
		$journal.="<tr style='background-color:#606060;color:#fefefe'>";
		$journal.="<td>INTEGRATION</td><td>SUPPLIER</td><td>COMMESSA</td><td>REFERENCE</td><td>QTY</td><td>STATUT COMPO</td>";
		$journal.="<tr>";
		$sql="select * from  `dior_orders` where `status` ='4' and `prefix_bat`='CL' and `qty_init`>0  and code_service='" . $service[$s]. "' group by `num_of` order by `date_integration` asc;";
		$retour=mysqli_query($con,$sql); 
		$i=0;
		while($row=mysqli_fetch_array($retour))
		{
			$origin = date_create($row['date_integration']);
			$target = date_create(date('Y-m-d'));
			$interval = date_diff($origin, $target);
			// echo $interval->format('%a');
			$color="";
			if($interval->format('%a')>=7)
			{
					$color=" ;color:red; ";
			}
			
			$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row['code_supplier'] . "' limit 1";
			$retourS=mysqli_query($con,$sqlS);
			$rowS=mysqli_fetch_object($retourS);
			$i++;
			if($i%2==0)
			{
				$journal.="<tr style=' $color '>";
			}
			else
			{
				$journal.="<tr style='background-color:#cccccc $color'>";
			}
			$qty=$TBL_qte[$row['num_of']][$row['reference']][$row['type_label']];
			$journal.="<td>" . as_date_us_french($row['date_integration']) . "</td>";
			$journal.="<td>" . $rowS->company_name . "</td>";
			$journal.="<td>" . $row['num_of'] . "</td>";
			$journal.="<td>" . $row['reference'] . "</td>";
			$journal.="<td>" . $qty . "</td>";
			$journal.="<td>" . $row['status_composition'] . "</td>";
			$journal.="</tr>";
		}
		$journal.="</table>";
		
		//
		$journal.="<h2>COMMESSAS IN PRODUCTION</h2>";
		$journal.="<table>";
		$journal.="<tr style='background-color:#606060;color:#fefefe'>";
		$journal.="<td>INTEGRATION</td><td>LANCEMENT</td><td>SUPPLIER</td><td>COMMESSA</td><td>REFERENCE</td><td>QTY</td>";
		$journal.="<tr>";
		$sql="select * from  `dior_orders` where `status` ='5' and `prefix_bat`='CL' and `qty_init`>0 and code_service='" . $service[$s]. "' group by `num_of` order by `date_integration` asc;";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row['code_supplier'] . "' limit 1";
			$retourS=mysqli_query($con,$sqlS);
			$rowS=mysqli_fetch_object($retourS);
			$i++;
			if($i%2==0)
			{
				$journal.="<tr>";
			}
			else
			{
				$journal.="<tr style='background-color:#cccccc'>";
			}
			$qty=$TBL_qte[$row['num_of']][$row['reference']][$row['type_label']];
			$journal.="<td>" . as_date_us_french($row['date_integration']) . "</td>";
			$journal.="<td>" . as_date_us_french($row['date_production']) . "</td>";
			$journal.="<td>" . $rowS->company_name . "</td>";
			$journal.="<td>" . $row['num_of'] . "</td>";
			$journal.="<td>" . $row['reference'] . "</td>";
			$journal.="<td>" . $qty . "</td>";
			
			$journal.="</tr>";
		}
		$journal.="</table>";
		//
		
		//
		$journal.="<h2>COMMESSAS IN QUALITY CONTROL</h2>";
		$journal.="<table>";
		$journal.="<tr style='background-color:#606060;color:#fefefe'>";
		$journal.="<td>INTEGRATION</td><td>CONTROLE</td><td>SUPPLIER</td><td>COMMESSA</td><td>REFERENCE</td><td>QTY</td>";
		$journal.="<tr>";
		$sql="select * from  `dior_orders` where `status` ='6' and `prefix_bat`='CL' and `qty_init`>0 and code_service='" . $service[$s]. "' group by `num_of` order by `date_integration` asc;";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row['code_supplier'] . "' limit 1";
			$retourS=mysqli_query($con,$sqlS);
			$rowS=mysqli_fetch_object($retourS);
			$i++;
			if($i%2==0)
			{
				$journal.="<tr>";
			}
			else
			{
				$journal.="<tr style='background-color:#cccccc'>";
			}
			$qty=$TBL_qte[$row['num_of']][$row['reference']][$row['type_label']];
			$journal.="<td>" . as_date_us_french($row['date_integration']) . "</td>";
			$journal.="<td>" . as_date_us_french($row['date_quality']) . "</td>";
			$journal.="<td>" . $rowS->company_name . "</td>";
			$journal.="<td>" . $row['num_of'] . "</td>";
			$journal.="<td>" . $row['reference'] . "</td>";
			$journal.="<td>" . $qty . "</td>";
			$journal.="</tr>";
		}
		$journal.="</table>";
		// $journal.="<h2>50 LAST COMMESSAS SENDING</h2>";
		// $journal.="<table>";
		// $journal.="<tr style='background-color:#606060;color:#fefefe'> ";
		// $journal.="<td>INTEGRATION</td><td>EXPEDITION</td><td>SUPPLIER</td><td>COMMESSA</td><td>REFERENCE</td><td>QTY</td><td>TRACKING</td>";
		// $journal.="<tr>";
		// $sql="select * from  `dior_orders` where `status` ='7' and `prefix_bat`='CL' and `qty_init`>0  and code_service='" . $service[$s]. "' group by `num_of` order by `date_delivery` desc limit 50;";
		// $retour=mysqli_query($con,$sql); 
		// while($row=mysqli_fetch_array($retour))
		// {
			// $sqlS="select * from  users_adresses  where `contractor`='" . $idConctractor ."' and code_supplier='" . $row['code_supplier'] . "' limit 1";
			// $retourS=mysqli_query($con,$sqlS);
			// $rowS=mysqli_fetch_object($retourS);
			// $i++;
			// if($i%2==0)
			// {
				// $journal.="<tr>";
			// }
			// else
			// {
				// $journal.="<tr style='background-color:#cccccc'>";
			// }
			// $qty=$TBL_qte[$row['num_of']][$row['reference']][$row['type_label']];
			// $journal.="<td>" . as_date_us_french($row['date_integration']) . "</td>";
			// $journal.="<td>" . as_date_us_french($row['date_delivery']) . "</td>";
			// $journal.="<td>" . $rowS->company_name . "</td>";
			// $journal.="<td>" . $row['num_of'] . "</td>";
			// $journal.="<td>" . $row['reference'] . "</td>";
			// $journal.="<td>" . $qty . "</td>";
			// $journal.="<td>" . $row['tracking'] . "</td>";
			// $journal.="</tr>";
		// }
		// $journal.="</table>";
		$journal.="<h2>STATUT 20 WITHOUT BAT</h2>";
		$journal.="<table>";
		$journal.="<tr style='background-color:#606060;color:#fefefe'>";
		$journal.="<td>REFERENCE</td><td>COLORIS</td><td>TAILLE</td>";
		$journal.="<tr>";
		$sql="select * from  `dior_orders` where `status` ='4' and `prefix_bat`='CL' and `qty_init`>0  and code_service='" . $service[$s]. "' and `status_composition`='20' order by `id` desc ;";
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
		
		// On recherche l'adresse mail dans la table users 
		$sql="select * from  users where `user_email` ='" .  mysqli_real_escape_string($con,$_POST['email']) . "' limit 1";
		$retour=mysqli_query($con,$sql); 
		if(mysqli_num_rows($retour)==1)
		{
			$row=mysqli_fetch_object($retour);
			// C'est un email principal, on envoi le mail avec les éléments de connexion
			
			$sujet=$TBL_sujet[$s];
			// $name=$row->user_name;
			// $mail=$row->user_email;
			// $login=$row->login;
			// $id=$row->id;
			$messageFR="
						Hi ,
						<br/><br/>Below is the activity log for your myeticnet.eticeurope.com platform.
						<br/><br>
						$journal
						<br/>
						<br/><br/>
						If you have any questions, you can send an email to supportit@eticeurope.com
						<br/>Kind regards,
						<br/>The MyEticnet Team.
						";
			
			// Envoi du mail
			echo $messageFR;
			// die();
			// $mail="abeau@christiandior.com";
			$tbl_mail=explode("|",$mailService[$s]);
			// $tbl_mail[0]="s.auger@eticeurope.com";
			$m=0;
			foreach($tbl_mail as $keyM=>$valueM)
			{
				$m++;
				if($m>2)
				{
					// break;
				}
				$mail=$valueM;
				$retourMail=send_mail($mail,$sujet,$messageFR);
				
				if ($retourMail==1)
				{
					
					echo "email been sent to the following email address:$mail.\nRemember to check your spam folder!.<br/>";
				}
				elseif($retourMail==0)
				{
					echo "Error to send mail at $email / Erreur d'envoi du mail à $mail";
				}
				else
				{
					echo "Error 2 to send mail at $email / Erreur 2 d'envoi du mail à $mail";
				}
			}
			// die(); // On a trouvé le mail ! Fin du script 
		}
	}
?>

