<?php

$host='localhost';
$username='root';
$pass= 'root';
$db='2024inform';

$conn= new mysqli($host, $username, $pass, $db);

if($conn->connect_error) {
    die("Ошибка подключения к БД");
}

?>