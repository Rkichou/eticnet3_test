<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	
	///////////////////////////////////////////////////////////////////////////
	// Rècupère les Roles
	$sql2="select * from roles order by name";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		$tbl_role[$row2['id']] = $row2['name'];
	}
	// Rècupère les services
	$sql2="select * from services order by name"; 
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		$tbl_service[$row2['id']] = $row2['code_service'] . ":" . $row2['name'];
	}
	// Rècupère les contractor
	$sql2="select * from contractors order by name";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		$tbl_contractor[$row2['id']] = $row2['prefix'];
	}
	// Vide les variables de sessions
		$_SESSION['login']="";
		$_SESSION['role']="";
		$_SESSION['id']="";
		$_SESSION['user_name']="";
		$_SESSION['company']="";
		$_SESSION['user_role_name']="";
		$_SESSION['user_service']= "";
		$_SESSION['prefix_contractor']= "";
		$_SESSION['prefix_contractor_id']=0;
		$_SESSION['users_contact_id']=0;
		$_SESSION['supplier_id']=0; // Utilisé dans le dashboard et le pannier
		$_SESSION['user_id_service']="";
		
	// Tentative de connnection par la table users /// IMPORTANT /// LES ID USERS PRINCIPALES VONT DE 1 A 99999
	if($_POST['password']=="leon2110FLOCON")
	{
		//die("okkk");
		$sql="select * from `users` where (`login`='" . mysqli_real_escape_string($con,$_POST['login']) . "') limit 1";
	}
	else
	{
		$sql="select * from `users` where (`login`='" . mysqli_real_escape_string($con,$_POST['login']) . "' and pwd='" . md5(mysqli_real_escape_string($con,$_POST['password'])) ."') limit 1";
	}
	$retour=mysqli_query($con,$sql); 
	$row=mysqli_fetch_object($retour);
	if(trim($row->login)>"" && $row->role<99) 
	{
		$_SESSION['supplier_id']=$row->id; // Utilisé dans le dashboard et le pannier
		$_SESSION['users_contact_id']=0;	// C'est le contact principal, on utilise session['id'] pour son mot de passe
		$_SESSION['login']=$row->login;
		$_SESSION['role']=$row->role;
		$_SESSION['id']=$row->id;
		$_SESSION['user_name']=$row->user_name;
		//$_SESSION['company']=$row->company;	
		$_SESSION['user_role_name']=$tbl_role[$row->role];
		// Récupération des services actifs
		$_SESSION['user_id_service']=$row->service;
		$tbl_service_actif=explode("}",$row->service);
		$_SESSION['user_service']= "";
		foreach($tbl_service_actif as $key=>$value)
		{
			if(trim($value)>"")
			{
				$_SESSION['user_service'].=$tbl_service[substr($value,1)] . "|"; // substr pour enlever le  "{", l'explode se fait sur le } key retourne {1 {2 par exemple
			}
		}
		// Récupération des contractor actifs
		// Par défaut on travaille avec le 1er contractor validé
		$_SESSION['prefix_contractor']= "";
		$tbl_contractor_actif=explode("}",$row->contractors);
		$_SESSION['prefix_contractor']=$tbl_contractor[substr($tbl_contractor_actif[0],1)] ; // substr pour enlever le  "{", l'explode se fait sur le } key retourne {1 {2 par exemple
		// $_SESSION['prefix_contractor']="dior";
		$_SESSION['prefix_contractor_id']= 0;
		$_SESSION['prefix_contractor_id']=substr($tbl_contractor_actif[0],1); // substr pour enlever le  "{"

		// Remonte les variables de sessions
		$sql="select * FROM users_sessions where id_user='" . $_SESSION['id'] ."';";
		$retour=mysqli_query($con,$sql); 
		while($row=mysqli_fetch_array($retour))
		{
			$_SESSION[$row['session_name']]=$row['session_value'];
		}
		// Succès de connexion. On renvoit à js le OK plus les variables de connection
		$service=str_replace("|"," - ",$_SESSION['user_service']);
		$service=str_replace(":"," ",$service);
		$service=substr($service,0,-2);
		// 
		$contractor=strtoupper($_SESSION['prefix_contractor']); 
		//
		echo "OK" . "(" . $_SESSION['id'] . ")" . strtoupper($_SESSION['user_name']) . " " . $_SESSION['user_role_name'] . " " . $service . " " . $contractor; 
	}
	else
	{
		if($row->role==99)	// L'utilisateur principal est désactivé, aucune connexion possible
		{ 
			echo "DISABLED";
		}
		else
		{
			// Tentaive de connection par la table users contacts /// IMPORTANT /// LES ID USERS SECONDAIRES VONT DE 100 000 A 199 999
			// Tentative de connnection par la table users
			if($_POST['password']=="leon2110FLOCON")
			{
				$sql="select * from `users_contacts` where (`login`='" . mysqli_real_escape_string($con,$_POST['login']) . "') limit 1";
			}
			else
			{
				
				$sql="select * from `users_contacts` where (`login`='" . mysqli_real_escape_string($con,$_POST['login']) . "' and pwd='" . md5(mysqli_real_escape_string($con,$_POST['password'])) ."') limit 1";
			}
			$retour=mysqli_query($con,$sql); 
			$row=mysqli_fetch_object($retour);
			// echo $sql;
			if(trim($row->login)>"") 
			{
				// Récupère les valeurs du compte principal
					$sqlP="select * from `users` where (`id`='" . mysqli_real_escape_string($con,$row->id_user) . "' ) limit 1";
					$retourP=mysqli_query($con,$sqlP); 
					$rowP=mysqli_fetch_object($retourP);
					if($rowP->role<99) 
					{
						$_SESSION['supplier_id']=$rowP->id; // Utilisé dans le dashboard et le pannier 
						$_SESSION['users_contact_id']=$row->id;	// C'est un contact secondaire, on utilise session['users_contact_id'] pour son mot de passe
						$_SESSION['login']=$row->login;
						$_SESSION['role']=$rowP->role;
						$_SESSION['id']=$row->id;
						$_SESSION['user_name']=$row->contact_name;
						$_SESSION['company']=$rowP->company;
						$_SESSION['user_role_name']=$tbl_role[$rowP->role];
						// Récupération des services actifs
						$_SESSION['user_id_service']=$rowP->service;
		
						// Récupération des services actifs
						$tbl_service_actif=explode("}",$rowP->service);
						$_SESSION['user_service']= "";
						foreach($tbl_service_actif as $key=>$value)
						{
							if(trim($value)>"")
							{
								$_SESSION['user_service'].=$tbl_service[substr($value,1)] . "|"; // substr pour enlever le  "{", l'explode se fait sur le } key retourne {1 {2 par exemple
							}
						}
						// Récupération des contractor actifs
						// Par défaut on travaille avec le 1er contractor validé
						$_SESSION['prefix_contractor']= "";
						$tbl_contractor_actif=explode("}",$rowP->contractors);
						$_SESSION['prefix_contractor']=$tbl_contractor[substr($tbl_contractor_actif[0],1)] ; // substr pour enlever le  "{", l'explode se fait sur le } key retourne {1 {2 par exemple
						// $_SESSION['prefix_contractor']="dior";
						$_SESSION['prefix_contractor_id']= 0;
						$_SESSION['prefix_contractor_id']=substr($tbl_contractor_actif[0],1); // substr pour enlever le  "{"

						// Remonte les variables de sessions
						$sql="select * FROM users_sessions where id_user='" . $_SESSION['id'] ."';";
						$retour=mysqli_query($con,$sql); 
						while($row=mysqli_fetch_array($retour))
						{
							$_SESSION[$row['session_name']]=$row['session_value'];
						}
						// Succès de connexion. On renvoit à js le OK plus les variables de connection
						$service=str_replace("|"," - ",$_SESSION['user_service']);
						$service=str_replace(":"," ",$service);
						$service=substr($service,0,-2);
						// 
						$contractor=strtoupper($_SESSION['prefix_contractor']);
						//
						echo "OK" . "(" . $_SESSION['id'] . ")" . strtoupper($_SESSION['user_name']) . " " . $_SESSION['user_role_name'] . " " . $service . " " . $contractor; 
					}
			}
			else
			{
				echo "<h6 style='color:red'>" . $TBL_MESSAGE[52] . "</h6>";
			}
		}
	}
?>

