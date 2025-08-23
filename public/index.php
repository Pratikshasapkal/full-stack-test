<?php
require __DIR__ . '/../src/lib/Database.php';

$pdo = Database::connect();

echo "<h2>Database connection successful ✅</h2>";
