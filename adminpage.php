<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 2)) {
    // If the user is not an admin, redirect to the login page or another page
    header("location: login.php");
    exit;
}
include("cfg/dbconnect.php");
include("topheader.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/admin.css">

    <!-- Bootstrap cdn css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <h1 id="main_title">Manage The Word</h1>

    <?php
    if(isset($_GET['update_msg'])){
    echo '<h6 style="color:green;">'.$_GET['update_msg'].'</h6>';
    }
?>
    <?php
    if(isset($_GET['message'])){
    echo '<h6 style="color:red;">'.$_GET['message'].'</h6>';
    }
?>
<?php
    if(isset($_GET['delete_msg'])){
    echo '<h6 style="color:red;">'.$_GET['delete_msg'].'</h6>';
    }
?>

<?php
    if(isset($_GET['insert_msg'])){
    echo '<h6 style="color:green;">'.$_GET['insert_msg'].'</h6>';
    }
?>
    <div class="container">
    
    <div class="box1">
    <?php
            
            $sql = "SELECT * FROM `words`";
            $result = $con->query($sql);
       
            if (!$result) {
                die("Query Failed: " . $con->error);
            }
            
            // Display total records count
            $total_records = mysqli_num_rows($result);
            echo "<h5 id='record_display'>Total Words: " . $total_records . "</h5>"; 
            ?>

        <h2>All Words</h2>
            
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Words</button>
    </div>

    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>word</th>
                <th>hint</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM `words`";

                $result = $con->query($sql);
                
                if(!$result){
                    die("Query Failed".mysqli_error($con));
                }
                else{
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['word']; ?></td>
                            <td><?php echo $row['hint']; ?></td>
                            <td><a href="update-page.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
                            <td><a href="delete-page.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>

                        <?php
                    }
                }

            ?>
        </tbody>
    </table>

    
    
<!-- Modal -->
<form action = "cfg/insert_data.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Words</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label for="word">Word</label>
                <input type="text" name="word" class="form-control">

                <label for="hint">Hint</label>
                <input type="text" name="hint" class="form-control">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_words" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>
<!-- Bootstrap cdn js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

