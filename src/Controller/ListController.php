<?php
namespace Controller;

class ListController {
    public function showCreateForm() {
        include __DIR__ . '/../views/view_create.php';
    }

    public function viewList() {
        echo "<h1>Visar lista (placeholder)</h1>";
    }
}