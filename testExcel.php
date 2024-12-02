<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');
echo $sheet->getCell('A1')->getValue();
?>
