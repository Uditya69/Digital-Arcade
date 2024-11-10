<?php

include '../includes/db.php'; 
include '../includes/functions.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $player_name = $_POST['player_name'];
    $score = $_POST['score'];
    saveScore($conn, 'Snake Game', $player_name, $score); 
    echo "<script>alert('Score saved!');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake Game</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a202c; 
            color: #e5e7eb; 
        }
        canvas {
            border: 4px solid #fff; 
            background: #2c3e50; 
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center h-screen" >
    <div id="score" class="text-2xl font-bold mb-4">Score: 0</div>
    <form id="scoreForm" method="POST" class="mb-4">
        <input type="text" name="player_name" placeholder="Enter your name" required class="p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <input type="hidden" name="score" id="scoreInput" />
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Score</button>
    </form>
    <button id="submitGuess" class="bg-red-400 text-white font-bold py-2 px-4 rounded" onclick="window.location.reload()">Restart</button>
    <div id="dashboard" class="text-lg mb-4">
        
        <a href="../index.php" class="text-blue-400 hover:underline">Back to Dashboard</a>
    </div>
    <canvas id="snakeGame" width="400" height="400"></canvas> <!-- Game area -->
    <script>
        const canvas = document.getElementById('snakeGame');
        const ctx = canvas.getContext('2d');

        const box = 20; 
        let snake = [{ x: 9 * box, y: 9 * box }]; 
        let direction = ''; 
        let food = generateFood(); 
        let score = 0; 

        
        document.addEventListener('keydown', directionControl);

        function directionControl(event) {
            if (event.key === 'ArrowLeft' && direction !== 'RIGHT') {
                direction = 'LEFT';
            } else if (event.key === 'ArrowUp' && direction !== 'DOWN') {
                direction = 'UP';
            } else if (event.key === 'ArrowRight' && direction !== 'LEFT') {
                direction = 'RIGHT';
            } else if (event.key === 'ArrowDown' && direction !== 'UP') {
                direction = 'DOWN';
            }
        }

        
        function generateFood() {
            return {
                x: Math.floor(Math.random() * (canvas.width / box)) * box,
                y: Math.floor(Math.random() * (canvas.height / box)) * box
            };
        }

        
        function draw() {
            ctx.fillStyle = "#2c3e50"; 
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < snake.length; i++) {
                ctx.fillStyle = (i === 0) ? "#00ff00" : "#68d391"; 
                ctx.fillRect(snake[i].x, snake[i].y, box, box);
                ctx.strokeStyle = "#ffffff"; 
                ctx.strokeRect(snake[i].x, snake[i].y, box, box);
            }

            ctx.fillStyle = "#ff4d4d"; 
            ctx.fillRect(food.x, food.y, box, box);

            let snakeX = snake[0].x;
            let snakeY = snake[0].y;

            
            if (direction == 'LEFT') snakeX -= box;
            if (direction == 'UP') snakeY -= box;
            if (direction == 'RIGHT') snakeX += box;
            if (direction == 'DOWN') snakeY += box;

            
            if (snakeX === food.x && snakeY === food.y) {
                score++;
                food = generateFood(); 
            } else {
                snake.pop(); 
            }

            let newHead = { x: snakeX, y: snakeY };

            
            if (snakeX < 0 || snakeY < 0 || snakeX >= canvas.width || snakeY >= canvas.height || collision(newHead, snake)) {
                document.getElementById('scoreInput').value = score; 
                document.getElementById('scoreForm').style.display = 'block'; 

                const gameOverDiv = document.createElement('div');
                gameOverDiv.innerText = "Game Over! Your score: " + score;
                document.body.appendChild(gameOverDiv);
                document.getElementById('scoreInput').value = score; 
                document.getElementById('scoreForm').style.display = 'block'; 
                return; 
            }

            snake.unshift(newHead); 
            document.getElementById('score').innerText = "Score: " + score; 
        }

        
        function collision(head, array) {
            for (let i = 0; i < array.length; i++) {
                if (head.x === array[i].x && head.y === array[i].y) {
                    return true;
                }
            }
            return false;
        }

        
        setInterval(draw, 100); 
    </script>
</body>
</html>
