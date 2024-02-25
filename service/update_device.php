<?php
session_start();
include('../config/connectdb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['device_id']) && isset($_POST['room_id']) && isset($_POST['device_name']) && isset($_POST['watt']) && isset($_POST['ip_sensor'])) {
        $device_id = $_POST['device_id'];
        $room_id = $_POST['room_id'];
        $device_name = $_POST['device_name'];
        $watt = $_POST['watt'];
        $ip_sensor = $_POST['ip_sensor'];

        $update_query = "UPDATE device SET room_id = '$room_id', watt = '$watt', ip_sensor = '$ip_sensor', device_name = '$device_name' WHERE device_id = '$device_id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            $_SESSION['success'] = "Device updated successfully";
            header('location: ../Page/manageDevice.php');
            exit();
        } else {
            $_SESSION['error'] = "Error updating device";
            header('location: manage_device.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Missing data";
        header('location: manage_device.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request";
    header('location: manage_device.php');
    exit();
}
?>
