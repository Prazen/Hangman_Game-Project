<?php
include('topheader.php');
include('cfg/dbconnect.php');
?>

<?php
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
   
        $sql = "SELECT * FROM `words` where `id` = '$id'";

        $result = $con->query($sql);
        
        if(!$result){
            die("Query Failed".mysqli_error($con));
        }
        else{
            $row = mysqli_fetch_assoc($result);
          
        }
    }
    
?>

<?php 
    if(isset($_POST['update_word'])){

        if(isset($_GET['id_new'])){
            $id_new = $_GET['id_new'];
        }
        $word = $_POST['word'];
        $hint = $_POST['hint'];

        $sql = "UPDATE `words` set `word` = '$word', `hint` = '$hint' where `id` = '$id_new'";

        $result = $con->query($sql);
        
        if(!$result){
            die("Query Failed".mysqli_error($con));
        }
        else{
            header('location: adminpage.php?update_msg=You have sucessfully updated the Word !');
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css?v1.58">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   
    <div class="container-update">
    <form action ="update-page.php?id_new=<?php echo $id;?>" method="post">
            <div class="form-group">
                <label for="word">Word</label>
                <input type="text" name="word" class="form-control"value="<?php echo $row['word']?>">
            </div>
            <div class="form-group">
                <label for="hint">Hint</label>
                <input type="text" name="hint" class="form-control"value="<?php echo $row['hint']?>">
            </div>
            <input type="submit" class="btn btn-success" name="update_word" value="UPDATE">
        </form>
    </div>
        
</body>
</html>
        
