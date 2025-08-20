<?php
$dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->exec("CREATE TABLE IF NOT EXISTS lists (id INTEGER PRIMARY KEY, title TEXT, type TEXT);");
echo "Database initialized at $dbPath\n";
