<?php
namespace App\Controller;

class ListController {
  public function handle($action) {
    echo '<!DOCTYPE html><html lang="sv"><head><meta charset="UTF-8"><title>Listapp</title>';
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '</head><body class="container mt-5">';
    echo '<div class="card p-4 shadow">';
    echo '<h1>Skapa en ny inköpslista</h1>';
    echo '<form>';
    echo '<div class="mb-3"><label class="form-label">Namn på lista:</label><input type="text" class="form-control"></div>';
    echo '<button class="btn btn-outline-secondary mb-3" type="button" onclick="navigator.clipboard.writeText(window.location.href)">📋 Kopiera länk</button>';
    echo '<div class="mb-3 row">';
    echo '<div class="col-auto"><input type="checkbox"></div>';
    echo '<div class="col"><input type="text" class="form-control" placeholder="Produkt"></div>';
    echo '<div class="col"><input type="text" class="form-control" placeholder="Antal/Vikt"></div>';
    echo '<div class="col-auto"><button class="btn btn-danger">🗑️</button></div>';
    echo '</div>';
    echo '</form>';
    echo '</div></body></html>';
  }
}
