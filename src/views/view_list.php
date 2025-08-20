<h1>Lista: <?= htmlspecialchars($list['title']) ?></h1>
<p>Typ: <?= htmlspecialchars($list['type']) ?></p>
<button onclick="navigator.clipboard.writeText(window.location.href)">📋 Kopiera länk</button>
<ul id="items"></ul>
<form onsubmit="addItem(); return false;">
  <input type="checkbox" disabled>
  <input type="text" id="product" placeholder="Produkt att köpa" required>
  <input type="text" id="amount" placeholder="Antal/vikt/volym">
  <button type="submit">➕</button>
</form>
<script>
function addItem() {
  const ul = document.getElementById('items');
  const li = document.createElement('li');
  const product = document.getElementById('product').value;
  const amount = document.getElementById('amount').value;
  li.innerHTML = `<input type='checkbox'> ${product} (${amount}) <button onclick='this.parentElement.remove()'>🗑️</button>`;
  ul.appendChild(li);
  document.getElementById('product').value = '';
  document.getElementById('amount').value = '';
}
</script>
