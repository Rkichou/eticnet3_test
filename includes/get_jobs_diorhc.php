<?php
	session_start();
	require_once("../config.inc.php");
	// Uniquement pour DIOR HC
	$_GET['prefix_contractor']="diorhc";
	$sql2="select * from " . $_GET['prefix_contractor'] . "_orders  where id='" . $_GET['id']. "' limit 1";
	$retour2=mysqli_query($con,$sql2);
	// echo $sql2;
	// die();
	while($row2=mysqli_fetch_array($retour2))
	{
				// Reconstitution du nom de BAT
				$initDirectory=$_GET['prefix_contractor'];
				$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
				// Exception DIOR
				if($row2['size']=="U" and $row2['prefix_bat']=='CL')
				{
					$row2['size']="TU";
				}
				if($row2['prefix_bat']=='STK')
				{
					$fullNameBAT=$row2['code_service'] . "_" . $row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" ;
				}
				else
				{
					$fullNameBAT=$row2['code_service'] . "_" . $row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
				}
				// $fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
			// Recherche la dernière version validées
				$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $_GET['prefix_contractor']. "' order by horodatage desc limit 1";
				$retourB=mysqli_query($con,$sqlB);
				$fullLinkImage="";
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
						$fullNameBAT=$row2['code_service'] . "_" . $row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" ;
					}
					else
					{
						$fullNameBAT=$row2['code_service'] . "_" . $row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
					}
					// Recherche la dernière version validées
					$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $_GET['prefix_contractor']. "' order by horodatage desc limit 1";
					$retourB=mysqli_query($con,$sqlB);
					$fullLinkImage="";
					while($rowB=mysqli_fetch_array($retourB))
					{
						$fullLinkImage=$rowB['bat_name'];
					}
				}
				//
				if(trim($fullLinkImage)>"")
				{
					// Rècupère uniquement le nom de l'image
					$tbl_name_image=explode("/",$fullLinkImage);
					$qty=$row2['qty_to_produce'];
					// $qty+=1;
					echo $tbl_name_image[count($tbl_name_image)-1]  . "|" . $row2['num_of'] . "|" . $qty;
				}
				
			}
			

?>

