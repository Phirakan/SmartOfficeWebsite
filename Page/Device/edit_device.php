<?php
session_start();
include('../../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: home.php');
    exit();
}
$username = $_SESSION['username'];
$query = "SELECT role FROM user WHERE username = '$username' AND role = 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "You don't have permission to access this page";
    header('location: ../home.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $device_id = $_POST['device_id'];
    $room_id = $_POST['room_id'];
    $watt = $_POST['watt'];
    $ip_sensor = $_POST['ip_sensor'];

    $update_query = "UPDATE device SET room_id = '$room_id', watt = '$watt', ip_sensor = '$ip_sensor' WHERE device_id = '$device_id'";
    
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        $_SESSION['success'] = "Device updated successfully";
    } else {
        $_SESSION['error'] = "Error updating device";
    }

    header('location: manageDevice.php');
    exit();
}

$device_id = $_GET['id'];
$select_query = "SELECT * FROM device WHERE device_id = '$device_id'";
$result = mysqli_query($conn, $select_query);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Device</title>
    <link rel="icon" href="../../asset/logo2.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Device</h2>
    <form action="../../service/update_device.php" method="post">
        <input type="hidden" name="device_id" value="<?php echo $row['device_id']; ?>">
        <div class="mb-3">
            <label for="room_id" class="form-label">Room ID</label>
            <input type="text" class="form-control" id="room_id" name="room_id" value="<?php echo $row['room_id']; ?>">
        </div>
        <div class="mb-3">
            <label for="device_name" class="form-label">Device</label>
            <input type="text" class="form-control" id="device_name" name="device_name" value="<?php echo $row['device_name']; ?>">
        </div>
        <div class="mb-3">
            <label for="watt" class="form-label">Watt</label>
            <input type="text" class="form-control" id="watt" name="watt" value="<?php echo $row['watt']; ?>">
        </div>
        <div class="mb-3">
            <label for="ip_sensor" class="form-label">IP Sensor</label>
            <input type="text" class="form-control" id="ip_sensor" name="ip_sensor" value="<?php echo $row['ip_sensor']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Device</button>
    </form>
</div>

</body>
</html>
