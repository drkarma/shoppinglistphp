<?php
$path = __DIR__ . '/../data/shoppinglist.sqlite';
$db = new PDO('sqlite:' . $path);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec('CREATE TABLE IF NOT EXISTS lists (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, type TEXT);');
echo "Database initialized at $path\n";