<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id_user = mysqli_real_escape_string($con, $_POST['id_user']);
    $login = mysqli_real_escape_string($con, $_POST['login']);
    $password = mysqli_real_escape_string($con, $_POST['pwd']);
    $contact_name = mysqli_real_escape_string($con, $_POST['contact_name']);
    $contact_email = mysqli_real_escape_string($con, $_POST['contact_email']);

    // Hachage du mot de passe
    $hashedPassword = md5($password);

    // Requête d'insertion dans la table users_contacts
    $insertContactQuery = "INSERT INTO users_contacts 
        (id_user, login, pwd, contact_name, contact_email) 
        VALUES 
        ('$id_user', '$login', '$hashedPassword', '$contact_name', '$contact_email')";

    if (mysqli_query($con, $insertContactQuery)) {
        echo "Contact ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du contact : " . mysqli_error($con);
    }
}
?>
