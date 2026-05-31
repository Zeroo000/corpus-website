<?php
// config/config.php - Konfigurasi Database

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'corpus_db');

// Koneksi Database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek Koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set Charset
$conn->set_charset("utf8");

// Session
session_start();

// Helper function untuk redirect
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

// Helper function untuk check login
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        redirect('../../login.php');
    }
}

// Helper function untuk check admin
function check_admin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
        redirect('../../index.php');
    }
}

// Helper function untuk check peserta
function check_peserta() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'peserta') {
        redirect('../../index.php');
    }
}
?>