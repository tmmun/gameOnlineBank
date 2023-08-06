<?php

$key = $_POST['key'];

require_once 'config.php';

// Пример использования констант
$host = DB_HOST;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

// Подключение к базе данных
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

mysqli_query($conn, 'set names utf8');
$sql = "SELECT title,bank,keyProf FROM account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // вывод данных
    while ($row = $result->fetch_assoc()) {
        echo json_encode($row, JSON_UNESCAPED_UNICODE) . ' ';
    }
} else {
    echo "0 результатов";
}
$conn->close();
