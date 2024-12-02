<?php
include('config.inc.php');

// Activer l'affichage des erreurs pour faciliter le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire et vérifier les champs vides
    $addressId = (int) $_POST['address_id'];
    
    // Utiliser mysqli_real_escape_string pour éviter les injections SQL et assigner NULL si vide
    $contact = !empty($_POST['contact']) ? "'" . mysqli_real_escape_string($con, $_POST['contact']) . "'" : 'NULL';
    $supplierCode = !empty($_POST['supplier_code']) ? "'" . mysqli_real_escape_string($con, $_POST['supplier_code']) . "'" : 'NULL';
    $addressName = !empty($_POST['address_name']) ? "'" . mysqli_real_escape_string($con, $_POST['address_name']) . "'" : 'NULL';
    $address1 = !empty($_POST['address_1']) ? "'" . mysqli_real_escape_string($con, $_POST['address_1']) . "'" : 'NULL';
    $address2 = !empty($_POST['address_2']) ? "'" . mysqli_real_escape_string($con, $_POST['address_2']) . "'" : 'NULL';
    $zip = !empty($_POST['zip']) ? "'" . mysqli_real_escape_string($con, $_POST['zip']) . "'" : 'NULL';
    $city = !empty($_POST['city']) ? "'" . mysqli_real_escape_string($con, $_POST['city']) . "'" : 'NULL';
    $region = !empty($_POST['region']) ? "'" . mysqli_real_escape_string($con, $_POST['region']) . "'" : 'NULL';
    $country = !empty($_POST['country']) ? "'" . mysqli_real_escape_string($con, $_POST['country']) . "'" : 'NULL';

    // Requête SQL pour mettre à jour l'adresse
    $query = "UPDATE users_adresses SET 
              contact = $contact, 
              code_supplier = $supplierCode, 
              adresse_name = $addressName, 
              adresse_1 = $address1, 
              adresse_2 = $address2, 
              zip = $zip, 
              city = $city, 
              state = $region, 
              country = $country 
              WHERE id = $addressId";

    // Exécuter la requête SQL
    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Address updated successfully']);
    } else {
        // Renvoie une erreur JSON avec le message d'erreur
        echo json_encode(['status' => 'error', 'message' => 'Failed to update address: ' . mysqli_error($con)]);
    }

    // Fermer la connexion
    mysqli_close($con);
}
?>
