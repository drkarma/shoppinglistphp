<h1>Skapa en ny lista</h1>
<form method='POST' action='?action=create'>
  Titel: <input type='text' name='title' required><br>
  Typ: <select name='type'>
    <option value='shopping'>Inköpslista</option>
    <option value='todo'>ToDo-lista</option>
    <option value='checklist'>Processchecklista</option>
  </select><br>
  <button type='submit'>Skapa lista</button>
</form>
