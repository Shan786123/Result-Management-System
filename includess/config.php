<?php
session_start();
define('DB_HOST', 'sqlxxx.infinityfree.com');
define('DB_USER', 'if0_41195576');
define('DB_PASS', 'JYgZoqxqnsxkBf');
define('DB_NAME', 'epiz_rms_db');


try {
    $pdo = new PDO("mysql:host=". DB_HOST. ";dbname=". DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
    
}
?>