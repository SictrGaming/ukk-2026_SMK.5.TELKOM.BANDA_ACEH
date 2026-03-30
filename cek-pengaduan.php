<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pengaduan | Aplikasi Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="css/sengaja.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body class="login-page">
    <div>
        <form action="#" method="post" class="login-card">
            <div class="google-dots">
                <span style="background:#4285F4"></span>
                <span style="background:#EA4335"></span>
                <span style="background:#FBBC05"></span>
                <span style="background:#34A853"></span>
            </div>
            <h3 class="card-title">Cek Pengaduan</h3>
            <p class="card-subtitle">Aplikasi Pengaduan Sarana Sekolah</p>
            <div class="form-group">
                <input type="number" name="nis" class="floating-input" required placeholder="Masukan NISN">
                <label for="" class="floating-label">NISN</label>
            </div>
            <div class="form-group">
                <select name="kelas" id="kelas" class="floating-input floating-select" required>
                    <option value="">PILIH KELAS</option>
                    <option value="X RPL 1">X RPL 1</option>
                    <option value="X RPL 2">X RPL 2</option>
                    <option value="X RPL 3">X RPL 3</option>
                    <option value="XI RPL 1">XI RPL 1</option>
                    <option value="XI RPL 2">XI RPL 2</option>
                    <option value="XI RPL 3">XI RPL 3</option>
                    <option value="XII RPL 1">XII RPL 1</option>
                    <option value="XII RPL 2">XII RPL 2</option>
                    <option value="XII RPL 3">XII RPL 3</option>
                </select>
                <label for="kelas" class="floating-label">Kelas</label>
            </div>
            <div style="display:grid; gap:10px; margin-top:20px;">
                <button type="submit" name="tombol" class="btn-google">Cek</button>
                <a href="index.php" class="anchor">Kembali</a>
            </div>
                <?php
                if(isset($_SESSION['error'])) {?>
                <div class="alert-google">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error'])
                ?>
                </div>
                <?php } ?>
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