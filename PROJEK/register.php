<?php
$errorMessage = '';
$usersFile = 'users.txt'; // File untuk menyimpan data pengguna

// Memproses registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah file pengguna ada
    if (file_exists($usersFile)) {
        $users = file($usersFile); // Membaca semua baris dari file

        // Memeriksa apakah username sudah ada
        foreach ($users as $user) {
            $storedUsername = explode(',', trim($user))[0]; // Mendapatkan username dari file
            if ($username === $storedUsername) {
                $errorMessage = "Username sudah terdaftar!";
                break;
            }
        }
    }

    // Jika username belum ada, tambahkan pengguna baru
    if (empty($errorMessage)) {
        $newUser = "$username,$password\n"; // Format untuk ditambahkan
        file_put_contents($usersFile, $newUser, FILE_APPEND); // Menambahkan data ke file
        header('Location: login.php'); // Arahkan ke halaman login
        exit();
    }
}
?>

<!-- HTML untuk register -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="image-side"></div>
        <div class="form-side">
            <div class="form-box">
                <div class="login-box">
                    <h2>Register</h2>
                    <!-- Menampilkan pesan kesalahan di sini -->
                    <?php if ($errorMessage): ?>
                        <div class="error-message" style="color: red; margin-bottom: 10px;">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                    <form action="register.php" method="POST">
                        <div class="input-box">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="input-box">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="input-box">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit">Register</button>
                    </form>
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
