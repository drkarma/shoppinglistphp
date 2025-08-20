<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8">
  <title>Ny inköpslista</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function copyLink() {
      navigator.clipboard.writeText(window.location.href);
      alert("Länken har kopierats!");
    }

    function addRow() {
      const container = document.getElementById("items");
      const row = document.createElement("div");
      row.className = "row mb-2 align-items-center";
      row.innerHTML = `
        <div class="col-auto"><input type="checkbox" /></div>
        <div class="col"><input type="text" class="form-control" name="product[]" placeholder="Produkt"></div>
        <div class="col"><input type="text" class="form-control" name="quantity[]" placeholder="Antal/vikt/volym"></div>
        <div class="col-auto"><button type="button" class="btn btn-danger" onclick="this.closest('.row').remove();">🗑️</button></div>
      `;
      container.appendChild(row);
    }
  </script>
</head>
<body class="container mt-5">
  <div class="card p-4 shadow">
    <h1>Skapa en ny inköpslista</h1>
    <form method="POST" action="?action=save">
      <div class="mb-3">
        <label class="form-label">Namn på lista:</label>
        <input type="text" class="form-control" name="title" required>
      </div>
      <button type="button" onclick="copyLink()" class="btn btn-outline-secondary mb-3">📋 Kopiera länk</button>

      <div id="items">
        <div class="row mb-2 align-items-center">
          <div class="col-auto"><input type="checkbox" /></div>
          <div class="col"><input type="text" class="form-control" name="product[]" placeholder="Produkt"></div>
          <div class="col"><input type="text" class="form-control" name="quantity[]" placeholder="Antal/vikt/volym"></div>
          <div class="col-auto"><button type="button" class="btn btn-danger" onclick="this.closest('.row').remove();">🗑️</button></div>
        </div>
      </div>

      <button type="button" class="btn btn-secondary mt-2" onclick="addRow()">+ Lägg till rad</button>
      <button type="submit" class="btn btn-primary mt-2">Spara lista</button>
    </form>
  </div>
</body>
</html>