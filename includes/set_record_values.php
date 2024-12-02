<?php
	session_start();
	require_once("../config.inc.php");
		// Enregistre la modification ou la création dans une table
		// Récupère les attributs de la table
		$sql="select * from attributs_tables where table_name='" . $_POST['_table_name_'] . "';";
		$retour=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($retour))
		{
			$TBL_Attributs[$row['field_name']]=$row['attributs'];
		}
		// Création ou modification en fonction de la valeur de l'ID	
		if($_POST['_record_id_'] * 1==0)
		{
			///////////////// OBSOLETE /////////////////////////////////////////
			// ATTENTION L'ENREGISTREMENT EST CREE PAR UNE PREMIERE FONCTION
			// LA CREATION EST INUTILE A CE NIVEAU
			
			// Création de l'enregistrement
			// $sql="insert into users_sessions (id,user_id,session_name,session_value) value (";
			// $sql.= "Null,";
			// $sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
			// $sql.= "\"" . mysqli_real_escape_string($con,$name) . "\", ";
			// $sql.= "\"" . mysqli_real_escape_string($con,$_SESSION[$name]) . "\") ";
			// $retour=mysqli_query($con,$sql); 
		}
		else	// C'est TOUJOURS LE CAS 
		{
			// Update de l'enregistrement
			$sql="update `" . $_POST['_table_name_']. "` set ";
			foreach($_POST as $key=>$value)
			{
				// Transforme value avec htmlspecialchars - 		ATTENTION NE JAMAIS CHANGER LES PARAMETRES
				$value=htmlentities($value,ENT_QUOTES ,"UTF-8");//  IL FAUT TOUJOURS LAISSER CETTE LIGNE ET NE PAS LA CHANGER
				// On ne traite que les posts qui concerne les champs de la table
				
				if($key!="_table_name_" && $key!="_record_id_" && $key!="_return_table_" && $key!="_return_id_"  && $key!="id")
				{
					if(isset($TBL_Attributs[$key]))
					{
						// Analyse les Attributs
						$TBL_tmp=explode(" ",$TBL_Attributs[$key]);
						switch($TBL_tmp[0])
						{
							case "LIST":
							{
								$sql.= $key . "=\"" . mysqli_real_escape_string($con,$value) . "\",";
								break;
							}
							case "PASSWORD":
							{
								// Aucune valeur pour les mots de passe
								if(trim($value)>"")	// On ne modifie le password que si il est saisi.
								{
									$sql.= $key . "=\"" . mysqli_real_escape_string($con,md5($value)) . "\",";
								}
								break;
							}
							default:
							{
								$sql.= $key . "=\"" . mysqli_real_escape_string($con,$value) . "\",";
								break;
							}
						}
					}
					else
					{
						// Aucun attribut traitement standard
						$sql.= $key . "=\"" . mysqli_real_escape_string($con,$value) . "\",";
					}
				}
			}
			$sql=substr($sql,0,-1);	// Supprime la dernière virgule
			$sql.=" where id='" . $_POST['_record_id_'] . "';";
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
		// echo $sql;
		// echo "<hr/>";
		// print_r($_POST);
	?>
