<?php
session_start();
include 'koneksi.php';
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukan Saran | Aplikasi Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/sengaja.css">
</head>
<body class="login-page">
    <form action="#" method="post" class="login-card" style="max-width:480px;">
        <div class="google-dots">
            <span style="background:#4285F4"></span>
            <span style="background:#EA4335"></span>
            <span style="background:#FBBC04"></span>
            <span style="background:#34A853"></span>
        </div>
        <h3 class="card-title">Pengaduan</h3>
        <p class="card-subtitle">Aplikasi Pengaduan Sarana Sekolah</p>

        <div class="form-group">
            <input type="number" name="nis" class="floating-input" required placeholder=" " id="nis">
            <label for="nis" class="floating-label">NISN</label>
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

        <div class="form-group">
            <select name="id_kategori" id="id_kategori" class="floating-input floating-select" required>
                <option value="">PILIH KATEGORI</option>
                <?php
                foreach($kategori as $data) {?>
                <option value="<?= $data['id_kategori'] ?>"><?= $data['ket_kategori'] ?></option>
                <?php } ?>
            </select>
            <label for="id_kategori" class="floating-label floating-label-select">Kategori</label>
        </div>

        <div class="form-group">
            <textarea name="lokasi" id="lokasi" class="floating-input floating-textarea" required placeholder=" "></textarea>
            <label for="lokasi" class="floating-label">Lokasi</label>
        </div>

        <div class="form-group">
            <textarea name="ket" id="ket" class="floating-input floating-textarea" required placeholder=" "></textarea>
            <label for="ket" class="floating-label">Deskripsi Laporan</label>
        </div>

        <div style="display:grid; gap:10px; margin-top:20px;">
        <button type="submit" name="tombol" class="btn-google">
            <i class="fa fa-paper-plane"></i> KIRIM
        </button>
        <a href="cek-pengaduan.php" class="anchor">Cek Pengaduan</a>
        </div>
    </form>
</body>
</html>
<?php
if(isset($_POST['tombol'])) {
    include 'koneksi.php';
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $data1 = mysqli_query($koneksi, "INSERT INTO siswa(nis,kelas) VALUES('$nis', '$kelas')");

    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $ket = $_POST['ket'];
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date('d-m-Y H:i:s');
    $sql = "INSERT INTO input_aspirasi(nis,id_kategori,lokasi,ket,tgl_input) VALUES('$nis','$id_kategori','$lokasi','$ket','$tgl')";
    $data2 = mysqli_query($koneksi, $sql);

    $id_pelaporan = mysqli_insert_id($koneksi);
    $status = "Menunggu";
    $sql1 = "INSERT INTO aspirasi (id_pelaporan,id_kategori,status,feedback) VALUES('$id_pelaporan','$id_kategori','$status','')";
    $data = mysqli_query($koneksi, $sql1);
    session_start();
    $_SESSION['Pengaduan Berhasil Disimpan'];
    header('location:cek-pengaduan.php');
}
?>