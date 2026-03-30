<?php
session_start();
if($_SESSION['login']== false) {
    $_SESSION['error'] = "Maaf anda harus login dulu";
    header('location:../login-admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sengaja.css">
</head>
<body>
        <nav class="navbar">
            <div class="navbar-inner">
                <a class="navbar-brand" href="#">
                    <div class="brand-dots">
                        <span style="background:#4285F4"></span>
                        <span style="background:#EA4335"></span>
                        <span style="background:#FBBC04"></span>
                        <span style="background:#34A853"></span>
                    </div>
                    Aplikasi Pengaduan Sarana Sekolah
                </a>
                <button class="navbar-toggler" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="navbar-collapse" id="navbarID">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <a class="nav-link active" aria-current="page" href="?page=kategori">
                            <i class="fa fa-tags"></i> Kategori Pengaduan
                        </a>
                        <a class="nav-link active" aria-current="page" href="?page=pengaduan">
                            <i class="fa fa-message"></i> Pengaduan
                        </a>
                        <a class="nav-link active" aria-current="page" href="logout.php">
                            <i class="fa fa-power-off"></i> logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="page-body">
            <div class="content-card">
            <?php
            $page = isset($_GET['page'])?$_GET['page']:'';
            if(file_exists($page.".php")) {
                include $page.".php";
            } else { ?>
                <div class="welcome-icon">
                    <i class="fa fa-school"></i>
                </div>
                <h4>Selamat Datang</h4>
                <p class="text-muted fst-italic">
                    Pengelolaan Pengaduan Sarana Sekolah digunakan untuk menerima, memverifikasi dan
                    menindaklanjuti laporan atas kerusakan dan kendala fisik sekolah secara terstruktur dan
                    terdokumentasi.
                </p>
                <div class="stat-chips">
                    <a href="?page=kategori" class="stat-chip"><i class="fa fa-tags"></i> Kategori Pengaduan</a>
                    <a href="?page=pengaduan" class="stat-chip"><i class="fa fa-message"></i> Lihat Pengaduan</a>
                </div>
            <?php }?>
            </div>
        </div>
</body>
</html>