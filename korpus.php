<?php
// korpus.php
require_once 'config/config.php';

$is_logged_in = isset($_SESSION['user_id']);
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Ambil semua corpus dari database
$query = "SELECT c.*, u.username FROM corpus c JOIN users u ON c.created_by = u.id ORDER BY c.created_at DESC";
$result = mysqli_query($conn, $query);
$corpus_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korpus - Website Corpus</title>
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
            height: 100%;
        }

        .card-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .card-body {
            padding: 1.5rem;
        }

        .badge-kategori {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
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
                        <a class="nav-link active" href="korpus.php">Korpus</a>
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
        <h1>Daftar Korpus</h1>
        <p>Temukan dan jelajahi berbagai jenis corpus data berkualitas</p>
    </section>

    <!-- Content -->
    <section class="section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari korpus..." onkeyup="filterCorpus()">
                </div>
                <div class="col-md-6">
                    <select class="form-select" id="categoryFilter" onchange="filterCorpus()">
                        <option value="">Semua Kategori</option>
                        <option value="Bahasa">Bahasa</option>
                        <option value="Medis">Medis</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Sastra">Sastra</option>
                    </select>
                </div>
            </div>

            <div class="row" id="corpusContainer">
                <?php if (count($corpus_list) > 0): ?>
                    <?php foreach ($corpus_list as $corpus): ?>
                        <div class="col-md-4 mb-4 corpus-item" data-kategori="<?= htmlspecialchars($corpus['kategori']) ?>" data-judul="<?= strtolower(htmlspecialchars($corpus['judul'])) ?>">
                            <div class="card card-item">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <span class="badge badge-kategori"><?= htmlspecialchars($corpus['kategori']) ?></span>
                                    </div>
                                    <h5 class="card-title"><?= htmlspecialchars($corpus['judul']) ?></h5>
                                    <p class="card-text text-muted"><?= substr(htmlspecialchars($corpus['deskripsi']), 0, 80) ?>...</p>
                                    <p class="card-text">
                                        <small class="text-muted"><i class="fas fa-file"></i> <?= htmlspecialchars($corpus['file']) ?></small>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted"><i class="fas fa-user"></i> <?= htmlspecialchars($corpus['username']) ?></small>
                                    </p>
                                    <?php if ($is_logged_in && $role == 'peserta'): ?>
                                        <a href="download_corpus.php?id=<?= $corpus['id'] ?>" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a>
                                    <?php else: ?>
                                        <a href="login.php" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Lihat Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center"><i class="fas fa-info-circle"></i> Belum ada corpus. <a href="login.php">Login</a> sebagai admin untuk menambahkan.</div>
                    </div>
                <?php endif; ?>
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
    <script>
        function filterCorpus() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const corpusItems = document.querySelectorAll('.corpus-item');

            corpusItems.forEach(item => {
                const judul = item.getAttribute('data-judul');
                const kategori = item.getAttribute('data-kategori');
                const matchSearch = judul.includes(searchInput);
                const matchCategory = categoryFilter === '' || kategori === categoryFilter;

                if (matchSearch && matchCategory) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>