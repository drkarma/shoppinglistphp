<?php
$db = new PDO('sqlite:' . __DIR__ . '/../data/shoppinglist.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS lists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    type TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$db->exec("CREATE TABLE IF NOT EXISTS list_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    list_id INTEGER NOT NULL,
    name TEXT NOT NULL,
    quantity TEXT,
    checked INTEGER DEFAULT 0,
    FOREIGN KEY (list_id) REFERENCES lists(id)
)");

echo 'Database initialized at ' . __DIR__ . '/../data/shoppinglist.sqlite';
