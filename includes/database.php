<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "phpfun";

$conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

if ($conn){

}
else{
    die("Database connection failed!");
}
?>