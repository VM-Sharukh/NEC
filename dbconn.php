<?php

date_default_timezone_set("Asia/Kolkata"); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NEC";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

include "functions.php";

?>	