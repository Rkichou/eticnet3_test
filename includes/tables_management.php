<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	require_once("../class/manage_table.php"); 
	// Instantiation de la classe manage table
	$table=new manage_table();
	// Ouverture de la connection pour l'utilisation dans la class manage_table
	$table->open_mysqli();
	//
		// Ici on gère un caractère de type jocker qui indique que la table commence par le prefix contractor.
		if (substr($_POST['tableName'],0,1)=="*")
		{
			// echo "ixi";
			$_POST['tableName']=str_replace("*",$_SESSION['prefix_contractor'],$_POST['tableName']);
		}
	echo $_POST['tableName'];
	
	// die();
	$table->set_master_table($_POST['tableName']);
	echo "<div class='as_agence-div-header-table'>";
		echo $table->get_header();
	echo "</div>";
	// Affichage des enregistrements de la table
	echo "<div class='as_agence-div-content-table'>";
		echo $table->get_records();
	echo "</div>";

?>  

