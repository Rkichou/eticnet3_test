<?php
include('config.inc.php'); // Inclure la configuration de la base de données


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées via AJAX
    $id = (int)$_POST['id']; // Assurez-vous de convertir l'ID en entier pour des raisons de sécurité
    $prefix = mysqli_real_escape_string($con, $_POST['prefix']);
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $name = mysqli_real_escape_string($con, $_POST['name']);

    // Préparer la requête de mise à jour
    $query = "UPDATE services SET prefix_contractor='$prefix', code_service='$code', name='$name' WHERE id=$id";
    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($con)]);
    }
}
?>
