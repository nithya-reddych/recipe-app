<?php
// Establish connection info
$server = "localhost"; 
$userid = "upanpimffcnbg";      
$pw = "ecompro@123";          
$db = "dbej74bmqzcm2d";      

// Create connection
$conn = new mysqli($server, $userid, $pw, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
