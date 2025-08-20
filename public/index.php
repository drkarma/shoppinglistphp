<?php
require_once __DIR__ . '/../src/bootstrap.php';

use App\Controller\ListController;

$controller = new ListController();
echo "<!DOCTYPE html>
<html lang='sv'>
<head>
  <meta charset='UTF-8'>
  <title>Listapp</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='container mt-5'>
  <div class='card p-4 shadow'>
    " . $controller->handleRequest() . "
  </div>
</body>
</html>";
