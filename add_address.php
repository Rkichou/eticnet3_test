<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id_user = mysqli_real_escape_string($con, $_POST['id_user']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $supplier_code = mysqli_real_escape_string($con, $_POST['supplier_code']);
    $address_name = mysqli_real_escape_string($con, $_POST['address_name']);
    $address_1 = mysqli_real_escape_string($con, $_POST['address_1']);
    $address_2 = mysqli_real_escape_string($con, $_POST['address_2']);
    $zip = mysqli_real_escape_string($con, $_POST['zip']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $country = mysqli_real_escape_string($con, $_POST['country']);

    // Requête d'insertion dans la table users_adresses
    $insertAddressQuery = "INSERT INTO users_adresses 
        (id_user, adresse_name, contractor, code_supplier, adresse_1, adresse_2, zip, city, state, country) 
        VALUES 
        ('$id_user', '$address_name', '$contact', '$supplier_code', '$address_1', '$address_2', '$zip', '$city', '$state', '$country')";

    if (mysqli_query($con, $insertAddressQuery)) {
        echo "Adresse ajoutée avec succès !";
    } else {
        echo "Erreur lors de l'ajout de l'adresse : " . mysqli_error($con);
    }
}
?>
