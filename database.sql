-- Buat Database
CREATE DATABASE IF NOT EXISTS corpus_db;
USE corpus_db;

-- Tabel Users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'peserta') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Corpus
CREATE TABLE corpus (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    file VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert Admin Default (username: admin, password: admin123)
INSERT INTO users (username, email, password, role) VALUES 
('admin', 'admin@corpus.com', '$2y$10$YIjlrLxG8z9KqZj2x7q7UekX.YOJ6L.nf.Q7Yz9Dz7K8M9L0H6', 'admin');
