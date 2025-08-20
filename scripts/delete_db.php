<?php
$dbFile = __DIR__ . '/../data/shoppinglist.sqlite';
if (file_exists($dbFile)) {
    unlink($dbFile);
    echo 'Deleted database.' . PHP_EOL;
} else {
    echo 'No database found.' . PHP_EOL;
}