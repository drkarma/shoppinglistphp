<?php
$dbPath = __DIR__ . '/../data/shoppinglist.sqlite';
if (file_exists($dbPath)) {
    unlink($dbPath);
    echo "Database deleted.\n";
} else {
    echo "No database found.\n";
}