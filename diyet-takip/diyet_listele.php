<?php
session_start();
require_once "includes/db.php";

// Giriş yapılmamışsa login'e at
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Kullanıcının diyet kayıtlarını çek
$sql = "SELECT * FROM diyet_kayitlari WHERE user_id = ? ORDER BY tarih DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$kayitlar = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Diyet Kayıtları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Diyet Kayıtlarım</h2>
    <a href="diyet_ekle.php" class="btn btn-success mb-3">Yeni Kayıt Ekle</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Anasayfa</a>

    <?php if (count($kayitlar) > 0): ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Tarih</th>
                <th>Öğün</th>
                <th>İçerik</th>
                <th>Kalori</th>
                <th>Not</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kayitlar as $kayit): ?>
               <tr>
    <td><?= htmlspecialchars($kayit["tarih"]) ?></td>
    <td><?= htmlspecialchars($kayit["ogun"]) ?></td>
    <td><?= nl2br(htmlspecialchars($kayit["icerik"])) ?></td>
    <td><?= htmlspecialchars($kayit["kalori"]) ?></td>
    <td><?= nl2br(htmlspecialchars($kayit["kisisel_not"])) ?></td>
    <td>
        <a href="diyet_sil.php?id=<?= $kayit['id'] ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Bu kaydı silmek istediğine emin misin?')">Sil</a>
           <a href="diyet_duzenle.php?id=<?= $kayit['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>

    </td>
</tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-info">Hiç kayıt bulunamadı.</div>
    <?php endif; ?>
</div>
</body>
</html>
