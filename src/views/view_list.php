<!DOCTYPE html>
<html lang='sv'>
<head>
  <meta charset='UTF-8'>
  <title>Inköpslista</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='container mt-5'>
  <div class='card p-4 shadow'>
    <h1>Inköpslista: <?= htmlspecialchars($list['title']) ?></h1>
    <button onclick="copyListLink()" class="btn btn-secondary mb-3">📋 Kopiera länk till listan</button>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Produkt</th>
          <th>Antal/Vikt/Volym</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="shopping-items">
        <?php foreach ($items as $item): ?>
        <tr>
          <td><input type="checkbox" <?= $item['checked'] ? 'checked' : '' ?>></td>
          <td><input type="text" class="form-control" value="<?= htmlspecialchars($item['name']) ?>"></td>
          <td><input type="text" class="form-control" value="<?= htmlspecialchars($item['quantity']) ?>"></td>
          <td><button class="btn btn-danger" onclick="removeRow(this)">🗑️</button></td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($items)): ?>
        <tr>
          <td><input type="checkbox"></td>
          <td><input type="text" class="form-control" placeholder="Ex: Tomater"></td>
          <td><input type="text" class="form-control" placeholder="Ex: 1kg"></td>
          <td><button class="btn btn-danger" onclick="removeRow(this)">🗑️</button></td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <button class="btn btn-primary" onclick="addRow()">➕ Lägg till rad</button>
  </div>

  <script>
    function copyListLink() {
      navigator.clipboard.writeText(window.location.href)
        .then(() => alert("Länk kopierad till urklipp!"))
        .catch(err => alert("Kunde inte kopiera länken: " + err));
    }

    function addRow() {
      const tbody = document.getElementById('shopping-items');
      const newRow = tbody.rows[0].cloneNode(true);
      newRow.querySelectorAll('input').forEach(input => input.value = '');
      tbody.appendChild(newRow);
    }

    function removeRow(button) {
      const row = button.closest('tr');
      const tbody = row.parentElement;
      if (tbody.rows.length > 1) {
        row.remove();
      } else {
        alert("Minst en rad krävs.");
      }
    }
  </script>
</body>
</html>
