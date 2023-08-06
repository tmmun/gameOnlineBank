<?php
// Получение значения из Ajax запроса

require_once 'config.php';

// Пример использования констант
$host = DB_HOST;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

// Подключение к базе данных
$title = $_POST['title'];

$options = [
    'cost' => 12,
];

echo password_hash($title, PASSWORD_BCRYPT, $options);

?>
