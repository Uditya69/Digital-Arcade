document.addEventListener('DOMContentLoaded', function () {
    const board = document.getElementById('tic-tac-toe-board');
    let currentPlayer = 'X';
    let boardState = ['', '', '', '', '', '', '', '', ''];

    function renderBoard() {
        board.innerHTML = '';
        boardState.forEach((cell, index) => {
            const cellDiv = document.createElement('div');
            cellDiv.classList.add('cell', 'bg-gray-800', 'text-center', 'text-5xl', 'flex', 'items-center', 'justify-center', 'cursor-pointer', 'hover:bg-gray-700', 'transition', 'w-24', 'h-24'); // Set fixed width and height
            cellDiv.textContent = cell;
            cellDiv.addEventListener('click', () => makeMove(index));
            board.appendChild(cellDiv);
        });
    }

    function makeMove(index) {
        if (boardState[index] === '') {
            boardState[index] = currentPlayer;
            currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
            renderBoard();
            checkWinner();
        }
    }

    function checkWinner() {
        const winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8], 
            [0, 3, 6], [1, 4, 7], [2, 5, 8], 
            [0, 4, 8], [2, 4, 6]
        ];
        winningCombinations.forEach(combo => {
            const [a, b, c] = combo;
            if (boardState[a] && boardState[a] === boardState[b] && boardState[a] === boardState[c]) {
                alert(boardState[a] + ' wins!');
                resetGame();
            }
        });
    }

    function resetGame() {
        boardState = ['', '', '', '', '', '', '', '', ''];
        renderBoard();
    }

    renderBoard();
});
