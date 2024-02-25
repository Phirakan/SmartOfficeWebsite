<?php
session_start();
include('../config/connectdb.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $user_id = $_POST['user_id'];
    
    $sql = "INSERT INTO room (room_name, user_id) VALUES ('$room_name', '$user_id')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Room added successfully";
        header('location: ../Page/home.php');
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        header('location: ../Page/home.php');
    }
} else {
    header('location: ../Page/home.php');
}

?>
