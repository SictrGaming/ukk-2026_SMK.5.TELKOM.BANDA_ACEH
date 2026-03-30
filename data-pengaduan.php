<?php
session_start();
function status($status) {
    if($status == "Menunggu") {
        echo "<div class=''> Menunggu</div>";
    } else if($status == "Proses") {
        echo "<div class=''> Proses</div>";
    } else {
        echo "<div class=''> Selesai";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan | Aplikasi Pengaduan Sarana Sekolah</title>
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
            <h3 class="card-title">Data Pengaduan</h3>
            <p class="card-subtitle">Aplikasi Pengaduan Sarana Sekolah</p>

            <a href="index.php" class="btn-add" style="margin-bottom:20px;">
                <i class="fa fa-plus"></i> Tambah Pengaduan
            </a>

            <table class="g-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include 'koneksi.php';
                $no = 1;
                $sql = "SELECT * FROM input_aspirasi, kategori, aspirasi WHERE
                input_aspirasi.id_kategori=kategori.id_kategori AND
                aspirasi.id_pelaporan=input_aspirasi.id_pelaporan AND
                input_aspirasi.nis = '$_SESSION[nis]'";
                $data = mysqli_query($koneksi, $sql);
                foreach($data as $pengaduan) { ?>
                <tr>
                    <td><span class="badge-no"><?= $no++ ?></span></td>
                    <td><?= $pengaduan['ket_kategori'] ?></td>
                    <td><?= $pengaduan['ket'] ?></td>
                    <td><?= status($pengaduan['status']) ?></td>
                    <td>
                        <a href="detail.php?id=<?= $pengaduan['id_pelaporan'] ?>" class="btn-icon btn-icon-edit">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <div style="display:flex;justify-content: end; gap:10px; margin-top:20px;">
                <button type="submit" name="tombol" class="btn-add" style="width:auto; padding:10px 28px;">
                    <i class="fa fa-rotate-right"></i> Cek
                </button>
                <a href="index.php" class="btn-add">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
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