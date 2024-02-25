<?php
session_start();
include('../config/connectdb.php');


if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: home.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/profile.css">
    <title>Add Room Page</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Smart Green Office</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="authentication/admin.php">Profile</a>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addroom.php">Add Room</a>
                </li>
            
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="authentication/dashboard.php">
                        <img src="../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
                    </a>
                </li>

            </ul>

            
        </div>
    </div>
    
    <?php
if(isset($_SESSION["username"])) {   
    echo '<li class="nav-item dropdown">';
    echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    echo $_SESSION["username"];
    echo '</a>';
    echo '<ul class="dropdown-menu" aria-labelledby="userDropdown">';
    echo '<li><a class="dropdown-item" href="authentication/profile.php">แสดงโปรไฟล์</a></li>'; // Add your dropdown options here
    echo '<li><a class="dropdown-item" href="authentication/dashboard.php">ไปยังหน้าแดชบอร์ด</a></li>';
    echo '<li><hr class="dropdown-divider"></li>';
    echo '<a href="../service/logout.php" style="color: black;">Logout</a>';
    echo '</ul>';
    echo '</li>';
    echo '<button class="button" id="form-open" onclick="Logout()">Logout</button>'; 
} else {
    echo '<button class="button" id="form-open" onclick="redirectToLogin()">Login</button>';
}
?>
</nav>
    <h1>Add Room Page</h1>

    <!-- ฟอร์มสำหรับเพิ่มข้อมูลห้อง -->
    <form action="../service/add_room_process.php" method="POST">
    <div class="mb-3">
        <label for="room_name">Room Name:</label><br>
        <input type="text" id="room_name" name="room_name"><br>
        </div>
        <div class="mb-3">
        <label for="user_id">User ID:</label><br>
        <input type="text" id="user_id" name="user_id"><br>
        <br>
        <a href="home.php">Back to Home</a>
        <br>
        <button type="submit" value="Add Room" class="btn btn-primary">Add room</button>
        </div>

        

        
    </form>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function Logout() {
            window.location.href = "../../service/logout.php";
        }
    </script>
</body>
</html>
