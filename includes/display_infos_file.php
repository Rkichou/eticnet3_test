<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	//Pour afficher le fichier d'origine de l'O.F.
	if($_POST['prefix_contractor']=="chloe")
	{ 
		//LA013
		$dir = "/home/eticnet/www/chloe_transfert/archives/";
		/////////////////////////////////////////////////////////
		$chunkSize = 100 * 1024 * 1024; // 100 MB in bytes
		$fp = null;
		$fp=fopen($dir . $_POST['filename'],"r");
		echo "<label style='color:red;cursor:pointer;display:inline-block' onclick=\"document.getElementById('local_window').style.display='NONE';\"><u>close</u></label>";
		echo "&nbsp;|&nbsp;<a href='chloe_transfert/archives/" . $_POST['filename'] . "' download>download file</a>";
		echo "<table style='font-size:10px;color:#404040;border-spacing: 0;border-collapse: collapse;'>";
		if($fp)
		{
			while (!feof($fp)) 
			{
					$fileDatas = fgets($fp, $chunkSize); // lecture du contenu de la ligne
					$lignes = explode("\r", $fileDatas); //Must be single quote, double quote are for real line return	
					// echo $fileDatas;
					// $lig=0;
					foreach ($lignes as $ligne)
					{
						$c++;
						$ligne = ltrim($ligne);
						$ligne = trim($ligne, '"'); //remove quotes
						if($ligne == "")
						{
							break;
						}
						$lig++;
						
						if($lig==1)
						{
							$ligneTete=$ligne;
						}							
						// echo $lig . ":"  . $ligne . "<hr/>";
						
						echo "<tr>";
							// echo "<td>$lig</td>";
							$tbl=explode("|",$ligne);
							foreach($tbl as $key=>$value)
							{
									if($lig==1)
									{
										echo "<td style='border:1px solid #999999;background-color:#808080;color:#fefefe'>" . $value . "</td>";
									}
									else
									{
										if($lig%2==0)
										{
											echo "<td style='border:1px solid #aaaaaa;background-color:#fafefe;color:#404040'>" . $value . "</td>";
										}
										else
										{
											echo "<td style='border:1px solid #aaaaaa;background-color:#ffffff;color:#404040'>" . $value . "</td>";
										}
									}
							}
							
						echo "</tr>";
						if($lig%15==0)
						{
							echo "<tr>";
							$tbl=explode("|",$ligneTete);
							foreach($tbl as $key=>$value)
							{
								
									echo "<td style='border:1px solid #999999;background-color:#808080;color:#fefefe'>" . $value . "</td>";
							}
							echo "</tr>";
						
						}
						
					}	
			}
		}
		echo "</table>";
		echo "<label style='color:red;cursor:pointer;display:inline-block' onclick=\"document.getElementById('local_window').style.display='NONE';\"><u>close</u></label>";
		echo "&nbsp;|&nbsp;<a href='chloe_transfert/archives/" . $_POST['filename'] . "' download>download file</a>";
			// print_r($_POST); 
		die();
	}
?>
	