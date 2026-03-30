<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Aplikasi Pengaduan Sarana Sekolah</title>
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
            <h3 class="card-title">Login Admin</h3>
            <p class="card-subtitle">Aplikasi Pengaduan Sarana Sekolah</p>
            <div class="form-group">
                <input type="text" name="username" class="floating-input" required placeholder="Masukan Username">
                <label for="" class="floating-label">Username</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="floating-input" required placeholder="Masukan Password">
                <label for="" class="floating-label">Password</label>
            </div>
            <button type="submit" name="tombol" class="btn-google">LOGIN</button>
                <?php 
                session_start();
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
    $username = $_POST['username'];
    $password = $_POST['password'];
    include 'koneksi.php';
    $sql = "SELECT * FROM admin WHERE username ='$username' AND password='$password' ";
    $data = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($data) > 0) {
        $_SESSION['login'] = true;
        header('location:admin/dashboard.php');
    } else {
        $_SESSION['error'] = "Maaf login gagal, periksa username / password";
        header('location:login-admin.php');
    }
}
?>