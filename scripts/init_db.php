<?php
$dbFile = __DIR__ . '/../data/shoppinglist.sqlite';
$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Skapa tabeller
$pdo->exec("
    CREATE TABLE IF NOT EXISTS lists (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        type TEXT NOT NULL
    );
    CREATE TABLE IF NOT EXISTS items (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        list_id INTEGER,
        content TEXT,
        checked INTEGER DEFAULT 0,
        FOREIGN KEY(list_id) REFERENCES lists(id)
    );
    CREATE TABLE IF NOT EXISTS templates (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL UNIQUE
    );
    CREATE TABLE IF NOT EXISTS template_steps (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        template_id INTEGER,
        title TEXT,
        info TEXT,
        quantity TEXT,
        FOREIGN KEY(template_id) REFERENCES templates(id)
    );
");

echo 'Database initialized at ' . realpath($dbFile) . PHP_EOL;