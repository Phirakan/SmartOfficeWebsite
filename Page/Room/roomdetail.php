<?php 
    session_start(); 
    include('../../config/connectdb.php');

    // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
    if (!isset($_SESSION['username'] )) {
        $_SESSION['error'] = "You must log in first";
        header('location: home.php');
        exit();
    }

    $username = $_SESSION['username'];
    $query = "SELECT role FROM user WHERE username = '$username' AND role = 1";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = "You don't have permission to access this page";
        header('location: ../home.php');
        exit();
    }
    

    // ตรวจสอบว่ามีการระบุ ID ของห้องใน URL หรือไม่
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        $_SESSION['error'] = "Room ID is missing in the URL";
        header('location: manageroom.php');
        exit();
    }

    // ดึงข้อมูลของห้องพร้อมกับเจ้าของ
    $room_id = $_GET['id'];
    $sql = "SELECT user.*, room.room_name 
        FROM user 
        INNER JOIN room ON user.id = room.user_id 
        WHERE room.room_id = $room_id";

    $result = mysqli_query($conn, $sql);
    $room_data = mysqli_fetch_assoc($result);

    // ดึงข้อมูลเครื่องใช้ไฟฟ้าในห้อง
    $device_sql = "SELECT * FROM device WHERE room_id = $room_id";
    $device_result = mysqli_query($conn, $device_sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Room Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../css/home.css" rel="stylesheet">
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
                    <a class="nav-link active" href="manage_room.php">Manage Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addroom.php">Add Room</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <img src="../../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
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
        echo '<li><a class="dropdown-item" href="authentication/profile.php">View Profile</a></li>'; // Add your dropdown options here
        echo '<li><a class="dropdown-item" href="authentication/dashboard.php">Go to Dashboard</a></li>';
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

<div class="container-fluid">
    <h2>Room Detail</h2>
    <div class="row">
        <div class="col-md-6">
            <h3><?php echo $room_data['room_name']; ?></h3>
            <p><strong>Owner:</strong> <?php echo $room_data['f_name']; ?></p>
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-6">
        <h3>Devices in the Room</h3>
        <ul>
            <?php
            $total_watt = 0; 
            while ($device = mysqli_fetch_assoc($device_result)) : 
                $total_watt += $device['watt']; 
            ?>
                <li><?php echo $device['device_name'] . " : " . $device['watt'] . " Watt"; ?></li>
            <?php endwhile; ?>
        </ul>
        <p><strong>Total Watt in the Room:</strong> <?php echo $total_watt; ?> Watt</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    function Logout() {
        window.location.href = "../../service/logout.php";
    }
</script>
</body>
</html>
