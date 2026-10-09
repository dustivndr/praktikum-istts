window.addEventListener('load', function () {
    const boardElement = document.querySelector('#sudoku-board');
    const padElement = document.querySelector('#number-pad');
    const timerElement = document.querySelector('#timer');
    const mistakesElement = document.querySelector('#mistakes');
    const hintsElement = document.querySelector('#hints-left');
    const modal = document.querySelector('#modal');
    const solution = Array.from({ length: 9 }, () => Array(9).fill(0));
    const puzzle = Array.from({ length: 9 }, () => Array(9).fill(0));
    const player = Array.from({ length: 9 }, () => Array(9).fill(0));
    const notes = Array.from({ length: 9 }, () => Array.from({ length: 9 }, () => new Set()));
    let selected = null;
    let pencilMode = false;
    let mistakes = 0;
    let hints = 3;
    let seconds = 0;
    let timer;
    let gameOver = false;

    const shuffle = (array) => array.sort(() => Math.random() - 0.5);
    const valid = (grid, row, col, value) => {
        for (let i = 0; i < 9; i++) if (grid[row][i] === value || grid[i][col] === value) return false;
        const r = Math.floor(row / 3) * 3, c = Math.floor(col / 3) * 3;
        for (let i = r; i < r + 3; i++) for (let j = c; j < c + 3; j++) if (grid[i][j] === value) return false;
        return true;
    };
    const solve = (grid) => {
        for (let row = 0; row < 9; row++) for (let col = 0; col < 9; col++) {
            if (grid[row][col]) continue;
            for (const value of shuffle([1, 2, 3, 4, 5, 6, 7, 8, 9])) {
                if (valid(grid, row, col, value)) {
                    grid[row][col] = value;
                    if (solve(grid)) return true;
                    grid[row][col] = 0;
                }
            }
            return false;
        }
        return true;
    };
    const formatTime = (value) => `${String(Math.floor(value / 60)).padStart(2, '0')}:${String(value % 60).padStart(2, '0')}`;
    const showModal = (title, message, isGameOver = false) => {
        document.querySelector('#modal-title').textContent = title;
        document.querySelector('#modal-message').textContent = message;
        document.querySelector('#modal-icon').innerHTML = isGameOver
            ? '<i class="fa-solid fa-xmark"></i>'
            : '<i class="fa-solid fa-star"></i>';
        document.querySelector('#modal-primary').textContent = 'Main lagi';
        modal.hidden = false;
    };
    const closeModal = () => { modal.hidden = true; };
    const render = () => {
        boardElement.innerHTML = '';
        const selectedValue = selected ? (player[selected[0]][selected[1]] || puzzle[selected[0]][selected[1]]) : 0;
        for (let row = 0; row < 9; row++) for (let col = 0; col < 9; col++) {
            const cell = document.createElement('button');
            const value = puzzle[row][col] || player[row][col];
            cell.className = 'sudoku-cell';
            if (row % 3 === 2 && row !== 8) cell.classList.add('border-bottom');
            if (col % 3 === 2 && col !== 8) cell.classList.add('border-right');
            if (selected && (selected[0] === row || selected[1] === col || (Math.floor(selected[0] / 3) === Math.floor(row / 3) && Math.floor(selected[1] / 3) === Math.floor(col / 3)))) cell.classList.add('related');
            if (selectedValue && value === selectedValue) cell.classList.add('same-number');
            if (selected && selected[0] === row && selected[1] === col) cell.classList.add('selected');
            if (puzzle[row][col]) cell.classList.add('given');
            if (player[row][col]) cell.classList.add('user-number');
            cell.innerHTML = value ? `<span>${value}</span>` : [...notes[row][col]].sort().map((note) => `<i>${note}</i>`).join('');
            cell.addEventListener('click', () => { selected = [row, col]; render(); });
            boardElement.appendChild(cell);
        }
        padElement.querySelectorAll('button').forEach((button) => {
            const value = Number(button.dataset.value);
            const count = [...puzzle.flat(), ...player.flat()].filter((item) => item === value).length;
            button.disabled = count >= 9;
        });
    };
    const isComplete = () => puzzle.every((row, r) => row.every((value, c) => value || player[r][c] === solution[r][c]));
    const inputNumber = (value) => {
        if (!selected || gameOver || puzzle[selected[0]][selected[1]]) return;
        const [row, col] = selected;
        if (pencilMode) { notes[row][col].has(value) ? notes[row][col].delete(value) : notes[row][col].add(value); render(); return; }
        notes[row][col].clear();
        if (value !== solution[row][col]) {
            mistakes++;
            mistakesElement.textContent = mistakes;
            if (mistakes >= 3) { gameOver = true; showModal('Game over', 'Tiga kesalahan sudah tercatat. Coba puzzle baru!', true); }
            render(); return;
        }
        player[row][col] = value;
        render();
        if (isComplete()) finishGame();
    };
    const finishGame = () => {
        gameOver = true; clearInterval(timer);
        $.ajax({
            url: 'index.php?action=save_score',
            type: 'POST',
            data: { completion_time: seconds },
            dataType: 'json'
        }).done(() => {
            loadLeaderboard();
            showModal('Congratulations!', `Puzzle selesai dalam ${formatTime(seconds)}. Skormu sudah masuk leaderboard.`);
        }).fail(() => {
            showModal('Puzzle selesai!', `Waktu penyelesaianmu ${formatTime(seconds)}. Skor belum dapat disimpan ke leaderboard.`);
        });
    };
    const startGame = () => {
        clearInterval(timer); solution.forEach((row) => row.fill(0)); puzzle.forEach((row) => row.fill(0)); player.forEach((row) => row.fill(0)); notes.forEach((row) => row.forEach((set) => set.clear()));
        solve(solution); solution.forEach((row, r) => row.forEach((value, c) => { puzzle[r][c] = Math.random() < 0.42 ? value : 0; }));
        selected = null; pencilMode = false; mistakes = 0; hints = 3; seconds = 0; gameOver = false;
        mistakesElement.textContent = '0'; hintsElement.textContent = '3'; document.querySelector('[data-tool="pencil"]').classList.remove('active');
        timer = setInterval(() => { seconds++; timerElement.textContent = formatTime(seconds); }, 1000);
        render();
    };
    const loadLeaderboard = () => {
        $.ajax({
            url: 'index.php?action=leaderboard',
            type: 'GET',
            dataType: 'json'
        }).done((data) => {
            const list = document.querySelector('#leaderboard-list');
            list.innerHTML = data.items.length ? data.items.map((item, index) => `<div class="leader-row"><span class="rank">${String(index + 1).padStart(2, '0')}</span><span class="avatar">${item.username.slice(0, 1).toUpperCase()}</span><strong>${item.username}</strong><time>${formatTime(Number(item.completion_time))}</time></div>`).join('') : '<div class="empty-leader">Belum ada skor. Jadilah yang pertama!</div>';
        }).fail(() => {
            document.querySelector('#leaderboard-list').innerHTML = '<div class="empty-leader">Leaderboard belum tersedia.</div>';
        });
    };
    padElement.innerHTML = [1, 2, 3, 4, 5, 6, 7, 8, 9].map((value) => `<button data-value="${value}">${value}</button>`).join('');
    padElement.addEventListener('click', (event) => {
        if (event.target.matches('button')) inputNumber(Number(event.target.dataset.value));
    });
    document.querySelectorAll('[data-tool]').forEach((button) => button.addEventListener('click', () => {
        const tool = button.dataset.tool;
        if (tool === 'pencil') { pencilMode = !pencilMode; button.classList.toggle('active', pencilMode); }
        if (tool === 'erase' && selected && !puzzle[selected[0]][selected[1]]) { player[selected[0]][selected[1]] = 0; notes[selected[0]][selected[1]].clear(); render(); }
        if (tool === 'hint' && hints > 0 && selected && !puzzle[selected[0]][selected[1]] && !player[selected[0]][selected[1]]) { player[selected[0]][selected[1]] = solution[selected[0]][selected[1]]; hints--; hintsElement.textContent = hints; render(); if (isComplete()) finishGame(); }
    }));
    document.querySelector('#new-game').addEventListener('click', startGame);
    document.querySelector('#modal-primary').addEventListener('click', () => { closeModal(); startGame(); });
    startGame(); loadLeaderboard();
});
