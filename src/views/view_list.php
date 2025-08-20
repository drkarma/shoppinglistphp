<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Inköpslista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card p-4 shadow">
        <h1>Inköpslista: <?= htmlspecialchars($list['title']) ?></h1>

        <div class="mb-3">
            <label class="form-label">Länk till listan:</label>
            <div class="input-group">
                <input type="text" id="listUrl" class="form-control" value="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/?action=view&id=' . urlencode($list['id']) ?>" readonly>
                <button class="btn btn-outline-secondary" onclick="copyLink()">Kopiera</button>
            </div>
        </div>

        <form method="POST" action="?action=update&id=<?= urlencode($list['id']) ?>">
            <div id="itemsContainer">
                <?php foreach ($items as $index => $item): ?>
                    <div class="row align-items-center mb-2">
                        <div class="col-auto">
                            <input type="checkbox" name="items[<?= $index ?>][checked]" class="form-check-input" <?= $item['checked'] ? 'checked' : '' ?>>
                        </div>
                        <div class="col">
                            <input type="text" name="items[<?= $index ?>][name]" class="form-control" value="<?= htmlspecialchars($item['name']) ?>" placeholder="Produkt">
                        </div>
                        <div class="col">
                            <input type="text" name="items[<?= $index ?>][quantity]" class="form-control" value="<?= htmlspecialchars($item['quantity']) ?>" placeholder="Antal/Vikt/Volym">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑️</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">+ Lägg till rad</button>
            <br>
            <button type="submit" class="btn btn-success">Spara ändringar</button>
        </form>
    </div>

    <script>
        function copyLink() {
            const copyText = document.getElementById("listUrl");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Länken har kopierats!");
        }

        function addRow() {
            const container = document.getElementById("itemsContainer");
            const index = container.children.length;
            const row = document.createElement("div");
            row.className = "row align-items-center mb-2";
            row.innerHTML = `
                <div class="col-auto">
                    <input type="checkbox" name="items[${index}][checked]" class="form-check-input">
                </div>
                <div class="col">
                    <input type="text" name="items[${index}][name]" class="form-control" placeholder="Produkt">
                </div>
                <div class="col">
                    <input type="text" name="items[${index}][quantity]" class="form-control" placeholder="Antal/Vikt/Volym">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑️</button>
                </div>
            `;
            container.appendChild(row);
        }

        function removeRow(button) {
            button.closest(".row").remove();
        }
    </script>
</body>
</html>
