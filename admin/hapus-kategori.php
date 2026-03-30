<?php
include 'akses.php';
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id'");
    if($data) {
        echo "<script>
              alert('Data Sukses Dihapus');
              window.location.assign('?page=kategori');
              </script>";
    } else {
        echo "<script>
              alert('Data Gagal Dihapus');
              window.location.assign('?page=kategori');
              </script>";
    }
?>