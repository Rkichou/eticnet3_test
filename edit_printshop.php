<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    $sql = "UPDATE printshop SET name='$name', contact='$contact' WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "Printshop updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
