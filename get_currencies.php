
<?php
// get_contractors.php
include('config.inc.php');

// Récupérer les IDs des contractors envoyés en POST
if (isset($_POST['currenciesIds']) && !empty($_POST['currenciesIds'])) {
    // Extraire les IDs (sous forme '{1}{2}{3}')
    $contractorsString = $_POST['currenciesIds'];
    $contractorsIds = explode('}{', trim($contractorsString, '{}'));
    
    // Requête pour récupérer les noms des contractors
    $contractorsIdsList = implode(',', array_map('intval', $contractorsIds)); // Sécuriser les IDs avec intval
    $query = "SELECT * FROM devises WHERE id IN ($contractorsIdsList)";
    $result = mysqli_query($con, $query);
    
    // Préparer une réponse sous forme de tableau associatif (ID -> Nom)
    $contractorsData = [];
    if ($result) {
        while ($contractor = mysqli_fetch_assoc($result)) {
            $contractorsData[$contractor['id']] = $contractor['name'];
        }
    }
    
    // Réponse en JSON
    echo json_encode($contractorsData);
}
?>
