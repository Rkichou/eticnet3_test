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
$TAB_M[1]='francesca_puddu@ratti.it';
$TAB_M[2]="claudio_bassenetti@ratti.it";
$TAB_M[3]="elisa_botta@ratti.it";
$TAB_M[4]="abutti@christiandior.com";




for($i=$_GET['id'];$i<=$_GET['id'];$i++)
{
	$_POST['email']=$TAB_M[$i];
	$new_password=generate_password();
	echo $_POST['email'] . ":" . $new_password;
	// On recherche l'adresse mail dans la table users 
	$sql="select * from  users where `user_email` ='" .  mysqli_real_escape_string($con,$_POST['email']) . "' limit 1";
	$retour=mysqli_query($con,$sql);
	$email_trouve=false;
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
					Login:$login
					<br/>
					Password:$new_password
					<br/><br/>
					En cas de problème vous pouvez envoyer un mail à supportit@eticeurope.com
					<br/><br/>Télécharger la documentation à l'adresse suivante : https://myeticnet.eticeurope.com/documentations/myeticnet_supplier_dior_documentation.pdf
					<br/><br/>
					<br/>Cordialement,
					<br/>L'équipe myeticnet
					";
		$messageEN="
					Hello $name,
					<br/><br/>Below you will find your login credentials for your myeticnet.eticeurope.com platform.
					<br/><br/>
					Login:$login
					<br/>
					Password:$new_password
					<br/><br/>
					In case of problem you can send an email to supportit@eticeurope.com
					<br/><br/>Follows this link to download the documentation : https://myeticnet.eticeurope.com/documentations/myeticnet_supplier_dior_documentation.pdf
					<br/><br/>
					Sincerely,
					<br/>The myeticnet team
					";
		// Envoi du mail
		$pj[0]="/home/eticnet/www/documentations/myeticnet_supplier_dior_documentation.pdf";
		$retourMail=send_mail($mail,$sujet,$messageEN . "<hr/>" . $messageFR,$pj);
		if ($retourMail==1)
		{
			// Mise à jour de la base de données
			$sql="update users set `pwd`=\"" . md5($new_password) . "\" where `id` ='" .  mysqli_real_escape_string($con,$id) . "' limit 1";
			$retour=mysqli_query($con,$sql); 
			
			echo "<br/>1 An email containing your login and password has just been sent to the following email address:$email.\nRemember to check your spam folder!.\nUn email contenant votre identifiant et votre mot de passe vient d'être envoyé à l'adresse mail suivante :$mail.\nPensez à vérifier votre dossier spam !";
		}
		elseif($retourMail==0)
		{
			echo "<br/>Error to send mail at $mail / Erreur d'envoi du mail à $mail";
		}
		else
		{
			echo "<br/>Error 2 to send mail at $mail / Erreur 2 d'envoi du mail à $mail";
		}
		$email_trouve=true; // On a trouvé le mail ! Fin du script 
	}
	if($email_trouve==false)
	{
		// On recherche l'adresse mail dans la table users_contacts
		$sql="select * from  users_contacts where `contact_email` ='" .  mysqli_real_escape_string($con,$_POST['email']) . "' limit 1";
		$retour=mysqli_query($con,$sql); 
		if(mysqli_num_rows($retour)==1)
		{
			$row=mysqli_fetch_object($retour);
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
						<br/><br/>Télécharger la documentation à l'adresse suivante : https://myeticnet.eticeurope.com/documentations/myeticnet_supplier_dior_documentation.pdf
						<br/><br/>
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
						<br/><br/>Follows this link to download the documentation : https://myeticnet.eticeurope.com/documentations/myeticnet_supplier_dior_documentation.pdf
						<br/><br/>
						Sincerely,
						<br/>The myeticnet team
						";
			// Envoi du mail
			$pj[0]="/home/eticnet/www/documentations/myeticnet_supplier_dior_documentation.pdf";
			$retourMail=send_mail($mail,$sujet,$messageEN . "<hr/>" . $messageFR,$pj);
			if ($retourMail==1)
			{
				// Mise à jour de la base de données
				$sql="update users_contacts set `pwd`=\"" . md5($new_password) . "\" where `id` ='" .  mysqli_real_escape_string($con,$id) . "' limit 1";
				$retour=mysqli_query($con,$sql); 
				// echo $sql . "<br/>" . $new_password;
				echo "<br/> 2 An email containing your login and password has just been sent to the following email address:$mail.\nRemember to check your spam folder!.\nUn email contenant votre identifiant et votre mot de passe vient d'être envoyé à l'adresse mail suivante :$mail.\nPensez à vérifier votre dossier spam !";
			}
			elseif($retourMail==0)
			{
				echo "<br/>Error to send mail at $mail / Erreur d'envoi du mail à $mail";
			}
			else
			{
				echo "<br/>Error (2) to send mail at $mail / Erreur (2) d'envoi du mail à $mail";
			}
			// die();
		}
	}
	// echo "Cette adresse email est inconnue dans notre base de données. / This email address is unknown in our database.";
}
?>

