<?php
require_once __DIR__ . '/../src/bootstrap.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $controller = new \Controller\ListController();
        $controller->showCreateForm();
        break;
    case 'view':
        $controller = new \Controller\ListController();
        $controller->viewList();
        break;
    default:
        include __DIR__ . '/../src/views/home.php';
}