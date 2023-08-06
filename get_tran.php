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

// Выполнение запроса к базе данных для получения данных из таблицы
$sql = "SELECT * FROM " . $tableName;
$result = mysqli_query($connection, $sql);

$response = [];

if ($result) {
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $response['success'] = true;
    $response['data'] = $data;
} else {
    $response['success'] = false;
}

// Отправка ответа в формате JSON
echo json_encode($response);

mysqli_close($connection);
