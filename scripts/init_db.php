<?php
declare(strict_types=1);

$dbFile = __DIR__ . '/../data/shoppinglist.sqlite';
$dir = dirname($dbFile);
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Lists table
$pdo->exec("CREATE TABLE IF NOT EXISTS lists (
    id TEXT PRIMARY KEY,
    title TEXT NOT NULL,
    type TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Items table (NOTE: correct name is list_items to match the app code)
$pdo->exec("CREATE TABLE IF NOT EXISTS list_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    list_id TEXT NOT NULL,
    name TEXT NOT NULL,
    quantity TEXT,
    checked INTEGER DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(list_id) REFERENCES lists(id)
)");

echo 'Database initialized at ' . realpath($dbFile) . PHP_EOL;