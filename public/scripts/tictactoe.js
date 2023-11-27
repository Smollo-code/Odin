let currentPlayer = "X";
let gameOver = false;

function makeMove(cell) {
    if (!cell.textContent && !gameOver) {
        cell.textContent = currentPlayer;
        cell.classList.add(currentPlayer.toLowerCase());
        currentPlayer = currentPlayer === "X" ? "O" : "X";
        checkForWinner();
    }
}

function checkForWinner() {
    const cells = document.querySelectorAll(".cell");
    const winningCombinations = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8],
        [0, 3, 6], [1, 4, 7], [2, 5, 8],
        [0, 4, 8], [2, 4, 6]
    ];

    for (const combination of winningCombinations) {
        const [a, b, c] = combination;
        if (cells[a].textContent && cells[a].textContent === cells[b].textContent && cells[b].textContent === cells[c].textContent) {
            document.getElementById("message").textContent = `${cells[a].textContent} hat Gewonnen`;
            gameOver = true;
            return;
        }
    }

    if ([...cells].every(cell => cell.textContent)) {
        document.getElementById("message").textContent = "Unentschieden";
        gameOver = true;
    }
}

function resetGame() {
    const cells = document.querySelectorAll(".cell");
    for (const cell of cells) {
        cell.textContent = "";
        cell.classList.remove("x", "o");
    }
    document.getElementById("message").textContent = "";
    gameOver = false;
    currentPlayer = "X";
}
