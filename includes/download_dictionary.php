<?php
require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once("config.inc.php");
require_once("includes/is_session_active.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Démarrer la session pour gérer les téléchargements
    session_start();


    $database = 'mmg_dictionnary';

    

    // Créer un nouvel objet Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Ajouter les en-têtes de colonnes
    $sheet->setCellValue('A1', 'Français');
    $sheet->setCellValue('B1', 'Anglais');
    $sheet->setCellValue('C1', 'Russe');
    $sheet->setCellValue('D1', 'Japonais');
    $sheet->setCellValue('E1', 'MANDARIN');

    // Requête pour récupérer les données
    $sql = "SELECT FRANCAIS, ANGLAIS, RUSSE, JAPONAIS, MANDARIN FROM mmg_dictionnary";
    $result = mysqli_query($con, $sql);

    if ($result && $result->num_rows > 0) {
        $rowIndex = 2; // Ligne de départ pour les données (après les en-têtes)
        while ($row = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $rowIndex, $row['FRANCAIS']);
            $sheet->setCellValue('B' . $rowIndex, $row['ANGLAIS']);
            $sheet->setCellValue('C' . $rowIndex, $row['RUSSE']);
            $sheet->setCellValue('D' . $rowIndex, $row['JAPONAIS']);
            $sheet->setCellValue('E' . $rowIndex, $row['MANDARIN']);
            $rowIndex++;
        }
    }

   
    // Nommer le fichier à télécharger
    $fileName = "dictionary_" . date('Y-m-d') . ".xlsx";

    // Préparer la sortie
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="dictionnary_' . $prefix . '_' . date('Y-m-d') . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save($file_name);
    exit;

?>
