<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Controller/ListController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'create':
        handleCreate($pdo);
        break;
    case 'view':
        viewList($pdo);
        break;
    default:
        showHome();
}