<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$profileDir = 'uploads/';
$profilePic = $profileDir . $username . '.png';

// Pastikan direktori uploads ada
if (!file_exists($profileDir)) {
    mkdir($profileDir, 0777, true);
}

// Cek apakah ada request POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses upload foto
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
        $targetFile = $profileDir . $username . '.png';
        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetFile)) {
            // Simpan jalur foto di sesi
            $_SESSION['profile_picture'] = $targetFile;
            echo "File berhasil di-upload.<br>";
        } else {
            echo "Gagal meng-upload file.<br>";
        }
    }

    // Setelah proses selesai, redirect ke halaman profil
    header("Location: profil.php");
    exit();
}

// Jika tidak ada file foto profil, gunakan default
if (!file_exists($profilePic)) {
    $profilePic = 'default.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit_profil.css">
    <title>Edit Profil</title>
</head>
<body>
<div class="container">
    <div class="profile-header">
        <h2>Edit Profile</h2>
        <img src="<?= $profilePic ?>" alt="Profile Picture" class="profile-img">
        <label for="profilePic" class="upload-photo">Upload New Photo</label>
        <input type="file" id="profilePic" name="profilePic" style="display: none;">
    </div>
    <div class="right">
        <form action="edit_profil.php" method="post" enctype="multipart/form-data" class="form-container">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" value="<?= $username ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= $username ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="example@example.com">
            </div>
            <div class="form-group">
                <label for="confirm_email">Confirm Email Address</label>
                <input type="email" id="confirm_email" name="confirm_email" value="example@example.com">
            </div>
            <input type="submit" value="Update Info">
        </form>
    </div>
</div>
</body>
</html>
