<?php
require_once("config.inc.php");

if (isset($_GET['prefix_contractor'])) {
    $prefix = mysqli_real_escape_string($con, $_GET['prefix_contractor']);

    // Query to fetch services based on contractor prefix
    $servicesQuery = "SELECT * FROM services WHERE prefix_contractor = '$prefix'";
    $servicesResult = mysqli_query($con, $servicesQuery);

    $services = [];
    while ($service = mysqli_fetch_assoc($servicesResult)) {
        $services[] = $service;
    }

    // Return the services as JSON
    header('Content-Type: application/json');
    echo json_encode($services);
    exit;
}
