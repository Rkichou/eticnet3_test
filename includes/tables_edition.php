<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	require_once("../class/manage_table.php"); 
	// Instantiation de la classe manage table
	$table=new manage_table();
	// Ouverture de la connection pour l'utilisation dans la class manage_table
	$table->open_mysqli();
	$table->set_master_table($_POST['tableName']);
	// Controle si edit une sous table (fonction js edit_sub_record)
	if(isset($_POST['returnTable']))
	{
		// indique la table de retour après enregistrement et l'id de retour
		$table->set_return_table($_POST['returnTable'],$_POST['returnID'],$_POST['linkID']);
	}
	//
	echo "<div class='as_agence-div-header-table'>";
		echo $table->get_header_edition($_POST['id']);
	echo "</div>";
	// Affichage des enregistrements de la table
	echo "<div class='as_agence-div-content-table'>";
		echo $table->edit_record($_POST['id']);
	echo "</div>";

?>  

