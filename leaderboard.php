<?php
include 'includes/db.php';
include 'includes/functions.php';

$scores = getTopScores($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Leaderboard</h1>
    <ul>
        <?php foreach ($scores as $score): ?>
            <li><?= htmlspecialchars($score['player_name']) ?> - <?= htmlspecialchars($score['score']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
