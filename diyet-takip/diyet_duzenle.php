<?php
session_start();
require_once "includes/db.php";

// Giriş yapılmamışsa login'e at
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: diyet_listele.php");
    exit;
}

// Kayıt çekiliyor
$sql = "SELECT * FROM diyet_kayitlari WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $user_id]);
$kayit = $stmt->fetch();

if (!$kayit) {
    echo "Kayıt bulunamadı.";
    exit;
}

// Form güncellenmişse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarih = $_POST["tarih"];
    $ogun = $_POST["ogun"];
    $icerik = $_POST["icerik"];
    $kalori = $_POST["kalori"];
    $kisisel_not = $_POST["kisisel_not"];

    $sql = "UPDATE diyet_kayitlari SET tarih=?, ogun=?, icerik=?, kalori=?, kisisel_not=? 
            WHERE id=? AND user_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tarih, $ogun, $icerik, $kalori, $kisisel_not, $id, $user_id]);

    header("Location: diyet_listele.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Kayıt Düzenle</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Tarih</label>
            <input type="date" name="tarih" class="form-control" required
                   value="<?= htmlspecialchars($kayit['tarih']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Öğün</label>
            <select name="ogun" class="form-control" required>
                <?php
                $ogunler = ["Kahvaltı", "Öğle", "Akşam", "Ara Öğün"];
                foreach ($ogunler as $ogun) {
                    $secili = $kayit['ogun'] == $ogun ? "selected" : "";
                    echo "<option value='$ogun' $secili>$ogun</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">İçerik</label>
            <textarea name="icerik" class="form-control" rows="3" required><?= htmlspecialchars($kayit['icerik']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Kalori</label>
            <input type="number" name="kalori" class="form-control" value="<?= htmlspecialchars($kayit['kalori']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Not</label>
            <textarea name="kisisel_not" class="form-control" rows="2"><?= htmlspecialchars($kayit['kisisel_not']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="diyet_listele.php" class="btn btn-secondary">İptal</a>
    </form>
</div>
</body>
</html>
