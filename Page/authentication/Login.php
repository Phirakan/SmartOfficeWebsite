<?php
include('../../config/connectdb.php');
session_start(); // ตรวจสอบ session ทุกรายการ
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Login&Register Page </title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="../../service/register_db.php" method="post">
                <h1>Create Account</h1>
                  
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" id="username" placeholder="Username" name="username" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <input type="password" id="c_password" placeholder="Confirm Password" name="c_password" required>
            <input type="f_name" id="f_name" placeholder="First Name" name="f_name" required>
            <input type="l_name" id="l_name" placeholder="Last Name" name="l_name" required>
            <input type="email" id="email" placeholder="Email" name="email" required>
            <input type="tel" id="tel" placeholder="PhoneNumber" name="tel" required>
                <button class="button" type="submit" name="reg_user">Register</button>
            </form>
             </form>
        </div>

        
        <div class="form-container sign-in">
            <form action="../../service/login_db.php"  method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your Username password</span>
                <input type="text" placeholder="Username" id="username" name="username" required>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <a href="#">Forget Your Password?</a>
                <button class="button" type="submit" name="login_user">Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend! Welcome to Your smart Office Website</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
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
