<?php 
session_start();

if(!isset($_SESSION['name'])){
    header("location: login.php");
    exit;
}

include("topheader.php");

// include("cfg/dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/game.css?v=1.3">
</head>
<body>
    <div class="game-model">
        <div class="content">
            <img src="Assets/hangman-game-images/lost.gif" alt="gif">
            <h4>Game Over!</h4>
            <p>The Correct word was: <b>rainbow</b></p>
            <button class="play-again">Play Again</button>
            <div class="score-text"><b>Score: 0</b></div>
        </div>
    </div>

    <div class="container">
        <div class="hangman-box">
            <h1>Hangman Game</h1>
            <img src="Assets/hangman-game-images/hangman-0.svg" alt="hangman-img">
            
        </div>
        <div class="game-box">
            <ul class="word-display">
            </ul>
            <h4 class="hint-text">
                Hint: <b>Lorem ipsum dolor sit amet consectetur adipisicing elit.</b>
                <p></p>
            </h4>
            <h4 class="guesses-text">
                Incorrect guesses:
                <b>0 / 6</b>
            </h4>
            <div class="keyboard">
                
            </div>
        </div>
    </div>


    
    <script src="scripts/game.js" defer ></script>
    
    
</body>
</html>