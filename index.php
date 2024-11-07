<?php
 
 require 'db.php';

 $result=$conn->query("SHOW TABLES");

 $tables=[];

 while($row=$result->fetch_assoc()) {
    $tables[]=reset($row);
 }

 echo "<ul>";
 foreach($tables as $table) {
    $colCount=$conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='" . $table . "'");

    $colCountRow= $colCount->fetch_row();
    $cols= $colCountRow[0];

    echo "<li>$table</li>"
 }

 echo "</ul>";
?>