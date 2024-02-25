<?php
session_start();
include('../config/connectdb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
    if (isset($_POST['room_id']) && isset($_POST['watt']) && isset($_POST['ip_sensor'])) {
        // รับค่าจากฟอร์ม
        $room_id = $_POST['room_id'];
        $watt = $_POST['watt'];
        $ip_sensor = $_POST['ip_sensor'];

        // ตรวจสอบความถูกต้องของข้อมูล

        // เพิ่มข้อมูลใหม่ลงในฐานข้อมูล
        $insert_query = "INSERT INTO device (room_id, watt, ip_sensor) VALUES ('$room_id', '$watt', '$ip_sensor')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            $_SESSION['success'] = "Device added successfully";
            header('location: ../Page/manageDevice.php');
            exit();
        } else {
            $_SESSION['error'] = "Error adding device";
            header('location: ../Page/add_device.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Missing data";
        header('location: ../Page/add_device.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request";
    header('location: ../Page/add_device.php');
    exit();
}
?>
