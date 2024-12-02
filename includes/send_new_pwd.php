<?php
	session_start();
	require_once("../config.inc.php");
	// Charge le script d'envoi d'email 
	require_once('./send_email.php');
	// Function qui génère un nouveau mot de passe
	function generate_password() 
	{
		$password = '';
		$password .= chr(rand(65, 90)); //A->Z
		$password .= chr(rand(48, 57)); //Numbers 
		$password .= chr(rand(97, 122)); //a->z
		$password .="?";
		$password .= chr(rand(65, 90)); //A->Z
		$password .= chr(rand(48, 57)); //Numbers 
		$password .=".";
		$password .= chr(rand(97, 122)); //a->z
		$password .= chr(rand(65, 90)); //A->Z
		$password .= chr(rand(48, 57)); //Numbers 
		$password .="!";
		$password .= chr(rand(97, 122)); //a->z
		// ATTENTION PAS DE CARACTERES SPECIAUX ILS PASSENT MAL DANS LES MAILS SAUF CEUX MIS PAR DEFAUT : 		.?!
		return $password;
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Génération du nouveau mot de passe
	$new_password=generate_password();
	$error="";$pj= array();
	// On recherche l'adresse mail dans la table users 
	$sql="select * from  users where `user_email` ='" .  mysqli_real_escape_string($con,$_POST['email']) . "' limit 1";
	$retour=mysqli_query($con,$sql); 

	// On recherche l'adresse mail dans la table users_contacts
	$sqlContact="select * from  users_contacts where `contact_email` ='" .  mysqli_real_escape_string($con,$_POST['email']) . "' limit 1";
	$retourContact=mysqli_query($con,$sqlContact); 

	if(mysqli_num_rows($retour)==1)
	{
		$row=mysqli_fetch_object($retour);
		// C'est un email principal, on envoi le mail avec les éléments de connexion
		$sujet="Your account credential to connect on myeticnet";
		$name=$row->user_name;
		$mail=$row->user_email;
		$login=$row->login;
		$id=$row->id;
		$messageFR="
					Bonjour $name,
					<br/><br/>Vous trouverez ci-dessous vos identifiants de connexion à votre plate-forme myeticnet.eticeurope.com.
					<br/><br>
					Login : $login
					<br/>
					Password : $new_password
					<br/><br/>
					En cas de problème vous pouvez envoyer un mail à supportit@eticeurope.com
					<br/>Cordialement,
					<br/>L'équipe myeticnet
					";
		$messageEN="
					Hello $name,
					<br/><br/>Below you will find your login credentials for your myeticnet.eticeurope.com platform.
					<br/><br/>
					Login: $login
					<br/>
					Password: $new_password
					<br/><br/>
					In case of problem you can send an email to supportit@eticeurope.com
					<br/><br/>
					Sincerely,
					<br/>The myeticnet team
					";
		// Envoi du mail
		$retourMail=send_mail($mail,$sujet,$messageEN . "<hr/>" . $messageFR,$pj);
		if ($retourMail==1)
		{
			// Mise à jour de la base de données
			$sql="update users set `pwd`=\"" . md5($new_password) . "\" where `id` ='" .  mysqli_real_escape_string($con,$id) . "' limit 1";
			$retour=mysqli_query($con,$sql); 
			
			$erreur=false;
		}
		elseif($retourMail==0)
		{
			$erreur=true;
			$error.= "Error to send mail at $mail / Erreur d'envoi du mail à $mail";
		}
		else
		{
			$error.= "Error 2 to send mail at $mail / Erreur 2 d'envoi du mail à $mail";
		}
	 // On a trouvé le mail ! Fin du script 
	}
	else if(mysqli_num_rows($retourContact)==1)
	{
		$row=mysqli_fetch_object($retourContact);
		// C'est un email secondaire, on envoi le mail avec les éléments de connexion
		$sujet="Your account credential to connect on myeticnet";
		$name=$row->contact_name;
		$mail=$row->contact_email;
		$login=$row->login;
		$id=$row->id;
		$messageFR="
					Bonjour $name,
					<br/><br/>Vous trouverez ci-dessous vos identifiants de connexion à votre plate-forme myeticnet.eticeurope.com.
					<br/><br>
					Login : $login
					<br/>
					Password : $new_password
					<br/><br/>
					En cas de problème vous pouvez envoyer un mail à supportit@eticeurope.com
					<br/>Cordialement,
					<br/>L'équipe myeticnet
					";
		$messageEN="
					Hello $name,
					<br/><br/>Below you will find your login credentials for your myeticnet.eticeurope.com platform.
					<br/><br/>
					Login: $login
					<br/>
					Password: $new_password
					<br/><br/>
					In case of problem you can send an email to supportit@eticeurope.com
					<br/><br/>
					Sincerely,
					<br/>The myeticnet team
					";
		// Envoi du mail
		
		$retourMail=send_mail($mail,$sujet,$messageEN . "<hr/>" . $messageFR,$pj);
		if ($retourMail==1)
		{
			// Mise à jour de la base de données
			$sql="update users_contacts set `pwd`=\"" . md5($new_password) . "\" where `id` ='" .  mysqli_real_escape_string($con,$id) . "' limit 1";
			$retour=mysqli_query($con,$sql); 
			// echo $sql . "<br/>" . $new_password; 
			$erreur=false;
			
		}
		elseif($retourMail==0)
		{
			$error.= "Error to send mail at $mail";
		}
		else
		{
			$error.= "Error (2) to send mail at $mail ";
		}
	}
	else{
		$erreur=true;
	}
	echo "<div class='main_reset_password'>";
	if($erreur==false){
		echo "<h1>Password reset e-mail sent</h1>";
		echo "<p>An e-mail has been sent to your address  $mail </br> Follow the instructions provided to reset your password. </p>";

		echo "<button class='Conex-btn' onclick=\"window.location.href='login.php'\">Connexion page</button>";
	}
	else{
		echo "<p style='color:red'>This email address is unknown to our database.</p>";
		echo "<p style='color:red'>". $error ."</p>";
	}
	echo "</div>";
?>

