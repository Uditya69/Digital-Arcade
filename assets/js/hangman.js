let word = "<?php echo $selectedWord; ?>".toUpperCase(); 
let guessedLetters = [];
let wrongGuesses = 0;
const maxWrongGuesses = 10; 
const wordElement = document.getElementById('word');
const wrongLettersElement = document.getElementById('wrongLetters');
const messageElement = document.getElementById('message');
const scoreElement = document.getElementById('score');
const saveScoreButton = document.getElementById('saveScore');
const restartGameButton = document.getElementById('restartGame');

function displayWord() {
    wordElement.innerHTML = word.split('').map(letter => (guessedLetters.includes(letter) ? letter : '_')).join(' ');
}

function updateWrongLetters() {
    wrongLettersElement.innerHTML = "Wrong Letters: " + guessedLetters.filter(letter => !word.includes(letter)).join(', ');
}

function checkGameOver() {
    if (wrongGuesses >= maxWrongGuesses) {
        messageElement.innerHTML = "Game Over! The word was " + word;
        saveScoreButton.style.display = "block";
        restartGameButton.style.display = "block";
    } else if (word.split('').every(letter => guessedLetters.includes(letter))) {
        messageElement.innerHTML = "Congratulations! You've guessed the word!";
        saveScoreButton.style.display = "block";
        restartGameButton.style.display = "block";
    }
}

document.getElementById('submitGuess').addEventListener('click', function() {
    const input = document.getElementById('letterInput');
    const letter = input.value.toUpperCase(); 
    input.value = ''; 

    if (letter && !guessedLetters.includes(letter) && letter.length === 1) {
        guessedLetters.push(letter); 
        if (!word.includes(letter)) {
            wrongGuesses++; 
            updateWrongLetters(); 
        }
        displayWord(); 
        checkGameOver(); 
    }
});


saveScoreButton.addEventListener('click', function() {
    const playerName = prompt("Enter your name:");
    if (playerName) {
        const score = Math.max(0, (maxWrongGuesses - wrongGuesses) * 10); 
        fetch('hangman.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `player_name=${encodeURIComponent(playerName)}&score=${score}`,
        }).then(response => response.text()).then(data => {
            alert(data);
            window.location.reload(); 
        });
    }
});


restartGameButton.addEventListener('click', function() {
    window.location.reload(); 
});


displayWord();
