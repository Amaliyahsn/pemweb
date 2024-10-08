<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$profileDir = 'uploads/';
$profilePic = $profileDir . $username . '.png';

// Check if profile picture exists
if (!file_exists($profilePic)) {
    $profilePic = 'default.png'; // Use a default image if no profile picture is found
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle profile picture upload
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == 0) {
        $fileTmpPath = $_FILES['profilePic']['tmp_name'];
        $fileName = $username . '.png';
        $dest_path = $profileDir . $fileName;

        // Move the file to the uploads directory
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $profilePic = $dest_path;
        } else {
            echo 'There was an error moving the uploaded file.';
        }
    }

    // Save the rest of the user data (just an example, modify to suit your storage method)
    $_SESSION['fullname'] = $_POST['fullname'];
    $_SESSION['email'] = $_POST['email'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap">
</head>

<body>

    <div class="profile-new">
        <!-- Navbar -->
        <div class="navbar">
            <div class="logo">
                <h2>LocalDoc</h2>
            </div>
            <ul class="menu">
                <li><a href="dashboard.php">Beranda</a></li>
                <li>
                    <a href="#">Layanan</a>
                    <ul class="services-dropdown">
                        <li><a href="chatdokter.php">Chat Dokter</a></li>
                        <li><a href="janjidokter.php">Janji Temu</a></li>
                        <li><a href="ruangpeduli.php">Ruang Peduli</a></li>
                    </ul>
                </li>
                <li><a href="#">Kontak</a></li>
            </ul>
            <div class="user-info">
                <img src="<?= $_SESSION['profile_picture'] ?? 'uploads/default.png'; ?>" alt="Profile Picture"
                    class="profile-img">
                <span class="username"  >Halo, <?= $_SESSION['username']; ?></span>
                <div class="dropdown-content" id="dropdown">
                    <a href="profil.php" class="logout-btn">Profil</a>
                    <a href="?logout" class="logout-btn">Logout</a>
                </div>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="rectangle-group">
            <div class="group-child"></div>
            <div class="lorem-ipsum-parent">
                <div class="lorem-ipsum">Lorem Ipsum</div>
                <div class="lorem-ipsum1">Lorem Ipsum</div>
                <div class="lorem-ipsum2">Lorem Ipsum</div>
                <div class="ellipse-parent">
                    <div class="group-item">
                        <img src="<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-pic" />
                    </div>
                    <input type="file" name="profilePic" accept="image/*" class="upload-photo" />

                </div>

            </div>
            <div class="lorem-ipsum-group">
                <b class="lorem-ipsum3">Lorem Ipsum</b>
                <div class="lorem-ipsum-dolor">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.</div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <form method="POST" enctype="multipart/form-data">
            <div class="edit-profile">EDIT PROFILE</div>
            <div class="ellipse-parent">
                <!-- Profile Picture Circle -->
                <div class="profile-circle">
                    <img src="<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-pic" />
                </div>
                <input type="file" name="profilePic" accept="image/*" class="upload-photo" />

            </div>

            <div class="profile-new-inner">
                <div class="nama-lengkap-parent">
                    <div class="login">Nama Lengkap</div>
                    <input type="text" name="fullname"
                        value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>"
                        class="frame-item" required>

                    <div class="login">Username</div>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="frame-item" readonly>

                    <div class="login">Kata Sandi</div>
                    <input type="password" name="password" class="frame-item" required>

                    <div class="login">Konfirmasi Kata Sandi</div>
                    <input type="password" name="confirm_password" class="frame-item" required>

                    <div class="login">Alamat Email</div>
                    <input type="email" name="email"
                        value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" class="frame-item"
                        required>

                    <div class="login">Konfirmasi Alamat Email</div>
                    <input type="email" name="confirm_email" class="frame-item" required>

                    <input type="submit" value="Save Changes" class="save-changes-btn">
                </div>
            </div>
        </form>
    </div>

</body>

</html>