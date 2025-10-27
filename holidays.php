<?php
require_once __DIR__ . '/db/config.php';

try {
    $pdo = db();
    $stmt = $pdo->prepare("SELECT name, holiday_date FROM holidays WHERE YEAR(holiday_date) = YEAR(CURDATE()) ORDER BY holiday_date ASC");
    $stmt->execute();
    $holidays = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In a real app, log this error. For now, show a simple message.
    $holidays = [];
    $error_message = "Database error. Please check configuration.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Holidays - HRMS WEBAPP</title>
    <meta name="description" content="View the official company holiday calendar. Built with Flatlogic Generator.">
    <meta name="keywords" content="hrms, human resources, holiday calendar, company holidays, employee portal, leave management, Built with Flatlogic Generator">
    <meta property="og:title" content="Company Holidays - HRMS WEBAPP">
    <meta property="og:description" content="View the official company holiday calendar.">
    <meta property="og:image" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">HRMS WEBAPP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="holidays.php">Holidays</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4">Company Holidays 2025</h1>
                <p class="lead">Official list of holidays for the current year.</p>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php elseif (empty($holidays)): ?>
                <div class="alert alert-info" role="alert">
                    No holidays found for this year. Please check back later.
                </div>
            <?php else: ?>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <?php foreach ($holidays as $holiday): ?>
                            <div class="holiday-card">
                                <span><?php echo htmlspecialchars($holiday['name']); ?></span>
                                <span class="holiday-date"><?php echo date("F j, Y", strtotime($holiday['holiday_date'])); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> HRMS WEBAPP. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>