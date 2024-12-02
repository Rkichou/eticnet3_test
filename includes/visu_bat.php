<style>
.stateRTP{
	border-radius: 8px;
    color: white;
    padding: 4px 8px;
    background-color: #59A735;
    text-decoration: none;
	font-size: 16px;
    width: 100px;
    display: block;
    text-align: center;
}
.imgRTP{
    border: 1px solid #606060;
	margin: 15px 0;
}
.title{
	font-size: 17px;
	font-weight: 500;
	font-family: Aeonik;
	line-height: 20.4px;
	margin: 10px 0;
}
</style>
<?php

	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	require_once("is_session_active.php");

	list($width, $height) = getimagesize($_GET['source']);
		// echo $width . "<br/>" . $height ;
		$width=$width/24;
		$height=$height/12;
		$pos = strpos($_GET['source'], "CL_");
		if($pos!==false)
		{
			echo "largeur " . $width . "mm X longueur " . $height . "mm<br/>";  
		}	
$tbl_name_image=explode("/",$_GET['source']);
	echo "<div class='title'>";
    	echo "Preview " . $tbl_name_image[count($tbl_name_image)-1];
	echo "</div>";
	echo "<a href=\"../". $_GET['source'] . "\" class='stateRTP' download=\"" . $_GET['source'] . "\">Download</a>";

	//Pour afficher toutes les pages de BAT pour Chloe : Ajout Quentin Auger 18 06 2024
	if($_SESSION['prefix_contractor']=="chloe")
	{
		for($b=1;$b<=20;$b++)
		{
			$tblFileNameWoNum = explode("_",$_GET['source']);
			// if($tblFileNameWoNum[1]=="S" )
			if(substr($tblFileNameWoNum[1],0,1)=="S" ) // Modification Samuel Auger 14/08/2024 
			{
				// Stickers
				$tmpFileNameWoNum = $tblFileNameWoNum[0] . "_" . $tblFileNameWoNum[1];
				// Vérifie si on est sur du waiting ou du validate / refusé / dévalidé
				if(count($tblFileNameWoNum)==4)
				{
					$tmpFileNameWoNum .= "_" . $tblFileNameWoNum[2];
				}
			
			}
			else
			{
				// Care Label
				$tmpFileNameWoNum = $tblFileNameWoNum[0] ;
				// Vérifie si on est sur du waiting ou du validate / refusé / dévalidé
				// print_r($tblFileNameWoNum);
				if(count($tblFileNameWoNum)==3)
				{
					
					$tmpFileNameWoNum .= "_" . $tblFileNameWoNum[1];
				}
			}
			
			// echo "...." . $tmpFileNameWoNum ;
			if (file_exists(urldecode($tmpFileNameWoNum ."_". $b . ".png")))
			{
				echo "<a href=\"../" . $tmpFileNameWoNum ."_". $b . ".png\" class='stateRTP' download=\"" . $tmpFileNameWoNum ."_". $b . ".png\">Download #$b</a>";
				
				echo "<img src='../" . ($tmpFileNameWoNum ."_". $b) . ".png' class='imgRTP'>";
				
			}
			else 
			{ 
				break; // On sort de la boucle... Les numéros doivent se suivre
			}
		}
	
		die();
	}
	if($_SESSION['prefix_contractor']=="loe")
	{
		for($b=1;$b<=20;$b++)
		{
			// echo $b;
			// echo $tmpFileNameWoNum . "<br/>";
			$tblFileNameWoNum = explode("_",$_GET['source']);
			$tmpFileNameWoNum = $tblFileNameWoNum[0] . "_" . $tblFileNameWoNum[1] . "_" . $tblFileNameWoNum[2] . "_" . $tblFileNameWoNum[3] ."_" . $tblFileNameWoNum[4] ;
			// echo $tmpFileNameWoNum ."_". $b . ".bmp" . "<br/>";
			if (file_exists(urldecode($tmpFileNameWoNum ."_". $b . ".bmp")))
			{
				echo "<a href=\"../" . $tmpFileNameWoNum ."_". $b . ".bmp\" class='stateRTP' download=\"" . $tmpFileNameWoNum ."_". $b . ".bmp\">Download #$b</a>";
				
				echo "<img src='../" . ($tmpFileNameWoNum ."_". $b) . ".bmp' class='imgRTP'>";
				
			}
			else 
			{ 
				// break; // On sort de la boucle... Les numéros doivent se suivre
				$tmpFileNameWoNum = $tblFileNameWoNum[0] . "_" . $tblFileNameWoNum[1] . "_" . $tblFileNameWoNum[2] . "_" . $tblFileNameWoNum[3]  ;
				if (file_exists(urldecode($tmpFileNameWoNum ."_". $b . ".bmp")))
				{
					echo "<a href=\"../" . $tmpFileNameWoNum ."_". $b . ".bmp\" class='stateRTP' download=\"" . $tmpFileNameWoNum ."_". $b . ".bmp\">Download #$b</a>";
					
					echo "<img src='../" . ($tmpFileNameWoNum ."_". $b) . ".bmp' class='imgRTP'>";
					
				}
			}
			
		}
		// echo "21<a href=\"". $_GET['source'] . "\" download=\"" . $_GET['source'] . "\">" . $_GET['source'] . "</a>";
		// echo "<img src='" . ($_GET['source']) . "' style='border:1px solid #606060'>";
	
		die();
	}
	
	echo "<img src='../" . ($_GET['source']) . "' class='imgRTP'>";
	
	echo "<a href=\"../". $_GET['source'] . "\" class='stateRTP' download=\"" . $_GET['source'] . "\">Download</a>";
	