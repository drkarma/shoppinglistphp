<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Controller/ListController.php';

use Controller\ListController;

$controller = new ListController();
$controller->handleRequest();
