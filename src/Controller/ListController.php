<?php
namespace Controller;

use View\ListView;

class ListController {
    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->createList($_POST);
        } elseif ($action === 'view' && isset($_GET['id'])) {
            $this->viewList($_GET['id']);
        } else {
            $this->showForm();
        }
    }

    private function showForm() {
        include __DIR__ . '/../views/view_create.php';
    }

    private function createList($data) {
        $title = $data['title'] ?? '';
        $type = $data['type'] ?? 'shopping';
        $id = uniqid('list_', true);

        $db = new \PDO('sqlite:' . __DIR__ . '/../../data/shoppinglist.sqlite');
        $stmt = $db->prepare("INSERT INTO lists (id, title, type) VALUES (?, ?, ?)");
        $stmt->execute([$id, $title, $type]);

        header("Location: ?action=view&id=" . urlencode($id));
        exit;
    }

    private function viewList($id) {
        include __DIR__ . '/../views/view_list.php';
    }
}
