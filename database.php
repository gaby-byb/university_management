<?php
require "config.php";

try {
    $conn = new PDO(
        "mysql:host=$db_server;dbname=$db_name",
        $db_user,
        $db_pass,
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('Connected');</script>";
} catch (PDOException $e) {
    die("Database connection failed: " . htmlspecialchars($e->getMessage()));
}

?>
