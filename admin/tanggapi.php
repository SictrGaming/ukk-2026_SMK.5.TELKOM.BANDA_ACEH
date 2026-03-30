<?php
include 'akses.php';
include '../koneksi.php';

function status($status) {
    if($status == "Menunggu") {
        echo "<div class='status-badge status-menunggu'> Menunggu</div>";
    } else if($status == "Proses") {
        echo "<div class='status-badge status-proses'> Proses</div>";
    } else {
        echo "<div class='status-badge status-selesai'> Selesai";
    }
}
$id     = $_GET['id'];
$sql    = "SELECT * FROM input_aspirasi, aspirasi, kategori, siswa WHERE
            kategori.id_kategori        = input_aspirasi.id_kategori AND
            aspirasi.id_kategori        = kategori.id_kategori      AND
            input_aspirasi.id_pelaporan = '$id' ";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/sengaja.css">
</head>
<body>
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fa fa-comments"></i>
            </div>
            <h4>Tanggapi Pengaduan</h4>
        </div>
    </div>

    <div>
        <form action="" method="post">

            <div style="border:1px solid #dadce0; border-radius:10px; overflow:hidden; margin-bottom:20px;">
                <div class="divnya">
                    <span class="spannya1"">NIS</span>
                    <span class="spannya2">:</span>
                    <span class="spannya3"><?= $data['nis'] ?></span>
                </div>
                <div class="divnya">
                    <span class="spannya1"">Kelas</span>
                    <span class="spannya2">:</span>
                    <span class="spannya3"><?= $data['kelas'] ?></span>
                </div>
                <div class="divnya">
                    <span class="spannya1"">Kategori Pengaduan</span>
                    <span class="spannya2">:</span>
                    <span class="spannya3"><?= $data['ket_kategori'] ?></span>
                </div>
                <div class="divnya">
                    <span class="spannya1"">Status</span>
                    <span class="spannya2">:</span>
                    <span class="spannya3"><?= status($data['status']) ?></span>
                </div>
                <div class="divnya">
                    <span class="spannya1"">Lokasi</span>
                    <span class="spannya2">:</span>
                    <span class="spannya3"><?= $data['lokasi'] ?></span>
                </div>
                <div style="display:grid; grid-template-columns:160px 12px 1fr; align-items:center; padding:11px 16px;">
                    <span class="spannya1"">Pengaduan</span>
                    <span class="spannya2">:</span>
                    <span class="spannya3"><?= $data['ket'] ?></span>
                </div>
            </div>


            <div class="detail-section">
                <div class="form-group" style="margin-top:10px;">
                    <select name="status" id="status" class="floating-input floating-select" required>
                        <option value="Menunggu" <?= ($data['status'] == "Menunggu")? 'Selected' : '' ?>>Menunggu</option>
                        <option value="Proses" <?= ($data['status'] == "Proses")? 'Selected' : '' ?>>Proses</option>
                        <option value="Selesai" <?= ($data['status'] == "Selesai")? 'Selected' : '' ?>>Selesai</option>
                    </select>
                    <label for="status" class="floating-label floating-label-select">Status</label>
                </div>
                <div class="form-group">
                    <textarea name="feedback" id="feedback" class="floating-input floating-textarea" required placeholder="Masukan tanggapan admin"></textarea>
                    <label for="feedback" class="floating-label">Tanggapan</label>
                </div>
                <div style="display:grid;gap:10px; margin-top:20px;">
                <button type="submit" name="tombol" class="btn-google">
                    <i class="fa fa-paper-plane"></i> Kirim
                </button>
                <a href="?page=pengaduan" class="anchor">Kembali</a>
            </div>

        </form>
    </div>
</body>
</html>
<?php 
if(isset($_POST['tombol'])) {
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];
    $data = mysqli_query($koneksi, "UPDATE aspirasi SET status = '$status', feedback = '$feedback' WHERE id_pelaporan = '$id' ");
    if($data) {
        echo "<script>alert('Feedback berhasil tersimpan'); window.location.assign('?page=pengaduan');</script>";
    } else {
        echo "<script>alert('Feedback gagal tersimpan'); window.location.assign('?page=pengaduan');</script>";
    }
}
?>