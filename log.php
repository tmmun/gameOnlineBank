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
$mykey = $_POST['mykey'];

// Создание подключения к базе данных
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка соединения на ошибки
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Подготовка и выполнение SQL-запроса
$sql = "SELECT * FROM `account` WHERE `title` = '$title'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Обработка полученных данных, например, вывод или использование в других операциях
    while ($row = $result->fetch_assoc()) {
        $myname = $row['title'];
        $mybank = $row['bank'];
        $key = $row['keyProf'];
        // ... другие поля
    }

    if (password_verify($mykey, $key)) {
        echo $myname.'|';
        echo $mybank.'|';
        echo 'account';
    } else {
        echo "Ошибка";
        //echo 'Пароль неправильный.';
    }

} else {
    echo "Ошибка";
}

// Закрытие соединения с базой данных
$conn->close();
