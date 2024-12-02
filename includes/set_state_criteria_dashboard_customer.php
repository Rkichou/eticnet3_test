<?php
	session_start();
	require_once("../config.inc.php");
	// défini le nombre de lignes affichées par table
	$tmp_tbl=explode("_",$_POST['table']);
	$table=$tmp_tbl[0];
	$name="state_criteria_" . $_POST['criteria_id'] . "_" . $table;
	$_SESSION[$name]=$_POST['criteria_value'] ;
	// Sauvegarde de la variable dans la table des sessions
	$sql="select * FROM users_sessions where id_user='" . $_SESSION['id'] . "' and session_name='" . $name . "' limit 1;";
	$retour=mysqli_query($con,$sql);  
	$row=mysqli_fetch_object($retour);
	$id=$row->id * 1;
	if($id==0)
	{
		// Création de l'enregistrement
		$sql="insert into users_sessions (id,id_user,session_name,session_value) value (";
		$sql.= "Null,";
		$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION['id']) . "\", ";
		$sql.= "\"" . mysqli_real_escape_string($con,$name) . "\", ";
		$sql.= "\"" . mysqli_real_escape_string($con,$_SESSION[$name]) . "\") ";
		$retour=mysqli_query($con,$sql); 
	}
	else
	{
		// Update de l'enregistrement
		$sql="update users_sessions set ";
		$sql.= "session_value=\"" . mysqli_real_escape_string($con,$_SESSION[$name]) . "\" where id=$id ";
		$retour=mysqli_query($con,$sql);
	}
?>

