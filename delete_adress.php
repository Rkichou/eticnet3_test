
<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $addressId = $_POST['id'];

    // Requête SQL pour supprimer l'adresse
    $query = "DELETE FROM users_adresses WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $addressId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete address']);
    }

    $stmt->close();
    $con->close();
}
?>
