<?php 
include("cfg/dbconnect.php");
$sql= "SELECT word, hint FROM words ORDER BY CHAR_LENGTH(word) ASC LIMIT 5";
$result = $con->query($sql);

$words = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $words[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($words);

$con->close();
?>