<?php
require_once __DIR__ . '/config.php';

try {
    $pdo = db();
    // Check if table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM holidays");
    if ($stmt->fetchColumn() > 0) {
        echo "Holidays table is not empty. Skipping seeding.\n";
        exit;
    }

    $holidays = [
        ['name' => 'New Year\'s Day', 'holiday_date' => '2025-01-01'],
        ['name' => 'Martin Luther King, Jr. Day', 'holiday_date' => '2025-01-20'],
        ['name' => 'Presidents\' Day', 'holiday_date' => '2025-02-17'],
        ['name' => 'Memorial Day', 'holiday_date' => '2025-05-26'],
        ['name' => 'Juneteenth', 'holiday_date' => '2025-06-19'],
        ['name' => 'Independence Day', 'holiday_date' => '2025-07-04'],
        ['name' => 'Labor Day', 'holiday_date' => '2025-09-01'],
        ['name' => 'Thanksgiving Day', 'holiday_date' => '2025-11-27'],
        ['name' => 'Christmas Day', 'holiday_date' => '2025-12-25'],
    ];

    $stmt = $pdo->prepare("INSERT INTO holidays (name, holiday_date) VALUES (:name, :holiday_date)");

    foreach ($holidays as $holiday) {
        $stmt->execute($holiday);
    }

    echo "Holidays table seeded successfully.\n";

} catch (PDOException $e) {
    die("Could not seed database: " . $e->getMessage());
}
