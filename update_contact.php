<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $login = mysqli_real_escape_string($con, $_POST['login']);
    $contact_name = mysqli_real_escape_string($con, $_POST['contact_name']);
    $contact_email = mysqli_real_escape_string($con, $_POST['contact_email']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    // Requête de mise à jour du contact dans la table users_contacts
    $updateQuery = "UPDATE users_contacts 
                    SET login = '$login', 
                        contact_name = '$contact_name', 
                        contact_email = '$contact_email'
                    WHERE id = '$id'";

    if (mysqli_query($con, $updateQuery)) {
        echo "Contact mis à jour avec succès !";
    } else {
        echo "Erreur lors de la mise à jour du contact : " . mysqli_error($con);
    }
}
?>
