<?php
require 'db.php';

// Basic server-side validation and sanitization
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

if ($name === '' || $comment === '') {
    header('Location: index.php?status=err');
    exit;
}

if (mb_strlen($name) > 100 || mb_strlen($comment) > 1000) {
    header('Location: index.php?status=err');
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO comments (name, comment) VALUES (:name, :comment)");
    $stmt->execute([':name' => $name, ':comment' => $comment]);
    header('Location: index.php?status=ok');
    exit;
} catch (Exception $e) {
    // In production, log the error instead of showing it
    header('Location: index.php?status=err');
    exit;
}
?>