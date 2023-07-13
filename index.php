<?php
// Подключаем файл для подключения к базе данных
require_once 'db.php';

// Получаем объект соединения с базой данных
$conn = checkDB();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Список пользователей</title>
</head>
<body>
    <div class="container">
        <h1>Тестовое задание для "ЮНОНА"</h1>        
        <h2>Список пользователей</h2>
        <form action="index.php" method="POST" onsubmit="searchUser(event)">
            <input type="text" id="search-input" name="search-input" placeholder="Поиск по логину" required>
            <button type="submit">Найти</button>
            <button class="reboot-btn" id="reset-button">Сбросить</button>
        </form>
        <div class="modal" id="user-popup">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" id="close-button">&times;</button>
                    <h2>Сообщения пользователя</h2>
                </div>
                <div class="modal-body">
                    <div class="message-text">
                        <p id="user-messages"></p>
                    </div>
                </div>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th id="login-header">Логин</th>
                    <th id="msg-count-header" title="Сортировка по убыванию\возрастанию">Кол-во сообщений<span class="sort-icon">&nbsp;</span><span class="sort-icon">&#9650;</span></th>
                </tr>
            </thead>
            <tbody id="user-list">
                <?php
                // Выполняем SQL-запрос на выборку пользователей и количества сообщений
                $sql = "SELECT users.id, users.login, COUNT(messages.id) AS message_count
                        FROM users
                        LEFT JOIN messages ON users.id = messages.user_id
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
                    echo '<span class="not-found">Данные не найдены!</span>';
                }
                // Закрываем результаты и соединение с базой данных
                $result->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="scripts.js"></script>
</body>
</html>