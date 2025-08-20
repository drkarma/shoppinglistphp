<?php
namespace App\Controller;

class ListController {
    private $dbPath;

    public function __construct() {
        $this->dbPath = __DIR__ . '/../../data/shoppinglist.sqlite';
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? null;
        if ($action === 'create') {
            $this->createList();
        } elseif (isset($_GET['id'])) {
            $this->viewList($_GET['id']);
        } else {
            include __DIR__ . '/../views/home.php';
        }
    }

    public function createList() {
        $title = $_POST['title'] ?? '';
        $type = $_POST['type'] ?? '';
        $id = uniqid();
        $db = new \PDO('sqlite:' . $this->dbPath);
        $stmt = $db->prepare("INSERT INTO lists (id, title, type) VALUES (?, ?, ?)");
        $stmt->execute([$id, $title, $type]);
        header("Location: ?id=$id");
        exit;
    }

    public function viewList($id) {
        $db = new \PDO('sqlite:' . $this->dbPath);
        $stmt = $db->prepare("SELECT * FROM lists WHERE id = ?");
        $stmt->execute([$id]);
        $list = $stmt->fetch();
        include __DIR__ . '/../views/view_list.php';
    }
}
