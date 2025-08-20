<?php
$dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
if (!file_exists(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE TABLE IF NOT EXISTS lists (
    id TEXT PRIMARY KEY,
    title TEXT NOT NULL,
    type TEXT NOT NULL
)");
$db->exec("CREATE TABLE IF NOT EXISTS items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    list_id TEXT NOT NULL,
    title TEXT NOT NULL,
    quantity TEXT,
    checked INTEGER DEFAULT 0,
    FOREIGN KEY(list_id) REFERENCES lists(id)
)");
echo "Database initialized at $dbPath\n";
