<?php
require_once 'config.php';

// Пример использования констант
$host = DB_HOST;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

// Подключение к базе данных
$connection = mysqli_connect($host, $username, $password, $dbname);
if (!$connection) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$tableName = $_POST['table_name'];
$columnName1 = $_POST['column_name_1'];
$columnName2 = $_POST['column_name_2'];

// Создание запроса для создания таблицы
$sql = "CREATE TABLE $tableName (
id INT AUTO_INCREMENT PRIMARY KEY,
$columnName1 VARCHAR(255),
$columnName2 VARCHAR(255),
date_time DATETIME NULL DEFAULT CURRENT_TIMESTAMP
)";

$result = mysqli_query($connection, $sql);

$response = [];

if ($result) {
$response['success'] = true;
} else {
$response['success'] = false;
}

// Отправляем ответ в формате JSON
echo json_encode($response);

mysqli_close($connection);
?>