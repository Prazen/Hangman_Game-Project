<?php 
if(!isset($_SESSION) || session_id()=="" || session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hangman Game: English Edition</title>

    <!-- css=>home -->
    <link rel="stylesheet" href= "css/home.css?v=1.57" >

    <!-- font = anta -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">

</head>
<body>
<div class="header">
    <a href="homepage.php" class="logo">Hangman Game</a>
    <?php if (isset($_SESSION['name']) && $_SESSION['role'] == 1) { ?>
        <span id="admin-display"> Welcome <?=$_SESSION['name'] ?></span>
    <?php } ?>
    <nav class="navbar">
        <ul>
            <li><a href="homepage.php" class="active"><img src="Assets/home-svgrepo-com.svg" height="20"> Home</a></li>
            <li><a href="#"><img src="Assets/message-three-points-1560-svgrepo-com.svg" height="20"> About</a></li>
             <?php
            if(isset($_SESSION['name']) && $_SESSION['role'] == 1) {  ?>
                <li><a href="#"><img src="Assets/account-svgrepo-com.svg" height="20">Manage</a>
                <?php 
            } else if (isset($_SESSION['name'])){?>
            <li><a href="#"><img src="Assets/account-svgrepo-com.svg" height="20"> Account</a>
            <?php
        } ?>
            
                <div class="sub-menu1">
                    <ul>
                    <?php
                         if (isset($_SESSION['name'])){
                            if($_SESSION['role'] == 1 ) { 
                            ?>
                        <li><a href="adminpage.php">Word List</a></li>
                        <li><a href="userpage.php">User List</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <?php 
                            }
                            else{ 
                             ?>
                        <li><?= $_SESSION['name'] ?></a></li>
                        <li><a href="logout.php">Logout</a></li>
               <?php  
               }
             } else {
                ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <?php
            }
            ?>                    
                    </ul>
                </div>
            </li>
            <?php 
            if(isset($_SESSION['name']) && $_SESSION['role'] != 1) {  ?>
                <li><a href="gamepage.php"><img src="Assets/game-svgrepo-com.svg" height="20">Play Game</a></li>
                <?php 
            } else if (!isset($_SESSION['name'])){?>
            <li><a href="login.php"><img src="Assets/game-svgrepo-com.svg" height="20">Play Game</a></li>
            <?php
        } ?>
        </ul>
    </nav>
</div>
</body>
</html>
