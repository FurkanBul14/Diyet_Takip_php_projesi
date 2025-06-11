<?php
session_start();
require_once "includes/db.php";

// Form gönderildiyse:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Şifre hashleme
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL'e hazırla
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email, $hashed_password]);

    // Başarılıysa login'e yönlendir
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Kayıt Ol</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Kullanıcı Adı</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email Adresi</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Kayıt Ol</button>
        <a href="login.php" class="btn btn-link">Zaten hesabın var mı?</a>
    </form>
</div>
</body>
</html>
