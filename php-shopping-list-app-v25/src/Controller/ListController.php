<?php

function handleCreate($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $type = $_POST['type'];

        $stmt = $pdo->prepare("INSERT INTO lists (title, type) VALUES (?, ?)");
        $stmt->execute([$title, $type]);

        $listId = $pdo->lastInsertId();
        header("Location: ?action=view&id=" . $listId);
        exit;
    }
}

function viewList($pdo) {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "❌ Lista saknar ID.";
        exit;
    }
    $stmt = $pdo->prepare("SELECT * FROM lists WHERE id = ?");
    $stmt->execute([$id]);
    $list = $stmt->fetch();

    if (!$list) {
        echo "❌ Lista hittades inte.";
        exit;
    }

    include __DIR__ . '/../views/view_list.php';
}

function showHome() {
    include __DIR__ . '/../views/home.php';
}