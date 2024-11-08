<?php
include 'includes/db.php';
include 'includes/functions.php';

$scores = getTopScores($conn);
$organizedScores = [];

foreach ($scores as $score) {
    $organizedScores[$score['game_name']][] = $score;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Arcade</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-300 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-blue-400 mb-8">Welcome to the Digital Arcade</h1>

        <div class="bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Play Games</h2>
            <ul class="space-y-2">
                <li><a href="games/tic-tac-toe.php" class="block bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition">Play Tic-Tac-Toe</a></li>
                <li><a href="games/flappy-bird.php" class="block bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition">Play Flappy Bird</a></li>
                <li><a href="games/snake-game.php" class="block bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition">Play Snake Game</a></li>
                <li><a href="games/dice-game.php" class="block bg-blue-500 text-white text-center py-2 rounded hover:bg-blue-600 transition">Play Roll The Dice</a></li>
            </ul>
        </div>

        <div class="bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Leaderboard</h2>
            <?php foreach ($organizedScores as $gameName => $gameScores): ?>
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-blue-400"><?= htmlspecialchars($gameName) ?></h3>
                    <ul class="space-y-2">
                        <?php foreach ($gameScores as $score): ?>
                            <li class="flex justify-between border-b border-gray-700 py-2">
                                <span class="text-gray-300"><?= htmlspecialchars($score['player_name']) ?></span>
                                <span class="text-blue-400 font-bold"><?= htmlspecialchars($score['score']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
