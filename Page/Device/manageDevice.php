<?php
session_start();
include('../../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: home.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../css/manage_device.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Navbar content -->
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
                    echo "<a href='../../service/delete_device.php?id=" . $row['device_id'] . "' class='btn btn-danger' onclick='return confirmDelete();'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this device?");
}
</script>
</body>
</html>
