<?php
session_start();

// Giriş yapılmamışsa login'e gönder
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hoş Geldin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Merhaba, <?php echo htmlspecialchars($_SESSION["username"]); ?> 👋</h2>
        <p>Diyet kayıtlarını buradan yönetebilirsin.</p>

        <a href="diyet_listele.php" class="btn btn-primary">Diyet Kayıtlarını Gör</a>
        <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
    </div>
</body>
</html>
