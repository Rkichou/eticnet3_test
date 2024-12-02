<?php
include('config.inc.php'); // Inclure le fichier de configuration de la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs envoyées par la requête AJAX
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $prefix = mysqli_real_escape_string($con, $_POST['prefix']);

    // Vérifier si les champs ne sont pas vides
    if (!empty($name) && !empty($prefix)) {
        // Requête pour insérer la nouvelle marque dans la table contractors
        $sql = "INSERT INTO contractors (name, prefix) VALUES ('$name', '$prefix')";

        if (mysqli_query($con, $sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Brand added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add brand: ' . mysqli_error($con)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    }
}
?>
