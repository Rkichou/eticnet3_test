<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '1G');
ini_set('max_execution_time', 300);
require_once("config.inc.php");
session_start();

if (isset($_POST['ajax_search'])) { // Détecte une requête AJAX
    $searchQuery = isset($_POST['search_query']) ? mysqli_real_escape_string($con, $_POST['search_query']) : '';
    $whereStateProduction = "WHERE 1=1";

    if (!empty($searchQuery)) {
        $whereStateProduction .= " AND (num_of LIKE '%$searchQuery%' 
                                       OR reference LIKE '%$searchQuery%' 
                                       OR made_in LIKE '%$searchQuery%' 
                                       OR product_name LIKE '%$searchQuery%' 
                                       OR date_integration LIKE '%$searchQuery%')";
    }

    if ($_SESSION['prefix_contractor'] == "mmg" || $_SESSION['prefix_contractor'] == "lan") {
        $ordersQuery = "SELECT * FROM " . $_SESSION['prefix_contractor'] . "_orders 
                        $whereStateProduction 
                        GROUP BY num_of, reference 
                        ORDER BY date_integration DESC;";
    } else {
        $ordersQuery = "SELECT * FROM " . $_SESSION['prefix_contractor'] . "_orders 
                        $whereStateProduction 
                        GROUP BY num_of 
                        ORDER BY date_integration DESC;";
    }

    $ordersResult = mysqli_query($con, $ordersQuery);

    $data = [];
    while ($ordersRow = mysqli_fetch_assoc($ordersResult)) {
        $orderDetailsQuery = "SELECT * FROM " . $_SESSION['prefix_contractor'] . "_orders 
                              WHERE num_of = '" . $ordersRow['num_of'] . "'";

        if ($_SESSION['prefix_contractor'] == "mmg" || $_SESSION['prefix_contractor'] == "lan") {
            $orderDetailsQuery .= " AND reference = '" . $ordersRow['reference'] . "'";
        }

        $orderDetailsResult = mysqli_query($con, $orderDetailsQuery);
        $orderDetails = [];
        while ($detailRow = mysqli_fetch_assoc($orderDetailsResult)) {
            $orderDetails[] = $detailRow;
        }

        $data[] = [
            'order' => $ordersRow,
            'details' => $orderDetails,
        ];
    }

    echo json_encode($data);
    exit;
}
