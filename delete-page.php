<?php include('cfg/dbconnect.php')?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql = "DELETE from `words` WHERE `id` = '$id'";

    $result= mysqli_query($con, $sql);

    if(!$result){
        die("Query Failed".mysqli_error($con));
    }
    else{
        header('location:adminpage.php?delete_msg=You have deleted the WORD!');
    }
?>