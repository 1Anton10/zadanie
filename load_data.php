<?php
// Установка соединения с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Получение списка записей блога
$posts_json = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$posts = json_decode($posts_json, true);

// Загрузка записей в базу данных
foreach ($posts as $post) {
    $userId = $post['userId'];
    $title = $post['title'];
    $body = $post['body'];

    $sql = "INSERT INTO posts (userId, title, body) VALUES ('$userId', '$title', '$body')";
    $conn->query($sql);
}

// Получение комментариев к записям
$comments_json = file_get_contents('https://jsonplaceholder.typicode.com/comments');
$comments = json_decode($comments_json, true);

// Загрузка комментариев в базу данных
foreach ($comments as $comment) {
    $postId = $comment['postId'];
    $name = $comment['name'];
    $email = $comment['email'];
    $body = $comment['body'];

    $sql = "INSERT INTO comments (postId, name, email, body) VALUES ('$postId', '$name', '$email', '$body')";
    $conn->query($sql);
}

// Вывод количества загруженных записей и комментариев
echo "Загружено " . count($posts) . " записей и " . count($comments) . " комментариев";

// Закрытие соединения с базой данных
$conn->close();
?>