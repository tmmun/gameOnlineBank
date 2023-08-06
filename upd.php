<?php
// Получение значения из Ajax запроса
$myname = $_POST['myname'];
$content = $_POST['content'];
$hisname = $_POST['hisname'];
$key = $_POST['key'];

// $options = [
//     'cost' => 12,
// ];
// $key_hash = password_hash($key, PASSWORD_BCRYPT, $options);

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

// echo $key_hash;

//UPDATE

$sql3 = "SELECT * FROM `account` WHERE `title` = '$myname'";
$result = mysqli_query($connection, $sql3);
if ($result && mysqli_num_rows($result) > 0) {
    // Обработайте найденный результат
    while ($row = mysqli_fetch_assoc($result)) {
        // Извлеките необходимые данные из строки результата
        $id = $row['id'];
        $myname = $row['title'];
        $mybank = $row['bank'];
        $mykey = $row['keyProf'];
        // и т.д.

        if (password_verify($key, $mykey) && $mybank > $content) {

            $nevnum2 = $mybank - $content; // вычесляем мою сумму

            // Обновление моего значения в таблице MySQL
            $sql3 = "UPDATE `account` SET `bank` = '$nevnum2' WHERE `title` = '$myname'";
            mysqli_query($connection, $sql3);

            echo $nevnum2;

            // echo $mykey;

            //echo $nevnum2 . 'мой банк';

            //UPDATE

            ////////////////////////////////////////////////////////////////////////////////////////////////

            // Выполнение запроса к базе данных для получения текущего числа
            $sql = "SELECT * FROM `account` WHERE `title` = '$hisname'";
            $result = mysqli_query($connection, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                // Обработайте найденный результат
                while ($row = mysqli_fetch_assoc($result)) {
                    // Извлеките необходимые данные из строки результата
                    $id = $row['id'];
                    $hisname = $row['title'];
                    $bank = $row['bank'];
                    // и т.д.
                }
            } else {
                echo " | Человек не найден | ";
            }

            $nevnum = $bank + $content; // вычесляем его сумму

            // Обновление его значения в таблице MySQL
            $sql = "UPDATE `account` SET `bank` = '$nevnum' WHERE `title` = '$hisname'";
            mysqli_query($connection, $sql);

            //echo $nevnum . 'его банк';

            //UPDATE


            //INSERT INTO

            $minusnum = (string)$content; // конвертим в строку

            $minus = 'перевел вам    + ' . $minusnum; // формируем строку для записис в его таблицу транзакций

            // добавляем значения в его таблицу $title
            $sql2 = "INSERT INTO `$hisname` (`id`, `title`, `sum`) VALUES (NULL, '$myname', '$minus')";

            // второй запрос к базе данных под занванием title
            $result2 = mysqli_query($connection, $sql2);

            if ($result2) {
            } else {
                // Обработка ошибки выполнения запроса
                echo " | Ошибка выполнения запроса: |" . mysqli_error($connection);
            }

            ////////////////////////////////////////////////////////////////////////////////////////////////

            $minus = 'вы перевели    - ' . $minusnum; // формируем строку для записис в его таблицу транзакций

            // добавляем значения в его таблицу $title
            $sql4 = "INSERT INTO `$myname` (`id`, `title`, `sum`) VALUES (NULL, '$hisname', '$minus')";

            // второй запрос к базе данных под занванием title
            $result4 = mysqli_query($connection, $sql4);

            if ($result4) {
            } else {
                // Обработка ошибки выполнения запроса
                echo " | Ошибка выполнения запроса: | " . mysqli_error($connection);
            }
        } else {
            echo ' | Пароль неправильный. | ';
        }
    }
} else {
    echo "Человек не найден";
}





//INSERT INTO


// Закрытие соединения с базой данных
mysqli_close($connection);

//
