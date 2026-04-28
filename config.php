<?php
$host = 'localhost'; //название хоста
$dbname = 'kurs'; //название базы данных
$username = 'root'; //имя пользователя
$password = ''; //пароль 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password); //подключение к бд
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //установка атрибута режима обработки ошибок
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //установка атрибута режима выборки данных по умолчанию
} catch(PDOException $e) { //выполняется, если в блоке try произошла ошибка типа PDOException
    die("Ошибка подключения к базе данных: " . $e->getMessage()); //сообщение об ошибке подключения
}
?>