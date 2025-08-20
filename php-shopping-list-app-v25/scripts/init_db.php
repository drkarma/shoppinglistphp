<?php
$dbFile = __DIR__ . '/../data/shoppinglist.sqlite';
if (!file_exists(dirname($dbFile))) {
    mkdir(dirname($dbFile), 0777, true);
}
$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("
CREATE TABLE IF NOT EXISTS lists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    type TEXT NOT NULL
);
");
echo "Database initialized at $dbFile";