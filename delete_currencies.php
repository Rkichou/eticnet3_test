<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM devises WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "Currency deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>
