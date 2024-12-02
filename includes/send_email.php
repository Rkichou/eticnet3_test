<?php
	// /Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require '../vendor/autoload.php';
	//
	require_once("../config.inc.php");
	// Function pour envoyer le mail
	function send_mail($email,$sujet,$msg,$pieceJointes)
	{
											// Pour ajouter des pièces jointes, passer les chemins de fichiers dans un array
		// Récupère l'identifiant de connexion mysqli pour vérifier l'existence du mail destinataire dans la base myeticnet 
		global $con;
		// Création du mail
		$from = "noreply@myeticnet.com \r\n";
		$entete  = "MIME-Version: 1.0 \r\n";
		$entete .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		$entete .= "From: $from <noreply@myeticnet.com> \r\n";
		$entete .= "Reply-to: $from \r\n";
		$entete .= "X-Mailer: PHP \r\n";
		$entete .= "X-Priority: 1 \r\n";
		$entete .= "Return-Path: <noreply@myeticnet.com> \r\n";
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$message="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
		$message.="<HTML><HEAD>";
		$message.="<META http-equiv=Content-Type content=\"text/html; charset=iso-8859-1\">";
		$message.="<META content=\"MSHTML 6.00.6000.16809\" name=GENERATOR>";
		$message.="<STYLE></STYLE>";
		$message.="</HEAD>";
		$message.="<BODY bgColor=#ffffff>";
		$message.="<DIV>";
		$message.="<DIV style=\"FONT-SIZE: 10pt; COLOR: #000000; FONT-FAMILY: Arial; LETTER-SPACING: 1pt; mso-bidi-font-size: 12.0pt; mso-ansi-language: FR; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; mso-fareast-language: FR; mso-bidi-language: AR-SA\">";
		$message.=$msg;
		$message.="</DIV>";
		$message.="<DIV>";
		$message.="<br/>";
		$message.="<img src='cid:imgLogo' style='width:50%;margin-left:0%;border:0px solid #202020'><br/>";
		$message.="<br/>";
		$message.="</DIV>";
		$message.="	<DIV style=\"FONT-SIZE: 8pt; COLOR: #494949; FONT-FAMILY: Arial; LETTER-SPACING: 1pt; mso-bidi-font-size: 12.0pt; mso-ansi-language: FR; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; mso-fareast-language: FR; mso-bidi-language: AR-SA\">";
		$message.="<hr/>Ce message et toutes les pièces jointes (ci-après le 'message') sont confidentiels et établis à l'attention exclusive de ses destinataires. Toute utilisation ou diffusion non autorisée est interdite. Tout message électronique est susceptible d'altération. Etic Europe décline toute responsabilité au titre de ce message s'il a été altéré, déformé ou falsifié. Afin de contribuer au respect de l'environnement, merci de n'imprimer ce courrier qu'en cas de nécessité. This message and any attachments ( the 'message') are confidential and intended solely for the addressees. Any unauthorised use or dissemination is prohibited. E-mails are susceptible to alteration. Etic Europe shall be liable for the message if altered, changed or falsified. Before printing this mail, please consider the environment.";
		$message.="</DIV>";

		$message.="</DIV></BODY></HTML>";
		/////////////////////////////////////////////
		$adressBBC			=	"supportit@eticeurope.com";
		$destinataire 		= 	$email;
		require_once('../mail_credential.inc');
		$adresseReceive 	=	$adresseSender;
		$first				=	$adresseSender;
		$last				=	$adresseSender; 
		$mail           	= 	new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
												// 1 = errors and messages
										   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		// $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "myeticnet.com";      // sets OVH as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the OVH server
		$mail->Username   = $adresseSender;  		// MAIL username
		$mail->Password   = $pwdSender;            // MAIL password
		$mail->SetFrom($adresseSender, $first );
		$mail->AddReplyTo($adresseSender,$first );
		$mail->Subject    = mb_convert_encoding($sujet, 'ISO-8859-1', 'UTF-8');
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->MsgHTML(mb_convert_encoding($message, 'ISO-8859-1', 'UTF-8'));
		$mail->AddAddress($destinataire);
		$mail->AddBCC($adressBBC);
		$nomImage="../images/logoMail.png" ;
		$mail->addEmbeddedImage($nomImage, "imgLogo");
		// Ajoute les pièces jointes
		foreach($pieceJointes as $key=>$value)
		{
			$mail->addAttachment($value);
		}
		
		
		// Ici on vérifie si on connait le mail de réception dans la table users ou users_contacts
		// Si inconnu on envoi pas le mail.
		// Vérification dans la table users
		$isMailOK=false;
		$sql="select * from  users where `user_email` ='" .  mysqli_real_escape_string($con,$email) . "' limit 1";
		$retour=mysqli_query($con,$sql);
		if(mysqli_num_rows($retour)==1)
		{
			$isMailOK=true;
		}
		// Vérification dans la table users_contacts 
		if($isMailOK==false)
		{
			$sql="select * from  users_contacts where `contact_email` ='" .  mysqli_real_escape_string($con,$email) . "' limit 1";
			$retour=mysqli_query($con,$sql);
			if(mysqli_num_rows($retour)==1)
			{
				$isMailOK=true;
			}
		}
		// unset($mail);//  
		// Si pas de mails dans la base myeticnet on retourne un code erreur 2
		if($isMailOK==false)
		{
			return 2;
		}
		if($mail->Send())
		{
			return 1;	// Le mail est bien parti
		}
		else
		{
			return 0;	// Le mail est en echec
		}
	}
?>

