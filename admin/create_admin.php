<?php
require_once '../functions/db.php';  // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Menghasilkan hash dari password input
    $role = 'admin'; // Role diatur sebagai admin

    // Query untuk memasukkan data admin baru ke dalam tabel users
    $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        echo "Admin baru berhasil ditambahkan!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!-- Form untuk menambahkan admin baru -->
<form method="POST" action="create_admin.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Buat Admin</button>
</form>
