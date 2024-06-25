<?php 
    session_start();
    include("cfg/dbconnect.php");
    $name = $email = $pwd = $confirmpwd = "";
    $name_err = $email_err = $pwd_err = $confirmpwd_err = "";
    $succ_msg = $err_msg = "";
    $error = false;

    if(isset($_POST['submit'])){
        $name= trim($_POST['name']);
        $email= trim($_POST['email']) ;
        $pwd= trim ($_POST['pwd']);
        $confirmpwd= trim($_POST['confirmpwd']);

        //validate input
        if($name == ""){
            $name_err = "Please enter Name";
            $error = true;
        }
    
        if($email == ""){
            $email_err = "Please enter Email";
            $error = true;
        }
        
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_err = "Invalid Email format";
            $error = true;
        }
        else{
            $sql = "select * from users where email = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $email_err= "Email alreay registered";
                $error = true;
            }
        }
    
        if($pwd == ""){
            $pwd_err = "Please enter Password";
            $error = true;
        }
    
        if($confirmpwd == ""){
            $confirmpwd_err = "Please enter Confirm Password";
            $error = true;
        }

        if ($pwd != "" && $confirmpwd !=""){
            if($pwd != $confirmpwd){
                $confirmpwd_err = "Password do not match";
                $error = true;
            }
        }

        if(!$error){
            //proceed for register

            $pwd = password_hash($pwd, PASSWORD_DEFAULT); //hash the password

            $role = 1; //role for admin as 1

            $sql = "insert into users (name, email, password, role) values (?, ? ,?, ?)"; // query to insert

            try{

                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssss",$name,$email,$pwd,$role);
                $stmt->execute();
                
                $_SESSION['succ_msg'] = "Registration Successful.";
                header("location:login.php");
                exit();
            }

            catch(Exception $e){
                $err_msg = $e->getMessage();
            }
        }


    }

  


    include("topheader.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sign.css?v=1.1">

    
</head>
<body>
<h1>Sign Up</h1>
<?php 
if(!empty($succ_msg)){ ?>
    <div class="alert-msg-succ">
    <?= $succ_msg; ?>
    </div>

    <?php }?>

    <?php 
if(!empty($err_msg)){ ?>
    <div class="alert-msg-err">
    <?= $err_msg; ?>
    </div>

    <?php }?>

<div class="signup-box">

    <h4>It's free and only takes a minutes</h4>

    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" >
        <div class="text-danger input-err"><?= $name_err ?></div>
    
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" >
        <div class="text-danger input-err"><?= $email_err ?></div>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="pwd" placeholder="Enter your password" >
        <div class="text-danger input-err"><?= $pwd_err ?></div>
    
        <label for="confirmpwd">Confirm Password</label>
        <input type="password" id="confirmpwd" name="confirmpwd" placeholder="Re-Confirm your Password" >
        <div class="text-danger input-err"><?= $confirmpwd_err ?></div>


        <input class="form-check-input" 
        name="" id="" type="checkbox" value="checkedValue" aria-label="Text for screen reader" onclick = "showPwd()">
        <p class="spwd">Show password </p>

        <input type="submit" value="Submit" name="submit">


        <p class="p1">Already have an account? 
            <strong>
            <a href="login.php">Login Here</a>
            </strong>
        </p>
    </form>
    
    

    
    
</div>
    <script>
        function showPwd(){
            var pwd = document.querySelector("#password");
            var confirmpwd = document.querySelector("#confirmpwd");

            if(pwd.type === "text")
                pwd.type = "password";
                else
                pwd.type = "text";

            if(confirmpwd.type === "text")
                confirmpwd.type = "password";
                else
                confirmpwd.type = "text";
        }    
    </script>
</body>
</html>