let currentPlayer = 'player1';
let gameBoard = createEmptyBoard();

function createEmptyBoard() {
    const board = [];
    for (let row = 0; row < 6; row++) {
        const rowArray = [];
        for (let col = 0; col < 7; col++) {
            rowArray.push(null);
        }
        board.push(rowArray);
    }
    return board;
}

function dropCoin(column) {
    for (let row = 5; row >= 0; row--) {
        if (gameBoard[row][column] === null) {
            gameBoard[row][column] = currentPlayer;
            break;
        }
    }

    currentPlayer = (currentPlayer === 'player1') ? 'player2' : 'player1';
    updateBoardUI();

    const winner = checkWinner();
    if (winner) {
        document.getElementById('winner-display').innerHTML = `Spieler ${winner} hat gewonnen!`;

        // Optional: Hier kannst du weitere Aktionen nach dem Gewinn durchführen

        // Setze das Spielfeld zurück, um ein neues Spiel zu beginnen
        setTimeout(() => {
            document.getElementById('winner-display').innerHTML = '';
            gameBoard = createEmptyBoard();
            updateBoardUI();
        }, 2000); // Warte 2 Sekunden, bevor das Spielfeld zurückgesetzt wird (kann nach Bedarf angepasst werden)
    }
}


function updateBoardUI() {
    const boardElement = document.getElementById('board');
    boardElement.innerHTML = '';

    for (let row = 0; row < 6; row++) {
        for (let col = 0; col < 7; col++) {
            const cell = document.createElement('div');
            cell.className = 'cell';

            if (gameBoard[row][col] === 'player1') {
                cell.classList.add('player1');
            } else if (gameBoard[row][col] === 'player2') {
                cell.classList.add('player2');
            }

            boardElement.appendChild(cell);
        }
    }
}

function checkWinner() {
    // Überprüfe horizontal
    for (let row = 0; row < 6; row++) {
        for (let col = 0; col < 4; col++) {
            if (
                gameBoard[row][col] !== null &&
                gameBoard[row][col] === gameBoard[row][col + 1] &&
                gameBoard[row][col] === gameBoard[row][col + 2] &&
                gameBoard[row][col] === gameBoard[row][col + 3]
            ) {
                return gameBoard[row][col];
            }
        }
    }


    for (let row = 0; row < 3; row++) {
        for (let col = 0; col < 7; col++) {
            if (
                gameBoard[row][col] !== null &&
                gameBoard[row][col] === gameBoard[row + 1][col] &&
                gameBoard[row][col] === gameBoard[row + 2][col] &&
                gameBoard[row][col] === gameBoard[row + 3][col]
            ) {
                return gameBoard[row][col];
            }
        }
    }


    for (let row = 0; row < 3; row++) {
        for (let col = 0; col < 4; col++) {
            if (
                gameBoard[row][col] !== null &&
                gameBoard[row][col] === gameBoard[row + 1][col + 1] &&
                gameBoard[row][col] === gameBoard[row + 2][col + 2] &&
                gameBoard[row][col] === gameBoard[row + 3][col + 3]
            ) {
                return gameBoard[row][col];
            }
        }
    }


    for (let row = 0; row < 3; row++) {
        for (let col = 3; col < 7; col++) {
            if (
                gameBoard[row][col] !== null &&
                gameBoard[row][col] === gameBoard[row + 1][col - 1] &&
                gameBoard[row][col] === gameBoard[row + 2][col - 2] &&
                gameBoard[row][col] === gameBoard[row + 3][col - 3]
            ) {
                return gameBoard[row][col];
            }
        }
    }


    return null;
}

