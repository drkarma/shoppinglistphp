<?php
namespace App\Controller;

class ListController
{
    private string $dbPath;

    public function __construct()
    {
        $this->dbPath = __DIR__ . '/../../data/shoppinglist.sqlite';
    }

    private function db(): \PDO
    {
        $dir = dirname($this->dbPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $pdo = new \PDO('sqlite:' . $this->dbPath);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    private function baseUrl(): string
    {
        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (($_SERVER['SERVER_PORT'] ?? '') == 443);
        $scheme = $https ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/');
        return $scheme . '://' . $host . ($scriptDir === '' ? '' : $scriptDir);
    }

    public function handleRequest(): void
    {
        $action = $_GET['action'] ?? 'home';
        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->createList();
                } else {
                    $this->renderHome();
                }
                return;
            case 'view':
                $id = $_GET['id'] ?? '';
                if ($id === '') {
                    $this->renderHome();
                    return;
                }
                $this->renderList($id);
                return;
            case 'add_item':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') $this->addItem();
                return;
            case 'toggle_item':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') $this->toggleItem();
                return;
            case 'delete_item':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') $this->deleteItem();
                return;
            default:
                $this->renderHome();
                return;
        }
    }

    private function createList(): void
    {
        $title = trim($_POST['title'] ?? '');
        $type  = 'shopping'; // fokus: inköpslista
        if ($title === '') {
            header('Location: ?');
            return;
        }
        $id = 'l' . bin2hex(random_bytes(6));

        $pdo = $this->db();
        $stmt = $pdo->prepare('INSERT INTO lists (id, title, type) VALUES (?, ?, ?)');
        $stmt->execute([$id, $title, $type]);

        header('Location: ?action=view&id=' . urlencode($id));
        exit;
    }

    private function renderHome(): void
    {
        $baseUrl = $this->baseUrl();
        include \view('home');
    }

    private function fetchList(string $id): ?array
    {
        $pdo = $this->db();
        $stmt = $pdo->prepare('SELECT * FROM lists WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    private function fetchItems(string $id): array
    {
        $pdo = $this->db();
        $stmt = $pdo->prepare('SELECT * FROM list_items WHERE list_id = ? ORDER BY id ASC');
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
    }

    private function renderList(string $id): void
    {
        $list = $this->fetchList($id);
        if (!$list) {
            http_response_code(404);
            echo '<!doctype html><meta charset="utf-8"><div style="padding:2rem;font-family:sans-serif">Lista saknas.</div>';
            return;
        }
        $items = $this->fetchItems($id);
        $baseUrl = $this->baseUrl();
        include \view('view_list');
    }

    private function addItem(): void
    {
        $list_id = $_POST['list_id'] ?? '';
        $name = trim($_POST['name'] ?? '');
        $quantity = trim($_POST['quantity'] ?? '');

        if ($list_id === '' || $name === '') {
            header('Location: ?');
            return;
        }
        $pdo = $this->db();
        $stmt = $pdo->prepare('INSERT INTO list_items (list_id, name, quantity, checked) VALUES (?, ?, ?, 0)');
        $stmt->execute([$list_id, $name, $quantity]);
        header('Location: ?action=view&id=' . urlencode($list_id));
        exit;
    }

    private function toggleItem(): void
    {
        $list_id = $_POST['list_id'] ?? '';
        $item_id = $_POST['item_id'] ?? '';
        $checked = isset($_POST['checked']) ? 1 : 0;

        if ($list_id === '' || $item_id === '') {
            header('Location: ?');
            return;
        }
        $pdo = $this->db();
        $stmt = $pdo->prepare('UPDATE list_items SET checked = ? WHERE id = ? AND list_id = ?');
        $stmt->execute([$checked, $item_id, $list_id]);
        header('Location: ?action=view&id=' . urlencode($list_id));
        exit;
    }

    private function deleteItem(): void
    {
        $list_id = $_POST['list_id'] ?? '';
        $item_id = $_POST['item_id'] ?? '';

        if ($list_id === '' || $item_id === '') {
            header('Location: ?');
            return;
        }
        $pdo = $this->db();
        $stmt = $pdo->prepare('DELETE FROM list_items WHERE id = ? AND list_id = ?');
        $stmt->execute([$item_id, $list_id]);
        header('Location: ?action=view&id=' . urlencode($list_id));
        exit;
    }
}
