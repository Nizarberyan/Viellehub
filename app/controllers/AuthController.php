<?php
require_once __DIR__ . '/../models/Auth.php';


$controller = new Auth();

if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'register':
            $controller->register();
            break;
        case 'login':
            $controller->login();
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            header('Location: ../views/auth/login.php');
            exit();
    }
}
