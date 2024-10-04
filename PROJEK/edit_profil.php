<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

// Inisialisasi variabel
$profilePic = 'uploads/default_profile.jpg'; // Gambar default

// Cek jika file profil sudah ada
if (file_exists('uploads/' . $_SESSION['username'] . '.jpg')) {
    $profilePic = 'uploads/' . $_SESSION['username'] . '.jpg';
}

// Proses unggah foto profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_picture'])) {
        $target_dir = 'uploads/';
        $target_file = $target_dir . $_SESSION['username'] . '.jpg'; // Menyimpan dengan nama username
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Cek apakah file gambar valid
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check !== false) {
            echo "File adalah gambar - " . $check['mime'] . ".";
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Cek ukuran file
        if ($_FILES['profile_picture']['size'] > 10000000) { // Batas ukuran 5MB
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Cek format file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Cek jika $uploadOk adalah 0 karena kesalahan
        if ($uploadOk == 0) {
            echo "Maaf, file tidak dapat diunggah.";
        } else {
            // Coba untuk mengunggah file
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                echo "File telah diunggah.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            }
        }
    }

    // Hapus foto profil
    if (isset($_POST['delete_picture'])) {
        $filePath = 'uploads/' . $_SESSION['username'] . '.jpg';
        if (file_exists($filePath)) {
            unlink($filePath);
            echo "Foto profil telah dihapus.";
            $profilePic = 'uploads/default_profile.jpg'; // Kembali ke gambar default
        } else {
            echo "Foto profil tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ganti dengan file CSS Anda -->
</head>
<body>
    <header>
        <h2>Edit Profil</h2>
    </header>

    <main>
        <h3>Foto Profil</h3>
        <img src="<?= $profilePic; ?>" alt="Foto Profil" class="profile-img">
        
        <form action="edit_profil.php" method="post" enctype="multipart/form-data">
            <label for="profile_picture">Unggah foto profil baru:</label>
            <input type="file" name="profile_picture" id="profile_picture" required>
            <button type="submit">Unggah</button>
        </form>

        <form action="edit_profil.php" method="post">
            <button type="submit" name="delete_picture">Hapus Foto Profil</button>
        </form>
    </main>

    <footer>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </footer>
</body>
</html>
