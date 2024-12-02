<?php
	session_start();
	require_once("../config.inc.php");
				//
	$sql2="select * from lem_orders  where id='" . $_GET['id']. "' limit 1";
	$retour2=mysqli_query($con,$sql2);
	// echo $sql2;
	while($row2=mysqli_fetch_array($retour2))
	{ 
				// Reconstitution du nom de BAT
				$initDirectory="lem";
				$batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
				$fullNameBAT=$row2['num_of'] . "_" . $row2['type_ordre']  ;
				// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
				$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
																				
				// Recherche la dernière version validées
				$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='lem' order by horodatage desc limit 1";
				$retourB=mysqli_query($con,$sqlB);
				$fullLinkImage="";
				while($rowB=mysqli_fetch_array($retourB))
				{
					$fullLinkImage=$rowB['bat_name'];
				}
				
	}
	
	// echo $sqlB;
	if(trim($fullLinkImage)>"")
	{
		$tbl_name_image=explode("/",$fullLinkImage);
		if(isset($tbl_name_image))
		{
			for ($n=1;$n<20;$n++)
			{
				$fileImageValidate=str_replace("_1.","_$n.",$tbl_name_image[count($tbl_name_image)-1]);
				if(file_exists($batsDirectoryV . $fileImageValidate))
				{
					
					echo  $fileImageValidate . "|";
				}
				else
				{
					// echo "ERROR FILE NOT EXIST";
				}
			}
		} 
		
	}
			

?>

