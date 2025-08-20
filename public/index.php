<?php
require_once __DIR__ . '/../src/bootstrap.php';

use App\Controller\ListController;

$controller = new ListController();
$controller->handleRequest();
