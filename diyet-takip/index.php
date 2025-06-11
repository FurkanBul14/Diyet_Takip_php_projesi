<?php
// Eğer kullanıcı giriş yaptıysa dashboard'a gönder, yapmadıysa login'e
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php");  // Veya doğrudan register.php istersen
    exit;
}
?>
