-- install.sql
-- Crie o banco de dados e a tabela de comentários
-- Altere o nome do banco se desejar.

CREATE DATABASE IF NOT EXISTS anoite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE anoite;

CREATE TABLE IF NOT EXISTS comments (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  comment TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
