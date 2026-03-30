<?php
include 'koneksi.php';
session_start();
function status($status) {
    if($status == "Menunggu") {
        echo "<div class=''> Menunggu</div>";
    } else if($status == "Proses") {
        echo "<div class=''> Proses</div>";
    } else {
        echo "<div class=''> Selesai</div>";
    }
}
$id     = $_GET['id'];
$sql    =  mysqli_query($koneksi, "SELECT * FROM input_aspirasi, aspirasi, kategori WHERE
            kategori.id_kategori        = input_aspirasi.id_kategori AND
            aspirasi.id_kategori        = kategori.id_kategori      AND
            input_aspirasi.id_pelaporan = '$id' ");
$data   = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan | Aplikasi Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/sengaja.css">
</head>
<body class="login-page">
    <div>
        <form action="#" method="post" class="login-card" style="max-width:560px;">
            <div class="google-dots">
                <span style="background:#4285F4"></span>
                <span style="background:#EA4335"></span>
                <span style="background:#FBBC05"></span>
                <span style="background:#34A853"></span>
            </div>
            <h3 class="card-title">Data Pengaduan NIS <?= $_SESSION['nis'] ?> Kelas <?= $_SESSION['kelas'] ?></h3>
            <p class="card-subtitle">Aplikasi Pengaduan Sarana Sekolah</p>

            <div style="display:grid; gap:10px; margin-top:20px;">
                <a href="index.php" class="btn-add" style="margin-bottom:20px;">
                    <i class="fa fa-plus"></i> Tambah Pengaduan
                </a>

                <div style="border:1px solid #dadce0; border-radius:10px; overflow:hidden; margin-bottom:20px;">
                    <div class="divnya">
                        <span class="spannya1">NIS</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3"><?= $data['nis'] ?></span>
                    </div>
                    <div class="divnya">
                        <span class="spannya1">Kelas</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3"><?= $_SESSION['kelas'] ?></span>
                    </div>
                    <div class="divnya">
                        <span class="spannya1">Kategori Pengaduan</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3"><?= $data['ket_kategori'] ?></span>
                    </div>
                    <div class="divnya">
                        <span class="spannya1">Status</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3"><?php status($data['status']); ?></span>
                    </div>
                    <div class="divnya">
                        <span class="spannya1">Lokasi</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3"><?= $data['lokasi'] ?></span>
                    </div>
                    <div class="divnya">
                        <span class="spannya1">Pengaduan</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3"><?= $data['ket'] ?></span>
                    </div>
                    <div class="divnya">
                        <span class="spannya1"><i class="fa fa-comment"></i> Feedback</span>
                        <span class="spannya2">:</span>
                        <span class="spannya3">
                            <?= ($data['feedback'] == "" ? "Belum ada balasan" : $data['feedback']) ?>
                        </span>
                    </div>
                </div>

                <a href="data-pengaduan.php" class="anchor" style="text-align: end;">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['tombol'])) {
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    include 'koneksi.php';
    $sql = "SELECT * FROM siswa WHERE nis ='$nis' AND kelas='$kelas' ";
    $data = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($data) > 0) {
        $_SESSION['nis'] = $nis;
        $_SESSION['kelas'] = $kelas;
        header('location:data-pengaduan.php');
    } else {
        $_SESSION['error'] = "Maaf Kombinasi NIS dan kelas tidak ditemukan";
        header('location:cek-pengaduan.php');
    }
}
?>