<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.inc.php');

// En-tête JSON
header('Content-Type: application/json');

// Récupère la valeur de la recherche
$query = isset($_POST['query']) ? $_POST['query'] : '';

// Récupère les paramètres de pagination
$rowsPerPage = isset($_POST['rowsPerPage']) ? intval($_POST['rowsPerPage']) : 15; // Par défaut 20 éléments par page
$currentPage = isset($_POST['page']) ? intval($_POST['page']) : 1;
$offset = ($currentPage - 1) * $rowsPerPage;

// Vérifier la connexion
if (!$con) {
    die(json_encode(['error' => 'Erreur de connexion à la base de données']));
}

// Calculer le nombre total de lignes
$totalRowsQuery = "
    SELECT COUNT(*) as total 
    FROM users
    LEFT JOIN roles ON users.role = roles.id
    LEFT JOIN printshop ON users.printshop = printshop.id
    LEFT JOIN contractors ON contractors.id = 
        CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(users.contractors, '}{', 1), '{', -1) AS UNSIGNED)
";
if (!empty($query)) {
    $escapedQuery = mysqli_real_escape_string($con, $query);
    $totalRowsQuery .= " 
    WHERE users.id LIKE '%$escapedQuery%' 
       OR users.login LIKE '%$escapedQuery%' 
       OR contractors.name LIKE '%$escapedQuery%'        
       OR roles.name LIKE '%$escapedQuery%'";
}

$totalRowsResult = mysqli_query($con, $totalRowsQuery);
$totalRows = mysqli_fetch_assoc($totalRowsResult)['total'];
$totalPages = ceil($totalRows / $rowsPerPage);

// Construire la requête principale avec pagination
$userQuery = "
    SELECT users.*, roles.name AS role_name, printshop.name AS printshop_name, contractors.name AS contractor_name
    FROM users
    LEFT JOIN roles ON users.role = roles.id
    LEFT JOIN printshop ON users.printshop = printshop.id
    LEFT JOIN contractors ON contractors.id = 
        CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(users.contractors, '}{', 1), '{', -1) AS UNSIGNED)
";
if (!empty($query)) {
    $userQuery .= " 
    WHERE users.id LIKE '%$escapedQuery%' 
       OR users.login LIKE '%$escapedQuery%' 
       OR contractors.name LIKE '%$escapedQuery%'        
       OR roles.name LIKE '%$escapedQuery%'";
}
$userQuery .= " LIMIT $rowsPerPage OFFSET $offset";

// Exécuter la requête
$userResult = mysqli_query($con, $userQuery);
$results = [];

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
    $results[] = [
        'sql'=> $userQuery,
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

// Retourner les résultats sous forme de JSON
echo json_encode([
    'results' => $results,
    'pagination' => [
        'totalRows' => $totalRows,
        'totalPages' => $totalPages,
        'currentPage' => $currentPage,
        'rowsPerPage' => $rowsPerPage
    ]
]);
exit;
