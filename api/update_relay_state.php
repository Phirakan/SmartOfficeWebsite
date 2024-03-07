<?php
// เชื่อมต่อฐานข้อมูล
$servername = '68.168.213.74';
$username = 'mosuuuut_green_office';
$password = '0952616334_';
$database = 'mosuuuut_green_office';

$conn = new mysqli($servername, $username, $password, $database);


// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// เลือกฐานข้อมูล
$sql_select_db = "USE $database";
if ($conn->query($sql_select_db) === TRUE) {
    echo "Database selected successfully";
} else {
    echo "Error selecting database: " . $conn->error;
}

// เพิ่มข้อมูลลงในตาราง power_usage
$sql = "INSERT INTO power_usage (datetime_start, datetime_stop) VALUES (NOW(), NOW() + INTERVAL 5 MINUTE)";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
