<?php
require_once '../models/Subject.php';
session_start();

$controller = new Subject();
if (isset($_GET['method'])) {

    switch ($_GET['method']) {
        case 'create':
            $controller->CreateSubject();
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            header('Location: ../views/subjects/list.php');
            exit();
    }
}
$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['method'])) {
    switch ($data['method']) {
        case 'renderSubjects':
            echo json_encode($controller->renderSubjects());
            break;
        default:
            header('Location: ../views/subjects/list.php');
            exit;
    }
}
