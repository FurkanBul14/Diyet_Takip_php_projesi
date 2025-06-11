<?php
session_start();
require_once "includes/db.php";

// Giriş yapılmamışsa login'e at
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user_id = $_SESSION["user_id"];

    // Sadece o kullanıcıya ait olan kayıt silinir
    $sql = "DELETE FROM diyet_kayitlari WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id, $user_id]);
}

header("Location: diyet_listele.php");
exit;
?>
