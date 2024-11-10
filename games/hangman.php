<?php

include '../includes/db.php'; 
include '../includes/functions.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $player_name = $_POST['player_name'];
    $score = $_POST['score'];
    saveScore($conn, 'Hangman', $player_name, $score); 
    echo "<script>alert('Score saved!');</script>";
    exit();
}


$hints = [
    'APPLE' => 'A popular fruit.',
    'BANANA' => 'A yellow fruit.',
    'GRAPE' => 'A small round fruit.',
    'PEAR' => 'A fruit shaped like a teardrop.',
    'ORANGE' => 'A citrus fruit.'
];


$words = array_keys($hints);
$selectedWord = $words[array_rand($words)];
$selectedHint = $hints[$selectedWord];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-4xl mb-4">Hangman Game</h1>
    <div id="word" class="text-3xl mb-4">_ _ _ _ _</div>
    <div id="wrongLetters" class="mb-4">Wrong Letters: </div>
    <div id="hint" class="mb-4 text-yellow-300">Hint: <?php echo htmlspecialchars($selectedHint); ?></div>
    <div id="message" class="mb-4"></div>
    <div id="score" class="text-2xl mb-4">Score: 0</div>
    <div id="dashboard" class="mb-4">
        <a href="../index.php" class="text-blue-500 underline">Back to Dashboard</a>
    </div>

    <input type="text" id="letterInput" maxlength="1" placeholder="Guess a letter" class="border border-gray-700 bg-gray-800 text-white p-2 mb-2" />
    <button id="submitGuess" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit Guess</button>
    <div id="saveScore" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" style="display:none;">Save Score</div>
    <div id="restartGame" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mt-4" style="display:none;">Restart Game</div>

    <script src="hangman.js"></script> <!-- Link to your JavaScript file -->
    <script>
        const word = "<?php echo $selectedWord; ?>"; 
    </script>
</body>
</html>

