<?php

require 'db.php';

$result = $conn->query("SHOW TABLES");
$tables = [];

while ($row = $result->fetch_assoc()) {
    $tables[] = reset($row);
}

echo "<ul>";
foreach ($tables as $table) {
    $colCount = $conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='" . $table . "'");
    $colCountRow = $colCount->fetch_row();
    $cols = $colCountRow[0];
    
    echo '<li><a href="?table=' . urlencode($table) . '">' . htmlspecialchars($table) . ' (' . $cols . ')</a></li>';
}
echo "</ul>";

if (isset($_GET['table'])) {
    $selected = $_GET['table'];
    $structure = $conn->query("DESCRIBE " . $selected);
    $fields = [];
    while ($row = $structure->fetch_assoc()) {
        $fields[] = $row;
    }

    $data = $conn->query("SELECT * FROM " . $selected);
    $rows = [];
    while ($row = $data->fetch_assoc()) {
        $rows[] = $row;
    }

    echo "<table>";
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field["Field"]) . "</th>";
    }
    echo "</tr>";

    foreach ($rows as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
