<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	require_once("./is_session_active.php");
	print_r($_POST);
	echo "<hr/>";
	$fileExport="/home/eticnet/www/millet_transfert/export_modeling/export_" . date('YmdHis') . ".csv";
	$fpW=fopen($fileExport, "w");
	$firstLigne=0;
	// Récupère le nom du fichier 
	foreach($_POST as $key=>$value)
	{
		echo $key . ":" . $value . "<br/>";
		
		$tbl=explode("|",$value);
		// Exception MMG
		if($_SESSION['prefix_contractor']=='mmg')
		{	
			// print_r($tbl); 
			$filename="/home/eticnet/www/millet_transfert/archives/converted_" . $tbl[2];
			// echo "<b>" . $filename . "</b></br>";
			// Ouverture du fichier
			if( file_exists( $filename ) ) 
			{
				echo "<hr/>Traitement du fichier $filename : <br/>";
				$fp = fopen($filename, 'r');
				$ligne="";
				while (false !== ($char = fgetc($fp))) 
				{
						$contentFile.=$char;
						if($char=="\r")
						{
							$tbl_content=explode("!",$contentFile);
							if($firstLigne==0)
							{
								$firstLigne=1;
								fwrite($fpW,$contentFile);
							}
							// echo $tbl_content[199] . ":" . $tbl[3] . "<br/>";
							if($tbl_content[220]==$tbl[3] && $tbl_content[199]==$tbl[4])
							{
								fwrite($fpW,$contentFile);
								// foreach($tbl_content as $idField=>$field)
								// {
									// echo "<b>ligne numéro ".$idField." : " . $field  . "</b>";
									// $i ++;
									// echo "</hr>";
									
								// }
							}
							$contentFile="";
						}
				}
				fclose($fp) ;
			} 
			else 
			{
				echo "<hr/>Le fichier $filename n\'existe pas.";
			}
		}
	}
	echo "Votre fichier est prêt.";
	fclose($fpW);
?>

