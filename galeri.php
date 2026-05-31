<?php
// galeri.php
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
    <title>Galeri - Website Corpus</title>
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

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay-text {
            color: white;
            text-align: center;
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
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="korpus.php">Korpus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="galeri.php">Galeri</a>
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
        <h1>Galeri</h1>
        <p>Lihat koleksi visual dari berbagai corpus dan penelitian kami</p>
    </section>

    <!-- Gallery -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/400x250?text=Corpus+Bahasa" alt="Gallery">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-text">
                                <h5>Corpus Bahasa Indonesia</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/400x250?text=Corpus+Medis" alt="Gallery">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-text">
                                <h5>Corpus Medis</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/400x250?text=Corpus+Teknologi" alt="Gallery">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-text">
                                <h5>Corpus Teknologi</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/400x250?text=Research+1" alt="Gallery">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-text">
                                <h5>Penelitian NLP</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/400x250?text=Research+2" alt="Gallery">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-text">
                                <h5>Machine Learning</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="https://via.placeholder.com/400x250?text=Corpus+Sastra" alt="Gallery">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-text">
                                <h5>Corpus Sastra Indonesia</h5>
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