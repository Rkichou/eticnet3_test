<?php 
require_once("../config.inc.php");
require_once("is_session_active.php");
// Retrieve POST data
$service = $_POST['service'] ?? '';
$title = $_POST['title'] ?? '';
$message = $_POST['message'] ?? '';
$prefix=$_SESSION['prefix_contractor'];
$user_id=$_SESSION['id'];
// Validate fields
if (empty($service) || empty($title) || empty($message)) {
    echo "Please fill in all required fields.";
    exit;
}
if($service=='it'){
$service='IT assistance';
}
else if($service=='order'){
$service='Order assitance';
}
else{
    echo "Please select assigned service";
}
$status=1;
// File upload handling
$fileName = '';
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $targetDir = "documents/".$prefix."/tickets/"; // Directory to save uploaded files
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Move the uploaded file
    if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        echo  "File upload failed.";
        exit;
    }
}
// Insert ticket into the database
$sql="INSERT INTO ticketing (id, user_id, prefix_contractor, title, message,service, files_attached, date_soumission, status) VALUES (";
$sql.= "'NULL', " . $user_id .", '". $prefix."', '".$title."', '". mysqli_real_escape_string($con,$message) ."',";
$sql.= "'". $service ."' , '".mysqli_real_escape_string($con,$fileName) ."', '". date('Y-m-d H:i:s') ."', $status);";
//echo $sql;
$retour=mysqli_query($con,$sql);
 