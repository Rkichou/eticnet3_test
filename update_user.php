<?php
include('config.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id']);
    $login = mysqli_real_escape_string($con, $_POST['login']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $role = intval($_POST['role']);
    $printshop = intval($_POST['printshop']);
    

    // Fonction pour transformer la chaîne en format {1}{2}{3}

    // Formatage des services, contractors et devises
    $contractors = isset($_POST['selected_contractors']) ? ($_POST['selected_contractors']) : 'NULL';
    $services = isset($_POST['selected_services']) ? ($_POST['selected_services']) : 'NULL';
    $currencies = isset($_POST['selected_currency']) ? ($_POST['selected_currency']) : 'NULL';

    
    // Update user query
    $query = "UPDATE users SET 
                login = '$login', 
                user_email = '$email', 
                user_name = '$username', 
                role = $role, 
                printshop = $printshop, 
                contractors = '$contractors', 
                service = '$services', 
                devise = '$currencies'
              WHERE id = $userId";

    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => $contractors]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($con)]);
    }
}
?>
