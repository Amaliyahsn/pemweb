<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$profileDir = 'uploads/';
$profilePic = $profileDir . $username . '.png';

// Cek apakah gambar profil ada
if (!file_exists($profilePic)) {
    $profilePic = 'default.png'; // Gambar default jika tidak ada
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <title>Profil</title>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <img src="<?= $profilePic ?>" alt="Profile Picture" class="profile-img">
            <h2><?= $username ?></h2>
            <a href="edit_profil.php" class="upload-photo">Upload New Photo</a>
            <p>Member Since: 29 September 2024</p> <!-- Ganti dengan tanggal yang sesuai -->
            <br>
            <a href="dashboard.php" class="back-to-dashboard">FINISH</a> <!-- Tombol untuk kembali ke dashboard -->
        </div>
    </div>
</body>
</html>
