<?php
include 'akses.php';
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../sengaja.css">
</head>
<body>
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fa fa-tags"></i>
            </div>
            <h4>Kategori Pengaduan</h4>
        </div>
        <a href="?page=tambah-kategori" class="btn-add">
            <i class="fa fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <table class="g-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Kelola</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no   = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");

        if(mysqli_num_rows($data) > 0) {
            while($kategori = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><span class="badge-no"><?= $no++ ?></span></td>
                    <td><?= $kategori['ket_kategori'] ?></td>
                    <td>
                        <a href="?page=edit-kategori&id=<?= $kategori['id_kategori'] ?>" class="btn-icon btn-icon-edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn-icon btn-icon-delete" onclick="hapus('Hapus Kategori <?= $kategori['ket_kategori'] ?>', <?= $kategori['id_kategori'] ?>);">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="3" style="text-align:center; padding:16px;">
                    Tidak ada kategori
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <script>
        function hapus(pesan, id_kategori) {
            if (confirm(pesan)) {
                window.location.href = '?page=hapus-kategori&id=' + id_kategori;
            }
        }
    </script>
</body>
</html>
