<?php
	session_start();
	require_once("../config.inc.php");
		// Abandonne la modification ou la création dans une table
		// Création ou modification en fonction de la valeur du champs id_to_save	
			if($_POST['id_to_save']==0)
			{
				// C'est une création d'enregistrement abandonné
				$sql=" delete from " .  mysqli_real_escape_string($con,$_POST['_table_name_']) . " where id='" . mysqli_real_escape_string($con,$_POST['_record_id_']) . "' limit 1;";
				$retour=mysqli_query($con,$sql); 
			}
		// Analyse la table de retour (renvoyé vers la fonction JS save_record())
		// Envoie une fonction suivi de la table de retour
		// La fonction 1 indique un retour simple vers une table master
		// La fonction 2 renvoie une fonction d'édition de la table master avec l'id de l'enregistrement en cours d'édition
		if(!isset($_POST['_return_table_']))
		{
			echo "1|" . $_POST['_table_name_'];
		}
		else
		{
			echo "2|" . $_POST['_return_table_'] . "|" . $_POST['_return_id_'] ;
		}
		
	?>
