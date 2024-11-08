document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("flappyCanvas");
    const ctx = canvas.getContext("2d");

    
    const bird = {
        x: 50,
        y: 150,
        width: 20,
        height: 20,
        gravity: 1, 
        lift: -12, 
        velocity: 0,
        color: "#FFD700", 
    };

    
    let pipes = [];
    const pipeWidth = 50; 
    const gap = 180; 
    let pipeInterval = 80; 
    let frames = 0;

    
    let score = 0;
    let gameActive = true;

    
    function drawBird() {
        ctx.fillStyle = bird.color;
        ctx.beginPath();
        ctx.arc(bird.x + bird.width / 2, bird.y + bird.height / 2, bird.width / 2, 0, Math.PI * 2);
        ctx.fill();
    }

    
    function drawPipes() {
        ctx.fillStyle = "#32CD32"; 
        pipes.forEach(pipe => {
            ctx.fillRect(pipe.x, 0, pipeWidth, pipe.top);
            ctx.fillRect(pipe.x, pipe.top + gap, pipeWidth, canvas.height - pipe.top - gap);
            pipe.x -= 2;

            
            if (pipe.x === bird.x) {
                score++;
            }

            
            if (pipe.x + pipeWidth < 0) {
                pipes.shift();
            }
        });
    }

    
    function updateBird() {
        bird.velocity += bird.gravity;
        bird.y += bird.velocity;

        if (bird.y + bird.height > canvas.height || bird.y < 0) {
            endGame();
        }
    }

    
    function createPipe() {
        const top = Math.floor(Math.random() * (canvas.height - gap - 20)) + 20; 
        pipes.push({ x: canvas.width, top });
    }

    
    function gameLoop() {
        if (!gameActive) return;

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawBird();
        drawPipes();
        updateBird();

        
        pipes.forEach(pipe => {
            if (
                bird.x < pipe.x + pipeWidth &&
                bird.x + bird.width > pipe.x &&
                (bird.y < pipe.top || bird.y + bird.height > pipe.top + gap)
            ) {
                endGame();
            }
        });

        
        if (frames % pipeInterval === 0) {
            createPipe();
        }

        frames++;
        requestAnimationFrame(gameLoop);
    }

    
    function endGame() {
        gameActive = false;
        document.getElementById("scoreInput").value = score;
        alert("Game Over! Your score: " + score);
    }

    
    canvas.addEventListener("click", () => {
        if (gameActive) {
            bird.velocity = bird.lift;
        } else {
            resetGame();
        }
    });

    
    function resetGame() {
        pipes = [];
        bird.y = 150;
        bird.velocity = 0;
        score = 0;
        frames = 0;
        gameActive = true;
        gameLoop();
    }

    
    gameLoop();
});
