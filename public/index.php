
<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

use App\Controller\ListController;

// Fallback diagnostics if needed: curl 'http://localhost:8080/?action=diagnostics'
if (($_GET['action'] ?? null) === 'diagnostics') {
    header('Content-Type: text/plain; charset=utf-8');
    $dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
    echo "DB path: $dbPath\n";
    echo 'DB exists: ' . (file_exists($dbPath) ? 'yes' : 'no') . "\n\n";
    try {
        $pdo = new PDO('sqlite:' . $dbPath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $tables = $pdo->query("SELECT name, sql FROM sqlite_master WHERE type='table' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
        echo "Tables:\n";
        foreach ($tables as $t) {
            echo "- {$t['name']}\n";
        }
        echo "\nSchemas:\n";
        foreach ($tables as $t) {
            echo "\n{$t['name']}:\n{$t['sql']}\n";
        }
    } catch (Throwable $e) {
        echo "PDO error: " . $e->getMessage() . "\n";
    }
    exit;
}

// Normal app routing
$controller = new ListController();
$controller->handleRequest();
