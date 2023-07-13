<?php
// Подключаем файл для подключения к базе данных
require_once 'db.php';

// Получаем объект соединения с базой данных
$conn = checkDB();

// Получаем значение из POST-запроса
$searchValue = $_POST['searchValue'];

// Выполняем SQL-запрос на выборку пользователей и количества сообщений
$sql = "SELECT users.id, users.login, COUNT(messages.id) AS message_count
        FROM users
        LEFT JOIN messages ON users.id = messages.user_id
        WHERE users.login LIKE '%$searchValue%'
        GROUP BY users.id";
$result = $conn->query($sql);

// Обрабатываем результаты запроса
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='" . $row["id"] . "' class='user-row'>";
        echo "<td class='user-login'>" . $row["login"] . "</td>";
        echo "<td>" . $row["message_count"] . "</td>";
        echo "</tr>";
    }
} else {
    echo '<span class="not-found">Логин не найден!</span>';
}

// Закрываем результаты и соединение с базой данных
$result->close();
$conn->close();
?>