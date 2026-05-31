<?php
// admin/tambah_corpus.php
require_once '../config/config.php';
check_admin();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $file = '';

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
        // Validasi file
        $allowed_ext = array('pdf', 'txt', 'docx', 'xlsx', 'csv', 'zip');
        if (!in_array(strtolower($file_ext), $allowed_ext)) {
            $error = 'Format file tidak didukung. Format yang diizinkan: pdf, txt, docx, xlsx, csv, zip';
        } else if ($file_size > 50000000) { // 50MB
            $error = 'Ukuran file terlalu besar (max 50MB)';
        } else {
            // Generate nama file unik
            $file = time() . '_' . basename($file_name);
            $file_path = '../uploads/' . $file;
            
            if (move_uploaded_file($file_tmp, $file_path)) {
                // File berhasil diupload
            } else {
                $error = 'Gagal mengupload file';
            }
        }
    } else {
        $error = 'Silakan pilih file';
    }

    // Insert ke database
    if (empty($error) && !empty($judul) && !empty($kategori) && !empty($file)) {
        $insert_query = "INSERT INTO corpus (judul, kategori, deskripsi, file, created_by, created_at) 
                         VALUES ('$judul', '$kategori', '$deskripsi', '$file', {$_SESSION['user_id']}, NOW())";
        
        if (mysqli_query($conn, $insert_query)) {
            $success = 'Corpus berhasil ditambahkan!';
            // Reset form
            $_POST = array();
        } else {
            $error = 'Gagal menambahkan corpus: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Corpus - Website Corpus</title>
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

        .form-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 30px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            padding: 10px 30px;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
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
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="tambah_corpus.php" class="active"><i class="fas fa-plus"></i> Tambah Corpus</a></li>
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

        <!-- Form Container -->
        <div class="form-container">
            <h4 class="mb-4"><i class="fas fa-plus-circle"></i> Tambah Corpus Baru</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i> <?= $success ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Judul Corpus *</label>
                    <input type="text" class="form-control" name="judul" required placeholder="Masukkan judul corpus">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori *</label>
                    <select class="form-select" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Bahasa">Bahasa</option>
                        <option value="Medis">Medis</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Sastra">Sastra</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="4" placeholder="Masukkan deskripsi corpus"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">File Corpus *</label>
                    <input type="file" class="form-control" name="file" required accept=".pdf,.txt,.docx,.xlsx,.csv,.zip">
                    <small class="text-muted">Format: PDF, TXT, DOCX, XLSX, CSV, ZIP (Max 50MB)</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-submit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="dashboard.php" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>