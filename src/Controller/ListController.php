<?php
namespace App\Controller;

class ListController {
    public function handleRequest() {
        $action = $_GET['action'] ?? 'new';

        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->createList();
        } elseif ($action === 'view' && isset($_GET['id'])) {
            $this->viewList($_GET['id']);
        } else {
            $this->showCreateForm();
        }
    }

    private function createList() {
        $id = uniqid();
        $title = $_POST['title'];
        $type = $_POST['type'];

        $db = new \PDO('sqlite:' . __DIR__ . '/../../../data/shoppinglist.sqlite');
        $stmt = $db->prepare("INSERT INTO lists (id, title, type) VALUES (?, ?, ?)");
        $stmt->execute([$id, $title, $type]);

        header("Location: ?action=view&id=$id");
        exit;
    }

    private function viewList($id) {
        $db = new \PDO('sqlite:' . __DIR__ . '/../../../data/shoppinglist.sqlite');
        $stmt = $db->prepare("SELECT * FROM lists WHERE id = ?");
        $stmt->execute([$id]);
        $list = $stmt->fetch();

        echo "<!DOCTYPE html><html><head><title>{$list['title']}</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='container mt-5'>";
        echo "<h1>{$list['title']}</h1>";
        echo "<div><input type='text' class='form-control d-inline w-50' value='http://localhost:8080/?action=view&id={$id}' readonly id='shareLink'> <button onclick='copyLink()' class='btn btn-outline-secondary'>📋</button></div>";
        echo "<form><ul class='list-group mt-3' id='itemList'></ul></form>";
        echo "<script>
        function copyLink() {
            const link = document.getElementById('shareLink');
            link.select(); document.execCommand('copy');
        }
        const list = document.getElementById('itemList');
        const row = document.createElement('li');
        row.className = 'list-group-item d-flex align-items-center';
        row.innerHTML = `<input class='form-check-input me-2' type='checkbox'>
                         <input class='form-control me-2' type='text' placeholder='Produkt'>
                         <input class='form-control me-2' type='text' placeholder='Antal / vikt / volym'>
                         <button class='btn btn-outline-danger'>🗑️</button>`;
        list.appendChild(row);
        </script></body></html>";
    }

    private function showCreateForm() {
        echo "<!DOCTYPE html><html lang='sv'><head><meta charset='UTF-8'><title>Listapp</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='container mt-5'><div class='card p-4 shadow'><h1>Skapa en ny lista</h1><form method='POST' action='?action=create'><div class='mb-3'><label for='title' class='form-label'>Titel:</label><input type='text' class='form-control' name='title' id='title' required></div><div class='mb-3'><label for='type' class='form-label'>Typ:</label><select name='type' class='form-select'><option value='shopping'>Inköpslista</option><option value='todo'>ToDo-lista</option><option value='checklist'>Processchecklista</option></select></div><button type='submit' class='btn btn-primary'>Skapa lista</button></form></div></body></html>";
    }
}
