<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	list($width, $height) = getimagesize($_GET['source']);
		// echo $width . "<br/>" . $height ;
		$width=$width/12;
		$height=$height/12;
	echo "largeur " . $width . "mm X longueur " . $height . "mm";  
	echo "<a href=\"". $_GET['source'] . "\" download=\"" . $_GET['source'] . "\">Download</a>";
	echo "<hr/>";
	echo "<img src='" . ($_GET['source']) . "?dt=" . date('YmdHis'). "'>";	
	echo "<hr/>";
	echo "<a href=\"". $_GET['source'] . "\" download=\"" . $_GET['source'] . "\">Download</a>";
	