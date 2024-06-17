<?php
include ("dbconnect.php");

if (isset($_POST['add_words'])) {
    $word = $_POST['word'];
    $hint = $_POST['hint'];

    // Check if word or hint is empty
    if (empty($word) || empty($hint)) {
        header('location: ../adminpage.php?message=You need to fill the words!');
        exit; // Ensure script stops executing after redirect
    } 
    else {
        // Used prepared to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO `words` (`word`, `hint`) VALUES (?, ?)");
        $stmt->bind_param("ss", $word, $hint);

        if ($stmt->execute()) { //execute the stmt
            header('location: ../adminpage.php?insert_msg=Data has been added successfully');
        } else {
            die("Query Failed: " . $stmt->error); //if error occurs the msg display
        }

        $stmt->close();
    }
}
?>