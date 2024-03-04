<?php

$servername = '68.168.213.74';
$username = 'mosuuuut_green_office';
$password = '0952616334_';
$database = 'mosuuuut_green_office';

// Create connection
$conn = new mysqli($servername, $username, $password, $database );
// Check connection
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}
//echo"Connected successfully.<br>";
$sql = "SET NAMES UTF8";
$conn->query($sql);

?>
