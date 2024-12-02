<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $parity_euro = $_POST['parity_euro'];

    $sql = "INSERT INTO devises (name, parity_euro) VALUES ('$name', '$parity_euro')";
    if (mysqli_query($con, $sql)) {
        echo "Currency added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>
