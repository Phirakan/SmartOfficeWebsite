<?php
session_start();
include('../../config/connectdb.php');

if (!isset($_SESSION['username'])) {
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

$sql = "SELECT device.*, room.room_name 
        FROM device 
        INNER JOIN room ON device.room_id = room.room_id";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Devices</title>
    <link rel="icon" href="../../asset/logo2.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../css/home.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <a class="navbar-brand" href="../home.php">Smart Green Office</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../admin.php">Manage Profile</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Room/manageroom.php">Manage Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manageDevice.php">Manage Device</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php">
                        <img src="../../asset/dashboard.png" alt="Dashboard" class="dashboard-icon">
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
    echo '<li><a class="dropdown-item" href="../profile.php">แสดงโปรไฟล์</a></li>'; // Add your dropdown options here
    echo '<li><a class="dropdown-item" href="../dashboard.php">ไปยังหน้าแดชบอร์ด</a></li>';
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

<div class="container mt-5">
    <h2>Manage Devices</h2>
    <a href="add_device.php" class="btn btn-primary mb-3">Add Device</a>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Device ID</th>
                    <th>Room Name</th>
                    <th>Device Name</th>
                    <th>Watt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['device_id'] . "</td>";
                    echo "<td>" . $row['room_name'] . "</td>";
                    echo "<td>" . $row['device_name'] . "</td>";
                    echo "<td>" . $row['watt'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_device.php?id=" . $row['device_id'] . "' class='btn btn-primary'>Edit</a> ";
                    echo "<a href='../../service/delete_device.php?device_id=" . $row['device_id'] . "' class='btn btn-danger' onclick='return confirmDelete();'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
  <center><a href="../home.php" class="btn btn-danger">Back to home page</a> </center> 
   
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this device?");
}
</script>
</body>
</html>
