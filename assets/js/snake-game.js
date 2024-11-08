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
        x: Math.floor(Math.random() * 20) * box,
        y: Math.floor(Math.random() * 20) * box
    };
}


function draw() {
    ctx.fillStyle = "#70c5ce"; 
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    for (let i = 0; i < snake.length; i++) {
        ctx.fillStyle = (i === 0) ? "green" : "lightgreen"; 
        ctx.fillRect(snake[i].x, snake[i].y, box, box);
        ctx.strokeStyle = "white"; 
        ctx.strokeRect(snake[i].x, snake[i].y, box, box);
    }

    ctx.fillStyle = "red"; 
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
        alert("Game Over! Your score: " + score);
        document.location.reload();
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
