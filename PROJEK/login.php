<?php
session_start();

$errorMessage = '';
$usersFile = 'users.txt'; // File untuk menyimpan data pengguna

// Memproses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah file pengguna ada
    if (file_exists($usersFile)) {
        $users = file($usersFile); // Membaca semua baris dari file

        foreach ($users as $user) {
            list($storedUsername, $storedPassword) = explode(',', trim($user)); // Memisahkan username dan password

            // Memeriksa kecocokan username dan password
            if ($username === $storedUsername && $password === trim($storedPassword)) {
                $_SESSION['username'] = $username; 
                header('Location: dashboard.php'); 
                exit();
            }
        }
    }

    // Jika login gagal
    $errorMessage = "Username atau password salah!";
}

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!-- HTML untuk login -->
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
                    <!-- Menampilkan pesan kesalahan di sini -->
                    <?php if ($errorMessage): ?>
                        <div class="error-message" style="color: red; margin-bottom: 10px;">
                            <?php echo $errorMessage; ?>
                        </div>
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
