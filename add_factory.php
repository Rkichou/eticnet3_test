<?php
include('config.inc.php');
header('Content-Type: application/json');

// Récupération des données POSTées
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data received']);
    exit;
}

// Capture des données de la requête
$supplierId = $data['supplierId'];
$factoryCompanyName = $data['factoryCompanyName'];
$factoryAddress1 = $data['factoryAddress1'];
$factoryAdditionalAddress = $data['factoryAdditionalAddress'];
$factoryZipCode = $data['factoryZipCode'];
$factoryCity = $data['factoryCity'];
$factoryCountry = $data['factoryCountry'];
$factoryCode= $data['factoryCode'];
$contactFirstName = $data['contactFirstName'];
$contactLastName = $data['contactLastName'];
$contactEmail = $data['contactEmail'];
$contactPhonePrefix = $data['contactPhonePrefix'];
$contactPhoneNumber = $data['contactPhoneNumber'];

mysqli_begin_transaction($con);

try {
    // Insertion de la nouvelle usine
    $factoryQuery = "INSERT INTO factory (supplier_id, name, address_1, additional_address, zip, city, country, factory_code) 
                     VALUES (?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = mysqli_prepare($con, $factoryQuery);
    mysqli_stmt_bind_param($stmt, 'isssssss', $supplierId, $factoryCompanyName, $factoryAddress1, $factoryAdditionalAddress, $factoryZipCode, $factoryCity, $factoryCountry,$factoryCode);
    mysqli_stmt_execute($stmt);
    $factoryId = mysqli_insert_id($con);  // Récupérer l'ID de la nouvelle usine

    // Insertion du contact associé à l'usine
    $contactQuery = "INSERT INTO users_contacts (factory_id, contact_name, contact_email, phone) 
                     VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $contactQuery);
    $contactPhone = $contactPhonePrefix . ' ' . $contactPhoneNumber;  // Combine le préfixe et le numéro
    mysqli_stmt_bind_param($stmt, 'isss', $factoryId, $contactFirstName, $contactEmail, $contactPhone);
    mysqli_stmt_execute($stmt);

    // Confirme la transaction
    mysqli_commit($con);

    // Réponse en cas de succès
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Annule la transaction en cas d'erreur
    mysqli_rollback($con);

    // Réponse en cas d'erreur
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
