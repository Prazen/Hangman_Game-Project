<?php 
    session_start();
    include("cfg/dbconnect.php");
    $email = $pwd = "";
    $email_err = $pwd_err = "";
    $err_msg = "";
    $error = false;
    $succ_msg = "";


    if (isset($_SESSION['succ_msg'])) {
        $succ_msg = $_SESSION['succ_msg'];
        unset($_SESSION['succ_msg']);
    }


    if(isset($_POST['submit'])){
        $email= trim($_POST['email']) ;
        $pwd= trim ($_POST['pwd']);  

        //validate input
        if($email == ""){
            $email_err = "Please enter Email";
            $error = true;
        }
        
        if($pwd == ""){
            $pwd_err = "Please enter Password";
            $error = true;
        }
    

        if(!$error){
            //proceed for login
          $sql = "select *, SUBSTRING_INDEX(name,' ',1) AS first_name FROM users where email = ?";
          $stmt = $con->prepare($sql);
          $stmt->bind_param("s",$email);
          $stmt->execute();
          $result= $stmt->get_result();

            if($result->num_rows == 1){
                $row = $result->fetch_assoc(); 
                $stored_pwd = $row['password']; 

                if(password_verify($pwd, $stored_pwd)){
                    //successful login

                    $_SESSION['name'] = $row['first_name'];
                    $_SESSION['role'] = $row['role'];

                    if($row['role'] == 1){
                        header("Location: homepage.php");
                    }
                    else{
                        header("location: gamepage.php");
                    }
                    
                }
                else{
                    $err_msg = "Incorrect Password";
                }
            }
            else{
                $err_msg = "Email is not Registered";
            }

        }


    }


    include("topheader.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sign.css?v=1.2">

    
</head>
<body>
<h1>Login</h1>
    <?php 
    if (!empty($succ_msg)) { ?>
    <div class="alert-msg-succ">
    <?= $succ_msg; ?>
    </div>
    <?php } ?>

    <?php 
if(!empty($err_msg)){ ?>
    <div class="alert-msg-err">
    <?= $err_msg; ?>
    </div>

    <?php }?>

<div class="login-box">

    <form action="" method="post">
    
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= $email ?>">
        <div class="text-danger input-err"><?= $email_err ?></div>
        

        <label for="password">Password</label>
        <input type="password" id="password" name="pwd" placeholder="Enter your password" >
        <div class="text-danger input-err"><?= $pwd_err ?></div>


        <input class="form-check-input" 
        name="remember" id="" type="checkbox" value="checkedValue" aria-label="Text for screen reader">
        <p class="spwd">Remember Me </p>

        <input type="submit" value="login" name="submit">


        <p class="p1">Not Registered? 
            <strong><a href="signup.php">Register Here</a></strong>
        </p>
    </form>
</div>
   
</body>
</html>
