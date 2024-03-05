<?php
include('../../config/connectdb.php');
session_start(); // ตรวจสอบ session ทุกรายการ

$username = $_SESSION['username'];
$query = "SELECT role FROM user WHERE username = '$username' AND role = 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "You don't have permission to access this page";
    header('location: ../home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="../../asset/logo2.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../css/admin_register.css">
    <title>Admin Register Page </title>
</head>

<body>

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="../../service/admin_register_db.php" method="post">
            <h1>Create Account</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <input type="text" id="username" placeholder="Username" name="username" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <input type="password" id="c_password" placeholder="Confirm Password" name="c_password" required>
            <input type="f_name" id="f_name" placeholder="First Name" name="f_name" required>
            <input type="l_name" id="l_name" placeholder="Last Name" name="l_name" required>
            <input type="email" id="email" placeholder="Email" name="email" required>
            <input type="tel" id="tel" placeholder="PhoneNumber" name="tel" required>
            <button class="button" type="submit" name="reg_user">Register</button>
        </form>
    </div>
</div>

    <script src="../../service/script.js"></script>
</body>

</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   

<script>
  function Logout() {
            window.location.href = "../../service/logout.php";
        }
</script>
</body>
</html>
