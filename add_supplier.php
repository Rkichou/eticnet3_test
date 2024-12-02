<?php
include('config.inc.php');
header('Content-Type: application/json');

// Get the posted JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data received']);
    exit;
}

// Capture supplier data
$corporate_id= $data['Corporate_id'];
$companyName = $data['companyName'];
$supplierCode = $data['supplierCode'];
$contractor_id= $data['contractor_id'];


// Capture factory data
$factoryName = $data['factoryName'];
$factoryCode = $data['factoryCode'];
$address1 = $data['address1'];
$additionalAddress = $data['additionalAddress'];
$zipCode = $data['zipCode'];
$city = $data['city'];
$country = $data['country'];
$printshop = $data['printshop'];

// Capture contact data
$firstName = $data['firstName'];
$lastName = $data['lastName'];
$email = $data['email'];
$password = md5($data['password']); // Encrypt the password
$phone = $data['phone'];
$services= $data['Service_id'];
// Begin a transaction
mysqli_begin_transaction($con);

try {
    // Insert supplier
    $supplierQuery = "INSERT INTO users_adresses (id_user,company_name, code_supplier ,adresse_1, adresse_2, zip, city, country, printshop,telephone,contractor) VALUES (?,?,?,?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $supplierQuery);
    mysqli_stmt_bind_param($stmt, 'issssssssss', $corporate_id,$companyName,$supplierCode,$address1, $additionalAddress, $zipCode, $city, $country, $printshop,$phone,$contractor_id);
    mysqli_stmt_execute($stmt);
    $supplierId = mysqli_insert_id($con);  // Get the supplier ID
    

    // Insert factory
    $factoryQuery = "INSERT INTO factory (supplier_id, factory_code, address_1, additional_address, zip, city, country,name) VALUES (?,?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $factoryQuery);
    mysqli_stmt_bind_param($stmt, 'isssisss', $supplierId, $factoryCode, $address1, $additionalAddress, $zipCode, $city, $country,$factoryName);
    mysqli_stmt_execute($stmt);
    $factoryId = mysqli_insert_id($con);  // Get the factory ID

    // Insert contact using the factory ID
    $contactQuery = "INSERT INTO users_contacts (factory_id, contact_name, contact_email, pwd,login,services,id_user,phone) VALUES (?,?,?, ?, ?, ?, ?,?)";
    $stmt = mysqli_prepare($con, $contactQuery);
    mysqli_stmt_bind_param($stmt, 'isssssis', $factoryId, $firstName, $email, $password,$email,$services,$corporate_id,$phone);
    mysqli_stmt_execute($stmt);
    

    // Commit transaction
    mysqli_commit($con);

    // Return success response
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // Rollback transaction in case of error
    mysqli_rollback($con);

    // Return error response
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
