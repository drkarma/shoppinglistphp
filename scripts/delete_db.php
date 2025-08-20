<?php
$path = __DIR__ . '/../data/shoppinglist.sqlite';
if (file_exists($path)) {
  unlink($path);
  echo "Deleted $path\n";
} else {
  echo "No database found.\n";
}