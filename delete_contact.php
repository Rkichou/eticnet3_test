
<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si l'ID du contact est bien envoyé
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $contactId = mysqli_real_escape_string($con, $_POST['id']);

        // Requête SQL pour supprimer le contact
        $query = "DELETE FROM users_contacts WHERE id = $contactId";

        // Exécuter la requête
        if (mysqli_query($con, $query)) {
            // Répondre avec succès
            echo json_encode(['status' => 'success', 'message' => 'Contact deleted successfully']);
        } else {
            // Répondre avec une erreur en cas d'échec de suppression
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete contact: ' . mysqli_error($con)]);
        }
    } else {
        // Répondre avec une erreur si l'ID n'est pas valide
        echo json_encode(['status' => 'error', 'message' => 'Invalid contact ID']);
    }

    // Fermer la connexion
    mysqli_close($con);
} else {
    // Si la requête n'est pas POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
