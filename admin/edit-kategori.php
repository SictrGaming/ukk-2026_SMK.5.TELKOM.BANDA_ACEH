<?php
include 'akses.php';
include '../koneksi.php';
$id = $_GET['id'];
$pilih = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id' ");
$kategori = mysqli_fetch_array($pilih);
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
                <i class="fa fa-tags"></i>
            </div>
            <h4>Edit Kategori Pengaduan</h4>
        </div>
    </div>

    <div class="form-card">
        <form action="#" method="post">
            <div class="form-group">
                <input type="text" value="<?= $kategori['ket_kategori'] ?>" name="ket_kategori" class="floating-input" required placeholder=" " id="ket_kategori">
                <label for="ket_kategori" class="floating-label">Kategori Pengaduan</label>
            </div>
            <button type="submit" name="tombol" class="btn-google">
                <i class="fa fa-save"></i> SIMPAN
            </button>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['tombol'])) {
    $ket = $_POST['ket_kategori'];
    $data = mysqli_query($koneksi, "UPDATE kategori SET ket_kategori = '$ket' WHERE id_kategori = '$id'");
    if($data) {
        echo "<script>
              alert('Data Sukses Disimpan');
              window.location.assign('?page=kategori');
              </script>";
    } else {
        echo "<script>
              alert('Data Gagal Disimpan');
              window.location.assign('?page=kategori');
              </script>";
    }
}
?>