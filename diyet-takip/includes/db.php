<?php
$host = "localhost";
$dbname = "dbstorage23360859084";
$username = "dbusr23360859084";
$password = "4c4vu7zNltH1";  // ŞİFRE KÜÇÜK-BÜYÜK HARFE DİKKAT!

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}
?>
