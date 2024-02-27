<?php 
    session_start(); 
    include('../config/connectdb.php');

    if (!isset($_SESSION['username'] )) {
        $_SESSION['error'] = "You must log in first";
        header('location: home.php');
    }

    $username = $_SESSION['username'];
$query = "SELECT role FROM user WHERE username = '$username' AND role = 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "You don't have permission to access this page";
    header('location: home.php');
    exit();
}


    $sql = "SELECT user.*, room.room_name 
            FROM user 
            LEFT JOIN room ON user.id = room.user_id ORDER BY user.id ASC";
    $result = mysqli_query($conn, $sql);



?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>หน้าหลัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../css/home.css" rel="stylesheet">
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
                    <a class="nav-link active" href="admin.php">Manage Profile</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Room/manageroom.php">Manage Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Device/manageDevice.php">Manage Device</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
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
    echo '<li><a class="dropdown-item" href="dashboard.php">ไปยังหน้าแดชบอร์ด</a></li>';
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

    <h2>หน้าจัดการข้อมูล</h2>
    
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">ห้อง</th>
                    <th scope="col">เจ้าของ</th>
                    <th scope="col">username</th>
                    <th scope="col">ดูข้อมูล</th>
                    <th scope="col">แก้ไขข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['room_name'] . "</td>";
                    echo "<td>" . $row['f_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td><a href='profile.php?id=" . $row['id'] . "' class='btn btn-primary btn-menu'>แสดงข้อมูล</a></td>";
                    echo "<td><a href='edit_profile.php?id=" . $row['id'] . "' class='btn btn-danger btn-menu'>แก้ไขข้อมูล</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function Logout() {
            window.location.href = "../service/logout.php";
        }
    </script>
</body>
</html>
