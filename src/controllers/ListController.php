<?php
$db = new PDO('sqlite:' . __DIR__ . '/../../data/shoppinglist.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $title = $_POST['title'] ?? '';
        $type = $_POST['type'] ?? 'shopping';
        if ($title) {
            $stmt = $db->prepare("INSERT INTO lists (title, type) VALUES (?, ?)");
            $stmt->execute([$title, $type]);
            $id = $db->lastInsertId();
            header("Location: ?action=view&id=$id");
            exit;
        }
        break;

    case 'view':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $db->prepare("SELECT * FROM lists WHERE id = ?");
            $stmt->execute([$id]);
            $list = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $db->prepare("SELECT * FROM list_items WHERE list_id = ?");
            $stmt->execute([$id]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            include __DIR__ . '/../views/view_list.php';
        } else {
            echo "Ingen lista specificerad.";
        }
        break;

    default:
        include __DIR__ . '/../views/create_list.php';
        break;
}
