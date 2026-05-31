<?php
// index.php
require_once 'config/config.php';

// Cek apakah user sudah login
$is_logged_in = isset($_SESSION['user_id']);
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Website Corpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffd700 !important;
            transform: translateY(-2px);
        }

        .btn-login {
            background-color: #ffd700;
            color: #667eea !important;
            border: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #ffed4e;
            transform: scale(1.05);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 20px;
            text-align: center;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .btn-cta {
            background-color: #ffd700;
            color: #667eea !important;
            padding: 12px 30px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cta:hover {
            background-color: #ffed4e;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Section */
        .section {
            padding: 80px 20px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 15px auto 0;
        }

        /* Card */
        .card-item {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .card-item img {
            height: 200px;
            object-fit: cover;
        }

        /* Footer */
        footer {
            background: #333;
            color: white;
            padding: 40px 20px;
            text-align: center;
            margin-top: 50px;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-book"></i> Website Corpus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="korpus.php">Korpus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeri.php">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <?php if ($is_logged_in): ?>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i> <?= htmlspecialchars($username) ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <?php if ($role == 'admin'): ?>
                                        <li><a class="dropdown-item" href="admin/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a></li>
                                    <?php else: ?>
                                        <li><a class="dropdown-item" href="peserta/dashboard.php"><i class="fas fa-user"></i> Dashboard Peserta</a></li>
                                    <?php endif; ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="btn btn-login btn-sm" href="login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1><i class="fas fa-graduation-cap"></i> Selamat Datang di Website Corpus</h1>
            <p>Platform terpadu untuk manajemen dan akses data corpus terlengkap</p>
            <a href="korpus.php" class="btn btn-cta">Jelajahi Korpus</a>
        </div>
    </section>

    <!-- Section Beranda -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title">Tentang Website Kami</h2>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card card-item">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-database fa-3x mb-3" style="color: #667eea;"></i>
                            <h5 class="card-title">Database Lengkap</h5>
                            <p class="card-text">Akses ke berbagai jenis corpus data dengan kualitas tinggi dan terstruktur dengan baik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-item">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-search fa-3x mb-3" style="color: #764ba2;"></i>
                            <h5 class="card-title">Pencarian Mudah</h5>
                            <p class="card-text">Cari corpus yang Anda butuhkan dengan fitur filter dan pencarian yang powerful dan akurat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-item">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-download fa-3x mb-3" style="color: #667eea;"></i>
                            <h5 class="card-title">Download Cepat</h5>
                            <p class="card-text">Download corpus data dengan cepat dan mudah untuk kebutuhan penelitian Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Fitur -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Fitur Unggulan</h2>
            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="d-flex">
                        <div style="min-width: 60px;">
                            <i class="fas fa-check-circle fa-2x" style="color: #667eea;"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Manajemen Corpus Terpusat</h5>
                            <p>Kelola semua corpus Anda dalam satu platform yang terintegrasi dengan baik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex">
                        <div style="min-width: 60px;">
                            <i class="fas fa-check-circle fa-2x" style="color: #764ba2;"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Akses Berbasis Peran</h5>
                            <p>Admin dapat mengelola corpus, peserta dapat mengakses dan mengunduh data.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex">
                        <div style="min-width: 60px;">
                            <i class="fas fa-check-circle fa-2x" style="color: #667eea;"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Kategori Lengkap</h5>
                            <p>Corpus tersedia dalam berbagai kategori untuk memudahkan pencarian Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex">
                        <div style="min-width: 60px;">
                            <i class="fas fa-check-circle fa-2x" style="color: #764ba2;"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Upload File Mudah</h5>
                            <p>Admin dapat dengan mudah menambahkan corpus baru melalui form upload yang sederhana.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Website Corpus. All rights reserved.</p>
            <p>
                <a href="tentang.php">Tentang Kami</a> | 
                <a href="#">Kebijakan Privasi</a> | 
                <a href="#">Hubungi Kami</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>