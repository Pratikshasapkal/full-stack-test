<?php
require __DIR__ . '/../src/lib/Database.php';

$pdo = Database::connect();

$stmt = $pdo->query("SELECT COUNT(*) AS cnt FROM tabs");
$row = $stmt->fetch();

echo "Tabs in DB: " . $row['cnt'];

