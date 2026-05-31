<?php
// berita.php
require_once 'config/config.php';

$is_logged_in = isset($_SESSION['user_id']);
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Website Corpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        }

        .btn-login {
            background-color: #ffd700;
            color: #667eea !important;
            border: none;
            font-weight: bold;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .section {
            padding: 60px 20px;
        }

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

        footer {
            background: #333;
            color: white;
            padding: 40px 20px;
            text-align: center;
            margin-top: 50px;
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
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="berita.php">Berita</a>
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
                                        <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard Admin</a></li>
                                    <?php else: ?>
                                        <li><a class="dropdown-item" href="peserta/dashboard.php">Dashboard Peserta</a></li>
                                    <?php endif; ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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

    <!-- Page Header -->
    <section class="page-header">
        <h1>Berita & Artikel</h1>
        <p>Tetap update dengan berita terbaru seputar corpus dan penelitian</p>
    </section>

    <!-- Content -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- Berita 1 -->
                    <div class="card card-item mb-4">
                        <img src="https://via.placeholder.com/700x300?text=Berita+1" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title">Peluncuran Corpus Bahasa Indonesia Terbaru</h5>
                            <p class="text-muted"><i class="far fa-calendar"></i> Diposting pada: 31 Mei 2025</p>
                            <p class="card-text">Kami dengan senang hati mengumumkan peluncuran corpus bahasa Indonesia terbaru dengan lebih dari 1 juta kalimat berkualitas tinggi yang telah dikurasi oleh para ahli bahasa...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- Berita 2 -->
                    <div class="card card-item mb-4">
                        <img src="https://via.placeholder.com/700x300?text=Berita+2" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title">Workshop Penggunaan Corpus untuk Penelitian NLP</h5>
                            <p class="text-muted"><i class="far fa-calendar"></i> Diposting pada: 28 Mei 2025</p>
                            <p class="card-text">Tim kami akan mengadakan workshop gratis tentang cara menggunakan corpus untuk penelitian NLP dan machine learning. Peserta akan mendapatkan sertifikat resmi...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- Berita 3 -->
                    <div class="card card-item mb-4">
                        <img src="https://via.placeholder.com/700x300?text=Berita+3" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title">Update Fitur Pencarian Corpus dengan AI</h5>
                            <p class="text-muted"><i class="far fa-calendar"></i> Diposting pada: 25 Mei 2025</p>
                            <p class="card-text">Kami telah mengintegrasikan teknologi AI untuk meningkatkan akurasi pencarian corpus. Fitur baru ini akan membantu pengguna menemukan corpus yang relevan dengan lebih cepat...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="card card-item mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-newspaper"></i> Berita Terbaru</h5>
                            <hr>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <a href="#" class="text-decoration-none text-dark"><strong>Update Fitur Pencarian Corpus</strong></a>
                                    <p class="text-muted small">31 Mei 2025</p>
                                </li>
                                <li class="mb-3">
                                    <a href="#" class="text-decoration-none text-dark"><strong>Penambahan Corpus Medis Baru</strong></a>
                                    <p class="text-muted small">29 Mei 2025</p>
                                </li>
                                <li class="mb-3">
                                    <a href="#" class="text-decoration-none text-dark"><strong>Statistik Penggunaan Corpus 2025</strong></a>
                                    <p class="text-muted small">27 Mei 2025</p>
                                </li>
                                <li class="mb-3">
                                    <a href="#" class="text-decoration-none text-dark"><strong>Kolaborasi dengan Universitas Ternama</strong></a>
                                    <p class="text-muted small">25 Mei 2025</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-item">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-bell"></i> Kategori Berita</h5>
                            <hr>
                            <div class="mb-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">Pengumuman</a>
                            </div>
                            <div class="mb-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">Workshop</a>
                            </div>
                            <div class="mb-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">Penelitian</a>
                            </div>
                            <div class="mb-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">Pembaruan Fitur</a>
                            </div>
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
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>