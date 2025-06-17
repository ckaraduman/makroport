document.addEventListener("DOMContentLoaded", () => {
    const word = document.body.dataset.word.toLowerCase();
    const maxTries = 6;
    const wordLength = word.length;
    let currentTry = 0;
    let currentGuess = "";

    const board = document.getElementById("board");
    const keyboard = document.getElementById("keyboard");

    // Satırları oluştur
    for (let i = 0; i < maxTries; i++) {
        const row = document.createElement("div");
        row.className = "word-row";
        for (let j = 0; j < wordLength; j++) {
            const box = document.createElement("div");
            box.className = "letter-box";
            row.appendChild(box);
        }
        board.appendChild(row);
    }

    // Klavyeyi oluştur
const keyRows = [
    ['Q','W','E','R','T','Y','U','I','O','P','Ğ','Ü'],
    ['A','S','D','F','G','H','J','K','L','Ş','İ'],
    ['Z','X','C','V','B','N','M','Ö','Ç'],
    ['Backspace', 'Enter']
];

    keyRows.forEach(row => {
        const rowDiv = document.createElement("div");
        rowDiv.className = "keyboard-row";

        row.forEach(key => {
            const button = document.createElement("button");
            button.textContent = key;
            button.className = "keyboard-key";
            if (key === "Backspace" || key === "Enter") {
                button.classList.add("wide");
            }

            button.addEventListener("click", () => {
                handleKey(
                    key === 'Backspace' ? "Backspace" :
                    key === 'Enter' ? "Enter" :
                    key.toLowerCase()
                );
            });

            rowDiv.appendChild(button);
        });

        keyboard.appendChild(rowDiv);
    });

    function updateRow() {
        const rows = document.querySelectorAll(".word-row");
        const currentRow = rows[currentTry];
        const boxes = currentRow.querySelectorAll(".letter-box");
        boxes.forEach((box, i) => {
            box.textContent = currentGuess[i] || "";
        });
    }

    function handleKey(key) {
        if (currentTry >= maxTries) return;

        if (key === "Enter") {
            if (currentGuess.length === wordLength) {
                checkGuess();
            }
        } else if (key === "Backspace") {
            currentGuess = currentGuess.slice(0, -1);
            updateRow();
        } else if (/^[a-zA-ZğüşıöçĞÜŞİÖÇ]$/.test(key) && currentGuess.length < wordLength) {
            currentGuess += key;
            updateRow();
        }
    }

    function checkGuess() {
        const rows = document.querySelectorAll(".word-row");
        const currentRow = rows[currentTry];
        const boxes = currentRow.querySelectorAll(".letter-box");
        const guess = currentGuess.toLowerCase();

        const letterCount = {};
        for (let l of word) {
            letterCount[l] = (letterCount[l] || 0) + 1;
        }

        boxes.forEach(box => {
            box.classList.remove("correct", "present", "absent");
        });

        for (let i = 0; i < wordLength; i++) {
            if (guess[i] === word[i]) {
                boxes[i].classList.add("correct");
                letterCount[guess[i]]--;
            }
        }

        for (let i = 0; i < wordLength; i++) {
            if (guess[i] !== word[i]) {
                if (letterCount[guess[i]] > 0) {
                    boxes[i].classList.add("present");
                    letterCount[guess[i]]--;
                } else {
                    boxes[i].classList.add("absent");
                }
            }
        }

        if (guess === word) {
            setTimeout(() => alert("🎉 Doğru tahmin!"), 300);
        } else {
            currentTry++;
            if (currentTry >= maxTries) {
                setTimeout(() => alert("❌ Tahmin hakkınız bitti! Kelime: " + word), 300);
            }
            currentGuess = "";
        }
    }

    document.addEventListener("keydown", (e) => {
        handleKey(e.key);
    });
});

