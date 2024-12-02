<?php
include('config.inc.php'); // Inclure le fichier de configuration de la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID de la marque à supprimer
    $id = mysqli_real_escape_string($con, $_POST['id']);

    // Vérifier si l'ID n'est pas vide
    if (!empty($id)) {
        // Requête pour supprimer la marque de la table contractors
        $sql = "DELETE FROM contractors WHERE id='$id'";

        if (mysqli_query($con, $sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Brand deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete brand: ' . mysqli_error($con)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Brand ID is required']);
    }
}
?>
