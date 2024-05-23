<?php
$server = "localhost";
$user = "root";
$pwd = "";
$db_name = "test";

$con = new mysqli($server,$user,$pwd,$db_name);

if($con->connect_error){
    die("Database connection error".$con->connect_error);
}