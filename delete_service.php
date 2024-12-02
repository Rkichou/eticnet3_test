<?php
include('config.inc.php'); // Inclure la configuration de la base de données


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID du service à supprimer
    $id = (int)$_POST['id']; // Assurez-vous de convertir l'ID en entier pour des raisons de sécurité

    // Préparer la requête de suppression
    $query = "DELETE FROM services WHERE id=$id";
    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($con)]);
    }
}
?>
