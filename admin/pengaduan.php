<?php
include 'akses.php';
include '../koneksi.php';
function status($status) {
    if($status == "Menunggu") {
        echo "<div class='status-badge status-menunggu'> Menunggu</div>";
    } else if($status == "Proses") {
        echo "<div class='status-badge status-proses'> Proses</div>";
    } else {
        echo "<div class='status-badge status-selesai'> Selesai</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../sengaja.css">
</head>
<body>
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fa fa-message"></i>
            </div>
            <h4>Daftar Pengaduan</h4>
        </div>
    </div>

    <table class="g-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Tanggapi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no  = 1;
        $sql = "SELECT * FROM input_aspirasi, aspirasi, kategori WHERE
                input_aspirasi.id_kategori = kategori.id_kategori AND
                input_aspirasi.id_pelaporan = aspirasi.id_pelaporan";
        $data = mysqli_query($koneksi, $sql);
        if(mysqli_num_rows($data) > 0) {
            while($pengaduan = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><span class="badge-no"><?= $no++ ?></span></td>
                    <td><?= $pengaduan['nis'] ?></td>
                    <?php 
                    $kelas = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$pengaduan[nis]'");
                    $tampilin_kelas = mysqli_fetch_array($kelas); ?>
                    <td><?= $tampilin_kelas['kelas'] ?></td>
                    <td><?= $pengaduan['ket_kategori'] ?></td>
                    <td><?= $pengaduan['ket'] ?></td>
                    <td><?php status($pengaduan['status']); ?></td>
                    <td>
                        <?php $cek = ($pengaduan['status'] == "Selesai") ? "Disabled" : ""; ?>
                        <a href="?page=tanggapi&id=<?= $pengaduan['id_pelaporan'] ?>" class="btn-icon btn-icon-edit <?= $cek ?>">
                            <i class="fa fa-reply"></i>
                        </a>
                    </td>
                </tr>
                <?php } } else { ?>
            <tr>
                <td colspan="7" style="text-align:center; padding:16px;">
                    Tidak ada pengaduan.
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
