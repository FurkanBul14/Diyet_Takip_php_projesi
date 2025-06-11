<?php
session_start();
require_once "includes/db.php";

// Giriş yapılmamışsa login'e at
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $tarih = $_POST["tarih"];
    $ogun = $_POST["ogun"];
    $icerik = $_POST["icerik"];
    $kalori = $_POST["kalori"];
    $kisisel_not = $_POST["kisisel_not"];

    $sql = "INSERT INTO diyet_kayitlari (user_id, tarih, ogun, icerik, kalori, kisisel_not)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $tarih, $ogun, $icerik, $kalori, $kisisel_not]);

    // Başarılıysa listeye yönlendir
    header("Location: diyet_listele.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Diyet Kaydı Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Diyet Kaydı Ekle</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Tarih</label>
            <input type="date" name="tarih" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Öğün</label>
            <select name="ogun" class="form-control" required>
                <option value="Kahvaltı">Kahvaltı</option>
                <option value="Öğle">Öğle</option>
                <option value="Akşam">Akşam</option>
                <option value="Ara Öğün">Ara Öğün</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">İçerik</label>
            <textarea name="icerik" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Kalori</label>
            <input type="number" name="kalori" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Not</label>
            <textarea name="kisisel_not" class="form-control" rows="2"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="dashboard.php" class="btn btn-secondary">Geri Dön</a>
    </form>
</div>
</body>
</html>
