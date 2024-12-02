<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $parity_euro = $_POST['parity_euro'];

    $sql = "UPDATE devises SET name='$name', parity_euro='$parity_euro' WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "Currency updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>
