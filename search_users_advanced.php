<?php
include('config.inc.php');

// Désactiver l'affichage direct des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Définir l'en-tête pour JSON
header('Content-Type: application/json');

// Commencer le tampon de sortie pour éviter les sorties non désirées
ob_start();

// Initialiser la réponse avec des valeurs par défaut
$response = ['results' => [], 'error' => ''];

// Récupérer les paramètres de recherche
$id = isset($_POST['id']) ? $_POST['id'] : '';
$login = isset($_POST['login']) ? $_POST['login'] : '';
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$contractor_id = isset($_POST['contractor_id']) ? $_POST['contractor_id'] : '';
$service_id = isset($_POST['service_id']) ? $_POST['service_id'] : '';

// Vérifier la connexion à la base de données
if (!$con) {
    $response['error'] = 'Erreur de connexion à la base de données';
    // Nettoyer le tampon de sortie et retourner la réponse
    ob_end_clean();
    echo json_encode($response);
    exit;
}

// Construire la requête de base
$userQuery = "
    SELECT users.*, roles.name AS role_name, printshop.name AS printshop_name, contractors.name AS contractor_name
    FROM users
    LEFT JOIN roles ON users.role = roles.id
    LEFT JOIN printshop ON users.printshop = printshop.id
    LEFT JOIN contractors ON contractors.id = CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(users.contractors, '}{', 1), '{', -1) AS UNSIGNED)
    LEFT JOIN services ON services.id = CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(users.service, '}{', 1), '{', -1) AS UNSIGNED)
    LEFT JOIN devises ON devises.id = CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(users.devise, '}{', 1), '{', -1) AS UNSIGNED)
    WHERE 1 = 1
";

// Ajouter des conditions en fonction des paramètres
if (!empty($id)) {
    $userQuery .= " AND users.id LIKE '%" . mysqli_real_escape_string($con, $id) . "%'";
}
if (!empty($login)) {
    $userQuery .= " AND users.login LIKE '%" . mysqli_real_escape_string($con, $login) . "%'";
}
if (!empty($user_name)) {
    $userQuery .= " AND users.user_name LIKE '%" . mysqli_real_escape_string($con, $user_name) . "%'";
}
if (!empty($contractor_id)) {
    $userQuery .= " AND contractors.id = '" . mysqli_real_escape_string($con, $contractor_id) . "'";
}
if (!empty($service_id)) {
    $userQuery .= " AND services.id = '" . mysqli_real_escape_string($con, $service_id) . "'";
}

// Exécuter la requête
$userResult = mysqli_query($con, $userQuery);
if (!$userResult) {
    $response['error'] = 'Erreur dans la requête SQL : ' . mysqli_error($con);
    // Nettoyer le tampon de sortie et retourner la réponse
    ob_end_clean();
    echo json_encode($response);
    exit;
}

// Récupérer les résultats
while ($row = mysqli_fetch_assoc($userResult)) {
    // Récupérer les identifiants des contractors
    $contractorIds = explode('}{', trim($row['contractors'], '{}'));

    // Si le tableau des contractors n'est pas vide, faire la requête SQL pour obtenir les noms des contractors
    $contractors = [];
    if (!empty($contractorIds)) {
        $contractorsQuery = "SELECT name FROM contractors WHERE id IN (" . implode(",", array_map('intval', $contractorIds)) . ")";
        $contractorsResult = mysqli_query($con, $contractorsQuery);
        while ($contractor = mysqli_fetch_assoc($contractorsResult)) {
            $contractors[] = $contractor['name'];
        }
    }

    // Récupérer les identifiants des services
    $serviceIds = explode('}{', trim($row['service'], '{}'));

    // Obtenir les noms des services
    $services = [];
    if (!empty($serviceIds)) {
        $servicesQuery = "SELECT name FROM services WHERE id IN (" . implode(",", array_map('intval', $serviceIds)) . ")";
        $servicesResult = mysqli_query($con, $servicesQuery);
        while ($service = mysqli_fetch_assoc($servicesResult)) {
            $services[] = $service['name'];
        }
    }

    // Récupérer les identifiants des devises
    $currencyIds = explode('}{', trim($row['devise'], '{}'));

    // Obtenir les noms des devises
    $currencies = [];
    if (!empty($currencyIds)) {
        $currenciesQuery = "SELECT name FROM devises WHERE id IN (" . implode(",", array_map('intval', $currencyIds)) . ")";
        $currenciesResult = mysqli_query($con, $currenciesQuery);
        while ($currency = mysqli_fetch_assoc($currenciesResult)) {
            $currencies[] = $currency['name'];
        }
    }

    // Ajouter les données à chaque utilisateur pour le retour JSON
    $response['results'][] = [
        'id' => $row['id'],
        'login' => $row['login'],
        'email' => $row['user_email'],
        'username' => $row['user_name'],
        'company' => $row['contractor_name'] ?: 'Aucune company trouvée',
        'role' => $row['role_name'],
        'printshop' => $row['printshop_name'],
        'contractors' => $contractors,
        'services' => $services,
        'currencies' => $currencies,
        'roleid' => $row['role'],
        'printshopid' => $row['printshop'],
        'contractorsid' => $row['contractors'],  // Stocke les IDs au lieu des noms
        'servicesid' => $row['service'],        // Stocke les IDs au lieu des noms
        'currenciesid' => $row['devise']        // Stocke les IDs au lieu des noms
    ];
}

// Nettoyer le tampon de sortie et envoyer la réponse JSON
ob_end_clean();
echo json_encode($response);
exit;
?>
