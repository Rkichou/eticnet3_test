<?php
	session_start();
	require_once("../config.inc.php");
	// Charge le script d'envoi d'email 
	require_once('./send_email.php');
	// Function qui génère un nouveau mot de passe
	$nom=$email=$countryCode=$phone=$company=$message="";
	// Vérifier que la requête est bien en POST
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		// Récupérer et nettoyer les données POST
		$nom = trim($_POST["name"] ?? "");
		$email = trim($_POST["email"] ?? "");
		$countryCode = trim($_POST["country-code"] ?? "");
		$phone = trim($_POST["phone"] ?? "");
		$company = trim($_POST["company"] ?? "");
		$message = trim($_POST["message"] ?? "");
	}
	$error="";$pj= array();
	
		// C'est un email principal, on envoi le mail avec les éléments de connexion
		$sujet="Eticnet Demo Request";
		$name="Benjamin Auger";
		$mail="b.auger@eticeurope.com";
		
		$messageEN="
					Hello $name,
					<br/><br/>Below you will find a new demo request. Here's the data sent.
					<br/><br/>
					Name: $nom <br>
					Email: $email <br>
					Phone number: $countryCode $phone <br>
					Company: $company <br>
					Message: $message <br>
					<br/><br/>
					Sincerely,
					<br/>The myeticnet team
					";
		// Envoi du mail
		$retourMail=send_mail($mail,$sujet,$messageEN ,$pj);
		if ($retourMail==1)
		{			
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
	
?>

