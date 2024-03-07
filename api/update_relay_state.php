<?php

$servername = "68.168.213.74";
$username = "mosuuuut_green_office"; 
$password = "0952616334_"; 
$dbname = "mosuuuut_green_office";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$state = $_POST['state'];
$device_id = $_POST['device_id'];

date_default_timezone_set('Asia/Bangkok');

if ($state == 0) {
    
    $start_time = date('Y-m-d H:i:s');
    $sql = "INSERT INTO power_usage (device_id, datetime_start) VALUES ('$device_id', '$start_time')";
    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    
    $end_time = date('Y-m-d H:i:s');
    $sql = "UPDATE power_usage SET datetime_stop='$end_time' WHERE device_id='$device_id' AND datetime_stop IS NULL";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
