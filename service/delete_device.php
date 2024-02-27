<?php
session_start();
include('../../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: ../home.php');
    exit();
}

$device_id = $_GET['id'];

$delete_query = "DELETE FROM device WHERE device_id = '$device_id'";
$result = mysqli_query($conn, $delete_query);

if ($result) {
    $_SESSION['success'] = "Device deleted successfully";
} else {
    $_SESSION['error'] = "Error deleting device";
}

header('location: ../Page/Device/manageDevice.php');
exit();
?>
