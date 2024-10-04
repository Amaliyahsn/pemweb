<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janji Temu</title>
    <link rel="stylesheet" href="janji.css">
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="logo">
            <img src="2.png" alt="Logo" class="logo-img">
            <h3>Hai Dokter!!</h3>
        </div>
        <nav>
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
        </nav>
        <div class="user-info">
    <img src="<?= $_SESSION['profile_picture'] ?? 'uploads/default.png'; ?>" alt="Profile Picture" class="profile-img">
    <span>Halo, <?= $_SESSION['username']; ?></span>
    <a href="edit_profil.php" class="edit-profile-btn">Edit Profil</a> <!-- Tautan untuk mengedit profil -->
    <a href="?logout" class="logout-btn">Logout</a>
</div>
    </header>

    <!-- Main Content -->
    <div class="content">
        <!-- Hero Section -->
        <section class="hero">
            <h2>JANJI TEMU</h2>
        </section>

        <!-- Search and Filter Section -->
        <section class="search-filter">
            <div class="search-bar">
                <input type="text" placeholder="Cari dokter atau Rumah Sakit">
                <button class="btn-search">Cari</button>
            </div>

            <!-- Doctor List -->
            <div class="doctor-list">
                <div class="doctor-card">
                    <img id="doctor-chat-image" src="1.png" alt="Doctor Image" class="doctor-img">
                    <div class="doctor-info">
                        <h3>dr. Elvira Rosa</h3>
                        <p>Umum</p>
                        <p>Klinik Kasih, Jl. Soekarno Hatta No.33</p>
                        <p>Mulai Dari Rp. 200,000</p>
                        <button class="btn-appointment">Buat Janji</button>
                    </div>
                </div>

                <!-- Additional Doctor Cards -->
                <div class="doctor-card">
                    <img id="doctor-chat-image" src="1.png" alt="Doctor Image" class="doctor-img">
                    <div class="doctor-info">
                        <h3>dr. Elvira Rosa</h3>
                        <p>Umum</p>
                        <p>Klinik Kasih, Jl. Soekarno Hatta No.33</p>
                        <p>Mulai Dari Rp. 200,000</p>
                        <button class="btn-appointment">Buat Janji</button>
                    </div>
                </div>

                <div class="doctor-card">
                    <img id="doctor-chat-image" src="1.png" alt="Doctor Image" class="doctor-img">
                    <div class="doctor-info">
                        <h3>dr. Elvira Rosa</h3>
                        <p>Umum</p>
                        <p>Klinik Kasih, Jl. Soekarno Hatta No.33</p>
                        <p>Mulai Dari Rp. 200,000</p>
                        <button class="btn-appointment">Buat Janji</button>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <aside class="filter-options">
                <h4>KETERSEDIAAN</h4>
                <ul>
                    <li><input type="checkbox"> Kapan saja</li>
                    <li><input type="checkbox"> Hari ini</li>
                    <li><input type="checkbox"> Besok</li>
                </ul>
                <h4>JAM</h4>
                <ul>
                    <li><input type="checkbox"> Pagi (08.00-12.00 WIB)</li>
                    <li><input type="checkbox"> Malam (16.00-20.00 WIB)</li>
                </ul>
                <h4>JENIS KELAMIN</h4>
                <ul>
                    <li><input type="checkbox"> Laki-Laki</li>
                    <li><input type="checkbox"> Perempuan</li>
                </ul>

                <h4>HARGA KONSULTASI DOKTER</h4>
                <ul>
                    <li><input type="radio" name="harga"> Rp. 200.000</li>
                    <li><input type="radio" name="harga"> Rp. 100.000 - Rp. 200.000</li>
                </ul>

                <button class="btn-reset">Hapus Filter</button>
            </aside>
        </section>
    </div> <!-- End of Content -->

    <!-- Footer Section -->
    <footer>
        <div class="footer-left">
            <h2>Lorem Ipsum</h2>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
            <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="footer-right">
            <ul>
                <li><a href=""></a>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
                <li>Lorem Ipsum</li>
            </ul>
        </div>
    </footer>
</body>
</html>
