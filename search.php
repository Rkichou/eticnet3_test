<?php
  // Inclure le fichier de configuration
  include('config.inc.php');

  // Vérifier que la connexion est bien établie
  if (!$con) {
    echo json_encode(['results' => [], 'error' => 'Database connection failed']);
    exit();
  }

  // Vérifier que 'query' est défini
  if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $query = mysqli_real_escape_string($con, $_POST['query']);

    // Requête SQL avec recherche dans quatre colonnes
    $sql = "SELECT * FROM users WHERE id=6 ";

    // Exécuter la requête et préparer les résultats
    $result = mysqli_query($con, $sql);
    $results = [];

    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
      }
    } else {
      echo json_encode(['results' => [], 'error' => 'Query failed']);
      exit();
    }

    // Retourner les résultats en JSON
    echo json_encode(['results' => $results]);
  } else {
    // Retourner un tableau vide si la requête est vide
    echo json_encode(['results' => []]);
  }
?>
