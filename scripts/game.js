const keyboardDiv = document.querySelector(".keyboard");
const wordDisplay = document.querySelector(".word-display");
const hangmanImage = document.querySelector(".hangman-box img");
const guessesText = document.querySelector(".guesses-text b");
const gameModel = document.querySelector(".game-model");
const playAgainBtn = document.querySelector(".play-again");
const scoreText = document.querySelector(".score-text b");

let currentWord, correctLetters = [], wrongGuessCount = 0, score = 0, currentIndex = 0;
const maxGuesses = 6;
const maxScore = 20;

const resetGame = () => {

    //Reseting all game variablese and UI elements
    correctLetters = [];
    wrongGuessCount = 0;

    hangmanImage.src = `Assets/hangman-game-images/hangman-${wrongGuessCount}.svg`;
    guessesText.innerText = `${wrongGuessCount} / ${maxGuesses}`;
    keyboardDiv.querySelectorAll("button").forEach(btn => btn.disabled = false);
    wordDisplay.innerHTML = currentWord.split("").map(() => `<li class="letter"></li>`). join("");
    gameModel.classList.remove("show");
}

const getRandomWord = () => {
    // Selecting the next word and hint from the WordList based on the current index
    if(currentIndex >= wordList.length){
        // alert('Congrats! You have completed all the words!');
        currentIndex = 0;
        score = 0;
    }

     const { word, hint } = wordList[currentIndex];
     currentWord = word;
    console.log(word);
     document.querySelector(".hint-text b").innerHTML = hint;
     resetGame();
    
}

const gameOver = (isVictory) => {
    //After 300ms of game complete .. showing model with 
    setTimeout(() =>{
        const modelText = isVictory ? `You found the word:` : `The correct word was:`;

        gameModel.querySelector("img").src = `Assets/hangman-game-images/${isVictory ?'victory' : 'lost'}.gif`;

        gameModel.querySelector("h4").innerText = `${isVictory ? 'Congrats!' : 'Game Over!'}`;

        gameModel.querySelector("p").innerHTML= `${modelText} <b>${currentWord}</b>`;

        gameModel.classList.add("show");

        if (isVictory){
            score++;
            scoreText.innerHTML = `Score: ${score}`;
            currentIndex++; //if each word is completed then index will also update by 1.
            if(score >= maxScore){
                setTimeout(() => {
                    alert('Congrats! You have completed all 20 words!');
                    scoreText.innerText = `Your Final Score: ${score}`;
                    playAgainBtn.style.display = 'block';
                }, 1000);
            }else{
                setTimeout(getRandomWord, 1000);
                playAgainBtn.style.display = 'none';
                // Automatically start a new round after 1 second
            }
        }else{
            currentIndex = 0; // if word is not complete then word index set to 0 {reset}.
            scoreText.innerHTML = `Your Final Score: ${score}`;
            playAgainBtn.style.display = 'block';
        }
    },300);
}

const initGame = (button, clickedLetter) => {
    //Checking if clickedLetter is exist on the currentWord
    if(currentWord.includes(clickedLetter)){
        //Showing all correct letters on the word display
        [...currentWord].forEach((letter, index) =>{
            if(letter === clickedLetter){
                correctLetters.push(letter);
                wordDisplay.querySelectorAll("li")[index].innerText = letter;
                wordDisplay.querySelectorAll("li")[index].classList.add("guessed");
            }
        });
    }
    else{
        // If clicked letter doesn't exist then update the wrongGuessCount and hangman image 
        wrongGuessCount++;
        hangmanImage.src = `Assets/hangman-game-images/hangman-${wrongGuessCount}.svg`;

    }

    button.disabled = true;
    guessesText.innerText = `${wrongGuessCount} / ${maxGuesses}`;

    //Calling gameOver function if any of these conditioon meets
    if(wrongGuessCount === maxGuesses) return gameOver(false);
    if(correctLetters.length === currentWord.length) return gameOver(true);
}

//Creating keyboard Button dynamically by click
for (let i=97; i<=122; i++){
    const button = document.createElement("button");
    button.innerText = String.fromCharCode(i);
    keyboardDiv.appendChild(button);
    button.addEventListener("click", e => initGame(e.target, String.fromCharCode(i)));
}
getRandomWord();

playAgainBtn.addEventListener("click" , () =>{
    playAgainBtn.style.display = 'none';
    score = 0 ;
    scoreText.innerHTML = `Score: ${score}`;
    getRandomWord();
});