<?php
require_once 'classes/Turkey.php';
require_once 'classes/TurkeyExport.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'getAllTurkeys':
        getAllTurkeys();
        break;
    case 'exportToCSV':
        exportToCSV();
        break;
    case 'generateSQLReport':
        generateSQLReport();
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

function getAllTurkeys() {
    $turkey = new Turkey();
    $turkeys = $turkey->getAllTurkeys();
    echo json_encode($turkeys);
}

function exportToCSV() {
    $exporter = new TurkeyExport();
    $filename = $exporter->exportToCSV();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    unlink($filename); // Delete the file after download
}

function generateSQLReport() {
    $exporter = new TurkeyExport();
    $filename = $exporter->generateSQLReport();
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    unlink($filename); // Delete the file after download
}
?>
