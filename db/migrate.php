<?php
require_once __DIR__ . '/config.php';

try {
    $pdo = db();
    $sql = file_get_contents(__DIR__ . '/migrations/001_create_holidays_table.sql');
    $pdo->exec($sql);
    echo "Migration completed successfully.\n";
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}

