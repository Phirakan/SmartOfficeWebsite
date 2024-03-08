<?php 
session_start();
include('../config/connectdb.php');

$error = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($error, "Username is required");
    }
    if (empty($password)) {
        array_push($error, "password is required");
    }

    if (count($error) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "";
            header("Location: ../Page/home.php");
        } else {
            array_push($error, "");
            $_SESSION['error'] = "";
            header("Location: ../Page/authentication/Login.php");
        }
    }
}


?>