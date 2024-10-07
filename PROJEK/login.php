<?php
session_start();

$errorMessage = '';  // Default kosong
$usersFile = 'users.txt'; // File untuk menyimpan data pengguna

// Memproses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isUserExists = false;
    $isPasswordCorrect = false;

    // Cek apakah file pengguna ada
    if (file_exists($usersFile)) {
        $users = file($usersFile); // Membaca semua baris dari file

        // Looping untuk cek username dan password
        foreach ($users as $user) {
            list($storedUsername, $storedPassword) = explode(',', trim($user)); // Memisahkan username dan password

            if ($username === $storedUsername) {
                $isUserExists = true; // Jika username ditemukan
                if ($password === trim($storedPassword)) {
                    $isPasswordCorrect = true; // Jika password cocok
                }
                break;
            }
        }
    }

    if (!$isUserExists) {
        // Jika pengguna tidak terdaftar
        $errorMessage = 'Akun belum ada, silakan buat akun terlebih dahulu.';
    } elseif (!$isPasswordCorrect) {
        // Jika username benar tapi password salah
        $errorMessage = 'Username atau password salah!';
    } else {
        // Jika login berhasil
        $_SESSION['username'] = $username; 
        header('Location: dashboard.php');
        exit();
    }
}

// Cek jika sudah login
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="image-side"></div>
        <div class="form-side">
            <div class="form-box">
                <div class="login-box">
                    <h2>Welcome</h2>

                    <!-- Tampilkan alert jika ada pesan error -->
                    <?php if ($errorMessage): ?>
                        <script>
                            alert('<?php echo $errorMessage; ?>');
                        </script>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                        <div class="input-box">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="input-box">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="options">
                            <label><input type="checkbox" name="remember"> Remember Me</label>
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit">Log In</button>
                    </form>
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
