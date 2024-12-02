<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO printshop (name, contact) VALUES ('$name', '$contact')";
    if (mysqli_query($con, $sql)) {
        echo "Printshop added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
