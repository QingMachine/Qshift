<?php
//connect DB
$servername = "localhost";
$username = "root";
$password = "qing";
$dbname0 = "myDB";
$dbname = "sft";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
   {die("Connection failed: " . $conn->connect_error);} 
   //echo "Connected successfully";

if (!$conn) 
   {die("Connection failed: " . mysqli_connect_error());}
?>