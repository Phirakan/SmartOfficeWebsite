<?php
session_start();
include('../config/connectdb.php');

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: ../Page/home.php');
    exit();
}

// ตรวจสอบว่ามีการระบุ ID ของผู้ใช้ใน URL หรือไม่
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "User ID is missing in the URL";
    header('location: ../Page/admin.php');
    exit();
}

$user_id = $_GET['id'];

// ลบผู้ใช้ออกจากระบบ
$remove_user_query = "DELETE FROM user WHERE id = $user_id";

if (mysqli_query($conn, $remove_user_query)) {
    $_SESSION['success'] = "User removed successfully";
} else {
    $_SESSION['error'] = "Error removing user: " . mysqli_error($conn);
}

header('location: ../Page/admin.php');
exit();
?>
