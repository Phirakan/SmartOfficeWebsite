<?php 
session_start();
include('../config/connectdb.php');

$error = array();

if(isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $role = 1;

    if (empty($username)) {
        array_push($error, "Username is required");
    }
    if (empty($email)) {
        array_push($error, "Email is required");
    }
    if (empty($password_1)) {
        array_push($error, "password is required");
    }
    if (empty($f_name)) {
        array_push($error, "first name is required");
    }
    if (empty($l_name)) {
        array_push($error, "last name is required");
    }
    if (empty($tel)) {
        array_push($error, "Phone Number is required");
    }
    if ($password_1 != $c_password) {
        array_push($error, "password do not match!!");
    }

    $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        if ($result['username'] === $username) {
            array_push($error, "Username already exists");
        }
        if ($result['email'] === $email) {
            array_push($error, "Email already exists");
        }
    }

    if (count($error) == 0) {
        $password = md5($password_1);
        $sql = "INSERT INTO user (username, password, f_name, l_name, email, tel, role) VALUES ('$username', '$password', '$f_name', '$l_name', '$email', '$tel', '$role')";
        mysqli_query($conn, $sql);
        
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header("Location: ../Page/home.php");
    }
}

?>