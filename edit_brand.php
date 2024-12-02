<?php
include('config.inc.php'); // Inclure le fichier de configuration de la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs envoyées par la requête AJAX
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $prefix = mysqli_real_escape_string($con, $_POST['prefix']);

    // Vérifier si les champs ne sont pas vides
    if (!empty($id) && !empty($name) && !empty($prefix)) {
        // Requête pour mettre à jour la marque
        $sql = "UPDATE contractors SET name='$name', prefix='$prefix' WHERE id='$id'";

        if (mysqli_query($con, $sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Brand updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update brand: ' . mysqli_error($con)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    }
}
?>
