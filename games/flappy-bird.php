<?php
include '../includes/db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $player_name = $_POST['player_name'];
    $score = $_POST['score'];
    saveScore($conn, 'Flappy Bird', $player_name, $score);
    echo "<script>alert('Score saved!');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flappy Bird</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a202c; /* Dark background */
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen text-gray-200">
    <h1 class="text-4xl font-bold text-blue-400 mb-4">Flappy Bird</h1>
    
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <canvas id="flappyCanvas" width="320" height="480" class="border border-gray-600 mb-4"></canvas>
        <p class="text-center text-gray-400">Click to start!</p>
    </div>

    <form id="scoreForm" method="POST" class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center text-blue-400">Save Your Score</h2>
        <input type="text" name="player_name" placeholder="Enter your name" required 
            class="w-full p-2 bg-gray-700 border border-gray-600 rounded mb-4 focus:outline-none focus:ring focus:ring-blue-500">
        <input type="hidden" name="score" id="scoreInput">
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Save Score</button>
    </form>

    <script src="../assets/js/flappy-bird.js"></script>
</body>
</html>
