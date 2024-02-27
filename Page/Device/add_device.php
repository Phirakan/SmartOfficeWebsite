<?php
session_start();
include('../../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: ../home.php');
    exit();
}
if ($_SESSION['role'] != 1) {
    header('location: ../home.php');
     exit();
 }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $watt = $_POST['watt'];
    $ip_sensor = $_POST['ip_sensor'];

    $insert_query = "INSERT INTO device (room_id, watt, ip_sensor) VALUES ('$room_id', '$watt', '$ip_sensor')";
    
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        $_SESSION['success'] = "Device added successfully";
    } else {
        $_SESSION['error'] = "Error adding device";
    }

    header('location: manage_device.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Device</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2>Add Device</h2>
    <form action="../service/add_device_process.php" method="post">
        <div class="mb-3">
            <label for="room_id" class="form-label">Room ID</label>
            <input type="text" class="form-control" id="room_id" name="room_id">
        </div>
        <div class="mb-3">
            <label for="device_name" class="form-label">Device</label>
            <input type="text" class="form-control" id="device_name" name="device_name">
        </div>
        <div class="mb-3">
            <label for="watt" class="form-label">Watt</label>
            <input type="text" class="form-control" id="watt" name="watt">
        </div>
        <div class="mb-3">
            <label for="ip_sensor" class="form-label">IP Sensor</label>
            <input type="text" class="form-control" id="ip_sensor" name="ip_sensor">
        </div>
        <button type="submit" class="btn btn-primary">Add Device</button>
    </form>
</div>

</body>
</html>
