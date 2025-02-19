<?php
require 'classes/Turkey.php';
require 'classes/TurkeyExport.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'getAllTurkeys':
        getAllTurkeys();
        break;
    case 'createTurkey':
        createTurkey();
        break;
    case 'editTurkey':
        editTurkey();
        break;
    case 'getTurkeyById':
        getTurkeyById();
        break;
    case 'exportToCSV':
        exportToCSV();
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

function createTurkey() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['name'], $data['weight'], $data['age'], $data['status'], $data['color'])) {
        $turkey = new Turkey();
        $turkey->name = $data['name'];
        $turkey->weight = $data['weight'];
        $turkey->age = $data['age'];
        $turkey->status = $data['status'];
        $turkey->color = $data['color'];
        $result = $turkey->save();
        echo json_encode(['success' => $result]);
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
}

function editTurkey() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'], $data['name'], $data['weight'], $data['age'], $data['status'], $data['color'])) {
        $turkey = new Turkey($data['id']);
        $turkey->name = $data['name'];
        $turkey->weight = $data['weight'];
        $turkey->age = $data['age'];
        $turkey->status = $data['status'];
        $turkey->color = $data['color'];
        $result = $turkey->save();
        echo json_encode(['success' => $result]);
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
}

function getTurkeyById() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $turkey = new Turkey();
        $result = $turkey->getTurkeyById($id);
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Invalid ID']);
    }
}

function exportToCSV() {
    $exporter = new TurkeyExport();
    $filename = $exporter->exportToCSV();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    unlink($filename); // Delete the file after download
}
?>
