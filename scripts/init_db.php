<?php
$dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE TABLE IF NOT EXISTS lists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    type TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
echo "Database initialized at " . realpath($dbPath) . "\n";
