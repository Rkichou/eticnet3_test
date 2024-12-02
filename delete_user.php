<?php
include('config.inc.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id']; // Récupérer l'ID envoyé via AJAX

    // Requête SQL pour supprimer l'utilisateur
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete user: ' . $stmt->error]);
    }

    $stmt->close();
    $con->close();
}
?>