<?php
include('config.inc.php');

header('Content-Type: application/json'); // Spécifier le type de contenu JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $login = mysqli_real_escape_string($con, $_POST['login']);
    $password = mysqli_real_escape_string($con, $_POST['password']); // Attention ici
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $printshop = mysqli_real_escape_string($con, $_POST['printshop']);

    // Vérifier que les champs obligatoires sont remplis
    if (empty($login) || empty($password) || empty($email) || empty($username) || empty($role) || empty($printshop)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Tous les champs obligatoires ne sont pas remplis.'
        ]);
        exit;
    }

    // Fonction pour transformer la chaîne en format {1}{2}{3}
    function formatToCurlyBraces($input) {
        if (!empty($input)) {
            // Séparer les IDs par des virgules, puis les entourer de {}
            $items = explode(',', rtrim($input, ','));
            $formatted = '';
            foreach ($items as $item) {
                $formatted .= '{' . $item . '}';
            }
            return $formatted;
        }
        return 'NULL';
    }

    // Formatage des services, contractors et devises
    $contractors = isset($_POST['selected_contractors']) ? formatToCurlyBraces($_POST['selected_contractors']) : 'NULL';
    $services = isset($_POST['selected_services']) ? formatToCurlyBraces($_POST['selected_services']) : 'NULL';
    $currencies = isset($_POST['selected_currency']) ? formatToCurlyBraces($_POST['selected_currency']) : 'NULL';

    // Hachage du mot de passe sécurisé
    $hashedPassword = md5($password);

    // Requête préparée avec contractors, services, et devises entourés d'accolades
    $stmt = $con->prepare("INSERT INTO users 
        (login, pwd, user_email, user_name, contractors, role, devise, service, printshop) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $login, $hashedPassword, $email, $username, $contractors, $role, $currencies, $services, $printshop);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Utilisateur ajouté avec succès !'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de l\'ajout de l\'utilisateur : ' . $stmt->error
        ]);
    }

    $stmt->close();
}
?>
