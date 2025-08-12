<?php
// db.php - configure your database connection here
$DB_HOST = 'localhost';
$DB_NAME = 'anoite';
$DB_USER = 'root';
$DB_PASS = 'root'; // ALTERE para sua senha

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die("Erro ao conectar ao banco de dados: " . htmlspecialchars($e->getMessage()));
}
?>