<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);
    
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Некорректный email адрес';
    }
    if (empty($comment)) {
        $errors[] = 'Введите текст отзыва';
    } elseif (strlen($comment) < 5) {
        $errors[] = 'Отзыв должен содержать минимум 5 символов';
    }
    
    $referer = $_SERVER['HTTP_REFERER'] ?? 'aficha.php';
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO otsiv (Email, Text) VALUES (?, ?)");
            $stmt->execute([$email, $comment]);

            header('Location: ' . $referer . '?review_success=1');
            exit;
        } catch (PDOException $e) {
            $errors[] = 'Ошибка базы данных: ' . $e->getMessage();
        }
    }
    
    if (!empty($errors)) {
        $error_msg = implode(', ', $errors);
        header('Location: ' . $referer . '?review_error=' . urlencode($error_msg));
        exit;
    }
}
?>