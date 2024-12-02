<?php
include('config.inc.php');

if (isset($_POST['id'])) {
    $roleId = (int) $_POST['id'];

    $query = "DELETE FROM roles WHERE id=$roleId";

    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete role']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
