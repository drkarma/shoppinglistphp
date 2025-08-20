<?php
$dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS lists (
    id TEXT PRIMARY KEY,
    title TEXT NOT NULL,
    type TEXT NOT NULL
);");

$db->exec("CREATE TABLE IF NOT EXISTS items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    list_id TEXT NOT NULL,
    content TEXT NOT NULL,
    amount TEXT,
    checked INTEGER DEFAULT 0
);");

echo "Database initialized at {$dbPath}\n";
