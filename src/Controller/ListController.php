<?php
namespace App\Controller;

class ListController {
    public function handleRequest() {
        $action = $_GET['action'] ?? null;
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->createList();
        } else {
            require view('home');
        }
    }

    private function createList() {
        $title = $_POST['title'] ?? '';
        $type = $_POST['type'] ?? 'shopping';
        $id = uniqid('list_', true);
        $db = new \PDO('sqlite:' . __DIR__ . '/../../data/shoppinglist.sqlite');
        $stmt = $db->prepare("INSERT INTO lists (id, title, type) VALUES (?, ?, ?)");
        $stmt->execute([$id, $title, $type]);
        header("Location: ?action=view&id=" . urlencode($id));
        exit;
    }
}
