<?php
namespace App\Controller;

class ListController {
    public function handleRequest() {
        echo "<h1>Skapa en ny lista</h1>";
        echo "<form method='POST' action='?action=create'>";
        echo "Titel: <input type='text' name='title' required><br>";
        echo "Typ: ";
        echo "<select name='type'>";
        echo "<option value='shopping'>Inköpslista</option>";
        echo "<option value='todo'>ToDo-lista</option>";
        echo "<option value='checklist'>Processchecklista</option>";
        echo "</select><br>";
        echo "<button type='submit'>Skapa lista</button>";
        echo "</form>";
    }
}
