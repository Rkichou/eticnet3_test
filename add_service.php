<?php
include('config.inc.php'); // Inclure la configuration de la base de données


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées via AJAX
    $prefix = mysqli_real_escape_string($con, $_POST['prefix']);
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $name = mysqli_real_escape_string($con, $_POST['name']);

    // Préparer la requête d'insertion
    $query = "INSERT INTO services (prefix_contractor, code_service, name) VALUES ('$prefix', '$code', '$name')";
    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($con)]);
    }
}
?>
