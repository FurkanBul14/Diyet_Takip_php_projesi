<?php
session_start();
session_unset(); // Tüm oturum verilerini temizle
session_destroy(); // Oturumu kapat

header("Location: login.php"); // Giriş ekranına geri dön
exit;
?>
