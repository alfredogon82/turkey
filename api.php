<?php
require 'classes/Turkey.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'getAllTurkeys':
        getAllTurkeys();
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
?>
