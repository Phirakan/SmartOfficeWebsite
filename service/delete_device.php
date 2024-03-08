<?php
session_start();
include('../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: ../home.php');
    exit();
}

$device_id = $_GET['device_id'];

$delete_query = "DELETE FROM device WHERE device_id = '$device_id'";
$result = mysqli_query($conn, $delete_query);



header('location: ../Page/Device/manageDevice.php');
exit();
?>
