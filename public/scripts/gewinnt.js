document.addEventListener('DOMContentLoaded', function () {
    const board = document.getElementById('board');
    let currentPlayer = 1;

    // Create the game board
    for (let row = 0; row < 6; row++) {
        for (let col = 0; col < 7; col++) {
            const cell = document.createElement('div');
            cell.className = 'cell';
            cell.dataset.row = row;
            cell.dataset.col = col;
            cell.addEventListener('click', handleCellClick);
            board.appendChild(cell);
        }
    }

    function handleCellClick(event) {
        const clickedCell = event.target;
        const col = clickedCell.dataset.col;

        // Find the bottom-most empty cell in the selected column
        const cellsInColumn = document.querySelectorAll(`.cell[data-col="${col}"]`);
        let emptyCell;
        for (let i = cellsInColumn.length - 1; i >= 0; i--) {
            if (!cellsInColumn[i].classList.contains('player1') && !cellsInColumn[i].classList.contains('player2')) {
                emptyCell = cellsInColumn[i];
                break;
            }
        }

        if (emptyCell) {
            emptyCell.classList.add(`player${currentPlayer}`);
            if (checkForWin(emptyCell)) {
                alert(`Player ${currentPlayer} wins!`);
                resetGame();
            } else {
                currentPlayer = 3 - currentPlayer; // Switch player (1 <-> 2)
            }
        }
    }

    function checkForWin(cell) {
        const row = parseInt(cell.dataset.row);
        const col = parseInt(cell.dataset.col);

        function checkDirection(dx, dy) {
            let count = 1;
            let currentRow, currentCol;

            // Check in one direction
            currentRow = row + dy;
            currentCol = col + dx;
            while (currentRow >= 0 && currentRow < 6 && currentCol >= 0 && currentCol < 7 &&
            document.querySelector(`.cell[data-row="${currentRow}"][data-col="${currentCol}"]`).classList.contains(`player${currentPlayer}`)) {
                count++;
                currentRow += dy;
                currentCol += dx;
            }

            // Check in the opposite direction
            currentRow = row - dy;
            currentCol = col - dx;
            while (currentRow >= 0 && currentRow < 6 && currentCol >= 0 && currentCol < 7 &&
            document.querySelector(`.cell[data-row="${currentRow}"][data-col="${currentCol}"]`).classList.contains(`player${currentPlayer}`)) {
                count++;
                currentRow -= dy;
                currentCol -= dx;
            }

            return count >= 4;
        }

        // Check all directions
        return checkDirection(1, 0) || // Horizontal
            checkDirection(0, 1) || // Vertical
            checkDirection(1, 1) || // Diagonal \
            checkDirection(1, -1);   // Diagonal /
    }

    function resetGame() {
        const cells = document.querySelectorAll('.cell');
        cells.forEach(cell => {
            cell.classList.remove('player1', 'player2');
        });
        currentPlayer = 1;
    }
});
