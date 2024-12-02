<?php
include('config.inc.php');

if (isset($_POST['id']) && isset($_POST['name'])) {
    $roleId = (int) $_POST['id'];
    $roleName = mysqli_real_escape_string($con, $_POST['name']);

    $query = "UPDATE roles SET name='$roleName' WHERE id=$roleId";

    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update role']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
