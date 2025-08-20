<?php
$dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
if (!file_exists(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE TABLE IF NOT EXISTS lists (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, type TEXT)");
echo "Database initialized at $dbPath\n";