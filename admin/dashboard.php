<?php
// admin/dashboard.php
require_once '../config/config.php';
check_admin();

// Ambil semua corpus
$query = "SELECT * FROM corpus ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$corpus_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
$total_corpus = count($corpus_list);

// Hitung total peserta
$peserta_query = "SELECT COUNT(*) as total FROM users WHERE role = 'peserta'";
$peserta_result = mysqli_query($conn, $peserta_query);
$peserta_data = mysqli_fetch_assoc($peserta_result);
$total_peserta = $peserta_data['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Website Corpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
        }

        .sidebar-brand {
            color: white;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 1.3rem;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            color: white;
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.2);
            padding-left: 30px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar-admin {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .stat-card h3 {
            color: #667eea;
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-card p {
            color: #666;
            margin-bottom: 0;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-tambah {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            margin-bottom: 20px;
        }

        .btn-tambah:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        table {
            margin-bottom: 0;
        }

        .badge-kategori {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-buttons a,
        .action-buttons form button {
            padding: 5px 10px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-book"></i> Admin Panel
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tambah_corpus.php"><i class="fas fa-plus"></i> Tambah Corpus</a></li>
            <li><a href="../index.php"><i class="fas fa-globe"></i> Kembali ke Website</a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-admin">
            <div class="container-fluid">
                <span class="navbar-text">
                    <i class="fas fa-user-circle"></i> Halo, <?= htmlspecialchars($_SESSION['username']) ?>
                </span>
            </div>
        </nav>

        <!-- Statistics -->
        <div class="row">
            <div class="col-md-6">
                <div class="stat-card">
                    <h3><?= $total_corpus ?></h3>
                    <p><i class="fas fa-book"></i> Total Corpus</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card">
                    <h3><?= $total_peserta ?></h3>
                    <p><i class="fas fa-users"></i> Total Peserta</p>
                </div>
            </div>
        </div>

        <!-- Daftar Corpus -->
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><i class="fas fa-list"></i> Daftar Corpus</h4>
                <a href="tambah_corpus.php" class="btn btn-tambah"><i class="fas fa-plus"></i> Tambah Corpus Baru</a>
            </div>

            <?php if (count($corpus_list) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>File</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($corpus_list as $corpus): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($corpus['judul']) ?></td>
                                    <td><span class="badge badge-kategori"><?= htmlspecialchars($corpus['kategori']) ?></span></td>
                                    <td><i class="fas fa-file"></i> <?= htmlspecialchars($corpus['file']) ?></td>
                                    <td><?= date('d M Y', strtotime($corpus['created_at'])) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit_corpus.php?id=<?= $corpus['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="hapus_corpus.php?id=<?= $corpus['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i> Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> Belum ada corpus. <a href="tambah_corpus.php">Tambah corpus baru</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>