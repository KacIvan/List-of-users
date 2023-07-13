<?php
require_once 'db.php';

// Получаем объект соединения с базой данных
$conn = checkDB();

// Получаем идентификатор пользователя из параметра GET-запроса
$user_id = $_GET['id'];

// Выполняем запрос к таблице messages
$sql = "SELECT * FROM messages WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Получаем результат запроса в виде ассоциативного массива
$result = $stmt->get_result();

// Проверяем, есть ли сообщения у пользователя
if ($result->num_rows === 0) {
    echo "Пользователь еще не оставил ни одного сообщения!";
} else {
    // Формируем HTML-код сообщений пользователя
    $html = '';
    while ($row = $result->fetch_assoc()) {
        $html .= "<div class='message-box'>" . "<span class='time'>" . $row["datetime"] . "</span>" . ": " . $row["text"] . "<br>" . "</div>";
    }

    // Выводим HTML-код сообщений пользователя
    echo $html;
}

// Закрываем результаты и соединение с базой данных
$stmt->close();
$conn->close();
?>