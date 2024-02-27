<?php
session_start();
include('../config/connectdb.php');

// $id = $_GET['id'];

// echo $id;

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: ../Page/home.php');
    exit();
}

$username = $_SESSION['username'];
$user_id = $_GET['id'];
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Error: ID parameter is missing in the URL";
    header('location: ../Page/profile.php');
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] == 0) {
        $target_dir = "../upload/";
        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file);
        } else {
            $_SESSION['error'] = "File is not an image.";
            header('location: ../Page/profile.php');
            exit();
        }
    }

    $f_name = $_POST['firstName'];
    $l_name = $_POST['lastName'];
    $email = $_POST['email'];
    $tel = $_POST['phoneNumber'];

    $update_query = "UPDATE user SET f_name = '$f_name', l_name = '$l_name', email = '$email', tel = '$tel'";
    if (isset($target_file)) {
        $update_query .= ", img = '$target_file'";
    }

    $update_query .= " WHERE id = '$user_id'";
    
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        $_SESSION['success'] = "Profile updated successfully";
    } else {
        $_SESSION['error'] = "Error updating profile";
    }

    header('location: ../Page/profile.php?id=' . $user_id);
    exit();
} else {
    $_SESSION['error'] = "Invalid request";
    header('location: ../Page/profile.php?id=' . $user_id);
    exit();
}
?>
