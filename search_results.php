<?php
// Установка соединения с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Получение текста для поиска из параметров запроса
$search_text = $_GET['search'];

// Поиск записей по тексту комментария
$sql = "SELECT posts.title, comments.body FROM posts INNER JOIN comments ON posts.id = comments.postId WHERE comments.body LIKE '%$search_text%'";
$result = $conn->query($sql);

// Вывод результатов поиска
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Заголовок записи: " . $row["title"]. "<br>";
        echo "Комментарий: " . $row["body"]. "<br><br>";
    }
} else {
    echo "Ничего не найдено";
}

// Закрытие соединения с базой данных
$conn->close();
?>