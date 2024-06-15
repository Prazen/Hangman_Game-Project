<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "css/home.css?v=1.3" >

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">

</head>
<body>
<div id="middle-container">
        <div class="h1-caption">"Explore the words,</div>
        <div class="h2-caption">While Challenging yourself"</div>
        <p></p>


        <?php
                    if (isset($_SESSION['name'])) { ?>
                        <a href="gamepage.php" class="play-button" type="button">Play Now</a>
                 <?php   }
                  else{ ?>
                  <a href="login.php" class="play-button" type="button">Play Now</a>
           <?php  }?>
        
</div>
</body>
</html>
