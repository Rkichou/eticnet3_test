<?php
include('config.inc.php');

// Vérifie si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données envoyées via AJAX
    $messageid = mysqli_real_escape_string($con, $_POST['messageid']);
    $roleName = mysqli_real_escape_string($con, $_POST['name']);
    
    // Vérifie si les champs ne sont pas vides
    if (!empty($messageid) && !empty($roleName)) {
        // Requête SQL pour insérer le nouveau rôle dans la base de données
        $query = "INSERT INTO roles (id_message, name) VALUES ('$messageid', '$roleName')";
        if (mysqli_query($con, $query)) {
            // Réponse en cas de succès
            echo json_encode(['status' => 'success', 'message' => 'Role added successfully']);
        } else {
            // En cas d'erreur SQL
            echo json_encode(['status' => 'error', 'message' => 'Failed to add role. MySQL error: ' . mysqli_error($con)]);
        }
    } else {
        // Si les champs sont vides
        echo json_encode(['status' => 'error', 'message' => 'Role ID and Name cannot be empty']);
    }
} else {
    // Si la requête n'est pas POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>
