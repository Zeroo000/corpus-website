<?php
// tentang.php
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
    <title>Tentang - Website Corpus</title>
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
        }

        .card-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .team-member {
            text-align: center;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
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
                        <a class="nav-link" href="galeri.php">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tentang.php">Tentang</a>
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
        <h1>Tentang Kami</h1>
        <p>Mengenal lebih jauh tentang Website Corpus</p>
    </section>

    <!-- Content -->
    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/500x400" class="img-fluid rounded" alt="Tentang Kami">
                </div>
                <div class="col-md-6">
                    <h2>Visi Kami</h2>
                    <p>Website Corpus adalah platform terpadu yang didirikan dengan visi menyediakan akses mudah terhadap corpus data berkualitas tinggi untuk mendukung penelitian NLP dan linguistik di Indonesia.</p>
                    <h2 class="mt-4">Misi Kami</h2>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle" style="color: #667eea;"></i> Menyediakan corpus data yang lengkap dan berkualitas</li>
                        <li class="mb-2"><i class="fas fa-check-circle" style="color: #764ba2;"></i> Memfasilitasi penelitian dalam bidang NLP dan linguistik</li>
                        <li class="mb-2"><i class="fas fa-check-circle" style="color: #667eea;"></i> Membangun komunitas peneliti yang kuat dan kolaboratif</li>
                        <li class="mb-2"><i class="fas fa-check-circle" style="color: #764ba2;"></i> Terus berinovasi dalam menyediakan fitur dan layanan terbaik</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Nilai-nilai Kami -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">Nilai-Nilai Kami</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-lightbulb fa-3x mb-3" style="color: #667eea;"></i>
                            <h5 class="card-title">Inovasi</h5>
                            <p class="card-text">Kami terus berinovasi untuk memberikan solusi terbaik bagi pengguna.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-handshake fa-3x mb-3" style="color: #764ba2;"></i>
                            <h5 class="card-title">Kolaborasi</h5>
                            <p class="card-text">Kami percaya pada kekuatan kolaborasi dan kerjasama tim.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-star fa-3x mb-3" style="color: #667eea;"></i>
                            <h5 class="card-title">Kualitas</h5>
                            <p class="card-text">Kualitas adalah prioritas utama dalam setiap aspek layanan kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-shield-alt fa-3x mb-3" style="color: #764ba2;"></i>
                            <h5 class="card-title">Keamanan</h5>
                            <p class="card-text">Data Anda aman dan terlindungi dengan sistem keamanan terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hubungi Kami -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">Hubungi Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-map-marker-alt fa-3x mb-3" style="color: #667eea;"></i>
                            <h5>Alamat</h5>
                            <p>Jalan Merdeka No. 123<br>Jakarta, Indonesia 12345</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-phone fa-3x mb-3" style="color: #764ba2;"></i>
                            <h5>Telepon</h5>
                            <p>(021) 1234-5678<br>+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-item text-center">
                        <div class="card-body p-4">
                            <i class="fas fa-envelope fa-3x mb-3" style="color: #667eea;"></i>
                            <h5>Email</h5>
                            <p><a href="mailto:info@corpus.com" class="text-decoration-none">info@corpus.com</a><br><a href="mailto:support@corpus.com" class="text-decoration-none">support@corpus.com</a></p>
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