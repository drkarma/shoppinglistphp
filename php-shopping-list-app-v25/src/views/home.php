<!DOCTYPE html>
<html lang='sv'>
<head>
  <meta charset='UTF-8'>
  <title>Listapp</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='container mt-5'>
  <div class='card p-4 shadow'>
    <h1>Skapa en ny lista</h1>
    <form method='POST' action='?action=create'>
        <div class='mb-3'>
            <label for='title' class='form-label'>Titel:</label>
            <input type='text' class='form-control' name='title' id='title' required>
        </div>
        <div class='mb-3'>
            <label for='type' class='form-label'>Typ:</label>
            <select name='type' class='form-select'>
                <option value='shopping'>Inköpslista</option>
                <option value='todo'>ToDo-lista</option>
                <option value='checklist'>Processchecklista</option>
            </select>
        </div>
        <button type='submit' class='btn btn-primary'>Skapa lista</button>
    </form>
  </div>
</body>
</html>